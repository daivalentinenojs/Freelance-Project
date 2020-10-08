<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Barangs', function (Blueprint $table) {
            $table->increments('IDBarang');
            $table->string('Nama', 45);
            $table->string('Tahun', 4);
            $table->integer('Stok');
            $table->integer('HargaBeli');
            $table->integer('HargaJual');
            $table->integer('StatusTerdaftar');
            $table->integer('KategoriID')->unsigned();
            $table->foreign('KategoriID')->references('IDKategori')->on('Kategoris');
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
        Schema::drop('Barangs');
    }
}
