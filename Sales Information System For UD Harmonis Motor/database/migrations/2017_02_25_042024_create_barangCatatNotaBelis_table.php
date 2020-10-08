<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangCatatNotaBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BarangCatatNotaBelis', function (Blueprint $table) {
            $table->primary(['NotaBeliID', 'BarangID']);
            $table->integer('NotaBeliID')->unsigned();
            $table->foreign('NotaBeliID')->references('IDNotaBeli')->on('NotaBelis');
            $table->integer('BarangID')->unsigned();
            $table->foreign('BarangID')->references('IDBarang')->on('Barangs');
            $table->integer('Kuantiti');
            $table->integer('HargaBeli');
            $table->integer('SubTotal');
            $table->integer('PerubahanJumlahBarang');
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
        Schema::drop('BarangCatatNotaBelis');
    }
}
