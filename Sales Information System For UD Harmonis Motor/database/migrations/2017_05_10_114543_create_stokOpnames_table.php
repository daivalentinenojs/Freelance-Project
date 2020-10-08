<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stokOpnames', function (Blueprint $table) {
            $table->increments('IDStokOpname');
            $table->string('NoNotaStokOpname', 45);
            $table->date('Tanggal');
            $table->integer('StatusTerdaftar');
            $table->integer('KaryawanID')->unsigned();
            $table->foreign('KaryawanID')->references('IDKaryawan')->on('Karyawans');
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
        Schema::dropIfExists('stokOpnames');
    }
}
