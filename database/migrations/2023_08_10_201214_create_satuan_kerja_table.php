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
        Schema::create('satuan_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->unsignedInteger('instansi_id');
            $table->string('bkn_id',32)->nullable(true);
            $table->timestamps();
            $table->foreign('instansi_id')->references('id')->on('instansi')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satuan_kerja');
    }
};
