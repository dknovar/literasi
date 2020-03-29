<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiterasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('literasi', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tanggal')->nullable();
            $table->string('judul')->nullable();
            $table->string('halaman')->nullable();
            $table->string('review')->nullable();
            $table->string('ket')->nullable();
            $table->unsignedInteger('id_siswa');
            $table->unsignedInteger('id_guru');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('id_guru')->references('id')->on('guru')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('literasi');
    }
}
