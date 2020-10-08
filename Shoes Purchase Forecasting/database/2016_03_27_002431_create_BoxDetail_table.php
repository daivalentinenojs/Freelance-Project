<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BoxDetail', function (Blueprint $table) {
      $table->increments('ID');
      $table->string('Boxsize');
      $table->integer('Jumlah');
      $table->tinyInteger('isDelete');
      $table->timestamps();

      $table->integer('SizeID')->unsigned();
            $table->foreign('SizeID')->references('ID')
            ->on('SizeSepatu')->onDelete('cascade');
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
