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
        Schema::create('eselon', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama',5);
            $table->string('jabatan_asn',50)->nullable(true);
            $table->char('bkn_id',2)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eselon');
    }
};
