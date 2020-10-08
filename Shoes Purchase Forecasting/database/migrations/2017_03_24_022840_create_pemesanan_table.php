<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Pemesanan', function (Blueprint $table) {
         $table->increments('Nomor');
         $table->date('Tanggal');
         $table->integer('Total');
         $table->tinyInteger('Status');//belum / sudah
         $table->timestamps();

         $table->integer('CustomerID')->unsigned();
         $table->foreign('CustomerID')->references('ID')
         ->on('Customer')->onDelete('cascade');

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
