<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bidang;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Karyawan;
use App\Models\detail_barang;
use App\Models\barang_tersedia;
use App\Models\pengajuan;
use App\Models\pengajuan_item;
use Illuminate\Support\Facades\DB; 
use App\Models\RequestModel;
use App\Models\Penerima;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenerimaController extends Controller
{

public function index()
    {
        $authUser = Auth::user();

        
        return view('penerima.dashboard', [
            'authUser' => $authUser,
        ]);
    }

    public function chart()
{
    $bidangId = Auth::user()->karyawan->bidang_id ?? null;

    if ($bidangId == 2) {
        $bidangFilter = [2, 4];
    } else {
        $bidangFilter = [$bidangId];
    }

    $totalRequest = RequestModel::whereIn('bidang_id', $bidangFilter)->count();

    $totalPermintaan = RequestModel::whereIn('bidang_id', $bidangFilter)
        ->where('request_type', 'permintaan')
        ->count();

    $totalPerbaikan = RequestModel::whereIn('bidang_id', $bidangFilter)
        ->where('request_type', 'perbaikan')
        ->count();

    $pending = RequestModel::whereIn('bidang_id', $bidangFilter)
        ->where('status', 'pending')
        ->count();

    $verified = RequestModel::whereIn('bidang_id', $bidangFilter)
    ->where('status', 'verified')
    ->count();

    $approved = RequestModel::whereIn('bidang_id', $bidangFilter)
        ->where('status', 'approved')
        ->count();

    $recentRequests = RequestModel::with('detailBarang')
    ->whereIn('bidang_id', $bidangFilter)
    ->latest()
    ->take(5)
    ->get();

    return view('penerima.chart', compact(
        'totalRequest',
        'totalPermintaan',
        'totalPerbaikan',
        'pending',
        'approved',
        'verified',
        'recentRequests'
    ));
}

//    public function Showpermintaan(Request $request)
// {
//     $authUser = Auth::user();
//     $bidangId = Auth::user()->karyawan->bidang_id ?? null;

//     // Ambil query pencarian dari request
//     $search = $request->input('search', '');

//     // Query untuk mengambil data permintaan berdasarkan pencarian
//     $requests = RequestModel::with('detailBarang')
//         ->where(function ($query) use ($search) {
//             $query->where('request_type', 'like', '%' . $search . '%')
//                   ->orWhereHas('detailBarang', function ($q) use ($search) {
//                       $q->where('nama_barang', 'like', '%' . $search . '%')
//                         ->orWhere('deskripsi', 'like', '%' . $search . '%');
//                   });
//         })
//         ->orderBy('created_at', 'desc')
//         ->get();

//     // Fetch Permintaan with pagination
// $permintaanRequests = RequestModel::with('detailBarang')
//     ->where('request_type', 'permintaan')  // Filter for permintaan
//     ->where('bidang_id', $bidangId)
//     ->where(function ($query) use ($search) {
//         $query->where('request_type', 'like', '%' . $search . '%')
//               ->orWhereHas('detailBarang', function ($q) use ($search) {
//                   $q->where('nama_barang', 'like', '%' . $search . '%')
//                     ->orWhere('deskripsi', 'like', '%' . $search . '%');
//               });
//     })
//     ->orderBy('created_at', 'desc')
//     ->paginate(10);  // Pagination for permintaan

// // Fetch Perbaikan with pagination
// $perbaikanRequests = RequestModel::with('detailBarang')
//     ->where('request_type', 'perbaikan')  // Filter for perbaikan
//     ->where('bidang_id', $bidangId)
//     ->where(function ($query) use ($search) {
//         $query->where('request_type', 'like', '%' . $search . '%')
//               ->orWhereHas('detailBarang', function ($q) use ($search) {
//                   $q->where('nama_barang', 'like', '%' . $search . '%')
//                     ->orWhere('deskripsi', 'like', '%' . $search . '%');
//               });
//     })
//     ->orderBy('created_at', 'desc')
//     ->paginate(10);  // Pagination for perbaikan


//     return view('penerima.permintaan', [
//         'authUser' => $authUser,
//         'modalreq' => $requests,
//         'search' => $search,  // Pass search query to the view
//         'permintaanRequests' => $permintaanRequests,
//         'perbaikanRequests' => $perbaikanRequests,
//     ]);
// }

public function Showpermintaan(Request $request)
{
    $authUser = Auth::user();
    $bidangId = Auth::user()->karyawan->bidang_id ?? null;

    // Ambil query pencarian dari request
    $search = $request->input('search', '');

    // ?? Tambahan logic di sini
    if ($bidangId == 2) {
        // Komputer ? gabung dengan lainnya
        $bidangFilter = [2, 4];
    } else {
        // Selain komputer ? hanya bidang masing-masing
        $bidangFilter = [$bidangId];
    }

    // Query untuk modal (opsional, kalau mau ikut filter juga bisa)
    $requests = RequestModel::with('detailBarang')
        ->whereIn('bidang_id', $bidangFilter)
        ->where(function ($query) use ($search) {
            $query->where('request_type', 'like', '%' . $search . '%')
                  ->orWhereHas('detailBarang', function ($q) use ($search) {
                      $q->where('nama_barang', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%');
                  });
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // ? Permintaan
    $permintaanRequests = RequestModel::with('detailBarang')
        ->where('request_type', 'permintaan')
        ->whereIn('bidang_id', $bidangFilter) // ?? pakai ini
        ->where(function ($query) use ($search) {
            $query->where('request_type', 'like', '%' . $search . '%')
                  ->orWhereHas('detailBarang', function ($q) use ($search) {
                      $q->where('nama_barang', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%');
                  });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // ? Perbaikan
    $perbaikanRequests = RequestModel::with('detailBarang')
        ->where('request_type', 'perbaikan')
        ->whereIn('bidang_id', $bidangFilter) // ?? pakai ini juga
        ->where(function ($query) use ($search) {
            $query->where('request_type', 'like', '%' . $search . '%')
                  ->orWhereHas('detailBarang', function ($q) use ($search) {
                      $q->where('nama_barang', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%');
                  });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('penerima.permintaan', [
        'authUser' => $authUser,
        'modalreq' => $requests,
        'search' => $search,
        'permintaanRequests' => $permintaanRequests,
        'perbaikanRequests' => $perbaikanRequests,
    ]);
}

public function lihatGambar($id)
{
    $req = RequestModel::with('detailBarang')->findOrFail($id);

    return view('pemohon.detail_gambar', compact('req'));
}

public function edit($id)
{
    $authUser = Auth::user();
    // Ambil permintaan berdasarkan ID
    $permintaan = RequestModel::findOrFail($id);
    
    // Kirim data ke halaman edit
    return view('penerima.permintaanedit', [
        'authUser' => $authUser,
        'permintaan' => $permintaan,
    ]);
}

public function view($id)
{
    $permintaan = RequestModel::with(['detailBarang', 'user'])->findOrFail($id);

    return view('form.formpermintaan', compact('permintaan'));
}



public function destroy($id)
{
    RequestModel::findOrFail($id)->delete();

    return back()->with('success', 'Data berhasil dihapus');
}

public function laporan(){
    $authUser = Auth::user();
    $bidangs = bidang::all();

    return view('penerima.laporan', [
        'authuser' =>$authUser,
        
    ]);

}

public function updatee(Request $request, $id)
{
    $authUser = Auth::user();

    // ================= VALIDASI =================
    $validated = $request->validate([
        'request_type' => 'required|in:permintaan,perbaikan',
        'status'       => 'required|in:pending,verified,approved,rejected',

        // PERMINTAAN
        'nama_barang'  => 'required|string|max:255',
        'jumlah'       => 'nullable|integer',
        'spesifikasi'  => 'nullable|string',
        'alasan'       => 'nullable|string',

        // PERBAIKAN
        'kode_aset'         => 'nullable|string|max:255',
        'deskripsi'         => 'nullable|string',
        'tanggal_kerusakan' => 'nullable|date',
    ]);

    $permintaan = RequestModel::with('detailBarang')->findOrFail($id);

    // ================= UPDATE STATUS =================
    $permintaan->status = $request->status;

    // 🔵 SAAT VERIFIED
    if ($request->status === 'verified') {

        // set penerima jika belum ada
        if ($permintaan->penerima_id === null) {
            $permintaan->penerima_id = $authUser->karyawan->id;
        }

        // set tanggal verif di detail barang
        if ($permintaan->detailBarang->tanggal_verif === null) {
            $permintaan->detailBarang->tanggal_verif = now();
        }
    }

    // 🔴 SAAT BALIK KE PENDING
    if ($request->status === 'pending') {
        $permintaan->penerima_id = null;
        $permintaan->detailBarang->tanggal_verif = null;
    }

    $permintaan->save();
    $permintaan->detailBarang->save();

    // ================= AUTO GENERATE NO SURAT =================
    if (
        $request->status === 'verified' &&
        empty($permintaan->detailBarang->no_surat)
    ) {
        $tahun = now()->year;
        $startNumber = 15;

        $count = \App\Models\detail_barang::whereYear('created_at', $tahun)
            ->whereNotNull('no_surat')
            ->count();

        $nomorUrut = $startNumber + $count;

        $permintaan->detailBarang->no_surat =
            $nomorUrut . '/SIMRS/' . $tahun;

        $permintaan->detailBarang->save();
    }

    // ================= UPDATE DETAIL BARANG =================
    if ($permintaan->request_type === 'permintaan') {

        $permintaan->detailBarang->update([
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $request->jumlah,
            'spesifikasi' => $request->spesifikasi,
            'alasan'      => $request->alasan,

            // reset field perbaikan
            'kode_aset'         => null,
            'deskripsi'         => null,
            'tanggal_kerusakan' => null,
        ]);
    }

    if ($permintaan->request_type === 'perbaikan') {

        $permintaan->detailBarang->update([
            'nama_barang'       => $request->nama_barang,
            'kode_aset'         => $request->kode_aset,
            'deskripsi'         => $request->deskripsi,
            'tanggal_kerusakan' => $request->tanggal_kerusakan,

            // reset field permintaan
            'jumlah'      => null,
            'spesifikasi' => null,
            'alasan'      => null,
        ]);
    }

    return redirect()
        ->route('penerima.permintaan')
        ->with('success', 'Permintaan berhasil diupdate');
}

public function preview(Request $request)
{
    $user = Auth::user();
    $bidangId = optional($user->karyawan)->bidang_id;

    $query = RequestModel::with(['user.karyawan', 'detailBarang'])
        ->where('status', 'approved')

        // 🔥 FILTER BIDANG LANGSUNG DI TABEL REQUEST
        ->where('bidang_id', $bidangId);

    // FILTER TAHUN
    if ($request->filled('tahun')) {
        $query->whereYear('created_at', $request->tahun);
    }

    // FILTER BULAN
    if ($request->filled('bulan')) {
        $query->whereMonth('created_at', $request->bulan);
    }

    // FILTER TANGGAL
    if ($request->filled('tanggal')) {
        $query->whereDay('created_at', $request->tanggal);
    }

    // FILTER JENIS PERMINTAAN
    if ($request->filled('request_type')) {
        $query->where('request_type', $request->request_type);
    }

    $data = $query->orderBy('created_at', 'desc')->get();

    return view('penerima.preview', compact('data'));
}


// public function preview(Request $request)
// {
//     $query = RequestModel::with(['user.karyawan', 'detailBarang'])
//         ->where('status', 'approved'); // 🔥 hanya data APPROVED

//     // FILTER TAHUN
//     if ($request->filled('tahun')) {
//         $query->whereYear('created_at', $request->tahun);
//     }

//     // FILTER BULAN
//     if ($request->filled('bulan')) {
//         $query->whereMonth('created_at', $request->bulan);
//     }

//     // FILTER TANGGAL
//     if ($request->filled('tanggal')) {
//         $query->whereDay('created_at', $request->tanggal);
//     }

//     // FILTER JENIS PERMINTAAN
//     if ($request->filled('request_type')) {
//         $query->where('request_type', $request->request_type);
//     }

//     $data = $query->orderBy('created_at', 'desc')->get();

//     return view('penerima.preview', compact('data'));
// }


public function exportCsv(Request $request)
{
    // ================= FILTER =================
    $baseQuery = RequestModel::with(['user.karyawan','detailBarang']);

    if ($request->filled('tahun')) {
        $baseQuery->whereYear('created_at', $request->tahun);
    }

    if ($request->filled('bulan')) {
        $baseQuery->whereMonth('created_at', $request->bulan);
    }

    if ($request->filled('tanggal')) {
        $baseQuery->whereDay('created_at', $request->tanggal);
    }

    // ================= DATA =================
    $permintaan = (clone $baseQuery)
        ->where('request_type','permintaan')
         ->where('status','approved')
        ->get();

    $perbaikan = (clone $baseQuery)
        ->where('request_type','perbaikan')
        ->where('status','approved')
        ->get();

    // ================= SPREADSHEET =================
    $spreadsheet = new Spreadsheet();

    // ================= SHEET PERMINTAAN =================
    $sheet1 = $spreadsheet->getActiveSheet();
    $sheet1->setTitle('Permintaan');

    $sheet1->fromArray([
        ['No','Nama Peminta','Barang','Ruangan','Tanggal Permintaan','Status','bidang']
    ], null, 'A1');

    // AUTO FILTER
    $sheet1->setAutoFilter('A1:G1');
    // $sheet1->freezePane('A2');

    $row = 2;
    foreach ($permintaan as $i => $item) {
        $sheet1->fromArray([
            $i + 1,
            $item->user->karyawan->nama ?? '-',
            $item->detailBarang->nama_barang ?? '-',
            $item->ruangan,
            $item->created_at->format('d-m-Y'),
            ucfirst($item->status),
            $item->bidang->nama_bidang,
        ], null, "A$row");
        $row++;
    }

    // ================= SHEET PERBAIKAN =================
    $sheet2 = $spreadsheet->createSheet();
    $sheet2->setTitle('Perbaikan');

    $sheet2->fromArray([
        ['No','Nama Peminta','Nama Barang','Kode Aset','Ruangan',
         'Kerusakan','Tanggal Kerusakan','Tanggal Permintaan','Status','bidang']
    ], null, 'A1');

    // AUTO FILTER
        $sheet2->setAutoFilter('A1:J1');
        // $sheet1->freezePane('A2');

    $row = 2;
    foreach ($perbaikan as $i => $item) {
        $sheet2->fromArray([
            $i + 1,
            $item->user->karyawan->nama ?? '-',
            $item->detailBarang->nama_barang ?? '-',
            $item->detailBarang->kode_aset ?? '-',
            $item->ruangan,
            $item->detailBarang->deskripsi ?? '-',
            $item->detailBarang->tanggal_kerusakan ?? '-',
            $item->created_at->format('d-m-Y'),
            ucfirst($item->status),
            $item->bidang->nama_bidang,
        ], null, "A$row");
        $row++;
    }

    // ================= NAMA FILE DINAMIS =================
    $filename = 'laporan';

    if ($request->filled('request_type')) {
        $filename .= '-' . $request->request_type;
    }

    if ($request->filled('tahun')) {
        $filename .= '-' . $request->tahun;
    }

    if ($request->filled('bulan')) {
        $filename .= '-' . str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
    }

    if ($request->filled('tanggal')) {
        $filename .= '-' . str_pad($request->tanggal, 2, '0', STR_PAD_LEFT);
    }

    $filename .= '.xlsx';

    // ================= DOWNLOAD =================
    $writer = new Xlsx($spreadsheet);
    $path = storage_path($filename);
    $writer->save($path);

    return response()->download($path)->deleteFileAfterSend(true);
}

//pengadaan

   public function chartpengadaan(Request $request)
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
            ->where('status', '!=', 'draft')
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

        return view('penerima.pengadaan.permintaan', compact(
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

    return view('penerima.pengadaan.show', compact('pengajuan', 'authUser'));
}

public function verifikasi(Request $request, $id)
{
    $request->validate([
        'status_verifikasi' => 'required|in:disetujui_koordinator,ditolak,revisi',
        'catatan_verifikasi' => 'required|string|min:5',
        'penerima_id' => 'required'
    ]);

    try {
        $pengajuan = pengajuan::findOrFail($id);
        
        $statusMap = [
            'disetujui_koordinator' => 'disetujui_koordinator',
            'ditolak' => 'ditolak_penerima',
            'revisi' => 'revisi',
            
        ];
        
        // Mapping untuk log_penerima (CUKUP STATUS SAJA)
        $logMap = [
            'disetujui_koordinator' => 'disetujui',
            'ditolak' => 'ditolak',
            'revisi' => 'revisi',
        ];
        
        $newStatus = $statusMap[$request->status_verifikasi];
        
        $pengajuan->update([
            'status' => $newStatus,
            'penerima_id' => $request->penerima_id,
            'catatan_unit' => $request->catatan_verifikasi,
            'diterima_at' => $request->status_verifikasi == 'disetujui_koordinator' ? now() : null,
            'log_status_penerima' => $newStatus, // ✅ CUKUP STATUS
        ]);

        return redirect()
            ->route('penerima.chartp')
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
//         'status_verifikasi' => 'required|in:disetujui_koordinator,ditolak,revisi',
//         'catatan_verifikasi' => 'required|string|min:5',
//     ]);

//     try {
//         $pengajuan = pengajuan::findOrFail($id);
        
//         $statusMap = [
//             'disetujui_koordinator' => 'disetujui_koordinator',
//             'ditolak' => 'ditolak_penerima',
//             'revisi' => 'revisi',
//         ];
        
//         $pengajuan->update([
//             'status' => $statusMap[$request->status_verifikasi],
//             'penerima_id' => Auth::id(),
//             'catatan_unit' => $request->catatan_verifikasi,
//             'diterima_at' => $request->status_verifikasi == 'disetujui_koordinator' ? now() : null,
//         ]);

//         // ✅ Redirect ke index dengan pesan sukses
//         return redirect()
//             ->route('penerima.chartp')
//             ->with('success', '✅ Pengajuan berhasil diverifikasi!');

//     } catch (\Exception $e) {
//         return back()
//             ->withInput()
//             ->with('error', '❌ Gagal verifikasi: ' . $e->getMessage());
//     }
// }




}
