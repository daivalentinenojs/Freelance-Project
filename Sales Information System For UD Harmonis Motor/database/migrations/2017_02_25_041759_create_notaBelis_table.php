<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NotaBelis', function (Blueprint $table) {
            $table->increments('IDNotaBeli');
            $table->string('NoNotaBeli', 45);
            $table->date('TanggalBuat');
            $table->date('JatuhTempo');
            $table->integer('Total');
            $table->enum('StatusBeli', array('Pesan', 'Dikirim', 'Lunas'));
            $table->integer('StatusTerdaftar');
            $table->integer('KaryawanID')->unsigned();
            $table->foreign('KaryawanID')->references('IDKaryawan')->on('Karyawans');
            $table->integer('PemasokID')->unsigned();
            $table->foreign('PemasokID')->references('IDPemasok')->on('Pemasoks');
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
        Schema::drop('NotaBelis');
    }
}
