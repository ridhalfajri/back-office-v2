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
        Schema::create('pegawai_riwayat_golongan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedTinyInteger('golongan_id');
            $table->date('tmt_golongan')->nullable();
            $table->string('no_sk', 50)->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->boolean('is_active')->nullable();
            
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('golongan_id')->references('id')->on('golongan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_golongan');
    }
};
