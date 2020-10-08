<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFPXPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('FPXP', function (Blueprint $table) {
        $table->increments('ID');
        $table->integer('IDPersyaratan')->unsigned();
        $table->foreign('IDPersyaratan')->references('ID')->on('Persyaratan');
        $table->integer('IDFormulirPermohonan')->unsigned();
        $table->foreign('IDFormulirPermohonan')->references('ID')->on('FormulirPermohonan');
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
        Schema::drop('FPXP');
    }
}
