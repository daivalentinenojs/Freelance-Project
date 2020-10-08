<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalUkurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('JadwalUkur', function (Blueprint $table) {
          $table->increments('ID');
          $table->datetime('TanggalMulai');
          $table->datetime('TanggalSelesai');
          $table->integer('IDKaryawan')->unsigned();
          $table->foreign('IDKaryawan')->references('ID')->on('Karyawan');
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
        Schema::drop('JadwalUkur');
    }
}
