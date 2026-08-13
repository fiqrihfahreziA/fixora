@extends('layouts.pengadaan.keuangan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark">
            <i class="bi bi-file-earmark-text text-primary me-2"></i>
            Detail Pengajuan - {{ $pengajuan->no_pengajuan }}
        </h4>
        <span class="text-muted">Pengajuan oleh: {{ $pengajuan->karyawan->nama ?? '-' }}</span>
    </div>
    <a href="{{ route('keuangan.pengadaan') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<!-- Status Pengajuan -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    @php
                        $statusBadge = [
                            'draft' => 'secondary',
                            'diajukan' => 'warning',
                            'revisi' => 'warning',
                            'disetujui_koordinator' => 'info',
                            'disetujui_kabid' => 'primary',
                            'menunggu_direktur' => 'warning',
                            'disetujui' => 'success',
                            'ditolak' => 'danger',
                            'ditolak_penerima' => 'danger'
                        ][$pengajuan->status] ?? 'secondary';
                        
                        $statusLabel = [
                            'draft' => 'Draft',
                            'diajukan' => 'Diajukan',
                            'revisi' => 'Revisi',
                            'disetujui_koordinator' => 'Disetujui Koordinator',
                            'disetujui_kabid' => 'Disetujui Kabid',
                            'menunggu_direktur' => 'Menunggu Direktur',
                            'disetujui' => 'Disetujui',
                            'ditolak' => 'Ditolak',
                            'ditolak_penerima' => 'Ditolak Penerima'
                        ][$pengajuan->status] ?? $pengajuan->status;
                    @endphp
                    <span class="badge bg-{{ $statusBadge }} fs-6 px-3 py-2">
                        <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>
                        {{ $statusLabel }}
                    </span>
                    <small class="text-muted">
                        <i class="bi bi-calendar3 me-1"></i>
                        Diajukan: {{ date('d M Y H:i', strtotime($pengajuan->created_at)) }}
                    </small>
                    @if($pengajuan->disetujui_kabid_at)
                    <small class="text-success">
                        <i class="bi bi-check-circle me-1"></i>
                        Disetujui Atasan: {{ date('d M Y H:i', strtotime($pengajuan->disetujui_kabid_at)) }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="fw-bold">Total Pengajuan: </span>
                <span class="text-primary fw-bold fs-5">
                    Rp {{ number_format($pengajuan->total_pengajuan, 0, ',', '.') }}
                </span>
            </div>
        </div>
        
        @if($pengajuan->catatan_bidang)
        <div class="mt-3 p-3 bg-light rounded">
            <div class="d-flex align-items-start gap-2">
                <i class="bi bi-chat-quote text-primary mt-1"></i>
                <div>
                    <small class="text-muted fw-semibold">Catatan dari Atasan (Kabid):</small>
                    <p class="mb-0 text-secondary">{{ $pengajuan->catatan_bidang }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <!-- Kolom Kiri -->
    <div class="col-lg-8">
        <!-- Informasi Pengaju -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-person-badge me-2 text-primary"></i>Informasi Pengaju
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Nama Pengaju</div>
                            <div class="value">{{ $pengajuan->karyawan->nama ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Jabatan</div>
                            <div class="value">{{ $pengajuan->karyawan->jabatan ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Bidang</div>
                            <div class="value">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Instalasi</div>
                            <div class="value">{{ $pengajuan->instalasi ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalPengaju">
                            <i class="bi bi-eye me-1"></i> Lihat Detail Lengkap Pengaju
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Penerima -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom border-success">
                <h6 class="fw-bold mb-0 text-success">
                    <i class="bi bi-person-check me-2"></i>Informasi Penerima (User)
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item bg-success bg-opacity-10">
                            <div class="label">Nama Penerima</div>
                            <div class="value">{{ $pengajuan->penerima->nama ?? 'Belum ditentukan' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-success bg-opacity-10">
                            <div class="label">Jabatan Penerima</div>
                            <div class="value">{{ $pengajuan->penerima->jabatan ?? 'Belum ditentukan' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-success bg-opacity-10">
                            <div class="label">Bidang Penerima</div>
                            <div class="value">{{ $pengajuan->penerima->bidang->nama_bidang ?? 'Belum ditentukan' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-success bg-opacity-10">
                            <div class="label">Status Penerimaan</div>
                            <div class="value">
                                @if($pengajuan->status_penerimaan == 'diterima')
                                    <span class="badge bg-success">Sudah Menerima</span>
                                @elseif($pengajuan->status_penerimaan == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="#" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalPenerima">
                            <i class="bi bi-eye me-1"></i> Lihat Detail Lengkap Penerima
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Atasan -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom border-primary">
                <h6 class="fw-bold mb-0 text-primary">
                    <i class="bi bi-person-up me-2"></i>Informasi Atasan (Approval)
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item bg-primary bg-opacity-10">
                            <div class="label">Nama Atasan</div>
                            <div class="value">{{ $pengajuan->atasan->nama ?? 'Belum ditentukan' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-primary bg-opacity-10">
                            <div class="label">Jabatan Atasan</div>
                            <div class="value">{{ $pengajuan->atasan->jabatan ?? 'Belum ditentukan' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-primary bg-opacity-10">
                            <div class="label">Status Persetujuan</div>
                            <div class="value">
                                @if($pengajuan->disetujui_kabid_at)
                                    <span class="badge bg-success">Sudah Menyetujui</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-primary bg-opacity-10">
                            <div class="label">Tanggal Persetujuan</div>
                            <div class="value">{{ $pengajuan->disetujui_kabid_at ? date('d M Y H:i', strtotime($pengajuan->disetujui_kabid_at)) : '-' }}</div>
                        </div>
                    </div>
                    @if($pengajuan->catatan_bidang)
                    <div class="col-12">
                        <div class="info-item bg-primary bg-opacity-10">
                            <div class="label">Catatan Atasan</div>
                            <div class="value">{{ $pengajuan->catatan_bidang }}</div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAtasan">
                            <i class="bi bi-eye me-1"></i> Lihat Detail Lengkap Atasan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alasan & Manfaat -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary mb-2">
                            <i class="bi bi-clipboard-check me-2"></i>Alasan Justifikasi
                        </h6>
                        <p class="mb-0 text-secondary" style="word-wrap: break-word; max-height: 150px; overflow-y: auto;">
                            {{ $pengajuan->alasan_justifikasi ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-2">
                            <i class="bi bi-star-fill me-2"></i>Manfaat
                        </h6>
                        <p class="mb-0 text-secondary" style="word-wrap: break-word; max-height: 150px; overflow-y: auto;">
                            {{ $pengajuan->manfaat ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dampak -->
        <div class="card border-warning shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold text-warning mb-2">
                    <i class="bi bi-exclamation-triangle me-2"></i>Dampak Jika Tidak Dilaksanakan
                </h6>
                <p class="mb-0 text-secondary">{{ $pengajuan->dampak ?? '-' }}</p>
            </div>
        </div>

        <!-- Kondisi Barang Lama -->
        @if($pengajuan->kondisi_barang_lama)
        <div class="card border-info shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold text-info mb-2">
                    <i class="bi bi-box-seam me-2"></i>Kondisi Barang Lama
                </h6>
                <div class="d-flex gap-3">
                    <span class="badge bg-warning text-dark">{{ $pengajuan->kondisi_barang_lama }}</span>
                    <small class="text-muted">{{ $pengajuan->ket_barang_lama ?? '-' }}</small>
                </div>
            </div>
        </div>
        @endif

        <!-- Daftar Barang -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent">
                <h6 class="fw-bold mb-0"><i class="bi bi-list-check me-2"></i>Daftar Barang yang Diajukan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuan->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->nama_barang }}</strong>
                                    <br>
                                    <small class="text-muted">Spesifikasi: {{ $item->spesifikasi ?? '-' }}</small>
                                </td>
                                <td class="text-center">{{ $item->jumlah }} {{ $item->satuan ?? 'Unit' }}</td>
                                <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="text-end fw-bold text-primary">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total Pengajuan</td>
                                <td class="text-end fw-bold text-primary">
                                    Rp {{ number_format($pengajuan->total_pengajuan, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- PDF Data Kerusakan -->
        @if($pengajuan->data_kerusakan)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="fw-bold mb-0 text-danger">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Dokumen Pendukung
                </h6>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center gap-3">
                            <div style="font-size: 40px; color: #dc3545;">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </div>
                            <div>
                                <p class="fw-semibold mb-1">{{ basename($pengajuan->data_kerusakan) }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    Diupload: {{ date('d M Y H:i', strtotime($pengajuan->created_at)) }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ asset('storage/' . $pengajuan->data_kerusakan) }}" 
                           target="_blank" 
                           class="btn btn-danger btn-sm rounded-pill px-3">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                        <a href="{{ asset('storage/' . $pengajuan->data_kerusakan) }}" 
                           download 
                           class="btn btn-outline-danger btn-sm rounded-pill px-3">
                            <i class="bi bi-download me-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Kolom Kanan: Timeline & Informasi -->
    <div class="col-lg-4">
        <!-- Ringkasan -->
        <div class="card border-0 shadow-sm bg-light mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-info-circle text-primary me-2"></i>Ringkasan Pengajuan
                </h6>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <span class="text-muted">No. Pengajuan</span>
                    <span class="fw-semibold">{{ $pengajuan->no_pengajuan }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <span class="text-muted">Pengaju</span>
                    <span class="fw-semibold">{{ $pengajuan->karyawan->nama ?? '-' }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <span class="text-muted">Penerima</span>
                    <span class="fw-semibold">{{ $pengajuan->penerima->nama ?? 'Belum ditentukan' }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <span class="text-muted">Atasan</span>
                    <span class="fw-semibold">{{ $pengajuan->atasan->nama ?? 'Belum ditentukan' }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Total Pengajuan</span>
                    <span class="text-primary fw-bold">Rp {{ number_format($pengajuan->total_pengajuan, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Timeline Persetujuan -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Alur Persetujuan
                </h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <!-- 1. Pengajuan -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-warning">
                            <i class="bi bi-file-earmark-text text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold mb-0">1. Pengajuan</h6>
                            <small class="text-muted">{{ date('d M Y H:i', strtotime($pengajuan->created_at)) }}</small>
                            <p class="mb-0 small text-muted">{{ $pengajuan->karyawan->nama ?? '-' }} mengajukan permohonan</p>
                        </div>
                    </div>

                    <!-- 2. Atasan -->
                    <div class="timeline-item">
                        <div class="timeline-icon {{ $pengajuan->disetujui_kabid_at ? 'bg-success' : 'bg-secondary' }}">
                            <i class="bi bi-person-up text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold mb-0">2. Persetujuan Atasan</h6>
                            <small class="text-muted">{{ $pengajuan->atasan->nama ?? 'Atasan' }}</small>
                            @if($pengajuan->disetujui_kabid_at)
                                <p class="mb-0 small text-success">
                                    <i class="bi bi-check-circle"></i> Disetujui 
                                    {{ date('d M Y', strtotime($pengajuan->disetujui_kabid_at)) }}
                                </p>
                            @else
                                <p class="mb-0 small text-warning">⏳ Menunggu persetujuan</p>
                            @endif
                        </div>
                    </div>

                    <!-- 3. Penerima -->
                    <div class="timeline-item">
                        <div class="timeline-icon {{ $pengajuan->status_penerimaan == 'diterima' ? 'bg-success' : 'bg-secondary' }}">
                            <i class="bi bi-person-check text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold mb-0">3. Konfirmasi Penerima</h6>
                            <small class="text-muted">{{ $pengajuan->penerima->nama ?? 'Penerima' }}</small>
                            @if($pengajuan->status_penerimaan == 'diterima')
                                <p class="mb-0 small text-success">
                                    <i class="bi bi-check-circle"></i> Telah menerima barang
                                </p>
                            @elseif($pengajuan->status_penerimaan == 'ditolak')
                                <p class="mb-0 small text-danger">
                                    <i class="bi bi-x-circle"></i> Ditolak penerima
                                </p>
                            @else
                                <p class="mb-0 small text-warning">⏳ Menunggu konfirmasi penerima</p>
                            @endif
                        </div>
                    </div>

                    <!-- 4. Keuangan -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-primary">
                            <i class="bi bi-cash-stack text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold mb-0">4. Verifikasi Keuangan</h6>
                            <small class="text-muted">Petugas Keuangan</small>
                            <p class="mb-0 small text-muted">⏳ Menunggu verifikasi</p>
                        </div>
                    </div>

                    <!-- 5. Direktur -->
                    <div class="timeline-item">
                        <div class="timeline-icon bg-secondary">
                            <i class="bi bi-building text-white"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="fw-bold mb-0">5. Persetujuan Direktur</h6>
                            <small class="text-muted">Direktur</small>
                            <p class="mb-0 small text-muted">⏳ Menunggu persetujuan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="card border-0 shadow-sm bg-info bg-opacity-10">
            <div class="card-body">
                <h6 class="fw-bold mb-2">
                    <i class="bi bi-lightbulb text-info me-2"></i>Informasi Verifikasi
                </h6>
                <ul class="small text-muted mb-0 ps-3">
                    <li class="mb-2">📋 Pastikan dokumen pendukung lengkap</li>
                    <li class="mb-2">💰 Cek kesesuaian anggaran</li>
                    <li class="mb-2">✅ Periksa kelengkapan data barang</li>
                    <li class="mb-2">📝 Cek catatan dari atasan</li>
                    <li>🔍 Verifikasi identitas penerima</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PENGAJU -->
<div class="modal fade" id="modalPengaju" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-person-badge me-2"></i>Detail Lengkap Pengaju
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Nama Lengkap</div>
                            <div class="value">{{ $pengajuan->karyawan->nama ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">NIP / NIK</div>
                            <div class="value">{{ $pengajuan->karyawan->nip ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Jabatan</div>
                            <div class="value">{{ $pengajuan->karyawan->jabatan ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Bidang</div>
                            <div class="value">{{ $pengajuan->bidang->nama_bidang ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Instalasi</div>
                            <div class="value">{{ $pengajuan->instalasi ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Email</div>
                            <div class="value">{{ $pengajuan->karyawan->email ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">No. Telepon</div>
                            <div class="value">{{ $pengajuan->karyawan->no_telepon ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Tanggal Bergabung</div>
                            <div class="value">{{ $pengajuan->karyawan->tanggal_bergabung ? date('d M Y', strtotime($pengajuan->karyawan->tanggal_bergabung)) : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PENERIMA -->
<div class="modal fade" id="modalPenerima" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bi bi-person-check me-2"></i>Detail Lengkap Penerima
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Nama Lengkap</div>
                            <div class="value">{{ $pengajuan->penerima->nama ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">NIP / NIK</div>
                            <div class="value">{{ $pengajuan->penerima->nip ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Jabatan</div>
                            <div class="value">{{ $pengajuan->penerima->jabatan ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Bidang</div>
                            <div class="value">{{ $pengajuan->penerima->bidang->nama_bidang ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Email</div>
                            <div class="value">{{ $pengajuan->penerima->email ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">No. Telepon</div>
                            <div class="value">{{ $pengajuan->penerima->no_telepon ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Status Penerimaan</div>
                            <div class="value">
                                @if($pengajuan->status_penerimaan == 'diterima')
                                    <span class="badge bg-success">Sudah Menerima</span>
                                @elseif($pengajuan->status_penerimaan == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Tanggal Konfirmasi</div>
                            <div class="value">{{ $pengajuan->tanggal_konfirmasi_penerima ? date('d M Y H:i', strtotime($pengajuan->tanggal_konfirmasi_penerima)) : '-' }}</div>
                        </div>
                    </div>
                    @if($pengajuan->catatan_penerima)
                    <div class="col-12">
                        <div class="info-item-modal">
                            <div class="label">Catatan Penerima</div>
                            <div class="value">{{ $pengajuan->catatan_penerima }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ATASAN -->
<div class="modal fade" id="modalAtasan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-person-up me-2"></i>Detail Lengkap Atasan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Nama Lengkap</div>
                            <div class="value">{{ $pengajuan->atasan->nama ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">NIP / NIK</div>
                            <div class="value">{{ $pengajuan->atasan->nip ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Jabatan</div>
                            <div class="value">{{ $pengajuan->atasan->jabatan ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Bidang</div>
                            <div class="value">{{ $pengajuan->atasan->bidang->nama_bidang ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Email</div>
                            <div class="value">{{ $pengajuan->atasan->email ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">No. Telepon</div>
                            <div class="value">{{ $pengajuan->atasan->no_telepon ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Status Persetujuan</div>
                            <div class="value">
                                @if($pengajuan->disetujui_kabid_at)
                                    <span class="badge bg-success">Sudah Menyetujui</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item-modal">
                            <div class="label">Tanggal Persetujuan</div>
                            <div class="value">{{ $pengajuan->disetujui_kabid_at ? date('d M Y H:i', strtotime($pengajuan->disetujui_kabid_at)) : '-' }}</div>
                        </div>
                    </div>
                    @if($pengajuan->catatan_bidang)
                    <div class="col-12">
                        <div class="info-item-modal">
                            <div class="label">Catatan Atasan</div>
                            <div class="value">{{ $pengajuan->catatan_bidang }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    background: #f8f9fa;
    padding: 10px 14px;
    border-radius: 8px;
}
.info-item .label {
    font-size: 0.7rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}
.info-item .value {
    font-size: 0.95rem;
    font-weight: 500;
    color: #1a1a2e;
    margin-top: 2px;
}

.info-item-modal {
    background: #f8f9fa;
    padding: 12px 16px;
    border-radius: 8px;
    border-left: 3px solid #0d6efd;
}
.info-item-modal .label {
    font-size: 0.7rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}
.info-item-modal .value {
    font-size: 1rem;
    font-weight: 500;
    color: #1a1a2e;
    margin-top: 2px;
}

/* Timeline Styles */
.timeline {
    position: relative;
    padding-left: 30px;
}
.timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}
.timeline-item {
    position: relative;
    margin-bottom: 25px;
}
.timeline-item:last-child {
    margin-bottom: 0;
}
.timeline-icon {
    position: absolute;
    left: -22px;
    top: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}
.timeline-icon i {
    font-size: 14px;
}
.timeline-content {
    padding-left: 5px;
}
.timeline-content h6 {
    font-size: 0.9rem;
}
.timeline-content small {
    font-size: 0.75rem;
}
.timeline-content p {
    font-size: 0.8rem;
}
</style>
@endsection