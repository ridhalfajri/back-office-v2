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
        Schema::create('pegawai_riwayat_gajiplus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('nominal_gaji_pokok');
            $table->unsignedBigInteger('tunjangan_beras');
            $table->unsignedBigInteger('tunjangan_pasangan');
            $table->unsignedBigInteger('tunjangan_anak');
            $table->unsignedBigInteger('tunjangan_jabatan');
            $table->unsignedBigInteger('tunjangan_kinerja');
            
            $table->unsignedBigInteger('total_gajiplus')->nullable(true);
            $table->year('tahun');
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_gajiplus');
    }
};
