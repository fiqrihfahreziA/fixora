@extends('layouts.pengadaan.penerima')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark">
            <i class="bi bi-file-earmark-text text-primary me-2"></i>
            Detail Pengajuan
        </h4>
        <span class="text-muted">{{ $pengajuan->no_pengajuan }}</span>
    </div>
    <a href="#" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<!-- Status -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <span class="badge bg-{{ $pengajuan->status_badge }} fs-6 px-3 py-2">
                    <i class="{{ $pengajuan->status_icon }} me-1"></i>
                    {{ $pengajuan->status_label }}
                </span>
                <small class="text-muted ms-3">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $pengajuan->created_at->format('d M Y H:i') }}
                </small>
                @if($pengajuan->diterima_at)
                <small class="text-success ms-3">
                    <i class="bi bi-check-circle me-1"></i>
                    Diterima: {{ $pengajuan->diterima_at->format('d M Y H:i') }}
                </small>
                @endif
            </div>
            <div>
                <span class="fw-bold">Total: </span>
                <span class="text-primary fw-bold fs-5">
                    Rp {{ number_format($pengajuan->total_pengajuan, 0, ',', '.') }}
                </span>
            </div>
        </div>
        @if($pengajuan->catatan_unit)
        <div class="mt-3 p-3 bg-light rounded">
            <small class="text-muted fw-semibold">Catatan Penerima:</small>
            <p class="mb-0 text-secondary">{{ $pengajuan->catatan_unit }}</p>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <!-- Kolom Kiri: Informasi -->
    <div class="col-md-8">
        <!-- Info Grid -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Pengajuan</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Pemohon</div>
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
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Dasar Usulan</div>
                            <div class="value">{{ $pengajuan->dasar_usulan ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="label">Tahun Anggaran</div>
                            <div class="value">{{ $pengajuan->tahun_anggaran ?? '-' }}</div>
                        </div>
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
                        <p class="mb-0 text-secondary">{{ $pengajuan->alasan_justifikasi ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-2">
                            <i class="bi bi-star-fill me-2"></i>Manfaat
                        </h6>
                        <p class="mb-0 text-secondary">{{ $pengajuan->manfaat ?? '-' }}</p>
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
                <h6 class="fw-bold mb-0"><i class="bi bi-list-check me-2"></i>Daftar Barang</h6>
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
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold text-primary">
                                    Rp {{ number_format($pengajuan->total_pengajuan, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Update -->
    <div class="col-md-4">
        @if($pengajuan->status == 'menunggu')
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Update Pengajuan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('penerima.pengadaan.update', $pengajuan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">Pilih Status</option>
                            <option value="diajukan">✅ Diajukan (Terima)</option>
                            <option value="ditolak">❌ Tolak</option>
                        </select>
                        <small class="text-muted">Pilih "Diajukan" untuk meneruskan ke tahap berikutnya</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Catatan</label>
                        <textarea name="catatan_unit" class="form-control" rows="4" placeholder="Tambahkan catatan..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </form>

                <hr>

                <!-- Form Revisi -->
                <form action="{{ route('penerima.pengadaan.revisi', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-warning">
                            <i class="bi bi-pencil me-1"></i> Minta Revisi
                        </label>
                        <textarea name="catatan_revisi" class="form-control" rows="2" placeholder="Jelaskan apa yang perlu direvisi..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="bi bi-arrow-return-left me-1"></i> Minta Revisi
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-check-circle fs-1 text-success"></i>
                <h6 class="mt-3">Pengajuan sudah direspon</h6>
                <p class="text-muted small">Status: {{ $pengajuan->status_label }}</p>
                @if($pengajuan->diterima_at)
                <small class="text-muted">Diterima: {{ $pengajuan->diterima_at->format('d M Y H:i') }}</small>
                @endif
            </div>
        </div>
        @endif

        <!-- Info Penerima -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-2">
                    <i class="bi bi-person-check me-2 text-primary"></i>Penerima
                </h6>
                <p class="mb-1">{{ $authUser->name }}</p>
                <small class="text-muted">{{ $authUser->email }}</small>
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
</style>
@endsection