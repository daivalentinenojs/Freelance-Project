<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangXNotaJualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BarangXNotaJual', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('IDBarang')->unsigned();
            $table->foreign('IDBarang')->references('ID')->on('Barang');
            $table->integer('IDNotaJual')->unsigned();
            $table->foreign('IDNotaJual')->references('ID')->on('NotaJual');
            $table->integer('Jumlah');
            $table->integer('HargaReal');
            $table->integer('SubTotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('BarangXNotaJual');
    }
}
