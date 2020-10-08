<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangCatatStokOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BarangCatatStokOpnames', function (Blueprint $table) {
            $table->primary(['StokOpnameID', 'BarangID']);
            $table->integer('StokOpnameID')->unsigned();
            $table->foreign('StokOpnameID')->references('IDStokOpname')->on('StokOpnames');
            $table->integer('BarangID')->unsigned();
            $table->foreign('BarangID')->references('IDBarang')->on('Barangs');
            $table->integer('JumlahSelisih');
            $table->string('Alasan', 45);
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
        Schema::dropIfExists('BarangCatatStokOpnames');
    }
}
