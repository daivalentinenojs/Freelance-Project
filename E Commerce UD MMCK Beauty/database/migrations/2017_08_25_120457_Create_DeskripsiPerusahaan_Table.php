<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeskripsiPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DeskripsiPerusahaan', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nama', 30);
            $table->string('Keterangan', 800);
            $table->string('Alamat', 50);
            $table->string('Kota', 30);
            $table->string('Negara', 50);
            $table->string('Telepon', 15);
            $table->string('Handphone', 20);
            $table->string('Email', 100);
            $table->integer('BatasStock');
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
        Schema::drop('DeskripsiPerusahaan');
    }
}
