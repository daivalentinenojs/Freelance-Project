<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Karyawan', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nama', 50);
            $table->string('Alamat', 50);
            $table->string('Kota', 30);
            $table->string('Telepon', 15);
            $table->string('Handphone', 20);
            $table->integer('IDUser')->unsigned();
            $table->foreign('IDUser')->references('ID')->on('User');
            $table->integer('IDJabatan')->unsigned();
            $table->foreign('IDJabatan')->references('ID')->on('Jabatan');
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
        Schema::drop('Karyawan');
    }
}
