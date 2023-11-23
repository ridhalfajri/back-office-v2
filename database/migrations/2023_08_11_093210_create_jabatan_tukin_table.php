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
        Schema::create('jabatan_tukin', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('jabatan_id')->comment('referensi ke nama tabel yang ada pada id jabatan_fungsional atau jabatan_fungsional_umum');
            $table->unsignedTinyInteger('jenis_jabatan_id')->comment('referensi ke nama tabel yang ada pada id jenis jabatan');

            $table->unsignedInteger('tukin_id');
            $table->timestamps();
            $table->foreign('tukin_id')->references('id')->on('tukin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenis_jabatan_id')->references('id')->on('jenis_jabatan')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_tukin');
    }
};
