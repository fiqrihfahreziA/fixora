<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_approvals extends Model
{
    protected $table = 'request_approvals';
    protected $fillable = [
    'request_id',
    'status'
    ];
    use HasFactory;
}
