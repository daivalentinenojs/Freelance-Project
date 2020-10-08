<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returBelis', function (Blueprint $table) {
            $table->increments('IDReturBeli');
            $table->string('NoNotaBeli', 45);
            $table->date('Tanggal');
            $table->integer('Total');
            $table->integer('SubTotal');
            $table->integer('StatusTerdaftar');
            $table->integer('KaryawanID')->unsigned();
            $table->foreign('KaryawanID')->references('IDKaryawan')->on('Karyawans');
            $table->integer('NotaBeliID')->unsigned();
            $table->foreign('NotaBeliID')->references('IDNotaBeli')->on('NotaBelis');
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
        Schema::dropIfExists('returBelis');
    }
}
