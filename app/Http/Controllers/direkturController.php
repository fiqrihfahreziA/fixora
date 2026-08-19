<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\bidang;
use App\Models\detail_barang;
use App\Models\barang_tersedia;
use App\Models\pengajuan;
use App\Models\pengajuan_item;
use Illuminate\Support\Facades\DB; 
use App\Models\RequestModel;
use Illuminate\Support\Facades\Auth;


class direkturController extends Controller
{
   public function index()
    {
        $authUser = Auth::user();

        
        return view('direktur.dashboard', [
            'authUser' => $authUser,
        ]);
    }

      public function showpengadaan(Request $request)
    {
        $authUser = Auth::user();
        
        // Ambil query pencarian
        $search = $request->input('search');
        $statusFilter = $request->input('status');

        /**
         * ============================
         * QUERY DASAR PENGADAAN (SEMUA)
         * TAMPILKAN SEMUA STATUS KECUALI:
         * - draft, revisi, diajukan, disetujui_koordinator
         * ============================
         */
        $query = Pengajuan::with(['items', 'karyawan', 'bidang'])
            ->whereNotIn('status', ['diajukan', 'draft', 'revisi', 'disetujui_koordinator'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('no_pengajuan', 'like', "%{$search}%")
                        ->orWhere('dasar_usulan', 'like', "%{$search}%")
                        ->orWhereHas('items', function ($itemQuery) use ($search) {
                            $itemQuery->where('nama_barang', 'like', "%{$search}%")
                                ->orWhere('spesifikasi', 'like', "%{$search}%");
                        });
                });
            })
            ->when($statusFilter, function ($q) use ($statusFilter) {
                $q->where('status', $statusFilter);
            });

        /**
         * ============================
         * DATA UNTUK TABEL SEMUA PENGAJUAN
         * ============================
         */
        $allPengajuan = clone $query;
        $allPengajuan = $allPengajuan->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());

        /**
         * ============================
         * STATISTIK DASHBOARD
         * ============================
         */
        $stats = [
            'total' => Pengajuan::whereNotIn('status', ['diajukan', 'draft', 'revisi', 'disetujui_koordinator'])->count(),
            'draft' => Pengajuan::where('status', 'draft')->count(),
            'diajukan' => Pengajuan::where('status', 'diajukan')->count(),
            'disetujui' => Pengajuan::where('status', 'disetujui')->count(),
            'ditolak' => Pengajuan::where('status', 'ditolak')->count(),
            'menunggu_direktur' => Pengajuan::where('status', 'menunggu_direktur')->count(),
            'disetujui_kabid' => Pengajuan::where('status', 'disetujui_kabid')->count(),
        ];

        return view('direktur.pengadaan.pengadaan', compact(
            'authUser',
            'allPengajuan',
            'search',
            'statusFilter',
            'stats'
        ));
    }

        public function detail($id)
    {
        $authUser = Auth::user();
        $pengajuan = Pengajuan::with(['items', 'karyawan', 'bidang'])->findOrFail($id);
        
        return view('direktur.pengadaan.detail', compact('authUser', 'pengajuan'));
    }

    public function setujui(Request $request, $id)
{
    $request->validate([
        // 'status_verifikasi' => 'required|in:disetujui_koordinator,ditolak,revisi',
        // 'catatan_verifikasi' => 'required|string|min:5',
        'direktur_id' => 'required'
    ]);
    
    $pengajuan = Pengajuan::findOrFail($id);
    $pengajuan->update([
        'status' => 'disetujui',
        'log_status_direktur' => 'disetujui',
        'total_disetujui_direktur' => $pengajuan->total_disetujui,
        'direktur_id' =>  $request->direktur_id,
        'disetujui_direktur_at' => now(),
        'catatan_direktur' => request('catatan_direktur')
    ]);
    return redirect()->route('direktur.pengadaan')->with('success', 'Pengajuan berhasil diverifikasi (anggaran tersedia penuh).');
}


    public function setujuii(Request $request, $id)
{
    $request->validate([
        'direktur_id' => 'required'
    ]);
    
    try {
        $pengajuan = Pengajuan::findOrFail($id);
        
        // Cek status
        if (!in_array($pengajuan->status, ['disetujui', 'menunggu_direktur'])) {
            return redirect()->back()->with('error', 'Pengajuan tidak dapat disetujui karena status tidak sesuai.');
        }
        
        // Ambil total yang disetujui
        $totalDisetujui = $pengajuan->total_disetujui ?? $pengajuan->total_pengajuan ?? 0;
        
        // Update pengajuan - PAKAI STATUS 'disetujui' karena di enum hanya itu
        $pengajuan->update([
            'status' => 'disetujui', // status tetap disetujui
            'total_disetujui_direktur' => $totalDisetujui,
            'direktur_id' => $request->direktur_id,
            'disetujui_direktur_at' => now(),
            'catatan_direktur' => $request->catatan_direktur,
        ]);
        
        // Update semua item menjadi disetujui
        foreach ($pengajuan->items as $item) {
            $item->update([
                'disetujui_direktur' => true
            ]);
        }
        
        return redirect()->route('direktur.pengadaan.detail', $id)
            ->with('success', 'Pengajuan berhasil disetujui (Full).');
            
    } catch (\Exception $e) {
        \Log::error('Error setujui: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
    /**
     * ============================================
     * SETUJUI SEBAGIAN PENGAJUAN
     * ============================================
     */
    public function setujuiSebagian(Request $request, $id)
    {
        $request->validate([
            'metode_sebagian' => 'required|in:item,nominal',
            'item_disetujui' => 'nullable|array',
            'item_disetujui.*' => 'exists:pengajuan_items,id',
            'jumlah_disetujui' => 'nullable|array',
            'jumlah_disetujui.*' => 'nullable|numeric|min:0',
            'total_disetujui_direktur_nominal' => 'nullable|numeric|min:1',
            'id_direktur' => 'required'
        ]);
        
        $pengajuan = Pengajuan::with('items')->findOrFail($id);
        
        // Cek status
        if (!in_array($pengajuan->status, ['disetujui', 'menunggu_direktur'])) {
            return redirect()->back()->with('error', 'Pengajuan tidak dapat disetujui karena status tidak sesuai.');
        }
        
        $totalDisetujui = 0;
        
        if ($request->metode_sebagian === 'item') {
            // ============================================
            // METODE: Tentukan Jumlah Unit per Item
            // ============================================
            $itemIds = $request->item_disetujui ?? [];
            $jumlahs = $request->jumlah_disetujui ?? [];
            
            if (empty($itemIds)) {
                return redirect()->back()->with('error', 'Silakan pilih minimal 1 item yang disetujui.');
            }
            
            // Update status item dan hitung total
            foreach ($pengajuan->items as $item) {
                if (in_array($item->id, $itemIds)) {
                    $jumlahDisetujui = intval($jumlahs[$item->id] ?? 0);
                    $maxJumlah = intval($item->jumlah ?? 0);
                    
                    // Validasi jumlah tidak melebihi max
                    if ($jumlahDisetujui > $maxJumlah) {
                        return redirect()->back()->with('error', 'Jumlah yang disetujui untuk "' . $item->nama_barang . '" tidak boleh melebihi ' . $maxJumlah . ' unit.');
                    }
                    
                    if ($jumlahDisetujui > 0) {
                        $item->update([
                            'disetujui_direktur' => true,
                            'jumlah_disetujui_direktur' => $jumlahDisetujui, // field baru
                        ]);
                        $totalDisetujui += $jumlahDisetujui * ($item->harga_satuan ?? 0);
                    } else {
                        $item->update([
                            'disetujui_direktur' => false,
                            'jumlah_disetujui_direktur' => 0,
                        ]);
                    }
                } else {
                    $item->update([
                        'disetujui_direktur' => false,
                        'jumlah_disetujui_direktur' => 0,
                    ]);
                }
            }
            
        } else {
            // ============================================
            // METODE: Nominal Total
            // ============================================
            $maxTotal = $pengajuan->total_disetujui ?? $pengajuan->total_pengajuan ?? 0;
            
            $request->validate([
                'total_disetujui_direktur_nominal' => 'required|numeric|min:1|max:' . $maxTotal,
            ]);
            
            $totalDisetujui = $request->total_disetujui_direktur_nominal;
            
            // Update semua item menjadi disetujui
            foreach ($pengajuan->items as $item) {
                $item->update([
                    'disetujui_direktur' => true,
                    'jumlah_disetujui_direktur' => $item->jumlah, // setujui semua jumlah
                ]);
            }
        }
        
        // Update pengajuan
        $pengajuan->update([
            'status' => 'disetujui_sebagian_direktur',
            'total_disetujui_direktur' => $totalDisetujui,
            'id_direktur' => $request->id_direktur,
            'disetujui_direktur_at' => now(),
            'catatan_direktur' => $request->catatan_direktur,
        ]);
        
        return redirect()->route('direktur.pengadaan.detail', $id)->with('success', 'Pengajuan berhasil disetujui sebagian. Total: Rp ' . number_format($totalDisetujui, 0, ',', '.'));
    }
    /**
     * ============================================
     * TUNDA PENGAJUAN
     * ============================================
     */
    public function tunda(Request $request, $id)
    {
        $request->validate([
            'alasan_direktur' => 'required|string|min:5',
            // 'id_direktur' => 'required'
        ]);
        
        $pengajuan = Pengajuan::findOrFail($id);
        
         $totalDisetujui = $pengajuan->total_disetujui ?? $pengajuan->total_pengajuan ?? 0;
        // Cek status
        if (!in_array($pengajuan->status, ['disetujui', 'menunggu_direktur'])) {
            return redirect()->back()->with('error', 'Pengajuan tidak dapat ditunda karena status tidak sesuai.');
        }
        
        $pengajuan->update([
            'status' => 'ditunda',
            'total_disetujui_direktur' => $totalDisetujui,
            'direktur_id' => $request->direktur_id,
            'disetujui_direktur_at' => now(),
            'catatan_direktur' => request('catatan_direktur')
        ]);
        
        return redirect()->route('direktur.pengadaan.detail', $id)->with('warning', 'Pengajuan berhasil ditunda.');
    }

    /**
     * ============================================
     * TOLAK PENGAJUAN
     * ============================================
     */

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan_direktur' => 'required|string|min:5',
             'direktur_id' => 'required'
            // 'id_direktur' => 'required'
        ]);
        
        $pengajuan = Pengajuan::findOrFail($id);
        
         $totalDisetujui = 0;
        // Cek status
        if (!in_array($pengajuan->status, ['disetujui', 'menunggu_direktur','ditunda'])) {
            return redirect()->back()->with('error', 'Pengajuan tidak dapat ditunda karena status tidak sesuai.');
        }
        
        $pengajuan->update([
            'status' => 'ditolak',
            'total_disetujui_direktur' => $totalDisetujui,
            'direktur_id' => $request->direktur_id,
            'disetujui_direktur_at' => now(),
            'catatan_direktur' => $request->catatan_direktur
        ]);
        
        return redirect()->route('direktur.pengadaan.detail', $id)->with('warning', 'Pengajuan berhasil ditunda.');
    }
    
    public function tolakd(Request $request, $id)
    {
        $request->validate([
            'alasan_direktur' => 'required|string|min:5',
            // 'id_direktur' => 'required'
        ]);
        
        $pengajuan = Pengajuan::with('items')->findOrFail($id);
        
        // Cek status
        if (!in_array($pengajuan->status, ['disetujui', 'menunggu_direktur'])) {
            return redirect()->back()->with('error', 'Pengajuan tidak dapat ditolak karena status tidak sesuai.');
        }
        
        // Update pengajuan
        $pengajuan->update([
            'status' => 'ditolak',
            'direktur_id' => $request->direktur_id,
            'disetujui_direktur_at' => now(),
            'catatan_direktur' => request('catatan_direktur')
    
        ]);
        
        // Update semua item menjadi ditolak
        foreach ($pengajuan->items as $item) {
            $item->update([
                'disetujui_direktur' => false
            ]);
        }
        
        return redirect()->route('direktur.pengadaan.detail', $id)->with('danger', 'Pengajuan berhasil ditolak.');
    }

    /**
     * ============================================
     * RESET PENGAJUAN YANG DITUNDA
     * ============================================
     */
    public function resetTunda($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        if ($pengajuan->status !== 'ditunda_direktur') {
            return redirect()->back()->with('error', 'Pengajuan tidak dalam status ditunda.');
        }
        
        $pengajuan->update([
            'status' => 'menunggu_direktur',
            'id_direktur' => null,
            'catatan_direktur' => null,
            'alasan_direktur' => null,
        ]);
        
        return redirect()->route('direktur.pengadaan.detail', $id)->with('success', 'Pengajuan berhasil di-reset dari status ditunda.');
    }

    public function cetak($id)
{
    $pengajuan = Pengajuan::with('items')->findOrFail($id);
    
    // Cek apakah user memiliki akses
    // Tambahkan authorization sesuai kebutuhan
    
    return view('direktur.pengadaan.print', compact('pengajuan'));
}

