<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulir Perencanaan Pengadaan</title>
    <style>
        @page {
            margin: 20mm 18mm 18mm 18mm;
            size: A4;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #1a1a1a;
            background: #fff;
        }
        
        /* === FRAME UTAMA === */
        .main-frame {
            max-width: 210mm;
            margin: 0 auto;
            padding: 8mm 6mm 6mm 6mm;
            border: 1px solid #000;
            background: #fff;
            position: relative;
        }
        
        /* === HEADER === */
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }
        .header-logo {
            width: 72px;
            flex-shrink: 0;
        }
        .header-logo img {
            width: 65px;
            height: auto;
            display: block;
        }
        .header-center {
            flex: 1;
            text-align: center;
            padding: 0 8px;
        }
        .header-title {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .header-sub {
            font-size: 11.5pt;
            font-weight: bold;
            letter-spacing: 0.2px;
        }
        .header-address {
            font-size: 9pt;
            letter-spacing: 0.2px;
        }
        .header-doc-title {
            margin-top: 6px;
            font-size: 12.5pt;
            font-weight: bold;
            text-decoration: underline;
            letter-spacing: 0.5px;
        }

        /* === SECTION TITLE === */
        .section-title {
            font-weight: bold;
            font-size: 11pt;
            margin-top: 14px;
            margin-bottom: 5px;
            text-decoration: underline;
            letter-spacing: 0.2px;
        }

        /* === TABEL TANPA BORDER (IDENTITAS) === */
        .table-no-border {
            width: 100%;
            border-collapse: collapse;
        }
        .table-no-border td {
            border: none;
            padding: 2px 4px;
            vertical-align: top;
        }
        .table-no-border .label {
            font-weight: bold;
            width: 170px;
        }
        .table-no-border .colon {
            width: 10px;
            text-align: center;
        }
        .table-no-border .value {
            padding-left: 2px;
        }

        /* === TABEL BORDER (URAIAN KEBUTUHAN) === */
        .table-bordered {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: middle;
        }
        .table-bordered th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 10pt;
        }
        .table-bordered td {
            font-size: 10.5pt;
        }
        .table-bordered input {
            border: none;
            background: transparent;
            width: 100%;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.5pt;
        }
        .table-bordered input:focus {
            outline: none;
            background: #f8f9fa;
        }
        .table-bordered .input-harga {
            text-align: right;
        }
        .table-bordered .input-jumlah {
            text-align: center;
        }

        /* === TABEL VERIFIKASI === */
        .table-verification {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }
        .table-verification th,
        .table-verification td {
            border: 1px solid #000;
            padding: 6px 5px;
            vertical-align: middle;
        }
        .table-verification th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 10pt;
        }
        .table-verification .verif-options {
            text-align: left;
            padding-left: 8px;
            font-size: 9.5pt;
            line-height: 1.7;
        }
        .table-verification .verif-options div {
            margin-bottom: 1px;
        }
        .table-verification .note-cell {
            font-size: 8.5pt;
            text-align: left;
            padding: 4px 6px;
        }

        /* === TABEL TANDA TANGAN === */
        .table-signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        .table-signature th {
            border: 1px solid #000;
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
            padding: 6px 8px;
        }
        .table-signature td {
            border: 1px solid #000;
            text-align: center;
            padding: 8px 6px;
            vertical-align: middle;
            height: 80px;
        }
        .signature-name {
            font-weight: bold;
            font-size: 10.5pt;
        }
        .signature-ttd img {
            max-width: 100px;
            max-height: 50px;
            display: block;
            margin: 0 auto;
        }
        .signature-nip {
            font-size: 9pt;
            margin: 2px 0;
        }

        /* === CHECKLIST === */
        .checklist {
            display: inline-block;
            margin-right: 14px;
            margin-bottom: 2px;
            font-size: 10.5pt;
        }
        .checklist-box {
            display: inline-block;
            width: 13px;
            height: 13px;
            border: 1.5px solid #000;
            margin-right: 3px;
            text-align: center;
            line-height: 13px;
            font-size: 9pt;
            font-weight: bold;
        }
        .checklist-box.checked {
            background-color: #000;
            color: #fff;
        }

        /* === BORDER BOX === */
        .border-box {
            border: 1px solid #000;
            padding: 10px 12px;
        }
        .border-dashed {
            border: 1px dashed #aaa;
            padding: 6px 8px;
            min-height: 40px;
        }

        /* === TEXT UTILITY === */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .text-bold { font-weight: bold; }
        .text-underline { text-decoration: underline; }
        .small-text { font-size: 8.5pt; }
        .mt-5 { margin-top: 4px; }
        .mt-10 { margin-top: 8px; }
        .mt-15 { margin-top: 12px; }
        .mt-20 { margin-top: 16px; }
        .mb-5 { margin-bottom: 4px; }
        .mb-10 { margin-bottom: 8px; }

        /* === LAMPIRAN === */
        .lampiran-list {
            padding-left: 18px;
            line-height: 1.7;
        }
        .lampiran-list div {
            margin-bottom: 1px;
        }

        /* === FOOTER === */
        .footer-print {
            margin-top: 20px;
            text-align: center;
            font-size: 8pt;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 6px;
        }

        /* === QR CODE PRINT FIX === */
        .qr-code-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .qr-code-container img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        /* === PRINT STYLES === */
        @media print {
            .no-print { display: none !important; }
            body { background: #fff; }
            .main-frame { 
                border: none; 
                padding: 0;
                margin: 0;
            }
            /* Force print backgrounds and images */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
            /* Ensure QR codes are printed */
            .qr-code-container img,
            .qr-code-container svg {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }
            /* Fix for SVG QR codes */
            svg {
                display: block !important;
                max-width: 100% !important;
                height: auto !important;
            }
        }

        /* === TOMBOL CETAK === */
        .no-print {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            display: flex;
            gap: 8px;
        }
        .btn-print {
            padding: 8px 20px;
            background: #1a3c6e;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .btn-print:hover { background: #0f2a4f; }
        .btn-close {
            padding: 8px 16px;
            background: #a02828;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .btn-close:hover { background: #7a1e1e; }
    </style>
</head>
<body>

<!-- ===== FRAME UTAMA ===== -->
<div class="main-frame">

    <!-- ===== HEADER ===== -->
    <div class="header">
        <div class="header-top">
            <div class="header-logo">
                <img src="{{ asset('gambar/trunojoyoo.png') }}" alt="Logo Kabupaten">
            </div>
            <div class="header-center">
                <div class="header-title">PEMERINTAH KABUPATEN SAMPANG</div>
                <div class="header-sub">RSUD dr. MOHAMMAD ZYN</div>
                <div class="header-sub">KABUPATEN SAMPANG</div>
                <div class="header-address">Jalan Rajawali No. 10, Sampang (69214) Telp. (0323) 323956</div>
                <div class="header-address">Email : rsud.dr.mohammad.zyn@sampangkab.go.id &nbsp;|&nbsp; website : rsud.sampangkab.go.id</div>
            </div>
            <div class="header-logo">
                <img src="{{ asset('gambar/rsmz.png') }}" alt="Logo RSUD">
            </div>
        </div>
        <div class="header-doc-title">FORMULIR PERENCANAAN PENGADAAN / PEMELIHARAAN BARANG</div>
    </div>

    <!-- ===== A. IDENTITAS PENGUSUL ===== -->
    <div class="section-title">A. IDENTITAS PENGUSUL</div>
    <table class="table-no-border">
        <tr>
            <td class="label">Ruangan / Instalasi / Bidang</td>
            <td class="colon">:</td>
            <td class="value">{{ $pengajuan->karyawan->ruangan ?? '________________________' }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pengusul</td>
            <td class="colon">:</td>
            <td class="value">{{ $pengajuan->karyawan->nama ?? '________________________' }}</td>
        </tr>
        <tr>
            <td class="label">Jabatan</td>
            <td class="colon">:</td>
            <td class="value">{{ $pengajuan->karyawan->jabatan ?? '________________________' }}</td>
        </tr>
        <tr>
            <td class="label">NIP / NIK</td>
            <td class="colon">:</td>
            <td class="value">{{ $pengajuan->karyawan->nip ?? '________________________' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pengajuan</td>
            <td class="colon">:</td>
            <td class="value">{{ $pengajuan->tanggal_pengajuan ? date('d F Y', strtotime($pengajuan->tanggal_pengajuan)) : '________________________' }}</td>
        </tr>
        <tr>
            <td class="label">Tahun Anggaran</td>
            <td class="colon">:</td>
            <td class="value">{{ $pengajuan->tahun_anggaran ?? date('Y') }}</td>
        </tr>
    </table>

    <!-- ===== B. DASAR USULAN ===== -->
    <div class="section-title">B. DASAR USULAN</div>
    <div style="margin: 3px 0 5px 0;">
        @php
            $dasar = explode(',', $pengajuan->dasar_usulan ?? '');
            $dasar = array_map('trim', $dasar);
        @endphp
        <span class="checklist">
            <span class="checklist-box {{ in_array('Program Kerja', $dasar) ? 'checked' : '' }}">{{ in_array('Program Kerja', $dasar) ? '✓' : '☐' }}</span> Program Kerja
        </span>
        <span class="checklist">
            <span class="checklist-box {{ in_array('Kebutuhan Operasional', $dasar) ? 'checked' : '' }}">{{ in_array('Kebutuhan Operasional', $dasar) ? '✓' : '☐' }}</span> Kebutuhan Operasional
        </span>
        <span class="checklist">
            <span class="checklist-box {{ in_array('Penggantian Barang Rusak', $dasar) ? 'checked' : '' }}">{{ in_array('Penggantian Barang Rusak', $dasar) ? '✓' : '☐' }}</span> Penggantian Barang Rusak
        </span>
        <span class="checklist">
            <span class="checklist-box {{ in_array('Penambahan Kapasitas Pelayanan', $dasar) ? 'checked' : '' }}">{{ in_array('Penambahan Kapasitas Pelayanan', $dasar) ? '✓' : '☐' }}</span> Penambahan Kapasitas Pelayanan
        </span><br>
        <span class="checklist">
            <span class="checklist-box {{ in_array('Pemenuhan Standar Akreditasi', $dasar) ? 'checked' : '' }}">{{ in_array('Pemenuhan Standar Akreditasi', $dasar) ? '✓' : '☐' }}</span> Pemenuhan Standar Akreditasi
        </span>
        <span class="checklist">
            <span class="checklist-box {{ in_array('Keselamatan Pasien', $dasar) ? 'checked' : '' }}">{{ in_array('Keselamatan Pasien', $dasar) ? '✓' : '☐' }}</span> Keselamatan Pasien
        </span>
        <span class="checklist">
            <span class="checklist-box {{ in_array('Lainnya', $dasar) ? 'checked' : '' }}">{{ in_array('Lainnya', $dasar) ? '✓' : '☐' }}</span> Lainnya : {{ $pengajuan->dasar_lainnya ?? '' }}
        </span>
    </div>

    <!-- ===== C. URAIAN KEBUTUHAN ===== -->
    <div class="section-title">C. URAIAN KEBUTUHAN</div>
    <table class="table-bordered" id="table-kebutuhan">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 145px;">Nama Barang / Pemeliharaan</th>
                <th style="width: 125px;">Spesifikasi Teknis</th>
                <th style="width: 50px;">Satuan</th>
                <th style="width: 50px;">Jumlah</th>
                <th style="width: 115px;">Perkiraan Harga Satuan (Rp)</th>
                <th style="width: 125px;">Total (Rp)</th>
            </tr>
        </thead>
        <tbody id="tbody-kebutuhan">
            @if(isset($pengajuan->items) && count($pengajuan->items) > 0)
                @foreach($pengajuan->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->spesifikasi }}</td>
                    <td class="text-center">{{ $item->satuan }}</td>
                    <td class="text-center">
                        <input type="number" class="input-jumlah" value="{{ $item->jumlah }}" 
                               data-index="{{ $index }}" onchange="hitungTotalBaris(this)">
                    </td>
                    <td>
                        <input type="text" class="input-harga" value="{{ number_format($item->harga_satuan, 0, ',', '.') }}" 
                               data-index="{{ $index }}" onchange="hitungTotalBaris(this)">
                    </td>
                    <td class="text-right total-barang">{{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @else
                @for($i = 0; $i < 5; $i++)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="text-center">
                        <input type="number" class="input-jumlah" value="" data-index="{{ $i }}" onchange="hitungTotalBaris(this)">
                    </td>
                    <td>
                        <input type="text" class="input-harga" value="" data-index="{{ $i }}" onchange="hitungTotalBaris(this)">
                    </td>
                    <td class="text-right total-barang">0</td>
                </tr>
                @endfor
            @endif
            <tr>
                <td colspan="6" class="text-right text-bold" style="padding-right: 8px;">TOTAL</td>
                <td class="text-right text-bold" id="grand-total">
                    {{ isset($pengajuan->total) ? number_format($pengajuan->total, 0, ',', '.') : '0' }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- ===== D. ALASAN DAN JUSTIFIKASI ===== -->
    <div class="section-title">D. ALASAN DAN JUSTIFIKASI PENGADAAN</div>
    <div class="border-dashed">
        {{ $pengajuan->alasan_justifikasi ?? '..............................................................................................................' }}
    </div>

    <!-- ===== E. MANFAAT ===== -->
    <div class="section-title">E. MANFAAT YANG DIHARAPKAN</div>
    <div class="border-dashed">
        {{ $pengajuan->manfaat ?? '1. .............................................................................' }}
    </div>

    <!-- ===== F. KONDISI BARANG YANG ADA ===== -->
    @if(isset($pengajuan->is_penggantian) && $pengajuan->is_penggantian)
    <div class="section-title">F. KONDISI BARANG YANG ADA (Jika Penggantian)</div>
    <table class="table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th style="width: 70px;">Jumlah</th>
                <th style="width: 110px;">Tahun Perolehan</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($pengajuan->barang_lama) && count($pengajuan->barang_lama) > 0)
                @foreach($pengajuan->barang_lama as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-center">{{ $item->tahun }}</td>
                    <td>{{ $item->kondisi }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div style="margin-top: 4px;">
        <span class="checklist">
            <span class="checklist-box {{ isset($pengajuan->kondisi_rusak_berat) && $pengajuan->kondisi_rusak_berat ? 'checked' : '' }}">✓</span> Rusak Berat
        </span>
        <span class="checklist">
            <span class="checklist-box {{ isset($pengajuan->kondisi_rusak_ringan) && $pengajuan->kondisi_rusak_ringan ? 'checked' : '' }}">✓</span> Rusak Ringan
        </span>
        <span class="checklist">
            <span class="checklist-box {{ isset($pengajuan->kondisi_tidak_memadai) && $pengajuan->kondisi_tidak_memadai ? 'checked' : '' }}">✓</span> Tidak Memadai
        </span>
        <span class="checklist">
            <span class="checklist-box {{ isset($pengajuan->kondisi_kapasitas_kurang) && $pengajuan->kondisi_kapasitas_kurang ? 'checked' : '' }}">✓</span> Kapasitas Kurang
        </span>
        <span class="checklist">
            <span class="checklist-box {{ isset($pengajuan->kondisi_tidak_tersedia) && $pengajuan->kondisi_tidak_tersedia ? 'checked' : '' }}">✓</span> Tidak Tersedia
        </span>
    </div>
    @endif

    <!-- ===== G. DAMPAK ===== -->
    <div class="section-title">G. DAMPAK APABILA TIDAK DILAKSANAKAN</div>
    <div class="border-dashed">
        {{ $pengajuan->dampak ?? '..............................................................................................................' }}
    </div>

    <!-- ===== H. DOKUMEN PENDUKUNG ===== -->
    <div class="section-title">H. DOKUMEN PENDUKUNG</div>
    <div style="margin: 3px 0 5px 0;">
        @php
            $dataKerusakan = $pengajuan->data_kerusakan ?? '';
            $isAda = !empty($dataKerusakan) && $dataKerusakan != '' && $dataKerusakan != 'null';
        @endphp
        <span class="checklist">
            <span class="checklist-box {{ $isAda ? 'checked' : '' }}">
                {{ $isAda ? '✓' : '☐' }}
            </span> Ada
        </span>
        <span class="checklist">
            <span class="checklist-box {{ !$isAda ? 'checked' : '' }}">
                {{ !$isAda ? '✓' : '☐' }}
            </span> Tidak ada
        </span>
    </div>

    <!-- ===== I. VERIFIKASI BERJENJANG ===== -->
    <div class="section-title">I. VERIFIKASI BERJENJANG</div>
    <table class="table-verification">
        <thead>
            <tr>
                <th style="width: 18%;">Telaah Unit Terkait</th>
                <th style="width: 18%;">Kepala Bidang / Bagian</th>
                <th style="width: 18%;">Bagian Keuangan</th>
                <th style="width: 18%;">Direktur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ka. {{ $pengajuan->unit_terkait ?? '...............' }}*</td>
                <td>Kepala Bidang / Bagian</td>
                <td>Bagian Keuangan</td>
                <td>Direktur</td>
            </tr>
            <tr>
                <!-- KOLOM 1: TELAAH UNIT TERKAIT -->
                <td class="verif-options">
                    @php
                        $status_unit = $pengajuan->log_status_penerima ?? '';
                    @endphp
                    <div>
                        <span class="checklist-box {{ $status_unit == 'disetujui_koordinator' ? 'checked' : '' }}">
                            {{ $status_unit == 'disetujui_koordinator' ? '✓' : '☐' }}
                        </span> Layak
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_unit == 'revisi' ? 'checked' : '' }}">
                            {{ $status_unit == 'revisi' ? '✓' : '☐' }}
                        </span> Perlu Survei / Perbaikan
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_unit == 'ditolak_penerima' ? 'checked' : '' }}">
                            {{ $status_unit == 'ditolak_penerima' ? '✓' : '☐' }}
                        </span> Tidak Direkomendasikan
                    </div>
                </td>

                <!-- KOLOM 2: KEPALA BIDANG / BAGIAN -->
                <td class="verif-options">
                    @php
                        $status_atasan = $pengajuan->log_status_atasan ?? '';
                    @endphp
                    <div>
                        <span class="checklist-box {{ $status_atasan == 'disetujui_kabid' ? 'checked' : '' }}">
                            {{ $status_atasan == 'disetujui_kabid' ? '✓' : '☐' }}
                        </span> Disetujui
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_atasan == 'dipertimbangkan' ? 'checked' : '' }}">
                            {{ $status_atasan == 'dipertimbangkan' ? '✓' : '☐' }}
                        </span> Dipertimbangkan
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_atasan == 'ditolak_kabid' ? 'checked' : '' }}">
                            {{ $status_atasan == 'ditolak_kabid' ? '✓' : '☐' }}
                        </span> Ditolak
                    </div>
                </td>

                <!-- KOLOM 3: BAGIAN KEUANGAN -->
                <td class="verif-options">
                    @php
                        $status_keuangan = $pengajuan->log_status_keuangan ?? '';
                    @endphp
                    <div>
                        <span class="checklist-box {{ $status_keuangan == 'disetujui_keuangan' ? 'checked' : '' }}">
                            {{ $status_keuangan == 'disetujui_keuangan' ? '✓' : '☐' }}
                        </span> Tersedia Anggaran
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_keuangan == 'sebagian' ? 'checked' : '' }}">
                            {{ $status_keuangan == 'sebagian' ? '✓' : '☐' }}
                        </span> Sebagian Anggaran
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_keuangan == 'tidak_tersedia' ? 'checked' : '' }}">
                            {{ $status_keuangan == 'tidak_tersedia' ? '✓' : '☐' }}
                        </span> Tidak Tersedia Anggaran
                    </div>
                </td>

                <!-- KOLOM 4: DIREKTUR -->
                <td class="verif-options">
                    @php
                        $status_direktur = $pengajuan->log_status_direktur ?? '';
                    @endphp
                    <div>
                        <span class="checklist-box {{ $status_direktur == 'disetujui' ? 'checked' : '' }}">
                            {{ $status_direktur == 'disetujui' ? '✓' : '☐' }}
                        </span> Disetujui
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_direktur == 'disetujui sebagian' ? 'checked' : '' }}">
                            {{ $status_direktur == 'disetujui sebagian' ? '✓' : '☐' }}
                        </span> Disetujui Sebagian
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_direktur == 'ditunda' ? 'checked' : '' }}">
                            {{ $status_direktur == 'ditunda' ? '✓' : '☐' }}
                        </span> Ditunda
                    </div>
                    <div>
                        <span class="checklist-box {{ $status_direktur == 'ditolak_direktur' ? 'checked' : '' }}">
                            {{ $status_direktur == 'ditolak_direktur' ? '✓' : '☐' }}
                        </span> Ditolak
                    </div>
                </td>
            </tr>
            <tr>
                <td class="note-cell"><strong>Note :</strong><br> {{ $pengajuan->catatan_unit ?? '' }}</td>
                <td class="note-cell"><strong>Note :</strong><br> {{ $pengajuan->catatan_bidang ?? '' }}</td>
                <td class="note-cell"><strong>Note :</strong><br> {{ $pengajuan->catatan_keuangan ?? '' }}</td>
                <td class="note-cell"><strong>Note :</strong><br> {{ $pengajuan->catatan_direktur ?? '' }}</td>
            </tr>
            <tr>
                <td>
                    <strong style="font-size: 9pt;">Nama &amp; Paraf :</strong>
                    <div style="text-align: center;">
                        @if($pengajuan->penerima->ttd)
                            <img src="{{ asset('storage/ttd/' . $pengajuan->penerima->ttd) }}" 
                                alt="TTD" 
                                style="max-width: 80px; max-height: 35px; display: block; margin: 2px auto;">
                            <div style="font-size: 10pt;">{{ $pengajuan->penerima->nama ?? '' }}</div>
                        @else
                            <div style="font-size: 8pt; font-style: italic; color: #999;">(TTD)</div>
                        @endif
                    </div>
                </td>
                <td>
                    <strong style="font-size: 9pt;">Nama &amp; Paraf :</strong>
                    <div style="text-align: center;">
                        @if($pengajuan->atasan->ttd)
                            <img src="{{ asset('storage/ttd/' . $pengajuan->atasan->ttd) }}" 
                                alt="TTD" 
                                style="max-width: 80px; max-height: 35px; display: block; margin: 2px auto;">
                            <div style="font-size: 10pt;">{{ $pengajuan->atasan->nama ?? '' }}</div>
                        @else
                            <div style="font-size: 8pt; font-style: italic; color: #999;">(TTD)</div>
                        @endif
                    </div>
                </td>
                <td>
                    <strong style="font-size: 9pt;">Nama &amp; Paraf :</strong>
                    <div style="text-align: center;">
                        @if($pengajuan->keuangan->ttd)
                            <img src="{{ asset('storage/ttd/' . $pengajuan->keuangan->ttd) }}" 
                                alt="TTD" 
                                style="max-width: 80px; max-height: 35px; display: block; margin: 2px auto;">
                            <div style="font-size: 10pt;">{{ $pengajuan->keuangan->nama ?? '' }}</div>
                        @else
                            <div style="font-size: 8pt; font-style: italic; color: #999;">(TTD)</div>
                        @endif
                    </div>
                </td>
                <td>
                    <strong style="font-size: 9pt;">Nama &amp; Paraf :</strong>
                    <div style="text-align: center;">
                        @if($pengajuan->direktur->ttd)
                            <img src="{{ asset('storage/ttd/' . $pengajuan->direktur->ttd) }}" 
                                alt="TTD" 
                                style="max-width: 80px; max-height: 35px; display: block; margin: 2px auto;">
                            <div style="font-size: 10pt;">{{ $pengajuan->direktur->nama ?? '' }}</div>
                        @else
                            <div style="font-size: 8pt; font-style: italic; color: #999;">(TTD)</div>
                        @endif
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- ===== J. KEPUTUSAN MANAJEMEN ===== -->
    <div class="section-title">J. KEPUTUSAN MANAJEMEN</div>
    <div class="border-box">
        <p><strong>Direksi memutuskan:</strong></p>
        <div style="margin: 3px 0 5px 0;">
            @php
                $keputusan = $pengajuan->log_status_direktur ?? '';
            @endphp
            <span class="checklist">
                <span class="checklist-box {{ $keputusan == 'disetujui' ? 'checked' : '' }}">
                    {{ $keputusan == 'disetujui' ? '✓' : '☐' }}
                </span> Disetujui
            </span>
            <span class="checklist">
                <span class="checklist-box {{ $keputusan == 'disetujui sebagian' ? 'checked' : '' }}">
                    {{ $keputusan == 'disetujui sebagian' ? '✓' : '☐' }}
                </span> Disetujui Sebagian
            </span>
            <span class="checklist">
                <span class="checklist-box {{ $keputusan == 'ditunda' ? 'checked' : '' }}">
                    {{ $keputusan == 'ditunda' ? '✓' : '☐' }}
                </span> Ditunda
            </span>
            <span class="checklist">
                <span class="checklist-box {{ $keputusan == 'ditolak' ? 'checked' : '' }}">
                    {{ $keputusan == 'ditolak' ? '✓' : '☐' }}
                </span> Ditolak
            </span>
        </div>
        <div style="margin-top: 6px;">
            <strong>Nominal yang Disetujui :</strong> Rp {{ isset($pengajuan->total_disetujui_direktur) ? number_format($pengajuan->total_disetujui_direktur, 0, ',', '.') : '____________________________' }}
        </div>
        <div style="margin-top: 6px;">
            <strong>Catatan Manajemen:</strong><br>
            <div class="border-dashed" style="min-height: 30px; margin-top: 2px;">
                {{ $pengajuan->catatan_direktur ?? '..............................................................................' }}
            </div>
        </div>
    </div>

    <!-- ===== TANDA TANGAN ===== -->
    <div style="margin-top: 14px;">
        <div class="text-center text-bold" style="font-size: 11pt; margin-bottom: 6px;">Mengetahui</div>
        <table class="table-signature" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; font-weight: bold; text-align: center; font-size: 10pt;">Pengusul</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; font-weight: bold; text-align: center; font-size: 10pt;">Kepala Instalasi</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; font-weight: bold; text-align: center; font-size: 10pt;">Kepala Bidang</th>
                    <th style="border: 1px solid #000; padding: 6px 8px; background-color: #f0f0f0; font-weight: bold; text-align: center; font-size: 10pt;">Direktur / Wakil Direktur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- KOLOM PENGUSUL -->
                    <td style="border: 1px solid #000; padding: 8px 6px; text-align: center; vertical-align: middle; height: 80px;">
                        <div style="font-weight: bold; font-size: 10.5pt;">{{ $pengajuan->karyawan->nama ?? '' }}</div>
                        <div style="font-size: 9pt; margin: 2px 0;">NIP. {{ $pengajuan->karyawan->nip ?? '' }}</div>
                        <div style="margin-top: 4px;">
                            @if($pengajuan->karyawan->ttd)
                                @php
                                    $diajukan = \Carbon\Carbon::parse($pengajuan->created_at);
                                    $qrTextPengusul = "Diajukan Oleh: " . $pengajuan->karyawan->nama . "\n" .
                                                      "Tanggal: " . $diajukan->format('d-m-Y') . "\n" .
                                                      "Jam: " . $diajukan->format('H:i:s') . "\n" .
                                                      "Instansi : RSUD Dr. Mohammad Zyn Sampang";
                                    $qrImagePengusul = DNS2D::getBarcodePNG($qrTextPengusul, 'QRCODE', 3, 3);
                                @endphp
                                <div class="qr-code-container">
                                    <img src="data:image/png;base64,{{ $qrImagePengusul }}" 
                                         alt="QR Code" 
                                         style="width: 50px; height: 50px; display: block;" />
                                </div>
                            @else
                                <div style="font-size: 9pt; font-style: italic; color: #666;">TTD</div>
                            @endif
                        </div>
                    </td>

                    <!-- KOLOM KEPALA INSTALASI -->
                    <td style="border: 1px solid #000; padding: 8px 6px; text-align: center; vertical-align: middle; height: 80px;">
                        <div style="font-weight: bold; font-size: 10.5pt;">{{ $pengajuan->penerima->nama ?? '' }}</div>
                        <div style="font-size: 9pt; margin: 2px 0;">NIP. {{ $pengajuan->penerima->nip ?? '' }}</div>
                        <div style="margin-top: 4px;">
                            @if($pengajuan->penerima->ttd)
                                @php
                                    $diterima = \Carbon\Carbon::parse($pengajuan->diterima_at);
                                    $qrTextPenerima = "Ditandatangani oleh: " . $pengajuan->penerima->nama . "\n" .
                                                      "Tanggal: " . $diterima->format('d-m-Y') . "\n" .
                                                      "Jam: " . $diterima->format('H:i:s') . "\n" .
                                                      "Instansi : RSUD Dr. Mohammad Zyn Sampang";
                                    $qrImagePenerima = DNS2D::getBarcodePNG($qrTextPenerima, 'QRCODE', 3, 3);
                                @endphp
                                <div class="qr-code-container">
                                    <img src="data:image/png;base64,{{ $qrImagePenerima }}" 
                                         alt="QR Code" 
                                         style="width: 50px; height: 50px; display: block;" />
                                </div>
                            @else
                                <div style="font-size: 9pt; font-style: italic; color: #666;">TTD</div>
                            @endif
                        </div>
                    </td>

                    <!-- KOLOM KEPALA BIDANG -->
                    <td style="border: 1px solid #000; padding: 8px 6px; text-align: center; vertical-align: middle; height: 80px;">
                        <div style="font-weight: bold; font-size: 10.5pt;">{{ $pengajuan->atasan->nama ?? '' }}</div>
                        <div style="font-size: 9pt; margin: 2px 0;">NIP. {{ $pengajuan->atasan->nip ?? '' }}</div>
                        <div style="margin-top: 4px;">
                            @if($pengajuan->atasan->ttd)
                                @php
                                    $diterimakabid = \Carbon\Carbon::parse($pengajuan->disetujui_kabid_at);
                                    $qrTextKabid = "Ditandatangani oleh: " . $pengajuan->atasan->nama . "\n" .
                                                   "Tanggal: " . $diterimakabid->format('d-m-Y') . "\n" .
                                                   "Jam: " . $diterimakabid->format('H:i:s') . "\n" .
                                                   "Instansi : RSUD Dr. Mohammad Zyn Sampang";
                                    $qrImageKabid = DNS2D::getBarcodePNG($qrTextKabid, 'QRCODE', 3, 3);
                                @endphp
                                <div class="qr-code-container">
                                    <img src="data:image/png;base64,{{ $qrImageKabid }}" 
                                         alt="QR Code" 
                                         style="width: 50px; height: 50px; display: block;" />
                                </div>
                            @else
                                <div style="font-size: 9pt; font-style: italic; color: #666;">TTD</div>
                            @endif
                        </div>
                    </td>

                    <!-- KOLOM DIREKTUR -->
                    <td style="border: 1px solid #000; padding: 8px 6px; text-align: center; vertical-align: middle; height: 80px;">
                        <div style="font-weight: bold; font-size: 10.5pt;">{{ $pengajuan->direktur->nama ?? '' }}</div>
                        <div style="font-size: 9pt; margin: 2px 0;">NIP. {{ $pengajuan->direktur->nip ?? '' }}</div>
                        <div style="margin-top: 4px;">
                            @if($pengajuan->direktur->ttd)
                                @php
                                    $diterimadirektur = \Carbon\Carbon::parse($pengajuan->disetujui_direktur_at);
                                    $qrTextDirektur = "Ditandatangani oleh: " . $pengajuan->direktur->nama . "\n" .
                                                      "Tanggal: " . $diterimadirektur->format('d-m-Y') . "\n" .
                                                      "Jam: " . $diterimadirektur->format('H:i:s') . "\n" .
                                                      "Instansi : RSUD Dr. Mohammad Zyn Sampang";
                                    $qrImageDirektur = DNS2D::getBarcodePNG($qrTextDirektur, 'QRCODE', 3, 3);
                                @endphp
                                <div class="qr-code-container">
                                    <img src="data:image/png;base64,{{ $qrImageDirektur }}" 
                                         alt="QR Code" 
                                         style="width: 50px; height: 50px; display: block;" />
                                </div>
                            @else
                                <div style="font-size: 9pt; font-style: italic; color: #666;">TTD</div>
                            @endif
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ===== LAMPIRAN ===== -->
    <div style="margin-top: 18px;">
        <div class="section-title">LAMPIRAN</div>
        <div class="lampiran-list">
            <div>1. Analisis kebutuhan.</div>
            <div>2. Spesifikasi teknis.</div>
            <div>3. Foto barang.</div>
            <div>4. Penawaran harga.</div>
            <div>5. Data penggunaan / pemakaian.</div>
            <div>6. Dokumen pendukung lainnya.</div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="footer-print">
        Dicetak pada : {{ date('d F Y H:i:s') }} &nbsp;|&nbsp; Dokumen ini adalah cetakan resmi dari sistem
    </div>

