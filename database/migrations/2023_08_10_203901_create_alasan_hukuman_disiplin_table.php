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
        Schema::create('alasan_hukuman_disiplin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->text('nama');
            $table->string('keterangan',30)->nullable(true);
            $table->string('bkn_id',32)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alasan_hukuman_disiplin');
    }
};
