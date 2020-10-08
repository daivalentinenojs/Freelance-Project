<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepalaDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('KepalaDesa', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('Nama', 250);
          $table->integer('IDDesa')->unsigned();
          $table->foreign('IDDesa')->references('ID')->on('Desa');
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
        Schema::drop('KepalaDesa');
    }
}