// Di controller untuk preview tanpa data
public function preview()
{
    // Buat data dummy jika perlu preview
    $pengajuan = new \stdClass();
    $pengajuan->ruangan = 'Ruangan Rawat Inap';
    $pengajuan->pengusul = 'dr. Ahmad';
    $pengajuan->jabatan = 'Kepala Ruangan';
    $pengajuan->nip = '197501012005011001';
    $pengajuan->tanggal_pengajuan = now();
    $pengajuan->tahun_anggaran = '2026';
    $pengajuan->dasar_usulan = 'Kebutuhan Operasional,Penggantian Barang Rusak';
    $pengajuan->alasan = 'Untuk meningkatkan pelayanan pasien';
    $pengajuan->manfaat = 'Meningkatkan efisiensi pelayanan';
    $pengajuan->dampak = 'Pelayanan menjadi terganggu';
    $pengajuan->total = 150000000;
    
    // Items dummy
    $pengajuan->items = [
        (object) ['nama_barang' => 'Infus Pump', 'spesifikasi' => 'Digital', 'satuan' => 'Unit', 'jumlah' => 5, 'harga_satuan' => 15000000, 'total' => 75000000],
        (object) ['nama_barang' => 'Bed Pasien', 'spesifikasi' => 'Elektrik', 'satuan' => 'Unit', 'jumlah' => 3, 'harga_satuan' => 25000000, 'total' => 75000000],
    ];
    
    return view('pengadaan.print', compact('pengajuan'));
}

}
