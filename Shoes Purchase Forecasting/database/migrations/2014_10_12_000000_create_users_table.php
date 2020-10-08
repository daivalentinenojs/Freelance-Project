<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //di buat pertama
        Schema::create('User', function (Blueprint $table) {
            $table->increments('IDUser');
            $table->string('Nama', 50);
            $table->string('Email',30);
            $table->string('Password',60);
            $table->string('Alamat');
            $table->string('Telepon', 15);
            $table->date('TanggalMulaiKerja');
            $table->tinyInteger('isDelete');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('JabatanID')->unsigned();
            $table->foreign('JabatanID')->references('ID')
            ->on('Jabatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Users');
    }
}
