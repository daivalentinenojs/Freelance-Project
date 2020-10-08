<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasPengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BerkasPengumuman', function (Blueprint $table) {
          $table->increments('NomorFisik');
          $table->integer('NomorBidang');
          $table->datetime('Tanggal');
          $table->string('Sanggahan', 1000);
          $table->string('Keterangan', 1000);
          $table->string('File', 50);
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
        Schema::drop('BerkasPengumuman');
    }
}
