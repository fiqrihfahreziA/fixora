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
use Illuminate\Support\Facades\Auth;

class AtasanController extends Controller
{
    public function index(){
        return view('patasan.dashboard');
    }

//     public function Showpermintaann(Request $request)
// {
//     $authUser = Auth::user();
//     $bidangId = Auth::user()->karyawan->bidang_id ?? null;


//     // Ambil query pencarian dari request
//     $search = $request->input('search', '');

//     // ================= SEMUA DATA (MODAL) =================
//     $requests = RequestModel::with('detailBarang')
//         ->whereIn('status', ['verified', 'approved','rejected'])
//         ->where(function ($query) use ($search) {
//             $query->where('request_type', 'like', '%' . $search . '%')
//                 ->orWhereHas('detailBarang', function ($q) use ($search) {
//                     $q->where('nama_barang', 'like', '%' . $search . '%')
//                       ->orWhere('deskripsi', 'like', '%' . $search . '%');
//                 });
//         })
//         ->orderBy('created_at', 'desc')
//         ->get();

//     // ================= PERMINTAAN BARANG =================
//     $permintaanRequests = RequestModel::with('detailBarang')
//         ->where('request_type', 'permintaan')
//         ->where('bidang_id', $bidangId)
//         ->whereIn('status', ['verified', 'approved','rejected'])
//         ->where(function ($query) use ($search) {
//             $query->orWhereHas('detailBarang', function ($q) use ($search) {
//                 $q->where('nama_barang', 'like', '%' . $search . '%')
//                   ->orWhere('deskripsi', 'like', '%' . $search . '%');
//             });
//         })
//         ->orderBy('created_at', 'desc')
//         ->paginate(10);

//     // ================= PERBAIKAN BARANG =================
//     $perbaikanRequests = RequestModel::with('detailBarang')
//         ->where('request_type', 'perbaikan')
//         ->where('bidang_id', $bidangId)
//         ->whereIn('status', ['verified', 'approved','rejected'])
//         ->where(function ($query) use ($search) {
//             $query->orWhereHas('detailBarang', function ($q) use ($search) {
//                 $q->where('nama_barang', 'like', '%' . $search . '%')
//                   ->orWhere('deskripsi', 'like', '%' . $search . '%');
//             });
//         })
//         ->orderBy('created_at', 'desc')
//         ->paginate(10);

//     return view('patasan.permintaan', [
//         'authUser'           => $authUser,
//         'modalreq'           => $requests,
//         'search'             => $search,
//         'permintaanRequests' => $permintaanRequests,
//         'perbaikanRequests'  => $perbaikanRequests,
//     ]);
// }

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



}
