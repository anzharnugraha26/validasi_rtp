<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiData extends Model
{
    use HasFactory;

     protected $fillable = [
        'client',
        'title',
        'create_by',
        'nama_file_1',
        'nama_file_2',
        'jumlah_data_1',
        'jumlah_data_2',
        'total_1',
        'total_2'
    ];
}
