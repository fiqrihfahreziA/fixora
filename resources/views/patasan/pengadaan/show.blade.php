@extends('layouts.pengadaan.keuangan')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-box-seam text-primary me-2"></i>Verifikasi Pengadaan
                    </h4>
                    <p class="text-muted mb-0">Verifikasi pengajuan yang sudah disetujui Kabid</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-grid-3x3-gap-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Total</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['total'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-info bg-opacity-10 text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-check2-circle fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Disetujui Kabid</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['disetujui_kabid'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-purple bg-opacity-10 text-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Menunggu</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['menunggu_direktur'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Disetujui</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['disetujui'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-danger bg-opacity-10 text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-x-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Ditolak</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['ditolak'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('keuangan.pengadaan') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-search me-1"></i> Cari
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control border-0 bg-light" 
                               placeholder="Cari no pengajuan, nama barang..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-filter me-1"></i> Status
                    </label>
                    <select name="status" class="form-select bg-light border-0">
                        <option value="">Semua Status</option>
                        <option value="disetujui_kabid" {{ request('status') == 'disetujui_kabid' ? 'selected' : '' }}>Disetujui Kabid</option>
                        <option value="menunggu_direktur" {{ request('status') == 'menunggu_direktur' ? 'selected' : '' }}>Menunggu Direktur</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="ditolak_penerima" {{ request('status') == 'ditolak_penerima' ? 'selected' : '' }}>Ditolak Penerima</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="tab-content p-4">
                <div class="tab-pane fade show active">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="20%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allPengajuan as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-semibold text-primary">{{ $pengajuan->no_pengajuan }}</span>
                                        <br>
                                        <small class="text-muted">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</small>
                                    </td>
                                    <td>
                                        {{ date('d/m/Y', strtotime($pengajuan->tanggal_pengajuan)) }}
                                    </td>
                                    <td>
                                        @foreach($pengajuan->items->take(2) as $item)
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-dot text-primary"></i>
                                                <span class="small">{{ $item->nama_barang }}</span>
                                                <span class="badge bg-light text-dark">x{{ $item->jumlah }}</span>
                                            </div>
                                        @endforeach
                                        @if($pengajuan->items->count() > 2)
                                            <small class="text-muted">+ {{ $pengajuan->items->count() - 2 }} item lainnya</small>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusColor = [
                                                'draft' => 'secondary',
                                                'revisi' => 'purple',
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger',
                                                'ditolak_penerima' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'revisi' => 'Revisi',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak',
                                                'ditolak_penerima' => 'Ditolak Penerima'
                                            ][$pengajuan->status] ?? $pengajuan->status;
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }} px-3 py-2 rounded-pill">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i>
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">Rp {{ number_format($pengajuan->total_pengajuan, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            {{-- TOMBOL DETAIL - KE HALAMAN DETAIL --}}
                                            <a href="{{ route('keuangan.pengadaan.detail', $pengajuan->id) }}" 
                                               class="btn btn-sm btn-outline-primary rounded-3" 
                                               title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            
                                            {{-- TOMBOL CETAK - UNTUK DISETUJUI --}}
                                            @if($pengajuan->status == 'disetujui')
                                                <a href="#" class="btn btn-sm btn-outline-success rounded-3" title="Cetak">
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                        <h6 class="text-muted">Belum ada data pengajuan</h6>
                                        <p class="text-muted small">Tidak ada pengajuan yang perlu diverifikasi</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $allPengajuan->firstItem() ?? 0 }} - {{ $allPengajuan->lastItem() ?? 0 }} 
                            dari {{ $allPengajuan->total() }} data
                        </div>
                        {{ $allPengajuan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
.transition-all {
    transition: all 0.3s ease;
}

.stats-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}
.bg-purple {
    background-color: #6f42c1;
}
.bg-purple-subtle {
    background-color: #e7d8f5 !important;
}
.text-purple {
    color: #6f42c1 !important;
}
.bg-success-subtle {
    background-color: #d4edda !important;
}
.bg-danger-subtle {
    background-color: #f8d7da !important;
}
.bg-warning-subtle {
    background-color: #fff3cd !important;
}
.bg-info-subtle {
    background-color: #d1ecf1 !important;
}
.bg-secondary-subtle {
    background-color: #e2e3e5 !important;
}
.bg-primary-subtle {
    background-color: #cfe2ff !important;
}
</style>
@endsection