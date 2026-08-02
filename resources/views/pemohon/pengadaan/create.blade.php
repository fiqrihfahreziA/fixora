@extends('layouts.pengadaan.pemohon')

@section('content')

<div class="container-fluid px-0">


<!-- Header -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h4 class="mb-1 fw-bold text-dark">
                    <i class="bi bi-plus-circle text-primary me-2"></i>Buat Pengajuan Baru
                </h4>
                <p class="text-muted mb-0">Isi formulir berikut untuk mengajukan permintaan atau perbaikan barang</p>
            </div>

            <div>
                <a href="{{ route('pemohon.pengadaan') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Form -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        <form action="#" method="POST" id="formPengajuan">
            @csrf

            <!-- Step Indicator -->
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

            <!-- STEP 1 -->
            <div class="step-content" id="step1">

                <h6 class="fw-bold text-primary mb-3">
                    <i class="bi bi-person-badge me-2"></i>Informasi Pengajuan
                </h6>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">
                            Tanggal Pengajuan <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                               name="tanggal_pengajuan"
                               class="form-control"
                               value="{{ date('Y-m-d') }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Bidang</label>

                        <select name="bidang_id" class="form-select">
                            <option value="">Pilih Bidang</option>

                            @foreach($bidangs as $bidang)
                                <option value="{{ $bidang->id }}">
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Tahun Anggaran</label>

                        <input type="number"
                               name="tahun_anggaran"
                               class="form-control"
                               placeholder="2026">
                    </div>

                    <!-- Jenis Pengajuan + Nama Pengaju dalam kolom yang sama -->
<div class="col-md-4">

    <label class="form-label fw-semibold small">
        Jenis Pengajuan <span class="text-danger">*</span>
    </label>

    <div class="d-flex gap-3 mb-2">

        <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="jenis_pengajuan"
                   value="permintaan"
                   checked>

            <label class="form-check-label">Permintaan</label>
        </div>

        <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="jenis_pengajuan"
                   value="perbaikan">

            <label class="form-check-label">Perbaikan</label>
        </div>

    </div>

    <label class="form-label fw-semibold small mb-1">
        Nama Pengaju <span class="text-danger">*</span>
    </label>

    <input type="text"
           class="form-control bg-light"
           value="{{ $authUser->karyawan->nama ?? $authUser->name ?? '' }}"
           readonly>
</div>

<!-- Instalasi tetap kolom sebelah -->
<div class="col-md-2">

    <label class="form-label fw-semibold small">Instalasi</label>

    <input type="text"
           name="instalasi"
           class="form-control bg-light"
           value="{{ $authUser->karyawan->ruangan ?? '' }}"
           readonly>
</div>

            <!-- STEP 2 -->
            <div class="step-content d-none" id="step2">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-primary mb-0">
                        <i class="bi bi-list-check me-2"></i>Daftar Barang
                    </h6>

                    <button type="button"
                            class="btn btn-sm btn-outline-primary"
                            onclick="addItem()">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Item
                    </button>
                </div>

                <div id="itemsContainer">

                    <div class="item-row card p-3 mb-3 bg-light">
                        <div class="row g-3 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">
                                    Nama Barang <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="items[0][nama_barang]"
                                       class="form-control item-required"
                                       placeholder="Nama barang"
                                       disabled>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold small">Spesifikasi</label>

                                <input type="text"
                                       name="items[0][spesifikasi]"
                                       class="form-control"
                                       placeholder="Spesifikasi"
                                       disabled>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label fw-semibold small">Satuan</label>

                                <select name="items[0][satuan]"
                                        class="form-select"
                                        disabled>
                                    <option value="Unit">Unit</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Box">Box</option>
                                    <option value="Paket">Paket</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label fw-semibold small">
                                    Jumlah <span class="text-danger">*</span>
                                </label>

                                <input type="number"
                                       name="items[0][jumlah]"
                                       class="form-control item-required"
                                       placeholder="0"
                                       min="1"
                                       disabled>
                            </div>

                            <div class="col-md-1">
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger w-100"
                                        onclick="removeItem(this)"
                                        disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold">Total Item:</span>
                        <span id="totalItem">1</span>
                    </div>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="step-content d-none" id="step3">

                <h6 class="fw-bold text-primary mb-3">
                    <i class="bi bi-paperclip me-2"></i>Dokumen Pendukung
                </h6>

                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="foto_barang"
                           value="1">

                    <label class="form-check-label">Foto Barang</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="data_kerusakan"
                           value="1">

                    <label class="form-check-label">Data Kerusakan</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="penawaran_harga"
                           value="1">

                    <label class="form-check-label">Penawaran Harga</label>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between">

                    <a href="{{ route('pemohon.pengadaan') }}"
                       class="btn btn-outline-secondary rounded-pill px-4">
                        Batal
                    </a>

                    <div class="d-flex gap-2">

                        <button type="button"
                                class="btn btn-outline-primary rounded-pill px-4"
                                id="btnPrevStep"
                                onclick="goPrevStep()"
                                style="display:none;">
                            Sebelumnya
                        </button>

                        <button type="button"
                                class="btn btn-primary rounded-pill px-4"
                                id="btnNextStep"
                                onclick="goNextStep()">
                            Selanjutnya
                        </button>

                        <button type="submit"
                                class="btn btn-success rounded-pill px-4"
                                id="submitBtn"
                                style="display:none;">
                            Kirim Pengajuan
                        </button>

                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


