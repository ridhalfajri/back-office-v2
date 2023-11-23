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
        Schema::create('pre_tak_tercatat', function(Blueprint $table) {
             $table->id();
			 $table->integer('no_enroll')->nullable(false);
			 $table->date('tanggal_pengajuan')->nullable(false);
			 $table->date('tanggal_approved')->nullable(false);
			 $table->integer('jenis')->nullable(false);
			 $table->datetime('jam_perubahan')->nullable(false);
			 $table->bigInteger('atasan_approval_id')->nullable(false);
			 $table->integer('status')->nullable(false);

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
