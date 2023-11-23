<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siasn_pns_data_ortu', function (Blueprint $table) {
            $table->id();
            $table->string('idPns');
            $table->unique(['idPns', 'ayahId', 'ibuId']);
            $table->string('ayahId');
            $table->string('ayahNama');
            $table->string('ayahTempatLahir')->nullable();
            $table->string('ayahTglLahir')->nullable();
            $table->string('ayahAktaMeninggal')->nullable();
            $table->string('ayahTglMeninggal')->nullable();
            $table->string('ayahJenisKelamin')->nullable();
            $table->string('ayahJenisAnak')->nullable();
            $table->string('ibuId');
            $table->string('ibuNama');
            $table->string('ibuTempatLahir')->nullable();
            $table->string('ibuTglLahir')->nullable();
            $table->string('ibuAktaMeninggal')->nullable();
            $table->string('ibuTglMeninggal')->nullable();
            $table->string('ibuJenisKelamin')->nullable();
            $table->string('ibuJenisAnak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siasn_pns_data_ortu');
    }
};
