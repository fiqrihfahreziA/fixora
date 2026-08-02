{{-- @extends('layouts.pengadaan.pemohon')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Section dengan Statistik -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-box-seam text-primary me-2"></i>Pengadaan Barang
                    </h4>
                    <p class="text-muted mb-0">Kelola permintaan dan perbaikan barang Anda</p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalPengajuan" data-bs-focus="false">
                        <i class="bi bi-plus-circle me-2"></i>Buat Pengajuan Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
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
                        <div class="stats-icon bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Draft</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['draft'] ?? 0 }}</h5>
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
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Proses</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['diajukan'] ?? 0 }}</h5>
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
    </div>

    <!-- Filter & Search Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('pemohon.pengadaan') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
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
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-filter me-1"></i> Status
                    </label>
                    <select name="status" class="form-select bg-light border-0">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="disetujui_koordinator" {{ request('status') == 'disetujui_koordinator' ? 'selected' : '' }}>Disetujui Koordinator</option>
                        <option value="disetujui_kabid" {{ request('status') == 'disetujui_kabid' ? 'selected' : '' }}>Disetujui Kabid</option>
                        <option value="menunggu_direktur" {{ request('status') == 'menunggu_direktur' ? 'selected' : '' }}>Menunggu Direktur</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-building me-1"></i> Bidang
                    </label>
                    <select name="bidang" class="form-select bg-light border-0">
                        <option value="">Semua Bidang</option>
                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}" {{ request('bidang') == $bidang->id ? 'selected' : '' }}>
                                {{ $bidang->nama_bidang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabs -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-tabs-custom border-0 px-4 pt-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-4 py-2" data-bs-toggle="tab" data-bs-target="#semua" type="button" role="tab">
                        <i class="bi bi-grid-3x3-gap me-2"></i>Semua
                        <span class="badge bg-primary rounded-pill ms-2">{{ $stats['total'] ?? 0 }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-2" data-bs-toggle="tab" data-bs-target="#permintaan" type="button" role="tab">
                        <i class="bi bi-box me-2"></i>Permintaan
                        <span class="badge bg-success rounded-pill ms-2">{{ $stats['permintaan_count'] ?? 0 }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-2" data-bs-toggle="tab" data-bs-target="#perbaikan" type="button" role="tab">
                        <i class="bi bi-tools me-2"></i>Perbaikan
                        <span class="badge bg-warning rounded-pill ms-2">{{ $stats['perbaikan_count'] ?? 0 }}</span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content p-4">
                <!-- Tab Semua -->
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="25%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="15%">Aksi</th>
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
                                    <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
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
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak'
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
                                            <a href="#" class="btn btn-sm btn-outline-primary rounded-3" data-bs-toggle="tooltip" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'draft')
                                                <a href="#" class="btn btn-sm btn-outline-warning rounded-3" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger rounded-3" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                            @if($pengajuan->status == 'disetujui')
                                                <a href="#" class="btn btn-sm btn-outline-success rounded-3" data-bs-toggle="tooltip" title="Cetak">
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
                                        <p class="text-muted small">Silakan buat pengajuan baru untuk memulai</p>
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

                <!-- Tab Permintaan -->
                <div class="tab-pane fade" id="permintaan" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="25%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permintaanPengajuan as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-semibold text-success">{{ $pengajuan->no_pengajuan }}</span>
                                        <br>
                                        <small class="text-muted">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</small>
                                    </td>
                                    <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
                                    <td>
                                        @foreach($pengajuan->items->take(2) as $item)
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-dot text-success"></i>
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
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak'
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
                                            <a href="#" class="btn btn-sm btn-outline-primary rounded-3">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'draft')
                                                <a href="#" class="btn btn-sm btn-outline-warning rounded-3">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-box text-muted fs-1 d-block mb-3"></i>
                                        <h6 class="text-muted">Belum ada pengajuan permintaan</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $permintaanPengajuan->firstItem() ?? 0 }} - {{ $permintaanPengajuan->lastItem() ?? 0 }} 
                            dari {{ $permintaanPengajuan->total() }} data
                        </div>
                        {{ $permintaanPengajuan->links() }}
                    </div>
                </div>

                <!-- Tab Perbaikan -->
                <div class="tab-pane fade" id="perbaikan" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="25%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($perbaikanPengajuan as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-semibold text-warning">{{ $pengajuan->no_pengajuan }}</span>
                                        <br>
                                        <small class="text-muted">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</small>
                                    </td>
                                    <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
                                    <td>
                                        @foreach($pengajuan->items->take(2) as $item)
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-dot text-warning"></i>
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
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak'
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
                                            <a href="#" class="btn btn-sm btn-outline-primary rounded-3">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'draft')
                                                <a href="#" class="btn btn-sm btn-outline-warning rounded-3">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-tools text-muted fs-1 d-block mb-3"></i>
                                        <h6 class="text-muted">Belum ada pengajuan perbaikan</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $perbaikanPengajuan->firstItem() ?? 0 }} - {{ $perbaikanPengajuan->lastItem() ?? 0 }} 
                            dari {{ $perbaikanPengajuan->total() }} data
                        </div>
                        {{ $perbaikanPengajuan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- MODAL PENGAJUAN BARU - FIXED VERSION -->
<!-- ============================================ -->
<div class="modal fade" id="modalPengajuan" tabindex="-1" aria-labelledby="modalPengajuanLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top-4 py-3 px-4">
                <div>
                    <h5 class="modal-title fw-bold" id="modalPengajuanLabel">
                        <i class="bi bi-plus-circle me-2"></i>Buat Pengajuan Baru
                    </h5>
                    <p class="text-white-50 small mb-0">Isi formulir berikut untuk mengajukan permintaan atau perbaikan barang</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <form action="#" method="POST" id="formPengajuan">
                @csrf
                <div class="modal-body p-4">
                    <!-- Step/Progress Indicator -->
                    <div class="d-flex justify-content-center mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="step-indicator active">
                                <span class="step-number">1</span>
                                <span class="step-label">Identitas</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-indicator">
                                <span class="step-number">2</span>
                                <span class="step-label">Detail Barang</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-indicator">
                                <span class="step-number">3</span>
                                <span class="step-label">Dokumen</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Identitas -->
                    <div class="step-content" id="step1">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-person-badge me-2"></i>Informasi Pengajuan
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-calendar3 me-1"></i>Tanggal Pengajuan <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-building me-1"></i>Bidang
                                </label>
                                <select name="bidang_id" class="form-select">
                                    <option value="">Pilih Bidang</option>
                                    @foreach($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-calendar-range me-1"></i>Tahun Anggaran
                                </label>
                                <input type="number" name="tahun_anggaran" class="form-control" placeholder="2026" min="2020" max="2030">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-file-text me-1"></i>Dasar Usulan
                                </label>
                                <input type="text" name="dasar_usulan" class="form-control" placeholder="Contoh: Surat Permintaan No. 001/SK/2026">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-list-ul me-1"></i>Jenis Pengajuan <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_pengajuan" id="jenisPermintaan" value="permintaan" checked>
                                        <label class="form-check-label" for="jenisPermintaan">
                                            <i class="bi bi-box text-success"></i> Permintaan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_pengajuan" id="jenisPerbaikan" value="perbaikan">
                                        <label class="form-check-label" for="jenisPerbaikan">
                                            <i class="bi bi-tools text-warning"></i> Perbaikan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-info-circle me-1"></i>Instalasi
                                </label>
                                <input type="text" name="instalasi" class="form-control bg-light" value="{{ $authUser->karyawan->ruangan ?? '' }}" readonly>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Alasan & Manfaat -->
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-question-circle me-2"></i>Alasan & Manfaat
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-pencil me-1"></i>Alasan / Justifikasi
                                </label>
                                <textarea name="alasan_justifikasi" class="form-control" rows="3" placeholder="Jelaskan alasan pengajuan ini..."></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-star me-1"></i>Manfaat
                                </label>
                                <textarea name="manfaat" class="form-control" rows="3" placeholder="Apa manfaat dari pengajuan ini?..."></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-exclamation-triangle me-1"></i>Dampak Jika Tidak Dipenuhi
                                </label>
                                <textarea name="dampak" class="form-control" rows="2" placeholder="Apa dampak jika pengajuan ini tidak dipenuhi?..."></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Kondisi Barang Lama -->
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-box-seam me-2"></i>Kondisi Barang Lama
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Kondisi Saat Ini</label>
                                <textarea name="kondisi_barang_lama" class="form-control" rows="2" placeholder="Deskripsikan kondisi barang lama..."></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Keterangan Tambahan</label>
                                <textarea name="ket_barang_lama" class="form-control" rows="2" placeholder="Keterangan tambahan tentang barang lama..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Detail Barang -->
                    <div class="step-content d-none" id="step2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-primary mb-0">
                                <i class="bi bi-list-check me-2"></i>Daftar Barang
                            </h6>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addItem()">
                                <i class="bi bi-plus-circle me-1"></i>Tambah Item
                            </button>
                        </div>

                        <div id="itemsContainer">
                            <!-- Item 1 -->
                            <div class="item-row card p-3 mb-3 bg-light">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold small">Nama Barang <span class="text-danger">*</span></label>
                                        <input type="text" name="items[0][nama_barang]" class="form-control" placeholder="Nama barang" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold small">Spesifikasi</label>
                                        <input type="text" name="items[0][spesifikasi]" class="form-control" placeholder="Spesifikasi">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold small">Satuan</label>
                                        <select name="items[0][satuan]" class="form-select">
                                            <option value="Unit">Unit</option>
                                            <option value="Buah">Buah</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Box">Box</option>
                                            <option value="Paket">Paket</option>
                                            <option value="Set">Set</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Meter">Meter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" name="items[0][jumlah]" class="form-control" placeholder="0" min="1" required>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="removeItem(this)" disabled>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light p-3 rounded-3">
                            <div class="row g-3">
                                <div class="col-md-6 offset-md-6">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold">Total Item:</span>
                                        <span id="totalItem">1</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold">Total Pengajuan:</span>
                                        <span class="fw-bold text-primary" id="totalPengajuan">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Dokumen -->
                    <div class="step-content d-none" id="step3">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-paperclip me-2"></i>Dokumen Pendukung
                        </h6>
                        <p class="text-muted small mb-3">Centang dokumen yang Anda lampirkan sebagai pendukung pengajuan</p>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card border-2 hover-card">
                                    <div class="card-body text-center p-3">
                                        <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                            <label class="form-check-label fw-semibold">
                                                <i class="bi bi-image text-primary me-2"></i>Foto Barang
                                            </label>
                                            <input class="form-check-input" type="checkbox" name="foto_barang" value="1" role="switch">
                                        </div>
                                        <small class="text-muted">Foto kondisi barang</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-2 hover-card">
                                    <div class="card-body text-center p-3">
                                        <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                            <label class="form-check-label fw-semibold">
                                                <i class="bi bi-file-earmark-text text-danger me-2"></i>Data Kerusakan
                                            </label>
                                            <input class="form-check-input" type="checkbox" name="data_kerusakan" value="1" role="switch">
                                        </div>
                                        <small class="text-muted">Laporan kerusakan barang</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-2 hover-card">
                                    <div class="card-body text-center p-3">
                                        <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                            <label class="form-check-label fw-semibold">
                                                <i class="bi bi-tag text-success me-2"></i>Penawaran Harga
                                            </label>
                                            <input class="form-check-input" type="checkbox" name="penawaran_harga" value="1" role="switch">
                                        </div>
                                        <small class="text-muted">Dokumen penawaran harga</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>Dokumen pendukung dapat dilampirkan setelah pengajuan disetujui.</small>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light rounded-bottom-4 py-3 px-4">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Batal
                            </button>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4" id="prevStep" onclick="prevStep()" style="display: none;">
                                <i class="bi bi-arrow-left me-1"></i>Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary rounded-pill px-4" id="nextStep" onclick="nextStep()">
                                Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                            <button type="submit" class="btn btn-success rounded-pill px-4" id="submitBtn" style="display: none;">
                                <i class="bi bi-check-circle me-1"></i>Kirim Pengajuan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- FIXED STYLES - COPY THIS ENTIRE SECTION -->
<!-- ============================================ -->
<style>
/* ===== BASE STYLES ===== */
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

.nav-tabs-custom .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    border-radius: 10px 10px 0 0;
    transition: all 0.3s ease;
    position: relative;
}
.nav-tabs-custom .nav-link:hover {
    color: #0d6efd;
    background: rgba(13, 110, 253, 0.05);
}
.nav-tabs-custom .nav-link.active {
    color: #0d6efd;
    background: transparent;
    border-bottom: 3px solid #0d6efd;
}
.nav-tabs-custom .nav-link .badge {
    font-size: 10px;
    padding: 3px 8px;
}

.table > :not(caption) > * > * {
    border-bottom-width: 1px;
    padding: 12px 12px;
}
.table thead th {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.stats-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

.btn-outline-primary,
.btn-outline-success,
.btn-outline-warning,
.btn-outline-danger {
    border-width: 1.5px;
}
.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-warning:hover,
.btn-outline-danger:hover {
    transform: scale(1.05);
}

/* Pagination */
.pagination .page-item .page-link {
    border-radius: 8px;
    margin: 0 3px;
    border: none;
    color: #6c757d;
}
.pagination .page-item.active .page-link {
    background: #0d6efd;
    color: white;
}
.pagination .page-item .page-link:hover {
    background: #e9ecef;
    color: #0d6efd;
}

/* ============================================ */
/* ===== FIXED MODAL STYLES - CRITICAL FIX ===== */
/* ============================================ */

/* Fix 1: Proper z-index layering */
.modal {
    z-index: 1060 !important;
}

.modal-backdrop {
    z-index: 1059 !important;
}

.modal-backdrop.show {
    opacity: 0.5;
}

/* Fix 2: Modal content must be clickable */
.modal-content {
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    z-index: 1061 !important;
    pointer-events: auto !important;
}

/* Fix 3: All modal parts must allow pointer events */
.modal-header,
.modal-body,
.modal-footer {
    z-index: 1062 !important;
    position: relative;
    pointer-events: auto !important;
}

/* Fix 4: All interactive elements inside modal must be clickable */
.modal-body * {
    pointer-events: auto !important;
}

.modal-body input,
.modal-body select,
.modal-body textarea,
.modal-body .form-check-input,
.modal-body button,
.modal-body a,
.modal-body .btn,
.modal-body .form-control,
.modal-body .form-select {
    position: relative;
    z-index: 1063 !important;
    pointer-events: auto !important;
}

/* Fix 5: Modal dialog must allow interaction */
.modal-dialog {
    pointer-events: auto !important;
}

/* Fix 6: Navbar z-index - LOWER than modal */
.navbar-glass,
.navbar {
    position: relative;
    z-index: 1030 !important;
}

/* Fix 7: Dropdowns should be above modal if needed */
.dropdown-menu {
    z-index: 1070 !important;
}

/* Fix 8: Modal open body fix */
.modal-open {
    overflow: hidden !important;
    padding-right: 0 !important;
}

.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}

/* Fix 9: Fixed/sticky elements should not overlap modal */
.fixed-top, 
.sticky-top,
.position-fixed {
    z-index: 1030 !important;
}

/* Fix 10: Ensure modal backdrop doesn't block clicks on modal content */
.modal-backdrop {
    pointer-events: auto;
}

.modal.show .modal-dialog {
    transform: none;
    pointer-events: auto !important;
}

/* ============================================ */
/* ===== STEP INDICATOR STYLES ===== */
.step-indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    opacity: 0.5;
    transition: all 0.3s ease;
}
.step-indicator.active {
    opacity: 1;
}
.step-indicator.active .step-number {
    background: #0d6efd;
    color: white;
    transform: scale(1.1);
}
.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
}
.step-label {
    font-size: 11px;
    font-weight: 600;
    color: #6c757d;
}
.step-indicator.active .step-label {
    color: #0d6efd;
}
.step-line {
    width: 40px;
    height: 2px;
    background: #dee2e6;
}
.step-indicator.active + .step-line {
    background: #0d6efd;
}

