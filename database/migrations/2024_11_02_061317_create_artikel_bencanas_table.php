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
        Schema::create('artikel_bencanas', function (Blueprint $table) {
            $table->bigIncrements('id_artikel_bencana');
            $table->string('judul_artikel');
            $table->string('isi_artikel')->nullable();
            $table->string('foto_artikel')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_bencanas');
    }
};
