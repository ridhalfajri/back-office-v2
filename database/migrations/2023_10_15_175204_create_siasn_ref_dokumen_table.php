<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siasn_ref_dokumen', function (Blueprint $table) {
            $table->id();
            $table->integer('layananId')->nullable();
            $table->string('layananNama')->nullable();
            $table->integer('subLayananId')->nullable();
            $table->string('subLayananNama')->nullable();
            $table->integer('detailLayananId')->nullable();
            $table->string('detailLayananNama')->nullable();
            $table->text('document')->nullable();
            $table->string('jenisDokumen')->nullable();
            $table->string('fileType')->nullable();
            $table->string('linkProses')->nullable();
            $table->boolean('mandatory')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siasn_ref_dokumen');
    }
};
