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
        Schema::create('desas', function (Blueprint $table) {
            $table->id('id_desa');
            $table->unsignedBigInteger('id_kecamatan');
            $table->string('nama_desa', 50);
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->string('code_adm');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('laporan_bencanas', function (Blueprint $table) {
            $table->bigIncrements('id_laporan_bencana');
            $table->unsignedBigInteger('id_users');
            $table->string('nama_bencana', 100);
            $table->text('deskripsi_bencana');
            $table->text('deskripsi_alamat');
            $table->enum('tingkat_bencana', ['rendah', 'sedang', 'tinggi'])->default('rendah');
            $table->dateTime('tanggal_kejadian');
            $table->string('foto_bencana');
            $table->unsignedBigInteger('id_desa');
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->integer('target_uang_donasi')->nullable();
            $table->enum('status', ['diajukan', 'terkonfirmasi', 'tidak terkonfirmasi', 'selesai'])->default('terkonfirmasi');
            $table->foreign('id_users')->references('id_users')->on('users');
            $table->foreign('id_desa')->references('id_desa')->on('desas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bencanas');
    }
};
