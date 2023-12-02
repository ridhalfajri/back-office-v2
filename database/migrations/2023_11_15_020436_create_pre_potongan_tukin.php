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
        Schema::create('pre_potongan_tukin', function (Blueprint $table) {
            $table->id();
            $table->char('keterlambatan')->nullable(true);
            $table->time('lama_waktu_keterlambatan')->nullable(true);
            $table->float('prosentase_pemotongan')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_potongan_tukin');
    }
};
