<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangCatatNotaJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BarangCatatNotaJuals', function (Blueprint $table) {
            $table->primary(['NotaJualID', 'BarangID']);
            $table->integer('NotaJualID')->unsigned();
            $table->foreign('NotaJualID')->references('IDNotaJual')->on('NotaJuals');
            $table->integer('BarangID')->unsigned();
            $table->foreign('BarangID')->references('IDBarang')->on('Barangs');
            $table->integer('Kuantiti');
            $table->integer('HargaJual');
            $table->integer('SubTotal');
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
        Schema::drop('BarangCatatNotaJuals');
    }
}
