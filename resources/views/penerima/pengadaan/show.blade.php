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
    <a href="{{ route('penerima.chartp') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<!-- Status -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
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
                        'diterima' => 'success',
                        'menunggu_diterima' => 'warning',
                        'ditolak_penerima' => 'danger',
                        'diverifikasi' => 'success'
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
                        'diterima' => 'Diterima',
                        'menunggu_diterima' => 'Menunggu Diterima',
                        'ditolak_penerima' => 'Ditolak Penerima',
                        'diverifikasi' => 'Diverifikasi'
                    ][$pengajuan->status] ?? $pengajuan->status;
                @endphp
                <span class="badge bg-{{ $statusBadge }} fs-6 px-3 py-2">
                    <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>
                    {{ $statusLabel }}
                </span>
                <small class="text-muted ms-3">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ date('d M Y H:i', strtotime($pengajuan->created_at)) }}
                </small>
                @if($pengajuan->diterima_at)
                <small class="text-success ms-3">
                    <i class="bi bi-check-circle me-1"></i>
                    Diterima: {{ date('d M Y H:i', strtotime($pengajuan->diterima_at)) }}
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
                <p class="mb-0 text-secondary" style="word-wrap: break-word; max-height: 100px; overflow-y: auto;">
                    {{ $pengajuan->dampak ?? '-' }}
                </p>
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

        <!-- ===== DATA KERUSAKAN (PDF) ===== -->
        @if($pengajuan->data_kerusakan)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="fw-bold mb-0 text-danger">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Data Kerusakan
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
                                @php
                                    $fileSize = Storage::disk('public')->exists($pengajuan->data_kerusakan) 
                                        ? Storage::disk('public')->size($pengajuan->data_kerusakan) 
                                        : 0;
                                @endphp
                                @if($fileSize > 0)
                                <br>
                                <small class="text-muted">
                                    <i class="bi bi-filetype-pdf me-1"></i>
                                    Ukuran: {{ number_format($fileSize / 1024, 2) }} KB
                                </small>
                                @endif
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

                <!-- Preview PDF -->
                <div class="mt-3">
                    <div class="border rounded-3 p-2" style="background: #f8f9fa;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted">Preview</small>
                            <a href="{{ asset('storage/' . $pengajuan->data_kerusakan) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-link text-primary">
                                <i class="bi bi-box-arrow-up-right me-1"></i>Buka baru
                            </a>
                        </div>

                        <embed src="{{ asset('storage/' . $pengajuan->data_kerusakan) }}" 
                               type="application/pdf" 
                               width="100%" 
                               height="350px" 
                               style="border-radius: 6px;">
                        <small class="text-muted d-block text-center mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Jika tidak muncul, klik tombol "Lihat"
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Jika tidak ada data kerusakan -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold text-muted mb-0">
                    <i class="bi bi-file-earmark me-2"></i>
                    Tidak ada dokumen data kerusakan
                </h6>
            </div>
        </div>
        @endif
    </div>

    <!-- ===== KOLOM KANAN: FORM VERIFIKASI SAJA ===== -->
<div class="col-md-4">
    <!-- ===== PETUNJUK (Tetap ada) ===== -->
    <div class="card border-0 shadow-sm bg-light mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-2">
                <i class="bi bi-lightbulb text-warning me-2"></i>Petunjuk
            </h6>
            <ul class="small text-muted mb-0 ps-3">
                <li class="mb-1">📌 <strong>Setujui</strong> = Pengajuan diteruskan</li>
                <li class="mb-1">❌ <strong>Tolak</strong> = Pengajuan ditolak</li>
                <li>📝 <strong>Minta Revisi</strong> = Kembali ke pemohon</li>
            </ul>
        </div>
    </div>

    <!-- ===== INFO PENERIMA + FORM VERIFIKASI (Tetap ada) ===== -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent">
            <h6 class="fw-bold mb-0">
                <i class="bi bi-person-check me-2 text-primary"></i>Verifikasi Penerima
            </h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p class="mb-1 fw-semibold">{{ $authUser->name }}</p>
                <small class="text-muted">{{ $authUser->email }}</small>
                <hr>
            </div>

            {{-- FORM VERIFIKASI --}}
            <form action="{{ route('penerima.pengadaan.verifikasi', $pengajuan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="penerima_id" value="{{ $authUser->karyawan->id }}">

                <div class="mb-3">
                    <label class="form-label fw-semibold small">
                        Status Verifikasi <span class="text-danger">*</span>
                    </label>
                    <select name="status_verifikasi" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="disetujui_koordinator">✅ Setujui</option>
                        <option value="ditolak">❌ Ditolak</option>
                        <option value="revisi">📝 Perlu Revisi</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold small">
                        Catatan Verifikasi <span class="text-danger">*</span>
                    </label>
                    <textarea name="catatan_verifikasi" class="form-control" rows="3" 
                            placeholder="Tuliskan catatan verifikasi..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-check-circle me-1"></i> Verifikasi
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleRespon() {
    const status = document.getElementById('statusSelect').value;
    const keteranganText = document.getElementById('keteranganText');
    const keteranganLabel = document.getElementById('keteranganLabel');
    const submitBtn = document.getElementById('submitBtn');
    
    if (status === 'disetujui') {
        keteranganLabel.textContent = '(alasan menyetujui)';
        keteranganText.placeholder = 'Tuliskan alasan pengajuan ini disetujui...';
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Setujui';
        submitBtn.className = 'btn btn-success w-100';
    } else if (status === 'ditolak') {
        keteranganLabel.textContent = '(alasan menolak)';
        keteranganText.placeholder = 'Tuliskan alasan pengajuan ini ditolak...';
        submitBtn.innerHTML = '<i class="bi bi-x-circle me-1"></i> Tolak';
        submitBtn.className = 'btn btn-danger w-100';
    } else if (status === 'revisi') {
        keteranganLabel.textContent = '(catatan revisi)';
        keteranganText.placeholder = 'Tuliskan apa yang perlu direvisi...';
        submitBtn.innerHTML = '<i class="bi bi-arrow-return-left me-1"></i> Minta Revisi';
        submitBtn.className = 'btn btn-warning w-100';
    } else {
        keteranganLabel.textContent = '(alasan keputusan)';
        keteranganText.placeholder = 'Tuliskan alasan keputusan Anda...';
        submitBtn.innerHTML = '<i class="bi bi-send me-1"></i> Kirim Respon';
        submitBtn.className = 'btn btn-primary w-100';
    }
}
</script>

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