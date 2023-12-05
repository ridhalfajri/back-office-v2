<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreIjinTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pre_ijin', function(Blueprint $table) {
             $table->id();
			 $table->bigInteger('no_enroll')->nullable(false);
			 $table->integer('jenis_ijin')->nullable(false);
			 $table->date('tanggal')->nullable(false);
			 $table->text('keterangan')->nullable(false);
			 $table->bigInteger('status')->nullable(false); //1=pengajuan pegawai, 2=Approved, 3=Ditolak

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
        Schema::dropIfExists('pre_ijin');
    }
}
