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
        Schema::create('cabor', function (Blueprint $table) {
            $table->tinyIncrements('id_cabor');
            $table->string('kode_cabor', 30)->unique()->nullable(false);
            $table->string('nama', 30)->unique()->nullable(false);
            $table->string('deskripsi', 30)->unique()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabor');
    }
};
