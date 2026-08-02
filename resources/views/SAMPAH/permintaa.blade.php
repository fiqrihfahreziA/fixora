@extends('layouts.pemohon')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Filter untuk Menampilkan Permintaan atau Perbaikan -->
<!-- Form Pencarian -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Daftar Permintaan</h5>
    <form method="GET" action="{{ route('pemohon.permintaan') }}" class="d-flex">
        <input type="text" class="form-control me-2" name="search" placeholder="Cari Barang, Deskripsi, atau Jenis" value="{{ $search }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

<!-- Tombol Tambah Permintaan -->
<div class="mb-3">
    <button type="button" class="btn btn-primary animate__animated animate__fadeIn" data-bs-toggle="modal" data-bs-target="#tambahPermintaanModal">
        <i class="bi bi-plus-circle"></i> Tambah Permintaan
    </button>
</div>

<!-- Tab Navigasi untuk Permintaan dan Perbaikan -->
<div class="card shadow-sm">
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="permintaan-tab" data-bs-toggle="tab" href="#permintaan" role="tab" aria-controls="permintaan" aria-selected="true">
                    Permintaan
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="perbaikan-tab" data-bs-toggle="tab" href="#perbaikan" role="tab" aria-controls="perbaikan" aria-selected="false">
                    Perbaikan
                </a>
            </li>
        </ul>

        <!-- Konten Tab -->
        <div class="tab-content mt-3">
            <!-- Konten Permintaan -->
            <div class="tab-pane fade show active" id="permintaan" role="tabpanel" aria-labelledby="permintaan-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover shadow-sm mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Alasan</th>
                                <th>Tanggal Permintaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalreq as $index => $req)
                                @if ($req->request_type === 'permintaan')
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $req->detailBarang->nama_barang }}</td>
                                        <td>{{ $req->detailBarang->jumlah }}</td>
                                        <td>{{ $req->detailBarang->alasan }}</td>
                                        <td>{{ $req->detailBarang->created_at }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match($req->status) {
                                                    'pending' => 'bg-secondary',
                                                    'approved' => 'bg-success',
                                                    'rejected' => 'bg-danger',
                                                    'verif' => 'bg-warning',
                                                    'submitted' => 'bg-primary',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $req->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($req->status === 'pending')
                                                <a href="#" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">Tidak bisa diubah</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Konten Perbaikan -->
            <div class="tab-pane fade" id="perbaikan" role="tabpanel" aria-labelledby="perbaikan-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover shadow-sm mt-3">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kode Aset</th>
                                <th>Ruangan</th>
                                <th>Deskripsi Kerusakan</th>
                                <th>Tanggal Kerusakan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalreq as $req)
                                @if ($req->request_type === 'perbaikan')
                                    <tr>
                                        <td>{{ $req->detailBarang->nama_barang }}</td>
                                        <td>{{ $req->detailBarang->kode_aset }}</td>
                                        <td>{{ $req->ruangan }}</td>
                                        <td>{{ $req->detailBarang->deskripsi }}</td>
                                        <td>{{ $req->detailBarang->tanggal_kerusakan }}</td>
                                        <td>{{ $req->status }}</td>
                                        <td class="text-center">
                                            @if ($req->status === 'pending')
                                                <a href="#" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">Tidak bisa diubah</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Permintaan -->
<div class="modal fade" id="tambahPermintaanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animate__animated animate__zoomIn">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Permintaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('pemohon.permintaan.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Jenis Permintaan -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Permintaan</label><br>
                        <input type="radio" name="request_type" value="permintaan" checked onclick="toggleForm()">
                        Permintaan Barang
                        &nbsp;&nbsp;
                        <input type="radio" name="request_type" value="perbaikan" onclick="toggleForm()">
                        Perbaikan Barang
                    </div>
                    <hr>

                    <!-- FIELD UMUM -->
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang">
                    </div>

                    <!-- PERMINTAAN -->
                    <div class="mb-3 field-permintaan">
                        <label>Spesifikasi</label>
                        <textarea class="form-control" name="spesifikasi"></textarea>
                    </div>
                    <div class="mb-3 field-permintaan">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah">
                    </div>
                    <div class="mb-3 field-permintaan">
                        <label>Alasan</label>
                        <textarea class="form-control" name="alasan"></textarea>
                    </div>

                    <!-- PERBAIKAN -->
                    <div class="mb-3 field-perbaikan">
                        <label>Kode Aset</label>
                        <input type="text" class="form-control" name="kode_aset">
                    </div>
                    <div class="mb-3 field-perbaikan">
                        <label>Ruangan</label>
                        <input type="text" class="form-control" name="ruangan" value="{{ $authUser->karyawan->ruangan }}" readonly>
                    </div>
                    <div class="mb-3 field-perbaikan">
                        <label>Deskripsi Kerusakan</label>
                        <textarea class="form-control" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-3 field-perbaikan">
                        <label>Tanggal Kerusakan</label>
                        <input type="date" class="form-control" name="tanggal_kerusakan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleForm() {
    const type = document.querySelector('input[name="request_type"]:checked').value;
    const permintaanFields = document.querySelectorAll('.field-permintaan');
    const perbaikanFields = document.querySelectorAll('.field-perbaikan');

    if (type === 'permintaan') {
        permintaanFields.forEach(el => el.style.display = 'block');
        perbaikanFields.forEach(el => el.style.display = 'none');
    } else {
        permintaanFields.forEach(el => el.style.display = 'none');
        perbaikanFields.forEach(el => el.style.display = 'block');
    }
}

document.addEventListener('DOMContentLoaded', toggleForm);
</script>

@endsection
