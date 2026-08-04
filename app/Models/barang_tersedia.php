<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_tersedia extends Model
{
    protected $table = 'barang_tersedias';
     protected $fillable = [
        'pengajuan_item_id','nama_barang','jumlah', 
        'tahun_perolehan','kondisi','keterangan'
    ];

    public function pengajuanItem()
    {
        return $this->belongsTo(pengajuan_item::class);
    }
    use HasFactory;
}
