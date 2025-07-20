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
        // Schema::create('tutupan_lahans', function (Blueprint $table) {
        //     $table->bigIncrements('id_tutupan_lahan');
        //     $table->unsignedBigInteger('id_desa');
        //     $table->string('nilai_tutupan_lahan');
        //     $table->dateTime('tanggal_tutupan_lahan');

        //     $table->foreign('id_desa')->references('id_desa')->on('desas')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutupan_lahans');
    }
};
