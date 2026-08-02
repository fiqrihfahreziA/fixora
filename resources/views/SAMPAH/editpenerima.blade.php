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
            <form action="{{ route('penerima.permintaan.update', $permintaan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Jenis Permintaan (Select Dropdown) -->
                    <div>
                    @if ($permintaan->request_type === 'permintaan')
                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            📦 Permintaan Barang
                        </span>
                    @else
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                            🛠️ Perbaikan Barang
                        </span>
                    @endif
                    <input type="hidden" name="request_type" value="{{ $permintaan->request_type }}">
                </div>

                <!-- FIELD UMUM -->

                <div class="mb-3 animated fadeIn" style="margin-top: 10px">
                    <label for="nama_barang" class="form-label" style="color: #555;">Nama karyawan</label>
                    <input type="text" class="form-control animated bounceInUp" id="nama_barang" name="nama_barang" 
                        value="{{ $permintaan->user->karyawan->nama }}" required readonly
                        style="background-color: #ffffff; color: #333; border-radius: 12px; border: 2px solid #3498db;">
                </div>
                <div class="mb-3 animated fadeIn">
                    <label for="nama_barang" class="form-label" style="color: #555;">Nama karyawan</label>
                    <input type="text" class="form-control animated bounceInUp" id="nama_barang" name="nama_barang" 
                        value="{{ $permintaan->ruangan }}" required readonly
                        style="background-color: #ffffff; color: #333; border-radius: 12px; border: 2px solid #3498db;">
                </div>

                <div class="mb-3 animated fadeIn">
                    <label for="nama_barang" class="form-label" style="color: #555;">Nama Barang</label>
                    <input type="text" class="form-control animated bounceInUp" id="nama_barang" name="nama_barang" 
                        value="{{ $permintaan->detailBarang->nama_barang }}" required 
                        style="background-color: #ffffff; color: #333; border-radius: 12px; border: 2px solid #3498db;">
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
                        <label for="alasan" class="form-label" style="color: #555;">Spesifikasi</label>
                        <textarea class="form-control animated bounceInUp" id="spesifikasi" name="spesifikasi" >{{ $permintaan->detailBarang->spesifikasi }}</textarea>
                    </div>
                </div>

                <div class="mb-3 animated fadeIn">
                    <label for="alasan" class="form-label" style="color: #555;">Alasan</label>
                    <textarea class="form-control animated bounceInUp" id="alasan" name="alasan">{{ $permintaan->detailBarang->alasan }}</textarea>
                </div>

                  
                </div>

                <div class="mb-4">
                    <label class="form-label animated fadeIn" style="color: #555;">
                        Status Permintaan
                    </label>

                    <select name="status" class="form-control animated fadeIn"
                        style="
                            border-radius: 12px;
                            border: 2px solid #6c757d;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                            transition: all 0.3s ease;
                        ">
                        <option value="pending" {{ $permintaan->status === 'pending' ? 'selected' : '' }}>
                            ⏳ Pending
                        </option>
                        <option value="verified" {{ $permintaan->status === 'verified' ? 'selected' : '' }}>
                            🔧 verified
                        </option>
                        {{-- <option value="approved" {{ $permintaan->status === 'approved' ? 'selected' : '' }}>
                            ✅ approved
                        </option>
                        <option value="rejected" {{ $permintaan->status === 'rejected' ? 'selected' : '' }}>
                            ❌ rejected
                        </option> --}}
                    </select>
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
    </script>
@endsection

