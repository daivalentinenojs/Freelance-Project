<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuktiPerpajakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BuktiPerpajakan', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('Tanggal');
          $table->string('UraianPatokD', 2000);
          $table->string('UraianVerponding', 2000);
          $table->string('UraianIPEDA', 2000);
          $table->string('UraianLain', 2000);
          $table->string('Tahun', 4);
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
        Schema::drop('BuktiPerpajakan');
    }
}
