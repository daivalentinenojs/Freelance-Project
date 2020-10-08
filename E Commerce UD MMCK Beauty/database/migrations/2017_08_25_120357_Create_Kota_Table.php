<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Kota', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nama', 50);
            $table->integer('IDProvinsi')->unsigned();
            $table->foreign('IDProvinsi')->references('ID')->on('Provinsi');
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
        Schema::drop('Kota');
    }
}
