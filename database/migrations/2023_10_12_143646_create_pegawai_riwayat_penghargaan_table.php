<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawai_riwayat_penghargaan', function (Blueprint $table) {
            $table->id();
            $table->string('bkn_id')->nullable();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->foreignId('penghargaan_id')->nullable()->constrained('penghargaan')->nullOnDelete();
            $table->string('no_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->year('tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat_penghargaan');
    }
};
