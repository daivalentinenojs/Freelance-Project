<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuktiPemilikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BuktiPemilikan', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->string('File', 50);
          $table->string('PilihanLain', 2000);
          $table->string('NomorSuratRiwayat', 50);
          $table->integer('NomorBuktiWarisan')->unsigned();
          $table->foreign('NomorBuktiWarisan')->references('Nomor')->on('BuktiWarisan');
          $table->integer('NomorBuktiHibah')->unsigned();
          $table->foreign('NomorBuktiHibah')->references('Nomor')->on('BuktiHibah');
          $table->integer('NomorPerwakafan')->unsigned();
          $table->foreign('NomorPerwakafan')->references('Nomor')->on('Perwakafan');
          $table->integer('NomorBuktiPembelian')->unsigned();
          $table->foreign('NomorBuktiPembelian')->references('Nomor')->on('BuktiPembelian');
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
        Schema::drop('BuktiPemilikan');
    }
}