</div>

<style>
.step-indicator{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:4px;
    opacity:.5;
    transition:.3s;
}

.step-indicator.active{
    opacity:1;
}

.step-number{
    width:32px;
    height:32px;
    border-radius:50%;
    background:#e9ecef;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

.step-indicator.active .step-number{
    background:#0d6efd;
    color:#fff;
}

.step-line{
    width:40px;
    height:2px;
    background:#dee2e6;
}

.step-indicator.active + .step-line{
    background:#0d6efd;
}
</style>
<script>
let itemIndex = 1;
let currentStep = 1;

// =========================
// TAMBAH ITEM
// =========================
function addItem() {
    const container = document.getElementById('itemsContainer');

    const itemRow = document.createElement('div');
    itemRow.className = 'item-row card p-3 mb-3 bg-light';

    itemRow.innerHTML = `
        <div class="row g-3 align-items-end">

            <div class="col-md-4">
                <label class="form-label fw-semibold small">
                    Nama Barang <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="items[${itemIndex}][nama_barang]"
                       class="form-control item-required"
                       placeholder="Nama barang"
                       required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold small">Spesifikasi</label>

                <input type="text"
                       name="items[${itemIndex}][spesifikasi]"
                       class="form-control"
                       placeholder="Spesifikasi">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold small">Satuan</label>

                <select name="items[${itemIndex}][satuan]" class="form-select">
                    <option value="Unit">Unit</option>
                    <option value="Buah">Buah</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Box">Box</option>
                    <option value="Paket">Paket</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold small">
                    Jumlah <span class="text-danger">*</span>
                </label>

                <input type="number"
                       name="items[${itemIndex}][jumlah]"
                       class="form-control item-required"
                       placeholder="0"
                       min="1"
                       required>
            </div>

            <div class="col-md-1">
                <button type="button"
                        class="btn btn-sm btn-outline-danger w-100"
                        onclick="removeItem(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>

        </div>
    `;

    container.appendChild(itemRow);

    itemIndex++;

    updateTotalItem();
}

// =========================
// HAPUS ITEM
// =========================
function removeItem(button) {

    const rows = document.querySelectorAll('.item-row');

    if (rows.length > 1) {
        button.closest('.item-row').remove();
        updateTotalItem();
    } else {
        alert('Minimal 1 item harus diisi!');
    }
}

// =========================
// UPDATE TOTAL ITEM
// =========================
function updateTotalItem() {

    document.getElementById('totalItem').textContent =
        document.querySelectorAll('.item-row').length;
}

// =========================
// VALIDASI STEP AKTIF
// =========================
function validateCurrentStep() {

    const step = document.getElementById('step' + currentStep);

    const requiredFields = step.querySelectorAll('[required]');

    for (const field of requiredFields) {

        if (field.disabled) continue;

        if (!field.value) {
            field.reportValidity();
            field.focus();
            return false;
        }
    }

    return true;
}

// =========================
// NEXT STEP
// =========================
function goNextStep() {

    if (!validateCurrentStep()) return;

    if (currentStep < 3) {
        currentStep++;
        updateUI();
    }
}

// =========================
// PREVIOUS STEP
// =========================
function goPrevStep() {

    if (currentStep > 1) {
        currentStep--;
        updateUI();
    }
}

// =========================
// UPDATE UI STEP
// =========================
function updateUI() {

    // tampil/sembunyi step
    for (let i = 1; i <= 3; i++) {

        const step = document.getElementById('step' + i);

        if (i === currentStep) {

            step.classList.remove('d-none');
            step.style.display = 'block';

            // aktifkan input step aktif
            step.querySelectorAll('input, select, textarea').forEach(el => {
                el.disabled = false;
            });

        } else {

            step.classList.add('d-none');
            step.style.display = 'none';

            // nonaktifkan input step lain
            step.querySelectorAll('input, select, textarea').forEach(el => {

                if (el.name !== '_token') {
                    el.disabled = true;
                }
            });
        }
    }

    // update indicator
    document.querySelectorAll('.step-indicator').forEach((el, index) => {

        el.classList.toggle('active', index + 1 === currentStep);
    });

    // update tombol
    document.getElementById('btnPrevStep').style.display =
        currentStep === 1 ? 'none' : 'inline-block';

    document.getElementById('btnNextStep').style.display =
        currentStep === 3 ? 'none' : 'inline-block';

    document.getElementById('submitBtn').style.display =
        currentStep === 3 ? 'inline-block' : 'none';
}

// =========================
// INIT
// =========================
document.addEventListener('DOMContentLoaded', function () {

    currentStep = 1;

    updateUI();

    updateTotalItem();
});
</script>

@endsection
