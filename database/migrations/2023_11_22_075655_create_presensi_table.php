<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePresensiTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('presensi', function(Blueprint $table) {
             $table->id();
			 $table->integer('no_enroll')->nullable(false);
			 $table->integer('jam_kerja_id')->nullable(false);
             $table->date('tanggal_presensi')->nullable(false);
			 $table->time('jam_masuk')->nullable(true);
			 $table->time('jam_pulang')->nullable(true);
			 $table->integer('is_ijin')->nullable(false)->default('0'); //0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang
             $table->enum('is_jk_normal',['Y', 'N'])->nullable(false)->default('Y');//untuk handling jam kerja pada saat bulan ramadhan
             $table->enum('status_kehadiran',['Hadir','Alpha','Cuti','Dinas Luar','Tugas Belajar'])->nullable(false);
			 $table->time('kekurangan_jam')->nullable(true);
			 $table->datetime('tanggal_update')->nullable(false)
                                                ->default(DB::raw('CURRENT_TIMESTAMP'))
                                                ->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
             $table->unique(['no_enroll', 'tanggal_presensi']);
             $table->string('keterangan')->nullable(true);

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
        Schema::dropIfExists('presensi');
    }
}
