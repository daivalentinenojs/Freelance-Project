<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSepatuCatatPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSepatuCatatPenjualan', function (Blueprint $table) {
          $table->integer('DetailSepatuID')->unsigned();
          $table->foreign('DetailSepatuID')->references('ID')
          ->on('DetailSepatu')->onDelete('cascade');

          $table->integer('PenjualanID')->unsigned();
          $table->foreign('PenjualanID')->references('Nomor')
          ->on('Penjualan')->onDelete('cascade');

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
