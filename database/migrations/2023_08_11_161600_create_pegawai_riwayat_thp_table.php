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
        Schema::create('pegawai_riwayat_thp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('nominal_gaji_pokok');
            $table->unsignedBigInteger('tunjangan_beras');
            $table->unsignedBigInteger('tunjangan_pasangan');
            $table->unsignedBigInteger('tunjangan_anak');
            $table->unsignedBigInteger('tunjangan_jabatan');
            $table->unsignedBigInteger('tunjangan_kinerja');
            $table->unsignedBigInteger('tunjangan_pajak');
            $table->unsignedBigInteger('potongan_simpanan_wajib');
            $table->unsignedBigInteger('potongan_tukin');
            $table->unsignedBigInteger('potongan_iwp');
            $table->unsignedBigInteger('potongan_bpjs');
            $table->unsignedBigInteger('potongan_bpjs_lainnya');
            $table->unsignedBigInteger('potongan_pajak');
            $table->unsignedBigInteger('potongan_tapera')->nullable(true);
            $table->unsignedBigInteger('total_thp')->nullable(true);
            $table->year('tahun');
            $table->enum('bulan',['01','02','03','04','05','06','07','08','09','10','11','12']);
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_thp');
    }
};
