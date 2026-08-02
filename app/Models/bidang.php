<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bidang extends Model

{  protected $table = 'bidangs';

    protected $fillable = [
        'nama_bidang'
    ];
    use HasFactory;

    public function users()
{
    return $this->hasMany(User::class);
}

 public function req()
{
    return $this->hasMany(RequestModel::class);
}

}
