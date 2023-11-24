<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //indrawan
    public function up(): void
    {
        Schema::create('pegawai_bpjs_lainnya', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->integer('total_mertua')->default(0);
            $table->integer('total_orang_tua')->default(0);
            $table->integer('total_kelebihan_anak')->default(0);

            $table->text('keterangan_mertua')->nullable();
            $table->text('keterangan_orang_tua')->nullable();
            $table->text('keterangan_kelebihan_anak')->nullable();
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_bpjs_lainnya');
    }
};
