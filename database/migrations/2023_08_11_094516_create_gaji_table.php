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
        Schema::create('gaji', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedTinyInteger('golongan_id');
            $table->integer('masa_kerja');
            $table->bigInteger('nominal');
            //indrawan
            $table->bigInteger('nominal_tunjangan_jabatan');
            $table->timestamps();
            $table->foreign('golongan_id')->references('id')->on('golongan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
