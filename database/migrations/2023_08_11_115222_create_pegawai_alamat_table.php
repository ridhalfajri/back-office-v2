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
        Schema::create('pegawai_alamat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->enum('tipe_alamat',["Domisili","Asal"]);
            $table->unsignedInteger('propinsi_id');
            $table->unsignedBigInteger('kota_id');
            $table->unsignedBigInteger('kecamatan_id');
            $table->unsignedBigInteger('desa_id');
            $table->string('kode_pos', 5);
            $table->text('alamat');
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('propinsi_id')->references('id')->on('propinsi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kota_id')->references('id')->on('kota')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('desa_id')->references('id')->on('desa')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_alamat');
    }
};
