<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreTakTercatatTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pre_dinas_luar', function(Blueprint $table) {
             $table->id();
			 $table->integer('no_enroll')->nullable(false);
			 $table->date('tanggal_dinas_awal')->nullable(false);
			 $table->date('tanggal_dinas_akhir')->nullable(false);
			 $table->string('nama_kegiatan')->nullable(false);
             $table->string('lokasi')->nullable(false);
			 $table->integer('status_approve')->nullable(false); //1:pengajuan 2:Disetujui 3: ditolak
			 $table->enum('is_active',['Y', 'N'])->nullable(false)->default('N');

            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('pre_tak_tercatat');
    }
}
