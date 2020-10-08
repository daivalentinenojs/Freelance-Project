<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsepatuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSepatu', function (Blueprint $table) {
         $table->increments('ID');
         $table->integer('Stok');
         $table->integer('HargaBeliTerakhir');
         $table->integer('HargaJual');
         $table->tinyInteger('isDelete');
         $table->string('Keterangan');
         $table->tinyInteger('StatusBox');
         $table->timestamps();

         $table->integer('WarnaID')->unsigned();
         $table->foreign('WarnaID')->references('ID')
         ->on('Warna')->onDelete('cascade');

         $table->integer('TipeID')->unsigned();
         $table->foreign('TipeID')->references('ID')
         ->on('Tipe')->onDelete('cascade');

         $table->integer('SizeorBoxID')->unsigned();
         $table->foreign('SizeorBoxID')->references('ID')
         ->on('SizeorBox')->onDelete('cascade');

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
