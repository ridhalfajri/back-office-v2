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
        Schema::create('tingkat_pendidikan', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama',30);
            $table->string('group_tk_pend_nm',30)->nullable(true);
            $table->char('bkn_id',2)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tingkat_pendidikan');
    }
};
