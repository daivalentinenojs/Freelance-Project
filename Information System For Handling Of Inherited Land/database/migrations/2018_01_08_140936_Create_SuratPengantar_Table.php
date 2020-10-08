<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratPengantarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('SuratPengantar', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('Tanggal');
          $table->string('Sanggahan', 2000);
          $table->string('File', 50);
          $table->integer('IDKepalaDesa')->unsigned();
          $table->foreign('IDKepalaDesa')->references('ID')->on('KepalaDesa');
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
        Schema::drop('SuratPengantar');
    }
}
