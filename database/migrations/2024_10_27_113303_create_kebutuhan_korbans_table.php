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
        Schema::create('kebutuhan_korbans', function (Blueprint $table) {
            $table->bigIncrements('id_kebutuhan_korban');
            $table->unsignedBigInteger('id_laporan_bencana');
            $table->string('nama_kebutuhan');
            $table->integer('jumlah_kebutuhan');

            $table->foreign('id_laporan_bencana')->references('id_laporan_bencana')->on('laporan_bencanas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_korbans');
    }
};
