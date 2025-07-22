<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiLog extends Model
{
    use HasFactory;

     protected $fillable = [
        'id_validasi',
        'aksi', // upload_file1, upload_file2, validasi_dijalankan
        'deskripsi', // ringkasan aktivitas
        'file1',     // isi dari file1 yang dibandingkan
        'file2',     // isi dari file2 yang dibandingkan
        'parameter', // kolom yang dibandingkan
        'sim_id',  // simid terkait
        'oleh',
    ];
}
