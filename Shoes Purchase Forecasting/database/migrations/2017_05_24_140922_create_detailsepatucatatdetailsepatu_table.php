<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsepatucatatdetailsepatuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSepatuCatatDetailSepatu', function (Blueprint $table) {
        $table->integer('BoxID')->unsigned();
        $table->foreign('BoxID')->references('ID')
        ->on('DetailSepatu')->onDelete('cascade');

        $table->integer('SizeID')->unsigned();
        $table->foreign('SizeID')->references('ID')
        ->on('DetailSepatu')->onDelete('cascade');

        $table->integer('Jumlah');
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
