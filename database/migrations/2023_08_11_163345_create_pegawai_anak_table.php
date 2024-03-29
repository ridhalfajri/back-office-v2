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
        Schema::create('pegawai_anak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->char('anak_ke', 2);
            $table->string('nama', 50);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum('status_anak', ['Kandung', 'Angkat']);
            $table->boolean('status_tunjangan'); //??
            $table->unsignedTinyInteger('pendidikan_id');
            $table->string('bidang_studi', 50)->nullable(true);
            $table->boolean('is_verified')->default(FALSE);
            //indrawan
            $table->boolean('keterangan_anak')->nullable(true)->comment('0 = anak sudah meninggal, 1 = anak masih hidup, 2 = anak sudah menikah atau sudah tidak dapat tunjangan');
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
        Schema::dropIfExists('pegawai_anak');
    }
};
