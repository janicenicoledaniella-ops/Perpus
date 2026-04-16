<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dateTime('tanggal_pinjam')->nullable();
            $table->dateTime('tanggal_jatuh_tempo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn(['tanggal_pinjam', 'tanggal_jatuh_tempo']);
        });
    }
};