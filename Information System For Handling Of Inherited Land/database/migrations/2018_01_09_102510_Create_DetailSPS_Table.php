<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSPS', function (Blueprint $table) {
          $table->increments('ID');
          $table->datetime('TanggalBayar');
          $table->string('Biaya', 100);
          $table->string('KodeDi', 200);
          $table->string('NomorDaftarIsian', 200);
          $table->string('Luas', 200);
          $table->string('Uraian', 2000);
          $table->integer('Banyak');
          $table->integer('Jumlah');
          $table->integer('IDPersyaratan')->unsigned();
          $table->foreign('IDPersyaratan')->references('ID')->on('Persyaratan');
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
      Schema::drop('DetailSPS');
    }
}
