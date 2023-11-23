<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siasn_pns_rw_penghargaan', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('pnsOrangId');
            $table->string('hargaId', 3);
            $table->year('tahun')->nullable();
            $table->string('skNomor')->nullable();
            $table->string('skDate')->nullable();
            $table->string('hargaNama')->nullable();
            $table->json('path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siasn_pns_rw_penghargaan');
    }
};
