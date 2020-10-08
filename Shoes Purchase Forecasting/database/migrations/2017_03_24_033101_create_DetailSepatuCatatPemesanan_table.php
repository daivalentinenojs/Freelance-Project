<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSepatuCatatPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSepatuCatatPemesanan', function (Blueprint $table) {
          $table->integer('DetailSepatuID')->unsigned();
          $table->foreign('DetailSepatuID')->references('ID')
          ->on('DetailSepatu')->onDelete('cascade');

          $table->integer('PemesananID')->unsigned();
          $table->foreign('PemesananID')->references('Nomor')
          ->on('Pemesanan')->onDelete('cascade');

          $table->Integer('Jumlah');

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
