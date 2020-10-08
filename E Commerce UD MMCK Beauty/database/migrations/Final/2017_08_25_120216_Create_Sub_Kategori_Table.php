<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SubKategori', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nama', 50);
            $table->string('Keterangan', 100);
            $table->integer('IDKategori')->unsigned();
            $table->foreign('IDKategori')->references('ID')->on('Kategori');
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
        Schema::drop('SubKategori');
    }
}
