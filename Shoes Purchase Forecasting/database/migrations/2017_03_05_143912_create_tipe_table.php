<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tipe', function (Blueprint $table) {
      $table->increments('ID');
      $table->string('Nama', 40);
      $table->tinyInteger('isDelete');
      $table->timestamps();

      $table->integer('MerekSepatuID')->unsigned();
      $table->foreign('MerekSepatuID')->references('ID')
      ->on('MerekSepatu')->onDelete('cascade');
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
