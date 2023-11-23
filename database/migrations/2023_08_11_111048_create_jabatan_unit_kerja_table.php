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
        Schema::create('jabatan_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jabatan_tukin_id');
            $table->unsignedInteger('hirarki_unit_kerja_id');
            $table->timestamps();
            $table->foreign('jabatan_tukin_id')->references('id')->on('jabatan_tukin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('hirarki_unit_kerja_id')->references('id')->on('hirarki_unit_kerja')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_unit_kerja');
    }
};
