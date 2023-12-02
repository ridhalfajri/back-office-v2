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
        Schema::create('pegawai_riwayat_umak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('uang_makan_id');
            //$table->unsignedBigInteger('potongan'); indrawan
            $table->unsignedTinyInteger('jumlah_hari_masuk');
            $table->unsignedBigInteger('total');
            $table->enum('bulan',['01','02','03','04','05','06','07','08','09','10','11','12']);
            $table->year('tahun');
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('uang_makan_id')->references('id')->on('uang_makan')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_umak');
    }
};
