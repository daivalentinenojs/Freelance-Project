<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pemasoks', function (Blueprint $table) {
            $table->increments('IDPemasok');
            $table->string('NoRekening', 45);
            $table->string('NamaRekening', 45);
            $table->string('Bank', 45);
            $table->string('Alamat', 45);
            $table->string('NoTelepon', 45);
            $table->integer('StatusBeli');
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
        Schema::drop('Pemasoks');
    }
}
