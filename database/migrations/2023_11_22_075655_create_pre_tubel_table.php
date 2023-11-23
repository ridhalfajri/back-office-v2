<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreTubelTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pre_tubel', function(Blueprint $table) {
             $table->id();
			 $table->integer('no_enroll')->nullable(false);
			 $table->date('tanggal_awal')->nullable(false);
			 $table->date('tanggal_akhir')->nullable(false);

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
        Schema::dropIfExists('pre_tubel');
    }
}
