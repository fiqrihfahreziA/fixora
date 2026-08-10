<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Karyawan;
use App\Models\detail_barang;
use App\Models\RequestModel;
use App\Models\Penerima;
use App\Models\pengajuan_item;
use App\Models\bidang;
use App\Models\pengajuan;
use App\Models\App\Models\barang_tersedia;
use Illuminate\Support\Facades\Auth;

class AtasanController extends Controller
{
    public function index(){
        return view('patasan.dashboard');
    }

    public function Showpermintaann(Request $request)
{
    $authUser = Auth::user();
    $bidangId = Auth::user()->karyawan->bidang_id ?? null;

    // Ambil query pencarian dari request
    $search = $request->input('search', '');

    // ?? Logic penggabungan bidang
    if ($bidangId == 2) {
        $bidangFilter = [2, 4]; // komputer + lainnya
    } else {
        $bidangFilter = [$bidangId];
    }

    // ================= SEMUA DATA (MODAL) =================
    $requests = RequestModel::with('detailBarang')
        ->whereIn('status', ['verified', 'approved', 'rejected'])
        ->whereIn('bidang_id', $bidangFilter) // ?? tambahkan ini
        ->where(function ($query) use ($search) {
            $query->where('request_type', 'like', '%' . $search . '%')
                ->orWhereHas('detailBarang', function ($q) use ($search) {
                    $q->where('nama_barang', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
                });
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // ================= PERMINTAAN BARANG =================
    $permintaanRequests = RequestModel::with('detailBarang')
        ->where('request_type', 'permintaan')
        ->whereIn('bidang_id', $bidangFilter) // ?? ganti ini
        ->whereIn('status', ['verified', 'approved', 'rejected'])
        ->where(function ($query) use ($search) {
            $query->whereHas('detailBarang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // ================= PERBAIKAN BARANG =================
    $perbaikanRequests = RequestModel::with('detailBarang')
        ->where('request_type', 'perbaikan')
        ->whereIn('bidang_id', $bidangFilter) // ?? ganti ini juga
        ->whereIn('status', ['verified', 'approved', 'rejected'])
        ->where(function ($query) use ($search) {
            $query->whereHas('detailBarang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('patasan.permintaan', [
        'authUser'           => $authUser,
        'modalreq'           => $requests,
        'search'             => $search,
        'permintaanRequests' => $permintaanRequests,
        'perbaikanRequests'  => $perbaikanRequests,
    ]);
}

public function edit($id)
{
    $authUser = Auth::user();
    // Ambil permintaan berdasarkan ID
    $permintaan = RequestModel::findOrFail($id);
    
    // Kirim data ke halaman edit
    return view('patasan.permintaanedit', [
        'authUser' => $authUser,
        'permintaan' => $permintaan,
    ]);
}

public function lihatGambar($id)
{
    $req = RequestModel::with('detailBarang')->findOrFail($id);

    return view('pemohon.detail_gambar', compact('req'));
}


    public function view($id)
    {
        $permintaan = RequestModel::with(['detailBarang', 'user'])->findOrFail($id);

        return view('form.formpermintaan', compact('permintaan'));
    }

public function update(Request $request, $id)
{
    $authUser = Auth::user();

    // ================= VALIDASI UMUM =================
    $validated = $request->validate([
        'request_type' => 'required|in:permintaan,perbaikan',
        'status'       => 'required|in:pending,verified,approved,rejected',

        // PERMINTAAN BARANG
        'nama_barang'  => 'required|string|max:255',
        'jumlah'       => 'nullable|integer',
        'spesifikasi'  => 'nullable|string',
        'alasan'       => 'nullable|string',

        // PERBAIKAN BARANG
        'kode_aset'        => 'nullable|string|max:255',
        'deskripsi'        => 'nullable|string',
        'tanggal_kerusakan'=> 'nullable|date',
    ]);

    $permintaan = RequestModel::with('detailBarang')->findOrFail($id);

    // ================= UPDATE STATUS =================
    $permintaan->status = $request->status;

    // ===== Jika Approved / Rejected =====
    if (in_array($request->status, ['approved', 'rejected'])) {

        if ($permintaan->atasan_id === null) {
            $permintaan->atasan_id = $authUser->karyawan->id;
        }

    }

    // ===== Jika Status Kembali ke Pending =====
    if ($request->status === 'verified') {
        $permintaan->atasan_id = null;
    }

    $permintaan->save();

    // ================= SIAPKAN DATA DETAIL =================
    $dataUpdate = [
        'nama_barang' => $request->nama_barang,
    ];

    // ===== LOGIC TANGGAL ACC =====
    if (in_array($request->status, ['approved', 'rejected'])) {
        if ($permintaan->detailBarang->tanggal_acc === null) {
            $dataUpdate['tanggal_acc'] = now();
        }
    }

    if ($request->status === 'verified') {
        $dataUpdate['tanggal_acc'] = null;
    }

    // ================= LOGIC BERDASARKAN TYPE =================
    if ($permintaan->request_type === 'permintaan') {

        $dataUpdate += [
            'jumlah'      => $request->jumlah,
            'spesifikasi' => $request->spesifikasi,
            'alasan'      => $request->alasan,

            'kode_aset'         => null,
            'deskripsi'         => null,
            'tanggal_kerusakan' => null,
        ];
    }

    if ($permintaan->request_type === 'perbaikan') {

        $dataUpdate += [
            'kode_aset'         => $request->kode_aset,
            'deskripsi'         => $request->deskripsi,
            'tanggal_kerusakan' => $request->tanggal_kerusakan,

            'jumlah'      => null,
            'spesifikasi' => null,
            'alasan'      => null,
        ];
    }

    // ===== UPDATE DETAIL =====
    $permintaan->detailBarang->update($dataUpdate);

    return redirect()
        ->route('atasan.permintaan')
        ->with('success', 'Permintaan berhasil diupdate');
}

// pengadaan

   public function pengadaanshow(Request $request)
    {
        $authUser = Auth::user();
        
        // Ambil bidang_id dari karyawan yang login (PENERIMA)
        $bidangId = $authUser->karyawan->bidang_id ?? null;
        $ruangan = $authUser->karyawan->ruangan ?? null;
        
        // Ambil bidang untuk filter
        $bidangs = bidang::all();

        // Ambil query pencarian
        $search = $request->input('search');
        $statusFilter = $request->input('status');
        $bidangFilter = $request->input('bidang');
        $typeFilter = $request->input('type');
         $tahunAnggaran = $request->input('tahun_anggaran');

        /**
         * ============================
         * QUERY DASAR PENGADAAN
         * Filter berdasarkan bidang_id user (PENERIMA)
         * ============================
         */
            $query = pengajuan::with(['items', 'karyawan', 'bidang'])
            ->where('bidang_id', $bidangId)
            ->whereNotIn('status', ['draft', 'revisi', 'diajukan'])
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
            })
            ->when($bidangFilter, function ($q) use ($bidangFilter) {
                $q->where('bidang_id', $bidangFilter);
            })
            ->when($tahunAnggaran, function ($q) use ($tahunAnggaran) { // <-- TAMBAHKAN FILTER TAHUN
            $q->where('tahun_anggaran', $tahunAnggaran);
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
         * DATA UNTUK TAB PERMINTAAN 
         * ============================
         */
        $permintaanQuery = clone $query;
        $permintaanPengajuan = $permintaanQuery->where(function($q) {
                $q->where('dasar_usulan', 'LIKE', '%Program Kerja%')
                  ->orWhere('dasar_usulan', 'LIKE', '%Kebutuhan Operasional%')
                  ->orWhere('dasar_usulan', 'LIKE', '%Penambahan Kapasitas Pelayanan%')
                  ->orWhere('dasar_usulan', 'LIKE', '%Pemenuhan Standar Akreditasi%')
                  ->orWhere('dasar_usulan', 'LIKE', '%Keselamatan Pasien%')
                  ->orWhereNull('dasar_usulan');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());

        /**
         * ============================
         * DATA UNTUK TAB PERBAIKAN 
         * ============================
         */
        $perbaikanQuery = clone $query;
        $perbaikanPengajuan = $perbaikanQuery->where(function($q) {
                $q->where('dasar_usulan', 'LIKE', '%Penggantian Barang Rusak%')
                  ->orWhere('dasar_usulan', 'LIKE', '%perbaikan%')
                  ->orWhere('dasar_usulan', 'LIKE', '%service%')
                  ->orWhere('dasar_usulan', 'LIKE', '%repair%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());

        /**
         * ============================
         * STATISTIK DASHBOARD
         * ============================
         */
        $stats = [
            'total' => Pengajuan::where('bidang_id', $bidangId)->count(),
            'draft' => Pengajuan::where('bidang_id', $bidangId)->where('status', 'draft')->count(),
            'diajukan' => Pengajuan::where('bidang_id', $bidangId)->where('status', 'diajukan')->count(),
            'disetujui' => Pengajuan::where('bidang_id', $bidangId)->where('status', 'disetujui')->count(),
            'ditolak' => Pengajuan::where('bidang_id', $bidangId)->where('status', 'ditolak')->count(),
            'revisi' => Pengajuan::where('bidang_id', $bidangId)->where('status', 'revisi')->count(),
            'menunggu_direktur' => Pengajuan::where('bidang_id', $bidangId)->where('status', 'menunggu_direktur')->count(),
            
            'permintaan_count' => Pengajuan::where('bidang_id', $bidangId)
                ->where(function($q) {
                    $q->where('dasar_usulan', 'LIKE', '%Program Kerja%')
                      ->orWhere('dasar_usulan', 'LIKE', '%Kebutuhan Operasional%')
                      ->orWhere('dasar_usulan', 'LIKE', '%Penambahan Kapasitas Pelayanan%')
                      ->orWhere('dasar_usulan', 'LIKE', '%Pemenuhan Standar Akreditasi%')
                      ->orWhere('dasar_usulan', 'LIKE', '%Keselamatan Pasien%')
                      ->orWhereNull('dasar_usulan');
                })->count(),
                
            'perbaikan_count' => Pengajuan::where('bidang_id', $bidangId)
                ->where(function($q) {
                    $q->where('dasar_usulan', 'LIKE', '%Penggantian Barang Rusak%')
                      ->orWhere('dasar_usulan', 'LIKE', '%perbaikan%')
                      ->orWhere('dasar_usulan', 'LIKE', '%service%')
                      ->orWhere('dasar_usulan', 'LIKE', '%repair%');
                })->count(),
        ];

        return view('patasan.pengadaan.permintaan', compact(
            'authUser',
            'allPengajuan',
            'permintaanPengajuan',
            'perbaikanPengajuan',
            'bidangs',
            'search',
            'statusFilter',
            'bidangFilter',
            'typeFilter',
            'stats',
            'tahunAnggaran', // <-- TAMBAHKAN INI
            'bidangId',
            'ruangan'
        ));
    }

     public function showpengadaan($id)
{
    $authUser = Auth::user();
    
    $pengajuan = pengajuan::with([
        'karyawan',
        'bidang',
        'items',
        'items.barangTersedia',
    ])->findOrFail($id); // <-- HAPUS where('penerima_id', $authUser->id)

    return view('patasan.pengadaan.show', compact('pengajuan', 'authUser'));
}

public function verifikasi(Request $request, $id)
{
    $request->validate([
        'status_verifikasi' => 'required|in:disetujui_kabid,ditolak,revisi',
        'catatan_verifikasi' => 'required|string|min:5',
    ]);

    try {
        $pengajuan = pengajuan::findOrFail($id);
        
        $data = [
            'status' => $request->status_verifikasi,
            'atasan_id' => Auth::id(),
            'catatan_bidang' => $request->catatan_verifikasi,
        ];

        // Hanya set tanggal jika statusnya disetujui
        if ($request->status_verifikasi == 'disetujui_kabid') {
            $data['disetujui_kabid_at'] = now();
        }

        $pengajuan->update($data);

        return redirect()
            ->route('atasan.pengadaan')
            ->with('success', '✅ Pengajuan berhasil diverifikasi!');

    } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', '❌ Gagal verifikasi: ' . $e->getMessage());
    }
}

// public function verifikasi(Request $request, $id)
// {
//     $request->validate([
//         'status_verifikasi' => 'required|in:disetujui_kabid,ditolak,revisi',
//         'catatan_verifikasi' => 'required|string|min:5',
//     ]);

//     try {
//         $pengajuan = pengajuan::findOrFail($id);
        
//         $statusMap = [
//             'disetujui_kabid' => 'disetujui_kabid',
//             'ditolak' => 'ditolak',
//             'revisi' => 'revisi',
//         ];
        
//         $pengajuan->update([
//             'status' => $statusMap[$request->status_verifikasi],
//             'atasan_id' => Auth::id(),
//             'catatan_bidang' => $request->catatan_verifikasi,
//             'disetujui_kabid_at' => $request->status_verifikasi == 'disetujui_kabid_at' ? now() : null,
//         ]);

//         // ✅ Redirect ke index dengan pesan sukses
//         return redirect()
//             ->route('atasan.pengadaan')
//             ->with('success', '✅ Pengajuan berhasil diverifikasi!');

//     } catch (\Exception $e) {
//         return back()
//             ->withInput()
//             ->with('error', '❌ Gagal verifikasi: ' . $e->getMessage());
//     }
// }

}
