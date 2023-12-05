<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreJamKerjaTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pre_jam_kerja', function(Blueprint $table) {
             $table->id();
			 $table->time('jam_masuk')->nullable(false);
			 $table->time('jam_pulang')->nullable(false);
             $table->time('jam_masuk_khusus')->nullable(false);
			 $table->time('jam_pulang_khusus')->nullable(false);
			 $table->time('waktu_floating')->nullable(false);
			 $table->enum('is_active',['Y', 'N'])->nullable(false)->default('N');
             $table->enum('is_jk_normal',['Y', 'N'])->nullable(false)->default('Y');
			 $table->text('keterangan')->nullable(false);

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
        Schema::dropIfExists('pre_jam_kerja');
    }
}
