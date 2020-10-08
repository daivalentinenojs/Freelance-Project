<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Penjualan', function (Blueprint $table) {
         $table->increments('Nomor');
         $table->date('Tanggal');
         $table->integer('Total');
         $table->timestamps();

         $table->integer('NomorPemesanan')->unsigned();
         $table->foreign('NomorPemesanan')->references('Nomor')
         ->on('Pemesanan')->onDelete('cascade');

         /*$table->integer('CustomerID')->unsigned();
         $table->foreign('CustomerID')->references('ID')
         ->on('Customer')->onDelete('cascade');*/

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
