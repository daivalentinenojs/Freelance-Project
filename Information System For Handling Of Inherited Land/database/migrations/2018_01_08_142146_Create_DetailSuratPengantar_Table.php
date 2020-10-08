<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSuratPengantarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSuratPengantar', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->string('Keterangan', 2000);
          $table->string('Naskah', 2000);
          $table->integer('Jumlah');
          $table->integer('NomorSuratPengantar')->unsigned();
          $table->foreign('NomorSuratPengantar')->references('Nomor')->on('SuratPengantar');
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
        Schema::drop('DetailSuratPengantar');
    }
}
