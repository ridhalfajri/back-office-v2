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
        Schema::create('pegawai_riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedTinyInteger('pendidikan_id');
            $table->string('nama_instansi')->comment('nama tempat pendidikannya');
            $table->unsignedInteger('propinsi_id');
            $table->unsignedBigInteger('kota_id');
            $table->text('alamat');
            $table->string('no_ijazah', 100);
            $table->date('tanggal_ijazah', 100);
            $table->string('kode_gelar_depan', 10);
            $table->string('kode_gelar_belakang', 10);
            $table->boolean('is_verified')->default(FALSE);
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pendidikan_id')->references('id')->on('tingkat_pendidikan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_pendidikan');
    }
};