</div>
<!-- ===== END FRAME UTAMA ===== -->

<!-- ===== TOMBOL CETAK ===== -->
<div class="no-print">
    <button class="btn-print" onclick="window.print()">🖨️ Cetak</button>
    <button class="btn-close" onclick="window.close()">✕ Tutup</button>
</div>

<!-- ===== JAVASCRIPT UNTUK TOTAL OTOMATIS ===== -->
<script>
// Fungsi untuk format angka ke Rupiah
function formatRupiah(angka) {
    if (!angka || isNaN(angka)) return '0';
    var number_string = angka.toString();
    var sisa = number_string.length % 3;
    var rupiah = number_string.substr(0, sisa);
    var ribuan = number_string.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return rupiah || '0';
}

// Fungsi untuk menghapus titik dan koma
function parseAngka(str) {
    if (!str) return 0;
    return parseFloat(str.replace(/\./g, '').replace(/,/g, '.')) || 0;
}

// Fungsi menghitung total per baris
function hitungTotalBaris(element) {
    var row = element.closest('tr');
    var jumlahInput = row.querySelector('.input-jumlah');
    var hargaInput = row.querySelector('.input-harga');
    var totalCell = row.querySelector('.total-barang');
    
    var jumlah = parseInt(jumlahInput.value) || 0;
    var harga = parseAngka(hargaInput.value);
    
    var total = jumlah * harga;
    totalCell.textContent = formatRupiah(total);
    
    // Hitung grand total
    hitungGrandTotal();
}

// Fungsi menghitung grand total
function hitungGrandTotal() {
    var totalCells = document.querySelectorAll('.total-barang');
    var grandTotal = 0;
    
    totalCells.forEach(function(cell) {
        var value = cell.textContent.replace(/\./g, '');
        var num = parseInt(value) || 0;
        grandTotal += num;
    });
    
    document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
}

// Event listener untuk input harga (format Rupiah otomatis)
document.addEventListener('DOMContentLoaded', function() {
    // Format harga saat input
    var hargaInputs = document.querySelectorAll('.input-harga');
    hargaInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            var value = this.value.replace(/[^0-9]/g, '');
            if (value) {
                this.value = formatRupiah(parseInt(value));
            }
            hitungTotalBaris(this);
        });
    });
    
    // Event listener untuk jumlah
    var jumlahInputs = document.querySelectorAll('.input-jumlah');
    jumlahInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            hitungTotalBaris(this);
        });
    });
    
    // Hitung ulang semua total saat halaman dimuat
    setTimeout(function() {
        var semuaInput = document.querySelectorAll('.input-jumlah, .input-harga');
        semuaInput.forEach(function(input) {
            hitungTotalBaris(input);
        });
    }, 100);
});
</script>

</body>
</html>