<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGambarUkurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('GambarUkur', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->string('NomorSuratTugasUkur', 45);
          $table->string('NomorPetaPendaftaran', 45);
          $table->datetime('Tanggal');
          $table->string('PetaGrafikal', 1000);
          $table->string('Sanggahan', 1000);
          $table->integer('Status');
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
        Schema::drop('GambarUkur');
    }
}
