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
        Schema::create('tukin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->tinyInteger('grade');
            $table->bigInteger('nominal');
            $table->string('keterangan')->nullable();
            $table->enum('is_active',['Y', 'N'])->nullable(false)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tukin');
    }
};
