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
        Schema::create('pegawai_rekening', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedInteger('bank_id');
            $table->string('no_rekening', 100)->nullable(true);
            $table->enum('tipe_rekening',['Gaji','Tukin','Umak'])->nullable(false);
            $table->timestamps();
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('bank')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_rekening');
    }
};
