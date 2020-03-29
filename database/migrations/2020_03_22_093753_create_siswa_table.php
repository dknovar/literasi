<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gambar')->nullable();
            $table->string('name');
            $table->string('nis')->nullable();
            $table->unsignedInteger('id_kelas');
            $table->unsignedInteger('id_users');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
        });
        // Schema::table('kelas', function($table) {
        //     $table->foreign('id_kelas')->references('id')->on('kelas');
        // });
        // Schema::table('users', function($table) {
        //     $table->foreign('id_user')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
