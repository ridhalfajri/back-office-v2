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
        Schema::create('jenis_diklat', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama',100);
            $table->string('jenis_kursus_sertipikat')->default("-");
            $table->char('bkn_id',2)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_diklat');
    }
};
