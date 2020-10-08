<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangCatatReturJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BarangCatatReturJuals', function (Blueprint $table) {
            $table->primary(['ReturJualID', 'BarangID']);
            $table->integer('ReturJualID')->unsigned();
            $table->foreign('ReturJualID')->references('IDReturJual')->on('ReturJuals');
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
        Schema::dropIfExists('BarangCatatReturJuals');
    }
}
