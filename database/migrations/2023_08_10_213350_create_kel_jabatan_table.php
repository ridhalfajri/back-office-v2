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
        Schema::create('kel_jabatan', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('nama',100);
            $table->char('jenis_jabatan_umum_id',1)->nullable(true)->comment('1: Guru, 2: Tenaga Medis, 3: Tenaga Teknis lainnya');
            $table->string('rumpun_jabatan_id',32)->nullable(true);
            $table->string('pembina_id',32)->nullable(true);
            $table->string('bkn_id',32)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kel_jabatan');
    }
};
