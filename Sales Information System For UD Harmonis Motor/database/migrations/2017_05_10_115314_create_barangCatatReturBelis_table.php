<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangCatatReturBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BarangCatatReturBelis', function (Blueprint $table) {
            $table->primary(['ReturBeliID', 'BarangID']);
            $table->integer('ReturBeliID')->unsigned();
            $table->foreign('ReturBeliID')->references('IDReturBeli')->on('ReturBelis');
            $table->integer('BarangID')->unsigned();
            $table->foreign('BarangID')->references('IDBarang')->on('Barangs');
            $table->integer('KuantitiBarangAsal');
            $table->integer('KuantitiBarangGanti');
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
        Schema::dropIfExists('BarangCatatReturBelis');
    }
}
