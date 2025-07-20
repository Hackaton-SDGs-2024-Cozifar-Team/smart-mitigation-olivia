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
        Schema::create('penggunaan_dana_donasis', function (Blueprint $table) {
            $table->bigIncrements('id_penggunaan_dana_donasi');
            $table->unsignedBigInteger('id_lapora_bencana');
            $table->string('nama_kebutuhan');
            $table->integer('nominal_uang');
            $table->string('foto_struk');
            $table->date('tanggal_pembelian');
            $table->string('bukti_keterangan');

            $table->foreign('id_lapora_bencana')->references('id_laporan_bencana')->on('laporan_bencanas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_dana_donasis');
    }
};
