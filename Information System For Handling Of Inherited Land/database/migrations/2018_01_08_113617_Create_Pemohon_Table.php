<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemohonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Pemohon', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('NIK', 20);
          $table->string('Nama', 250);
          $table->string('Telepon', 20);
          $table->string('Alamat', 250);
          $table->string('Pekerjaan', 250);
          $table->integer('Umur');
          $table->integer('IDUser')->unsigned();
          $table->foreign('IDUser')->references('id')->on('users');
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
        Schema::drop('Pemohon');
    }
}
