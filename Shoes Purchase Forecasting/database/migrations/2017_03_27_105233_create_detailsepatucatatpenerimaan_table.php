<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsepatucatatpenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('DetailSepatuCatatPenerimaan', function (Blueprint $table) {
        $table->integer('DetailSepatuID')->unsigned();
        $table->foreign('DetailSepatuID')->references('ID')
        ->on('DetailSepatu')->onDelete('cascade');

        $table->integer('PenerimaanID')->unsigned();
        $table->foreign('PenerimaanID')->references('Nomor')
        ->on('Penerimaan')->onDelete('cascade');

        $table->Integer('Jumlah');
        $table->Integer('Harga');

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
        //
    }
}
