<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Barang', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nama', 50);
            $table->string('Keterangan', 300);
            $table->integer('Stok');
            $table->integer('Berat');
            $table->integer('HargaBeli');
            $table->integer('HargaJual');
            $table->integer('HargaJualPromo');
            $table->integer('IDSubKategori')->unsigned();
            $table->foreign('IDSubKategori')->references('ID')->on('SubKategori');
            $table->integer('IDMerk')->unsigned();
            $table->foreign('IDMerk')->references('ID')->on('Merk');
            $table->integer('IDStatusBarang')->unsigned();
            $table->foreign('IDStatusBarang')->references('ID')->on('StatusBarang');
            $table->integer('IsPromo');
            $table->integer('IsActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Barang');
    }
}
