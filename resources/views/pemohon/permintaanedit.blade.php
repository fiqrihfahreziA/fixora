@extends('layouts.penerima')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center animated fadeIn" style="color: #333;">Edit Permintaan</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success mb-4 animated fadeInUp">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-lg p-4 rounded-lg animated zoomIn" style="background-color: #f9f9f9;">
            <form action="{{ route('pemohon.permintaan.update', $permintaan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Jenis Permintaan (Select Dropdown) -->
                <div class="mb-4">
                    <label class="form-label animated fadeIn" style="color: #555;">Jenis Permintaan</label>
                    <select name="request_type" class="form-control animated fadeIn" onchange="toggleForm()" 
                        style="border-radius: 12px; border: 2px solid #3498db; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                        <option value="permintaan" {{ $permintaan->request_type === 'permintaan' ? 'selected' : '' }}>
                            Permintaan Barang
                        </option>
                        <option value="perbaikan" {{ $permintaan->request_type === 'perbaikan' ? 'selected' : '' }}>
                            Perbaikan Barang
                        </option>
                    </select>
                </div>

                <hr>

                <!-- FIELD UMUM -->
                <div class="mb-3 animated fadeIn">
                    <label for="nama_barang" class="form-label" style="color: #555;">Nama Barang</label>
                    <input type="text" class="form-control animated bounceInUp" id="nama_barang" name="nama_barang" 
                        value="{{ $permintaan->detailBarang->nama_barang }}" required 
                        style="background-color: #ffffff; color: #333; border-radius: 12px; border: 2px solid #3498db;">
                </div>

                                <!-- Checkbox Sertakan Gambar -->
                <div class="form-check mb-3">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="includeImage"
                        onclick="toggleImageUpload()">

                    <label class="form-check-label">
                        Ubah / Sertakan Gambar
                    </label>
                </div>

                <!-- Upload Image -->
                <div class="mb-3" id="imageUploadField" style="display:none;">
                    <label>Upload Gambar</label>

                    <input 
                        type="file" 
                        class="form-control"
                        name="gambar"
                        id="imageInput"
                        accept=".jpg,.jpeg,.png"
                        onchange="validateImage()">

                    <small class="text-muted">
                        Format: JPG, JPEG, PNG | Maks 2MB
                    </small>

                    <small class="text-danger" id="imageError" style="display:none;"></small>

                    {{-- Preview gambar lama --}}
                    @if(!empty($permintaan->detailBarang->image))
                        <div class="mt-3">
                            <label>Gambar Saat Ini</label><br>
                            <img 
                                src="{{ asset('storage/'.$permintaan->detailBarang->image) }}"
                                width="180"
                                class="rounded shadow">
                        </div>
                    @endif
                </div>

                <!-- FIELD PERMINTAAN (hanya muncul saat memilih Permintaan Barang) -->
                <div id="permintaanFields" class="form-fields">
                    <div class="mb-3 animated fadeIn">
                        <label for="jumlah" class="form-label" style="color: #555;">Jumlah</label>
                        <input type="number" class="form-control animated bounceInUp" id="jumlah" name="jumlah" 
                            value="{{ $permintaan->detailBarang->jumlah }}"  
                            style="background-color: #ffffff; color: #333; border-radius: 12px; border: 2px solid #3498db;">
                    </div>

                    <div class="mb-3 animated fadeIn">
                        <label for="alasan" class="form-label" style="color: #555;">Alasan</label>
                        <textarea class="form-control animated bounceInUp" id="alasan" name="alasan" 
                            >{{ $permintaan->detailBarang->alasan }}</textarea>
                    </div>
                </div>

                <!-- FIELD PERBAIKAN (hanya muncul saat memilih Perbaikan Barang) -->
                <div id="perbaikanFields" class="form-fields" style="display: none;">
                    <div class="mb-3 animated fadeIn">
                        <label for="kode_aset" class="form-label" style="color: #555;">Kode Aset</label>
                        <input type="text" class="form-control animated flipInX" id="kode_aset" name="kode_aset" 
                            value="{{ $permintaan->detailBarang->kode_aset }}" 
                            style="background-color: #ffffff; color: #5a4e4e; border-radius: 12px; border: 2px solid #3498db;">
                    </div>

                    <div class="mb-3 animated fadeIn">
                        <label for="ruangan" class="form-label" style="color: #555;">Ruangan</label>
                        <input type="text" class="form-control animated flipInX" id="ruangan" name="ruangan" 
                            value="{{ $permintaan->ruangan }}" readonly 
                            style="background-color: #ffffff; color: #000000; border-radius: 12px; border:  2px solid #3498db;">
                    </div>

                    <div class="mb-3 animated fadeIn">
                        <label for="deskripsi" class="form-label" style="color: #555;">Deskripsi Kerusakan</label>
                        <textarea class="form-control animated bounceInUp" id="deskripsi" name="deskripsi">{{ $permintaan->detailBarang->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3 animated fadeIn">
                        <label for="tanggal_kerusakan" class="form-label" style="color: #555;">Tanggal Kerusakan</label>
                        <input type="date" class="form-control animated flipInX" id="tanggal_kerusakan" name="tanggal_kerusakan" 
                            value="{{ $permintaan->detailBarang->tanggal_kerusakan }}" 
                            style="background-color: #ffffff; color: #333; border-radius: 12px; border: 2px solid #3498db;">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-4 py-2 mt-4 animated pulse" 
                        style="background-color: #FF8C00; border: none; transition: background-color 0.3s ease-in-out; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan dan menyembunyikan field berdasarkan jenis permintaan
        function toggleForm() {
            var requestType = document.querySelector('select[name="request_type"]').value;

            // Menyembunyikan atau menampilkan field berdasarkan jenis permintaan
            if (requestType === 'permintaan') {
                document.getElementById('permintaanFields').style.display = 'block';
                document.getElementById('perbaikanFields').style.display = 'none';
            } else if (requestType === 'perbaikan') {
                document.getElementById('permintaanFields').style.display = 'none';
                document.getElementById('perbaikanFields').style.display = 'block';
            }
        }

        // Jalankan toggleForm saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', function() {
            toggleForm();
        });

        function toggleImageUpload() {
                let field = document.getElementById('imageUploadField');
                let check = document.getElementById('includeImage');

                if (check.checked) {
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                }
            }

            function validateImage() {
                let input = document.getElementById('imageInput');
                let error = document.getElementById('imageError');

                error.style.display = "none";

                if (input.files.length > 0) {
                    let file = input.files[0];
                    let maxSize = 2 * 1024 * 1024;

                    if (file.size > maxSize) {
                        error.innerHTML = "Ukuran file maksimal 2MB";
                        error.style.display = "block";
                        input.value = "";
                    }
                }
            }
    </script>
@endsection
