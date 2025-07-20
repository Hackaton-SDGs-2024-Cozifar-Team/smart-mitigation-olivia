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
        // Schema::create('prediksi_bencanas', function (Blueprint $table) {
        //     $table->bigIncrements('id_prediksi_bencana');
        //     $table->unsignedBigInteger('id_desa');
        //     $table->string('nilai_prediksi');
        //     $table->enum('status_prediksi', ['terprediksi', 'tidak terprediksi'])->default('terprediksi');
        //     $table->dateTime('tanggal_prediksi');

        //     $table->foreign('id_desa')->references('id_desa')->on('desas')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediksi_bencanas');
    }
};
