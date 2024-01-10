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
        Schema::create('pegawai_tambahan_mk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedInteger('tahun_plus_pengajuan')->default(0);
            $table->unsignedInteger('bulan_plus_pengajuan')->default(0);
            $table->string('no_sk',50)->nullable(true);
            $table->date('tanggal_sk')->nullable(true);
            $table->unsignedInteger('tahun_plus_disetujui')->nullable(true)->default(null);
            $table->unsignedInteger('bulan_plus_disetujui')->nullable(true)->default(null);
            $table->string('pejabat_penetap',255)->nullable(true);
            $table->tinyInteger('status')->nullable(true);
            $table->string('tipe_pengalaman',50)->nullable(true);
            $table->text('keterangan')->nullable(true);
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_tambahan_mk');
    }
};
