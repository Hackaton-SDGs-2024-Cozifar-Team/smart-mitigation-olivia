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
        Schema::create('distribusis', function (Blueprint $table) {
            $table->id('id_distribusi');
            $table->unsignedBigInteger('id_posko');
            $table->string('nama_kebutuhan');
            $table->integer('jumlah');
            $table->datetime('tanggal');
            $table->string('foto_keterangan');
            $table->timestamps();

            $table->foreign('id_posko')->references('id_posko')->on('poskos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusis');
    }
};
