<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siasn_ref_kedudukan_hukum', function (Blueprint $table) {
            $table->string('id', 3)->unique();
            $table->string('nama', 100);
            $table->string('aturan');
            $table->string('kode', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siasn_ref_kedudukan_hukum');
    }
};
