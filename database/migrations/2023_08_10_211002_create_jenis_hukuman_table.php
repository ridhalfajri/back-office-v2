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
        Schema::create('jenis_hukuman', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama',60);
            $table->char('jenis_tingkat_hukuman',1);
            $table->char('bkn_id',2)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_hukuman');
    }
};
