<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siasn_pns_data_pasangan', function (Blueprint $table) {
            $table->id();
            $table->unique(['idPns', 'orangId']);
            $table->string('idPns', 50);
            $table->string('orangId', 50);
            $table->string('ayahId', 50)->nullable();
            $table->string('ibuId', 50)->nullable();
            $table->string('nama')->nullable();
            $table->string('namaKtp')->nullable();
            $table->string('gelarDepan')->nullable();
            $table->string('gelarBlk')->nullable();
            $table->string('tempatLahir')->nullable();
            $table->string('tglLahir', 10)->nullable();
            $table->string('aktaMeninggal')->nullable();
            $table->string('tglMeninggal', 10)->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('jenisAnak')->nullable();
            $table->string('statusHidup', 5)->nullable();
            $table->string('jenisKawinId', 5)->nullable();
            $table->string('karisKarsu')->nullable();
            $table->string('statusNikah')->nullable();
            $table->string('dataPernikahanId', 50)->nullable();
            $table->string('tglMenikah', 10)->nullable();
            $table->tinyText('aktaMenikah')->nullable();
            $table->string('tglCerai', 10)->nullable();
            $table->tinyText('aktaCerai')->nullable();
            $table->integer('posisi')->nullable();
            $table->string('status', 10)->nullable();
            $table->boolean('isPns')->nullable();
            $table->string('noSkPensiun')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siasn_pns_data_pasangan');
    }
};
