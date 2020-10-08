<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerekCatatBoxDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('MerekCatatBoxDetail', function (Blueprint $table) {
          $table->increments('ID');
          $table->timestamps();

          $table->integer('MerekSepatuID')->unsigned();
          $table->foreign('MerekSepatuID')->references('ID')
          ->on('MerekSepatu')->onDelete('cascade');

          $table->integer('BoxDetailID')->unsigned();
          $table->foreign('BoxDetailID')->references('ID')
          ->on('BoxDetail')->onDelete('cascade');

          $table->tinyInteger('isDelete');
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
