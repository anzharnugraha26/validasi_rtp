<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('validasi_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_validasi')->nullable();
            $table->string('aksi')->nullable(); // upload_file1, upload_file2, validasi_dijalankan
            $table->text('deskripsi')->nullable(); // ringkasan aktivitas
            $table->text('file1')->nullable();     // isi dari file1 yang dibandingkan
            $table->text('file2')->nullable();     // isi dari file2 yang dibandingkan
            $table->string('parameter')->nullable(); // kolom yang dibandingkan
            $table->string('sim_id')->nullable();  // simid terkait
            $table->string('oleh')->nullable();                // user / ip
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_logs');
    }
};
