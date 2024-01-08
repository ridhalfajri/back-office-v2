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
        Schema::create('pegawai_cuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedTinyInteger('jenis_cuti_id');
            $table->string('keterangan_cuti_p', 150)->nullable(true);
            $table->string('detail_keterangan_cuti_p', 50)->nullable(true);
            $table->date('tanggal_awal_cuti');
            $table->date('tanggal_akhir_cuti');
            $table->tinyInteger('lama_cuti')->nullable(false);
            $table->string('alasan');
            $table->string('alamat_cuti');
            $table->string('no_telepon_cuti', 15);
            $table->unsignedBigInteger('atasan_langsung_id')->nullable(true);
            $table->date('tanggal_approve_al')->comment('al : atasan_langsung')->nullable(true);
            $table->unsignedBigInteger('kabiro_sdmoh_id')->nullable(true);
            $table->date('tanggal_approve_akb')->comment('akb : atasan sdmoh')->nullable(true);
            $table->date('tanggal_penolakan_cuti')->nullable(true)->nullable(true);
            $table->unsignedTinyInteger('status_pengajuan_cuti_id')->nullable(true);
            $table->string('keterangan')->nullable(true);
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenis_cuti_id')->references('id')->on('jenis_cuti')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('atasan_langsung_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kabiro_sdmoh_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_pengajuan_cuti_id')->references('id')->on('status_cuti')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_cuti');
    }
};
