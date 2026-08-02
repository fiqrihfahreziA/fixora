<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
     protected $table = 'karyawans';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'ruangan',
        'ttd',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengguna()
    {
        return $this->hasOne(User::class, 'karyawan_id');
    }

    /** @use HasFactory<\Database\Factories\KaryawanFactory> */
    use HasFactory;
}
