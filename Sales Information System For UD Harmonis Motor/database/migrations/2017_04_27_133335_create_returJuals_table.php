<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returJuals', function (Blueprint $table) {
            $table->increments('IDReturJual');
            $table->string('NoNotaJual', 45);
            $table->date('Tanggal');
            $table->integer('Total');
            $table->integer('SubTotal');
            $table->integer('StatusTerdaftar');
            $table->integer('KaryawanID')->unsigned();
            $table->foreign('KaryawanID')->references('IDKaryawan')->on('Karyawans');
            $table->integer('NotaJualID')->unsigned();
            $table->foreign('NotaJualID')->references('IDNotaJual')->on('NotaJuals');
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
        Schema::dropIfExists('returJuals');
    }
}
