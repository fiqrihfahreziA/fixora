<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Permintaan</title>
<style>
    body { font-family: Arial; font-size: 12px; }
    .container { width: 800px; margin: auto; }
    table { width: 100%; border-collapse: collapse; }
    table, th, td { border: 1px solid #000; }
    th, td { padding: 6px; }
    .header { text-align: center; border-bottom: 2px solid #000; }
    
</style>
</head>
<body>

<div class="container">

{{-- <div class="header">
    <h3>PEMERINTAH KABUPATEN SAMPANG</h3>
    <h2>RSUD dr. MOHAMMAD ZYN</h2>
    <h3>KABUPATEN SAMPANG</h3>
</div> --}}

<table width="100%" style="border:none; margin-bottom:10px;">
    <tr>
        <!-- Logo Kiri -->
        <td width="15%" style="text-align:center; border:none;">
            <img src="{{ asset('gambar/trunojoyoo.png') }}" width="70">
        </td>

        <!-- Teks Tengah -->
        <td width="70%" style="text-align:center; border:none;">
            <div style="font-size:14px; font-weight:bold;">
                PEMERINTAH KABUPATEN SAMPANG
            </div>
            <div style="font-size:16px; font-weight:bold;">
                RSUD dr. MOHAMMAD ZYN
            </div>
            <div style="font-size:14px; font-weight:bold;">
                KABUPATEN SAMPANG
            </div>
            <div style="font-size:11px;">
                Jalan Rajawali No. 10, Sampang (69214) Telp. (0323) 323956<br>
                Email : rsud.dr.mohammad.zyn@sampangkab.go.id  
                Website : rsud.sampangkab.go.id
            </div>
        </td>

        <!-- Logo Kanan -->
        <td width="15%" style="text-align:center; border:none;">
            <img src="{{ asset('gambar/rsmz.png') }}" width="70">
        </td>
    </tr>
</table>

<!-- Garis bawah kop -->
<hr style="border:1px solid #000; margin:2px 0;">
<hr style="border:2px solid #000; margin-top:0;">
{{-- 
<h3 style="text-align:center;">FORM PERMINTAAN PERBAIKAN / PERMINTAAN BARANG</h3> --}}

<h3 style="text-align:center;" class="judul">LAPORAN PERMINTAAN & PERBAIKAN BARANG</h3>

<div class="text-center" style="font-size:12px; margin-bottom:10px; text-align:center;">
    Nomor Surat :
    <span>
        {{ $permintaan->detailBarang->no_surat ?? '-' }}
    </span>
</div>


<b>A. DATA PEMOHON</b>
<table>
<tr>
    <th style="text-align:center;">Nama</th>
    <th style="text-align:center;">Jabatan</th>
    <th style="text-align:center;">Ruangan</th>
    <th style="text-align:center;">Tanggal</th>
</tr>
<tr>
    <td style="text-align:center;">{{ $permintaan->user->karyawan->nama }}</td>
    <td style="text-align:center;">{{ $permintaan->user->karyawan->jabatan ?? '-' }}</td>
    <td style="text-align:center;">{{ $permintaan->ruangan }}</td>
    <td style="text-align:center;">{{ $permintaan->created_at->format('d-m-Y') }}</td>
</tr>
</table>

<br>

<b>B. JENIS PERMINTAAN</b><br><br>

@if($permintaan->request_type === 'perbaikan')
    <b>☑ Permintaan Perbaikan</b><br>
    ☐ Permintaan Barang
@else
    ☐ Permintaan Perbaikan<br>
    <b>☑ Permintaan Barang</b>
@endif


<br><br>

@if($permintaan->request_type == 'perbaikan')
<b>C. DETAIL PERBAIKAN</b>
<table>
<tr>
    <th style="text-align:center;">Nama Barang</th>
    <th style="text-align:center;">Kode Aset</th>
    <th style="text-align:center;">Lokasi Barang</th>
    <th style="text-align:center;">Deskripsi Kerusakan</th>
    <th style="text-align:center;">Tanggal Kerusakan</th>
</tr>
<tr>
    <td style="text-align:center; width:15%">{{ $permintaan->detailBarang->nama_barang }}</td>
    <td style="text-align:center; width:10%">{{ $permintaan->detailBarang->kode_aset }}</td>
    <td style="text-align:center; width:15%">{{ $permintaan->ruangan }}</td>
    <td style="text-align:center; width:50%">{{ $permintaan->detailBarang->deskripsi }}</td>
    <td style="text-align:center; width:10%">{{ $permintaan->detailBarang->tanggal_kerusakan }}</td>
</tr>
</table>
@endif

@if($permintaan->request_type == 'permintaan')
<b>C. PERMINTAAN BARANG</b>
<table>
<tr>
    <th style="text-align:center; width:20%">Nama Barang</th>
    <th style="text-align:center; width:50%">Spesifikasi</th>
    <th style="text-align:center; width:5%">Jumlah</th>
    <th style="text-align:center; width:25%">Alasan/Keterangan</th>
</tr>
<tr>
    <td style="text-align:center;">{{ $permintaan->detailBarang->nama_barang }}</td>
    <td style="text-align:center;">{{ $permintaan->detailBarang->spesifikasi }}</td>
    <td style="text-align:center;">{{ $permintaan->detailBarang->jumlah }}</td>
     <td style="text-align:center;">{{ $permintaan->detailBarang->alasan }}</td>
</tr>
</table>
@endif

<br>

{{-- <b>D. VERIFIKASI</b>
<table>
    <tr>
        <th>Ttd Pemohon</th>
        <th>Ttd Penerima</th>
        <th>Ttd Atasan (PPTK)</th>
    </tr>
    <tr style="height:80px;">
    <td style="text-align:center;">
        @if($permintaan->user->karyawan && $permintaan->user->karyawan->ttd)
            <img src="{{ asset('storage/ttd/'.$permintaan->user->karyawan->ttd) }}"
                style="height:60px;"><br>
        @endif
        ( {{ $permintaan->user->name }} )
    </td>

        <td style="text-align:center;">( .................... )</td>
        <td style="text-align:center;">( .................... )</td>
    </tr>
</table> --}}

<b>D. VERIFIKASI</b>
<table>
    <tr>
        <th>Ttd Pemohon</th>
        <th>Ttd Penerima</th>
        <th>Ttd Atasan (PPTK)</th>
    </tr>

    <tr style="height:90px;">
        {{-- PEMOHON --}}
        <td style="text-align:center;">
            @if($permintaan->user->karyawan && $permintaan->user->karyawan->ttd)
                <img src="{{ asset('storage/ttd/'.$permintaan->user->karyawan->ttd) }}"
                     style="height:60px;"><br>
            @endif
            ( {{ $permintaan->user->karyawan->nama }} )
        </td>

        {{-- PENERIMA --}}
        <td style="text-align:center;">
            @if($permintaan->penerima && $permintaan->penerima->ttd)
                <img src="{{ asset('storage/ttd/'.$permintaan->penerima->ttd) }}"
                     style="height:60px;"><br>
                ( {{ $permintaan->penerima->nama }} )
            @else
                <br><br>
                ( Belum Diverifikasi )
            @endif
        </td>

        {{-- ATASAN --}}
        <td style="text-align:center;">
            @if($permintaan->atasan && $permintaan->atasan->ttd)
                <img src="{{ asset('storage/ttd/'.$permintaan->atasan->ttd) }}"
                     style="height:60px;"><br>
                ( {{ $permintaan->atasan->nama }} )
            @else
                <br><br>
                ( Belum Disetujui )
            @endif
        </td>
        {{-- <td style="text-align:center;">( .................... )</td> --}}
    </tr>
</table>

<br>

<b>E. STATUS PERMINTAAN (Diisi Petugas)</b><br><br>

<table width="100%" style="border:none;">
    <tr>
        <td style="border:none;">
            <input type="checkbox"
                {{ $permintaan->status == 'approved' ? 'checked' : '' }}>
            Disetujui
        </td>
    </tr>
    <tr>
        <td style="border:none;">
            <input type="checkbox"
                {{ $permintaan->status == 'rejected' ? 'checked' : '' }}>
            Ditolak
        </td>
    </tr>
    {{-- <tr>
        <td style="border:none;">
            <input type="checkbox"
                {{ $permintaan->status == 'verified' ? 'checked' : '' }}>
            Dalam Proses
        </td>
    </tr> --}}
</table>



</div>

<script>
window.print();
</script>

</body>
</html>
