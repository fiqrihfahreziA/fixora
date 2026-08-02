@extends('layouts.atasan')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Filter untuk Menampilkan Permintaan atau Perbaikan -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Daftar Permintaan</h5>
    <form method="GET" action="#" class="d-flex">
        <input type="text" class="form-control me-2" name="search" placeholder="Cari Barang, Deskripsi, atau Jenis" value="{{ $search }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

<!-- Tombol Tambah Permintaan -->
{{-- <div class="mb-3">
    <button type="button" class="btn btn-primary animate__animated animate__fadeIn" data-bs-toggle="modal" data-bs-target="#tambahPermintaanModal">
        <i class="bi bi-plus-circle"></i> Tambah Permintaan
    </button>
</div> --}}

<!-- Tab Navigasi untuk Permintaan dan Perbaikan -->
<div class="card shadow-lg p-3 mb-3 bg-white rounded animate__animated animate__fadeInUp">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="permintaan-tab" data-bs-toggle="tab" href="#permintaan" role="tab" aria-controls="permintaan" aria-selected="true">
                Permintaan 
                <span id="badge-permintaan" class="badge bg-danger ms-1"></span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
             <a class="nav-link" id="perbaikan-tab" data-bs-toggle="tab" href="#perbaikan" role="tab" aria-controls="perbaikan" aria-selected="false">
                Perbaikan 
                <span id="badge-perbaikan" class="badge bg-danger ms-1"></span>
            </a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="myTabContent">
        <!-- Konten Permintaan -->
        <div class="tab-pane fade show active" id="permintaan" role="tabpanel" aria-labelledby="permintaan-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                             <th class="text-center">Jenis Permintaan</th>
                            <th class="text-center">Barang</th>
                            <th class="text-center">Ruangan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Alasan</th>
                            <th class="text-center">Tanggal Permintaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $noPermintaan = 1;  // Nomor urut untuk permintaan
                            $noPerbaikan = 1;   // Nomor urut untuk perbaikan
                        @endphp
                        @foreach ($permintaanRequests as $req)
                            @if ($req->request_type === 'permintaan')
                                <tr>
                                    <td class="text-center">{{ $noPermintaan++ }}</td>
                                    <td class="text-center">{{ optional($req->bidang)->nama_bidang ?? '-' }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->nama_barang }}</td>
                                    <td class="text-center">{{ $req->ruangan }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->jumlah }}</td>
                                    {{-- <td>{{ optional($req->detailBarang)->alasan }}</td> --}}
                                    <td class="text-center">{{ optional($req->detailBarang)->alasan }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        @php
                                            $badgeClass = match($req->status) {
                                                 'approved' => 'bg-primary',
                                                 'rejected' => 'bg-danger',
                                                 'verified' => 'bg-success',
                                                 'submitted' => 'bg-primary',
                                                 default => 'bg-warning',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $req->status }}</span>
                                    </td>
                                    <td class="text-center">
                                            <a href="{{ route('atasan.permintaan.edit', $req->id) }}" class="btn btn-sm btn-success" target="_blank">
                                                <i class="bi bi-pencil"></i>Accept
                                            </a>
                                            
                                            <!-- Delete Form -->
                                            {{-- <form action="{{ route('penerima.permintaan.destroyy', $req->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form> --}}
                                             <a href="{{ route('atasan.permintaan.view', $req->id) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-secondary">
                                                👁️
                                            </a>
                                             @if(!empty($req->detailBarang->gambar))
                                        <a 
                                            href="{{ route('penerima.permintaan.gambar', $req->id) }}" 
                                            target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-image"></i>
                                        </a>
                                        @endif
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{ $permintaanRequests->links() }}
            </div>
        </div>

        <!-- Konten Perbaikan -->
        <div class="tab-pane fade" id="perbaikan" role="tabpanel" aria-labelledby="perbaikan-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                             <th class="text-center">Jenis Permintaan</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Kode Aset</th>
                            <th class="text-center">Ruangan</th>
                            <th class="text-center">Kerusakan</th>
                            <th class="text-center">Tanggal Kerusakan</th>
                            <th class="text-center">Tanggal Permintaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $noPermintaan = 1;  // Nomor urut untuk permintaan
                            $noPerbaikan = 1;   // Nomor urut untuk perbaikan
                        @endphp
                        @foreach ($perbaikanRequests as $index => $req)
                            @if ($req->request_type === 'perbaikan')
                                <tr>
                                    <td class="text-center">{{ $noPerbaikan++ }}</td>
                                    <td class="text-center">{{ optional($req->bidang)->nama_bidang ?? '-' }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->nama_barang }}</td>
                                    {{-- <td>{{ optional($req->detailBarang)->nama_barang }}</td> --}}
                                    <td class="text-center">{{ optional($req->detailBarang)->kode_aset }}</td>
                                    <td class="text-center">{{ $req->ruangan }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->deskripsi }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->tanggal_kerusakan }}</td>
                                    <td class="text-center">{{ optional($req->detailBarang)->created_at->format('Y-m-d') }}</td>

                                    <td class="text-center">
                                        @php
                                            $badgeClass = match($req->status) {
                                                 'approved' => 'bg-primary',
                                                 'rejected' => 'bg-danger',
                                                 'verified' => 'bg-success',
                                                 'submitted' => 'bg-primary',
                                                 default => 'bg-warning',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $req->status }}</span>
                                    </td>
                                    <td class="text-center">
                                        
                                            <a href="{{ route('atasan.permintaan.edit', $req->id) }}" class="btn btn-sm btn-success" target="_blank">
                                                <i class="bi bi-pencil"></i>Accept
                                            </a>

                                            {{-- <form action="{{ route('penerima.permintaan.destroyy', $req->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form> --}}

                                            <a href="{{ route('atasan.permintaan.view', $req->id) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-secondary ">
                                                👁️
                                            </a>

                                             @if(!empty($req->detailBarang->gambar))
                                        <a 
                                            href="{{ route('penerima.permintaan.gambar', $req->id) }}" 
                                            target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-image"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{ $perbaikanRequests->links() }}
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
            <form method="POST" action="{{ route('penerima.permintaan.store') }}">
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
                    {{-- <div class="mb-3 field-permintaan">
                        <label>Spesifikasi</label>
                        <textarea class="form-control" name="spesifikasi"></textarea>
                    </div> --}}
                    <div class="mb-3 field-permintaan">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah">
                    </div>
                    <div class="mb-3 field-permintaan">
                        <label>Alasan</label>
                        <textarea class="form-control" name="alasan"></textarea>
                    </div>

                    <!-- PERBAIKAN -->
                    <div class="mb-3 field-perbaikan" style="display:none;">
                        <label>Kode Aset</label>
                        <input type="text" class="form-control" name="kode_aset">
                    </div>
                    <div class="mb-3 field-perbaikan" style="display:none;">
                        <label>Ruangan</label>
                        <input type="text" class="form-control" name="ruangan" value="{{ $authUser->karyawan->ruangan }}" readonly>
                    </div>
                    <div class="mb-3 field-perbaikan" style="display:none;">
                        <label>Deskripsi Kerusakan</label>
                        <textarea class="form-control" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-3 field-perbaikan" style="display:none;">
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

let lastTotal = 0;

function loadNotif() {

    fetch("/atasan/notif-pending")
        .then(res => res.json())
        .then(data => {

            let permintaan = document.getElementById("badge-permintaan");
            let perbaikan = document.getElementById("badge-perbaikan");

            let total = data.permintaan + data.perbaikan;

            // update badge
            permintaan.innerText = data.permintaan > 0 ? data.permintaan : "";
            perbaikan.innerText = data.perbaikan > 0 ? data.perbaikan : "";

            // 🔥 reload kalau jumlah bertambah
             if (total !== lastTotal && lastTotal !== 0)
 {
               sessionStorage.setItem("autoReload", "true");
                location.reload();

            }

            lastTotal = total;

        });
}


</script>

@endsection
