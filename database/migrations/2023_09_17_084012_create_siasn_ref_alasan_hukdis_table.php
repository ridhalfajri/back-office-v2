<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siasn_ref_alasan_hukdis', function (Blueprint $table) {
            $table->string('id', 40)->unique();
            $table->text('nama');
            $table->string('keterangan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siasn_ref_alasan_hukdis');
    }
};
