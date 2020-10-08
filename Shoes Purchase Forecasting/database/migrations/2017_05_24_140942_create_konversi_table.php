<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonversiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Konversi', function (Blueprint $table) {
        $table->increments('ID');
        $table->date('Tanggal');
        $table->integer('Kuantiti');

        $table->integer('DetailSepatuID')->unsigned();
        $table->foreign('DetailSepatuID')->references('ID')
        ->on('DetailSepatu')->onDelete('cascade');

        $table->integer('UserID')->unsigned();
        $table->foreign('UserID')->references('IDUser')
        ->on('User')->onDelete('cascade');
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
