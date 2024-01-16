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
        Schema::create('aturan_thr_gajiplus', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('persentase_tukin')->nullable(true);
            $table->integer('persentase_lainnya')->nullable(true);
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
