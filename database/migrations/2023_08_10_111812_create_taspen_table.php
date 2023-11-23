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
        Schema::create('taspen', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('ktua_id',32)->nullable(true);
            $table->string('nama',30);
            $table->char('bkn_id',3)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taspen');
    }
};
