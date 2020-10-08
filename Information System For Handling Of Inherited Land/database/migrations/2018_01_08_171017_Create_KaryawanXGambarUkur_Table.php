<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanXGambarUkurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('KaryawanXGambarUkur', function (Blueprint $table) {
          $table->increments('ID');
          $table->integer('IDKaryawan')->unsigned();
          $table->foreign('IDKaryawan')->references('ID')->on('Karyawan');
          $table->integer('NomorGambarUkur')->unsigned();
          $table->foreign('NomorGambarUkur')->references('Nomor')->on('GambarUkur');
          $table->integer('IsActive');
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
        Schema::drop('KaryawanXGambarUkur');
    }
}
