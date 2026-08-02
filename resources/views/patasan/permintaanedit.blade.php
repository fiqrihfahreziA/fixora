@extends('layouts.atasan')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4">verifikasi Permintaan</h2>

    {{-- DEBUG (hapus setelah normal) --}}
    {{-- <h4>TYPE: {{ $permintaan->request_type }}</h4> --}}

    <div class="card p-4 shadow">
        <form action="{{ route('atasan.permintaan.update', $permintaan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="request_type" value="{{ $permintaan->request_type }}">

            {{-- INFO UMUM --}}
            <div class="mb-3">
                <label>Nama Karyawan</label>
                <input class="form-control"
                    value="{{ $permintaan->karyawan->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label>Ruangan</label>
                <input class="form-control"
                    value="{{ $permintaan->ruangan }}" readonly>
            </div>

            {{-- ====================== PERMINTAAN BARANG ====================== --}}
            @if (strtolower($permintaan->request_type) === 'permintaan')

                <div class="alert alert-primary">
                    📦 VERIFIKASI PERMINTAAN BARANG
                </div>

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control"
                        name="nama_barang"
                        value="{{ $permintaan->detailBarang->nama_barang }}">
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" class="form-control"
                        name="jumlah"
                        value="{{ $permintaan->detailBarang->jumlah }}">
                </div>

                <div class="mb-3">
                    <label>Spesifikasi</label>
                    <textarea class="form-control"
                        name="spesifikasi">{{ $permintaan->detailBarang->spesifikasi }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Alasan</label>
                    <textarea class="form-control"
                        name="alasan">{{ $permintaan->detailBarang->alasan }}</textarea>
                </div>

            @endif

            {{-- ====================== PERBAIKAN BARANG ====================== --}}
            @if (strtolower($permintaan->request_type) === 'perbaikan')

                <div class="alert alert-warning">
                    🛠️ VERIFIKASI PERBAIKAN BARANG
                </div>

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control"
                        name="nama_barang"
                        value="{{ $permintaan->detailBarang->nama_barang }}">
                </div>

                <div class="mb-3">
                    <label>Kode Aset</label>
                    <input type="text" class="form-control"
                        name="kode_aset"
                        value="{{ $permintaan->detailBarang->kode_aset }}">
                </div>

                <div class="mb-3">
                    <label>Deskripsi Kerusakan</label>
                    <textarea class="form-control"
                        name="deskripsi">{{ $permintaan->detailBarang->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Tanggal Kerusakan</label>
                    <input type="date" class="form-control"
                        name="tanggal_kerusakan"
                        value="{{ $permintaan->detailBarang->tanggal_kerusakan }}">
                </div>

            @endif

            {{-- STATUS --}}
            <div class="mb-4">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="approved" {{ $permintaan->status == 'approved' ? 'selected' : '' }}>approved</option>
                    <option value="rejected" {{ $permintaan->status == 'rejected' ? 'selected' : '' }}>rejected</option>
                    
                </select>
            </div>

            <button class="btn btn-success w-100">
                Simpan Perubahan
            </button>

        </form>
    </div>
</div>
@endsection
