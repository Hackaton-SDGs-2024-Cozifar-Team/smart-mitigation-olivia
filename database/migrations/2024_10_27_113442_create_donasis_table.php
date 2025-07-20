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
        Schema::create('donasis', function (Blueprint $table) {
            $table->bigIncrements('id_donasi');
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_laporan_bencana');
            $table->unsignedBigInteger('id_kebutuhan_korban')->nullable();
            $table->enum('jenis_donasi', ['uang', 'barang'])->default('uang');
            $table->integer('nominal_donasi')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->string('fotos_barang')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamp('tanggal_donasi');
            $table->enum('status', ['diterima', 'ditolak'])->default('diterima');

            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_laporan_bencana')->references('id_laporan_bencana')->on('laporan_bencanas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kebutuhan_korban')->references('id_kebutuhan_korban')->on('kebutuhan_korbans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
