<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Karyawans', function (Blueprint $table) {
            $table->increments('IDKaryawan');
            $table->string('Nama', 45);
            $table->string('Alamat', 45);
            $table->string('Email', 45);
            $table->string('Password',100);
            $table->string('NoTelepon',45);
            $table->integer('StatusTerdaftar');
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
        Schema::drop('Karyawans');
    }
}
