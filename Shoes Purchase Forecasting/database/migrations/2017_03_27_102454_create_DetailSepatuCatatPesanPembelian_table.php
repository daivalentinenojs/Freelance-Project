<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSepatuCatatPesanPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetailSepatuCatatPesanPembelian', function (Blueprint $table) {
          $table->integer('DetailSepatuID')->unsigned();
          $table->foreign('DetailSepatuID')->references('ID')
          ->on('DetailSepatu')->onDelete('cascade');

          $table->integer('PembelianID')->unsigned();
          $table->foreign('PembelianID')->references('Nomor')
          ->on('PesanPembelian')->onDelete('cascade');

          $table->Integer('Jumlah');
          $table->Integer('harga');

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
        //
    }
}
