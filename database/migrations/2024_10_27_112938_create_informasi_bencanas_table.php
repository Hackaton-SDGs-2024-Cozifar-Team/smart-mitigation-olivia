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
        Schema::create('informasi_bencanas', function (Blueprint $table) {
            $table->bigIncrements('id_informasi_bencana');
            $table->unsignedBigInteger('id_laporan_bencana');
            $table->integer('korban_terluka');
            $table->integer('korban_meninggal');
            $table->integer('korban_hilang');
            $table->integer('korban_mengungsi');
            $table->enum('dampak_kerusakan', ['rendah', 'sedang', 'tinggi'])->default('rendah');
            $table->timestamp('tanggal');

            $table->foreign('id_laporan_bencana')->references('id_laporan_bencana')->on('laporan_bencanas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_bencanas');
    }
};
