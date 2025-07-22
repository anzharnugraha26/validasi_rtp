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
        Schema::create('validasi_data', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('title');
            $table->string('create_by');
            $table->string('nama_file_1')->nullable();
            $table->string('nama_file_2')->nullable();
            $table->string('jumlah_data_1')->nullable();
            $table->string('jumlah_data_2')->nullable();
            $table->string('total_1')->nullable();
            $table->string('total_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_data');
    }
};
