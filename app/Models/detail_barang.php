<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_barang extends Model
{
   protected $table = 'detail_barangs';
   protected $fillable = [
    'request_id',
    'nama_barang',
    'kode_aset',
    'deskripsi',
    'spesifikasi',
    'jumlah',
    'tanggal_kerusakan',
    'alasan',
    'no_surat',
    'gambar',
];

public function request()
{
    return $this->belongsTo(RequestModel::class, 'request_id');
}




    use HasFactory;
}
