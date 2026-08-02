<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\bidang;



class RequestModel extends Model
{
    
protected $table = 'requests';

    protected $fillable = [
        'karyawan_id',
        'ruangan',
        'request_type',
        'status',
        'atasan_id',
        'penerima_id',
        'bidang_id'
    ];

   public function detailBarang()
        {
            return $this->hasOne(detail_barang::class, 'request_id'); 
            // request_id = FK di detail_barangs ke requests.id
        }

  
    // Di dalam RequestModel.php
    public function user()
    {
        return $this->belongsTo(User::class, 'karyawan_id'); // karyawan_id adalah foreign key
    }

    public function penerima()
    {
        return $this->belongsTo(Karyawan::class, 'penerima_id');
    }

    public function atasan()
    {
        return $this->belongsTo(Karyawan::class, 'atasan_id');
    }
    
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

        public function bidang()
    {
        return $this->belongsTo(bidang::class, 'bidang_id');
    }



    use HasFactory;
}
