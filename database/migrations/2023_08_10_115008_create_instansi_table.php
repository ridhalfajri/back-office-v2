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
        Schema::create('instansi', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('nama',100);
            $table->char('jenis',1)->nullable(true)->comment('Jenis instansi P: Pusat, D: Daerah');
            $table->string('cepat_kode',10)->nullable(true);
            $table->string('jenis_instansi_id',10)->nullable(true)->comment(
                'Jenis instansi KO: Kementerian Koordinator, KEMENT: Kementerian, LPNK: Lembaga non Kementerian, LNS: Lembaga non Struktural, PROV: Provinsi, KAB: Kabupaten, KOTA: Kota'
            );
            $table->string('bkn_id',32)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansi');
    }
};
