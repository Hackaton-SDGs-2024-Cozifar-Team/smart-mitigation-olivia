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
        Schema::create('clustering_bencanas', function (Blueprint $table) {
            $table->id('id_clustering_bencana');
            $table->unsignedBigInteger('id_desa');
            $table->integer('nilai_cluster');
            $table->enum('cluster', ['rendah', 'sedang', 'tinggi']);
            $table->dateTime('tanggal_prediksi');

            $table->foreign('id_desa')->references('id_desa')->on('desas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clustering_bencanas');
    }
};