/* ===== ITEM ROW STYLES ===== */
.item-row {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}
.item-row:hover {
    border-color: #0d6efd;
    background: white !important;
}

/* ===== HOVER CARD STYLES ===== */
.hover-card {
    transition: all 0.3s ease;
    cursor: pointer;
}
.hover-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    border-color: #0d6efd !important;
}

/* ===== FORM CONTROL STYLES ===== */
.form-control, .form-select {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    padding: 10px 14px;
    font-size: 0.9rem;
}
.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}
.form-control.bg-light {
    background: #f8f9fa !important;
}

/* ===== SWITCH STYLES ===== */
.form-switch .form-check-input {
    width: 40px;
    height: 20px;
    cursor: pointer;
}
.form-switch .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .stats-icon {
        width: 40px;
        height: 40px;
    }
    .stats-icon i {
        font-size: 1.2rem !important;
    }
    .table-responsive {
        font-size: 0.85rem;
    }
    .btn-sm {
        padding: 0.2rem 0.4rem;
    }
    .modal-dialog {
        margin: 10px;
    }
    .modal-body {
        padding: 20px !important;
    }
    .step-indicator .step-label {
        font-size: 9px;
    }
    .step-line {
        width: 20px;
    }
}
</style>

<!-- ============================================ -->
<!-- SCRIPTS -->
<!-- ============================================ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Fix: Ensure modal is on top when shown
    document.addEventListener('shown.bs.modal', function(e) {
        if (e.target.id === 'modalPengajuan') {
            // Force modal to be on top
            e.target.style.zIndex = '1060';
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.style.zIndex = '1059';
            }
            // Re-apply pointer events
            document.querySelectorAll('.modal-body *').forEach(function(el) {
                el.style.pointerEvents = 'auto';
            });
        }
    });
});

