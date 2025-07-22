<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiDataDetail extends Model
{
    use HasFactory;

     protected $fillable = [
        'id_validasi',
        'sim_id',
        'parameter',
        'file1',
        'file2',
    ];
}
