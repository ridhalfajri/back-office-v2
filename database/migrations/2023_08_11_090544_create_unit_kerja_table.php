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
        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('nama',);
            $table->unsignedTinyInteger('jenis_unit_kerja_id');
            $table->string('singkatan',10)->nullable(true);
            $table->string('keterangan',100)->nullable(true);
            $table->timestamps();
            $table->foreign('jenis_unit_kerja_id')->references('id')->on('jenis_unit_kerja')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerja');
    }
};
