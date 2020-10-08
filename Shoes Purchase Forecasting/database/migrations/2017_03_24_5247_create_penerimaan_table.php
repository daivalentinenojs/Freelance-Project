<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Penerimaan', function (Blueprint $table) {
         $table->increments('Nomor');
         $table->date('Tanggal');
         $table->integer('Total');
         $table->timestamps();

         $table->integer('NomorPesanPembelian')->unsigned();
         $table->foreign('NomorPesanPembelian')->references('Nomor')
         ->on('PesanPembelian')->onDelete('cascade');

         /*$table->integer('SupplierID')->unsigned();
         $table->foreign('SupplierID')->references('ID')
         ->on('Supplier')->onDelete('cascade');*/

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
