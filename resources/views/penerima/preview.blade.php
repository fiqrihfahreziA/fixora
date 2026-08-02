<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Permintaan & Perbaikan Barang</title>

<style>
/* =========================
   SETUP A4 PRINT (INI MARGIN ASLI)
========================= */
@page {
    size: A4;
    margin: 25mm 25mm 25mm 25mm; /* ATAS KANAN BAWAH KIRI */
}

body {
    font-family: "Times New Roman", serif;
    background: #f0f0f0;

    color: #000;
}

/* =========================
   WRAPPER
========================= */
.print-area {
    background: #fff;
     margin: 20px;
    padding: 20px;
}

/* =========================
   KOP SURAT
========================= */
.kop-table {
    width: 100%;
    border-collapse: collapse;
}

.kop-table td {
    vertical-align: middle;
}

.kop-judul-1 {
    font-size: 14px;
    font-weight: bold;
}

.kop-judul-2 {
    font-size: 18px;
    font-weight: bold;
}

.kop-alamat {
    font-size: 11px;
    line-height: 1.4;
    margin-top: 5px;
}

.garis-atas {
    border-top: 3px solid #000;
    margin-top: 10px;
}

.garis-bawah {
    border-top: 1px solid #000;
    margin-bottom: 15px;
}

/* =========================
   JUDUL
========================= */
.judul {
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 10px;
}

.periode {
    text-align: center;
    font-size: 12px;
    margin-bottom: 20px;
}

/* =========================
   TABEL
========================= */
table.laporan {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}

table.laporan th,
table.laporan td {
    border: 1px solid #000;
    padding: 6px;
}

table.laporan th {
    background: #f2f2f2;
    text-align: center;
}

.text-center {
    text-align: center;
}

/* =========================
   PRINT MODE (PALING PENTING)
========================= */
@media print {
    body {
        background: #fff;
    }

    .print-area {
        margin: 20;
        padding: 20;
    }
}
</style>
</head>

<body>

<div class="print-area">

<table class="kop-table">
<tr>
    <td width="15%" align="center">
        <img src="{{ asset('gambar/trunojoyoo.png') }}" width="70">
    </td>

    <td width="70%" align="center">
        <div class="kop-judul-1">PEMERINTAH KABUPATEN SAMPANG</div>
        <div class="kop-judul-2">RSUD dr. MOHAMMAD ZYN</div>
        <div class="kop-judul-1">KABUPATEN SAMPANG</div>
        <div class="kop-alamat">
            Jalan Rajawali No. 10, Sampang (69214)<br>
            Telp. (0323) 323956 | Email: rsud.dr.mohammad.zyn@sampangkab.go.id<br>
            Website: rsud.sampangkab.go.id
        </div>
    </td>

    <td width="15%" align="center">
        <img src="{{ asset('gambar/rsmz.png') }}" width="70">
    </td>
</tr>
</table>

<div class="garis-atas"></div>
<div class="garis-bawah"></div>

<div class="judul">LAPORAN PERMINTAAN & PERBAIKAN BARANG</div>


<div class="periode">
    Periode :
    {{ request('tanggal') ? request('tanggal').' / ' : '' }}
    {{ request('bulan') ? request('bulan').' / ' : '' }}
    {{ request('tahun') ?? 'Semua' }}
</div>

<table class="laporan">
<thead>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama Karyawan</th>
    <th>Ruangan</th>
    <th>Nama Barang</th>
    <th>Jml</th>
    <th>Bidang</th>
    <th>Jenis</th>
    <th>Status</th>
</tr>
</thead>
<tbody>
@forelse($data as $item)
<tr>
    <td class="text-center">{{ $loop->iteration }}</td>
    <td class="text-center">{{ $item->created_at->format('d-m-Y') }}</td>
    <td>{{ $item->karyawan->nama ?? '-' }}</td>
    <td>{{ $item->ruangan }}</td>
    <td>{{ $item->detailBarang->nama_barang ?? '-' }}</td>
    <td class="text-center">
        {{ $item->request_type == 'permintaan'
            ? $item->detailBarang->jumlah
            : '-' }}
    </td>
    <th class="text-center">{{ $item->bidang->nama_bidang }}</th>
    <td class="text-center">{{ ucfirst($item->request_type) }}</td>
    <td class="text-center">{{ ucfirst($item->status) }}</td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center">Tidak ada data</td>
</tr>
@endforelse
</tbody>
</table>

</div>
</body>
</html>
