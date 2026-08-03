<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $table = 'pengajuans';
   protected $fillable = [
    'karyawan_id', 'penerima_id', 'atasan_id','direktur_id','total_pengajuan','bidang_id','no_pengajuan','tanggal_pengajuan','instalasi','dasar_usulan','alasan_justifikasi','manfaat','dampak','kondisi_barang_lama','ket_barang_lama','foto_barang','data_kerusakan','penawaran_harga','diterima_at','disetujui_kabid_at','disetujui_direktur_at','catatan_unit','catatan_bidang','catatan_perencanaan','catatan_ipsrs','catatan_farmasi','catatan_direktur','catatan_keuangan',

];
    use HasFactory;
}
