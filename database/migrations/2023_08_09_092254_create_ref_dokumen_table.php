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
        Schema::create('ref_dokumen', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('detail_layanan_nama', 100);
            $table->string('document', 100);
            $table->string('file_type', 3)->nullable(true);
            $table->string('link_proses', 100)->nullable(true);
            $table->boolean('mandatory')->nullable(true);
            $table->string('bkn_id', 5)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_dokumen');
    }
};
