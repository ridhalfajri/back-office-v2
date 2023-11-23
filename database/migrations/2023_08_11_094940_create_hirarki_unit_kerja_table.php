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
        Schema::create('hirarki_unit_kerja', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('child_unit_kerja_id');
            $table->unsignedInteger('parent_unit_kerja_id');
            $table->timestamps();
            $table->foreign('child_unit_kerja_id')->references('id')->on('unit_kerja')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parent_unit_kerja_id')->references('id')->on('unit_kerja')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hirarki_unit_kerja');
    }
};
