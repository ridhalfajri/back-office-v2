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
        Schema::create('pesan_ruang_rapat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedInteger('ruang_rapat_id');
            $table->text('nama_rapat');
            $table->date('tanggal');
			$table->time('waktu_mulai');
            $table->time('waktu_selesai');
			
			$table->text('keterangan_orang_tua');
			
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_ruang_rapat');
    }
};
