<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class keuanganController extends Controller
{
   public function index()
    {
        $authUser = Auth::user();

        
        return view('keuangan.dashboard', [
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

        return view('keuangan.pengadaan.pengadaan', compact(
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
        
        return view('keuangan.pengadaan.detail', compact('authUser', 'pengajuan'));
    }



    
}
