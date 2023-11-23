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
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->unsignedTinyInteger('tingkat_pendidikan_id');
            $table->boolean('status')->default(true)->nullable();
            $table->string('bkn_id', 32)->nullable(true);
            $table->timestamps();
            $table->foreign('tingkat_pendidikan_id')->references('id')->on('tingkat_pendidikan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan');
    }
};
