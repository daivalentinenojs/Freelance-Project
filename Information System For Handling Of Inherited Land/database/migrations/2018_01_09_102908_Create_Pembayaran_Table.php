<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Pembayaran', function (Blueprint $table) {
          $table->increments('ID');
          $table->datetime('Tanggal');
          $table->string('NamaBank', 100);
          $table->string('NamaPemegangKartu', 100);
          $table->string('NomorKartu', 30);
          $table->integer('IDFormulirPermohonan')->unsigned();
          $table->foreign('IDFormulirPermohonan')->references('ID')->on('FormulirPermohonan');
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
        Schema::drop('Pembayaran');
    }
}
