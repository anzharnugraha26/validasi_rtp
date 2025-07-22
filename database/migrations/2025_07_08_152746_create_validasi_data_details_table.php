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
        Schema::create('validasi_data_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_validasi');
            $table->string('sim_id');
            $table->string('parameter');
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_data_details');
    }
};
