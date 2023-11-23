<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siasn_ref_agama', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siasn_ref_agama');
    }
};