// ===== MODAL FUNCTIONS =====
let itemIndex = 1;
let currentStep = 1;
const totalSteps = 3;

// Add Item
function addItem() {
    const container = document.getElementById('itemsContainer');
    const itemRow = document.createElement('div');
    itemRow.className = 'item-row card p-3 mb-3 bg-light';
    itemRow.innerHTML = `
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" name="items[${itemIndex}][nama_barang]" class="form-control" placeholder="Nama barang" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Spesifikasi</label>
                <input type="text" name="items[${itemIndex}][spesifikasi]" class="form-control" placeholder="Spesifikasi">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold small">Satuan</label>
                <select name="items[${itemIndex}][satuan]" class="form-select">
                    <option value="Unit">Unit</option>
                    <option value="Buah">Buah</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Box">Box</option>
                    <option value="Paket">Paket</option>
                    <option value="Set">Set</option>
                    <option value="Kg">Kg</option>
                    <option value="Gram">Gram</option>
                    <option value="Liter">Liter</option>
                    <option value="Meter">Meter</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                <input type="number" name="items[${itemIndex}][jumlah]" class="form-control" placeholder="0" min="1" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="removeItem(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(itemRow);
    itemIndex++;
    updateTotalItem();
}

// Remove Item
function removeItem(button) {
    const row = button.closest('.item-row');
    if (document.querySelectorAll('.item-row').length > 1) {
        row.remove();
        updateTotalItem();
    } else {
        alert('Minimal 1 item harus diisi!');
    }
}

// Update Total Item
function updateTotalItem() {
    const total = document.querySelectorAll('.item-row').length;
    document.getElementById('totalItem').textContent = total;
}

// Step Navigation
function nextStep() {
    if (currentStep < totalSteps) {
        document.getElementById(`step${currentStep}`).classList.add('d-none');
        currentStep++;
        document.getElementById(`step${currentStep}`).classList.remove('d-none');
        updateStepIndicators();
        updateButtons();
    }
}

function prevStep() {
    if (currentStep > 1) {
        document.getElementById(`step${currentStep}`).classList.add('d-none');
        currentStep--;
        document.getElementById(`step${currentStep}`).classList.remove('d-none');
        updateStepIndicators();
        updateButtons();
    }
}

function updateStepIndicators() {
    document.querySelectorAll('.step-indicator').forEach((el, index) => {
        el.classList.toggle('active', index + 1 === currentStep);
    });
}

function updateButtons() {
    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    
    if (prevBtn) prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';
    if (nextBtn) nextBtn.style.display = currentStep === totalSteps ? 'none' : 'inline-block';
    if (submitBtn) submitBtn.style.display = currentStep === totalSteps ? 'inline-block' : 'none';
}

// Reset modal when closed
document.getElementById('modalPengajuan').addEventListener('hidden.bs.modal', function() {
    currentStep = 1;
    document.querySelectorAll('.step-content').forEach((el, index) => {
        el.classList.toggle('d-none', index !== 0);
    });
    updateStepIndicators();
    updateButtons();
    document.getElementById('formPengajuan').reset();
    // Reset items to 1
    const container = document.getElementById('itemsContainer');
    container.innerHTML = `
        <div class="item-row card p-3 mb-3 bg-light">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" name="items[0][nama_barang]" class="form-control" placeholder="Nama barang" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Spesifikasi</label>
                    <input type="text" name="items[0][spesifikasi]" class="form-control" placeholder="Spesifikasi">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold small">Satuan</label>
                    <select name="items[0][satuan]" class="form-select">
                        <option value="Unit">Unit</option>
                        <option value="Buah">Buah</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Box">Box</option>
                        <option value="Paket">Paket</option>
                        <option value="Set">Set</option>
                        <option value="Kg">Kg</option>
                        <option value="Gram">Gram</option>
                        <option value="Liter">Liter</option>
                        <option value="Meter">Meter</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="items[0][jumlah]" class="form-control" placeholder="0" min="1" required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="removeItem(this)" disabled>
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    itemIndex = 1;
    updateTotalItem();
});

