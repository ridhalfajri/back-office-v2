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
        Schema::create('pegawai_riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('jabatan_unit_kerja_id');
            $table->string('no_sk', 50);
            $table->string('no_pelantikan', 50)->nullable(true);
            $table->date('tanggal_sk')->nullable(true);
            $table->date('tanggal_pelantikan')->nullable(true);
            $table->date('tmt_jabatan');
            $table->string('pejabat_penetap', 50);
            $table->boolean('is_plt');
            $table->boolean('is_now');
            $table->unsignedTinyInteger('tx_tipe_jabatan_id');
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jabatan_unit_kerja_id')->references('id')->on('jabatan_unit_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tx_tipe_jabatan_id')->references('id')->on('tx_tipe_jabatan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_jabatan');
    }
};
