<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $table = 'pengajuans';
   protected $fillable = [
    'tahun_anggaran',
    'karyawan_id', 
    'penerima_id', 
    'atasan_id',
    'id_keuangan',
    'direktur_id',
    'total_pengajuan',
    'bidang_id',
    'no_pengajuan',
    'tanggal_pengajuan',
    'instalasi',
    'status',
    'dasar_usulan',
    'alasan_justifikasi',
    'manfaat',
    'dampak',
    'kondisi_barang_lama',
    'ket_barang_lama',
    'foto_barang',
    'data_kerusakan',
    'penawaran_harga',
    'diterima_at',
    'disetujui_kabid_at',
    'disetujui_direktur_at',
    'catatan_unit',
    'catatan_bidang',
    'catatan_perencanaan',
    'catatan_ipsrs',
    'catatan_farmasi',
    'catatan_direktur',
    'catatan_keuangan',
    'total_disetujui',
    'log_status_penerima',
     'log_status_atasan',
     'log_status_keuangan',
     'disetujui_keuangan_at',
     'log_status_direktur',
     'status_keuangan',
     'total_disetujui_direktur'


];

 public function items()
    {
        return $this->hasMany(pengajuan_item::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class);
    }

    public function bidang()
    {
        return $this->belongsTo(bidang::class);
   }

     public function atasan()
    {
        return $this->belongsTo(karyawan::class, 'atasan_id');
   }

   public function penerima()
    {
        return $this->belongsTo(karyawan::class, 'penerima_id',);
   }
   
   public function keuangan()
    {
        return $this->belongsTo(karyawan::class, 'id_keuangan');
   }
}