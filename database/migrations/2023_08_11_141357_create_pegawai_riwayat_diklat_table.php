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
        Schema::create('pegawai_riwayat_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedTinyInteger('jenis_diklat_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->integer('jam_pelajaran');
            $table->text('lokasi');
            $table->string('penyelenggaran', 100);
            $table->string('no_sertifikat', 100);
            $table->date('tanggal_sertifikat');
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenis_diklat_id')->references('id')->on('jenis_diklat')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_diklat');
    }
};
