<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_modul');
            $table->unsignedBigInteger('id_asisten');
            $table->date('tgl_praktikum');
            $table->text('pdf');
            $table->text('pesan');

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_modul')->references('id')->on('modul');
            $table->foreign('id_asisten')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
