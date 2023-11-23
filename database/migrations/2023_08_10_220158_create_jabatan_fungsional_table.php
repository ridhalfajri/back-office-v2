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
        Schema::create('jabatan_fungsional', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->tinyInteger('bup_usia')->nullable(true);
            $table->unsignedInteger('kel_jabatan_id');
            $table->char('jenjang',2)->nullable(true)->comment("Kode dari jenjang jabatan fungsional
                PM, TR, MH, PY (Pemula, Terampil, Mahir, Penyelia)
                PT, MU, MA, UT (Pertama, Muda Madya, Utama)");
            $table->char('status',1)->nullable(true)->comment('N: untuk jabatan yang masih berlaku
                O: untuk jabatan yang tidak digunakan');
            $table->string('cepat_kode',6)->nullable(true);
            $table->string('bkn_id',32)->nullable(true);
            $table->timestamps();
            $table->foreign('kel_jabatan_id')->references('id')->on('kel_jabatan')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_fungsional');
    }
};
