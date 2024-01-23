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
        Schema::create('uang_makan', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('golongan_id');
            $table->bigInteger('nominal');
            $table->enum('is_active',['Y', 'N'])->nullable(false)->default('N');
            $table->timestamps();
            $table->foreign('golongan_id')->references('id')->on('golongan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uang_makan');
    }
};
