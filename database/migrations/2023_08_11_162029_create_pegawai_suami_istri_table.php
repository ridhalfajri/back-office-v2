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
        Schema::create('pegawai_suami_istri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->string('nama', 100);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->date('tanggal_kawin');
            $table->string('no_kartu', 50);
            //$table->boolean('is_pns');
            //indrawan
            $table->boolean('status_pns')->nullable(true)->comment('0 = bukan pns, 1 = pns');
            $table->unsignedBigInteger('pendidikan_id');
            $table->string('pekerjaan', 50);
            $table->boolean('status_tunjangan')->nullable(true)->comment('0 = tidak dapat tunjangan, 1 = dapat tunjangan');
            $table->string('no_sk_cerai', 50)->nullable(true);
            $table->date('tmt_sk_cerai')->nullable(true);
            $table->unsignedTinyInteger('jenis_kawin_id');
            $table->string('no_buku_nikah', 50);
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pendidikan_id')->references('id')->on('pendidikan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenis_kawin_id')->references('id')->on('jenis_kawin')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_suami_istri');
    }
};
