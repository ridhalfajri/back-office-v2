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
        Schema::create('pre_dinas_luar', function (Blueprint $table) {
            $table->id();
            $table->string('no_enroll', 50)->nullable(true);
            $table->date('tanggal_dinas_awal')->nullable();
            $table->date('tanggal_dinas_akhir')->nullable();
            $table->text('nama_kegiatan')->nullable();
            $table->string('lokasi', 100)->nullable(true);
            $table->tinyInteger('status_approve')->nullable(true); //0 = pengajuan pegawai, 1 = acc atasan, 2 = ditolak atasan

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_dinas_luar');
    }
};
