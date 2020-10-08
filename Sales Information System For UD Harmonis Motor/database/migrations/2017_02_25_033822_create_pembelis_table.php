<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pembelis', function (Blueprint $table) {
            $table->increments('IDPembeli');            
            $table->string('Nama', 45);
            $table->string('NoTelepon', 45);
            $table->string('Kota', 45);
            $table->string('Bank', 45);
            $table->integer('StatusLangganan');
            $table->integer('StatusJual');
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
        Schema::drop('Pembelis');
    }
}
