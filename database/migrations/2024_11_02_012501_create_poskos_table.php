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
        Schema::create('poskos', function (Blueprint $table) {
            $table->id('id_posko');
            $table->unsignedBigInteger('id_laporan_bencana');
            $table->string('nama_posko');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();

            $table->foreign('id_laporan_bencana')->references('id_laporan_bencana')->on('laporan_bencanas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poskos');
    }
};
