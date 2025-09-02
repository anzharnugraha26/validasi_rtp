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
         Schema::table('validasi_logs', function (Blueprint $table) {
            $table->string('client')->nullable()->after('id');
            $table->string('title')->nullable()->after('client');
            $table->string('created_date')->nullable()->after('title'); // lebih aman daripada 'created'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('validasi_logs', function (Blueprint $table) {
            $table->dropColumn(['client', 'title', 'created_date']);
        });
    }
};
