<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\Request;

class PengadaanReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Pengajuan::with(['karyawan', 'bidang']);

        // Filter TAHUNAN
        if ($this->request->filled('tahun')) {
            $query->whereYear('tanggal_pengajuan', $this->request->tahun);
        }

        // Filter BULANAN (harus pakai tahun juga)
        if ($this->request->filled('bulan') && $this->request->filled('tahun')) {
            $query->whereMonth('tanggal_pengajuan', $this->request->bulan)
                  ->whereYear('tanggal_pengajuan', $this->request->tahun);
        }

        // Filter tambahan (opsional)
        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->filled('bidang_id')) {
            $query->where('bidang_id', $this->request->bidang_id);
        }

        return $query->orderBy('tanggal_pengajuan', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No Pengajuan',
            'Nama Karyawan',
            'Bidang',
            'Instalasi',
            'Tanggal Pengajuan',
            'Tahun Anggaran',
            'Status',
            'Total Pengajuan (Rp)',
            'Total Disetujui (Rp)',
            'Catatan',
        ];
    }

    public function map($pengajuan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $pengajuan->no_pengajuan,
            $pengajuan->karyawan->nama ?? '-',
            $pengajuan->bidang->nama ?? '-',
            $pengajuan->instalasi,
            date('d-m-Y', strtotime($pengajuan->tanggal_pengajuan)),
            $pengajuan->tahun_anggaran ?? '-',
            $this->formatStatus($pengajuan->status),
            number_format($pengajuan->total_pengajuan, 2, ',', '.'),
            number_format($pengajuan->total_disetujui, 2, ',', '.'),
            $pengajuan->catatan_unit ?? '-',
        ];
    }

    private function formatStatus($status)
    {
        $map = [
            'draft' => 'Draft',
            'diajukan' => 'Diajukan',
            'disetujui_koordinator' => 'Disetujui Koordinator',
            'disetujui_kabid' => 'Disetujui Kabid',
            'dipertimbangkan' => 'Dipertimbangkan',
            'menunggu_direktur' => 'Menunggu Direktur',
            'disetujui' => 'Disetujui',
            'disetujui sebagian' => 'Disetujui Sebagian',
            'ditolak' => 'Ditolak',
            'revisi' => 'Revisi',
            'ditunda' => 'Ditunda',
        ];

        return $map[$status] ?? $status;
    }
}