// Validate form before submit
document.getElementById('formPengajuan').addEventListener('submit', function(e) {
    const items = document.querySelectorAll('.item-row');
    let valid = true;
    items.forEach((row, index) => {
        const nama = row.querySelector(`input[name="items[${index}][nama_barang]"]`);
        const jumlah = row.querySelector(`input[name="items[${index}][jumlah]"]`);
        if (!nama.value.trim()) {
            valid = false;
            nama.classList.add('is-invalid');
        } else {
            nama.classList.remove('is-invalid');
        }
        if (!jumlah.value || parseInt(jumlah.value) < 1) {
            valid = false;
            jumlah.classList.add('is-invalid');
        } else {
            jumlah.classList.remove('is-invalid');
        }
    });

    if (!valid) {
        e.preventDefault();
        alert('Mohon lengkapi data barang yang wajib diisi!');
    }
});
</script>
@endsection --}}

@extends('layouts.pengadaan.pemohon')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Section dengan Statistik -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-box-seam text-primary me-2"></i>Pengadaan Barang
                    </h4>
                    <p class="text-muted mb-0">Kelola permintaan dan perbaikan barang Anda</p>
                </div>
                <div>
                    <a href="{{ route('pemohon.pengadaan.create') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle me-2"></i>Buat Pengajuan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
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
                        <div class="stats-icon bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Draft</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['draft'] ?? 0 }}</h5>
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
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Proses</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['diajukan'] ?? 0 }}</h5>
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
    </div>

    <!-- Filter & Search Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('pemohon.pengadaan') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
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
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-filter me-1"></i> Status
                    </label>
                    <select name="status" class="form-select bg-light border-0">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="disetujui_koordinator" {{ request('status') == 'disetujui_koordinator' ? 'selected' : '' }}>Disetujui Koordinator</option>
                        <option value="disetujui_kabid" {{ request('status') == 'disetujui_kabid' ? 'selected' : '' }}>Disetujui Kabid</option>
                        <option value="menunggu_direktur" {{ request('status') == 'menunggu_direktur' ? 'selected' : '' }}>Menunggu Direktur</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-building me-1"></i> Bidang
                    </label>
                    <select name="bidang" class="form-select bg-light border-0">
                        <option value="">Semua Bidang</option>
                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}" {{ request('bidang') == $bidang->id ? 'selected' : '' }}>
                                {{ $bidang->nama_bidang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabs -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-tabs-custom border-0 px-4 pt-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-4 py-2" data-bs-toggle="tab" data-bs-target="#semua" type="button" role="tab">
                        <i class="bi bi-grid-3x3-gap me-2"></i>Semua
                        <span class="badge bg-primary rounded-pill ms-2">{{ $stats['total'] ?? 0 }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-2" data-bs-toggle="tab" data-bs-target="#permintaan" type="button" role="tab">
                        <i class="bi bi-box me-2"></i>Permintaan
                        <span class="badge bg-success rounded-pill ms-2">{{ $stats['permintaan_count'] ?? 0 }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-2" data-bs-toggle="tab" data-bs-target="#perbaikan" type="button" role="tab">
                        <i class="bi bi-tools me-2"></i>Perbaikan
                        <span class="badge bg-warning rounded-pill ms-2">{{ $stats['perbaikan_count'] ?? 0 }}</span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content p-4">
                <!-- Tab Semua -->
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="25%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="15%">Aksi</th>
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
                                    <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
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
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak'
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
                                            <a href="#" class="btn btn-sm btn-outline-primary rounded-3" data-bs-toggle="tooltip" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'draft')
                                                <a href="#" class="btn btn-sm btn-outline-warning rounded-3" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger rounded-3" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                            @if($pengajuan->status == 'disetujui')
                                                <a href="#" class="btn btn-sm btn-outline-success rounded-3" data-bs-toggle="tooltip" title="Cetak">
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
                                        <p class="text-muted small">Silakan buat pengajuan baru untuk memulai</p>
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

                <!-- Tab Permintaan -->
                <div class="tab-pane fade" id="permintaan" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="25%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permintaanPengajuan as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-semibold text-success">{{ $pengajuan->no_pengajuan }}</span>
                                        <br>
                                        <small class="text-muted">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</small>
                                    </td>
                                    <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
                                    <td>
                                        @foreach($pengajuan->items->take(2) as $item)
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-dot text-success"></i>
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
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak'
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
                                            <a href="#" class="btn btn-sm btn-outline-primary rounded-3">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'draft')
                                                <a href="#" class="btn btn-sm btn-outline-warning rounded-3">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-box text-muted fs-1 d-block mb-3"></i>
                                        <h6 class="text-muted">Belum ada pengajuan permintaan</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $permintaanPengajuan->firstItem() ?? 0 }} - {{ $permintaanPengajuan->lastItem() ?? 0 }} 
                            dari {{ $permintaanPengajuan->total() }} data
                        </div>
                        {{ $permintaanPengajuan->links() }}
                    </div>
                </div>

                <!-- Tab Perbaikan -->
                <div class="tab-pane fade" id="perbaikan" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3" width="5%">#</th>
                                    <th class="py-3 px-3" width="15%">No Pengajuan</th>
                                    <th class="py-3 px-3" width="15%">Tanggal</th>
                                    <th class="py-3 px-3" width="25%">Nama Barang</th>
                                    <th class="py-3 px-3" width="15%">Status</th>
                                    <th class="py-3 px-3" width="10%">Total</th>
                                    <th class="py-3 px-3 text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($perbaikanPengajuan as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="fw-semibold text-warning">{{ $pengajuan->no_pengajuan }}</span>
                                        <br>
                                        <small class="text-muted">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</small>
                                    </td>
                                    <td>{{ $pengajuan->tanggal_pengajuan->format('d/m/Y') }}</td>
                                    <td>
                                        @foreach($pengajuan->items->take(2) as $item)
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="bi bi-dot text-warning"></i>
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
                                                'diajukan' => 'warning',
                                                'disetujui_koordinator' => 'info',
                                                'disetujui_kabid' => 'primary',
                                                'menunggu_direktur' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger'
                                            ][$pengajuan->status] ?? 'secondary';
                                            
                                            $statusLabel = [
                                                'draft' => 'Draft',
                                                'diajukan' => 'Diajukan',
                                                'disetujui_koordinator' => 'Disetujui Koordinator',
                                                'disetujui_kabid' => 'Disetujui Kabid',
                                                'menunggu_direktur' => 'Menunggu Direktur',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak'
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
                                            <a href="#" class="btn btn-sm btn-outline-primary rounded-3">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'draft')
                                                <a href="#" class="btn btn-sm btn-outline-warning rounded-3">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-tools text-muted fs-1 d-block mb-3"></i>
                                        <h6 class="text-muted">Belum ada pengajuan perbaikan</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $perbaikanPengajuan->firstItem() ?? 0 }} - {{ $perbaikanPengajuan->lastItem() ?? 0 }} 
                            dari {{ $perbaikanPengajuan->total() }} data
                        </div>
                        {{ $perbaikanPengajuan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ===== BASE STYLES ===== */
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

.nav-tabs-custom .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    border-radius: 10px 10px 0 0;
    transition: all 0.3s ease;
    position: relative;
}
.nav-tabs-custom .nav-link:hover {
    color: #0d6efd;
    background: rgba(13, 110, 253, 0.05);
}
.nav-tabs-custom .nav-link.active {
    color: #0d6efd;
    background: transparent;
    border-bottom: 3px solid #0d6efd;
}
.nav-tabs-custom .nav-link .badge {
    font-size: 10px;
    padding: 3px 8px;
}

.table > :not(caption) > * > * {
    border-bottom-width: 1px;
    padding: 12px 12px;
}
.table thead th {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.stats-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

.btn-outline-primary,
.btn-outline-success,
.btn-outline-warning,
.btn-outline-danger {
    border-width: 1.5px;
}
.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-warning:hover,
.btn-outline-danger:hover {
    transform: scale(1.05);
}

/* Pagination */
.pagination .page-item .page-link {
    border-radius: 8px;
    margin: 0 3px;
    border: none;
    color: #6c757d;
}
.pagination .page-item.active .page-link {
    background: #0d6efd;
    color: white;
}
.pagination .page-item .page-link:hover {
    background: #e9ecef;
    color: #0d6efd;
}

@media (max-width: 768px) {
    .stats-icon {
        width: 40px;
        height: 40px;
    }
    .stats-icon i {
        font-size: 1.2rem !important;
    }
    .table-responsive {
        font-size: 0.85rem;
    }
    .btn-sm {
        padding: 0.2rem 0.4rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection