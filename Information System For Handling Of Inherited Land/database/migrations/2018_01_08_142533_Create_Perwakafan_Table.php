<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerwakafanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Perwakafan', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('Tanggal');
          $table->string('NamaPPAW', 200);
          $table->integer('AktaPengganti'); // 1 : Akta Pengganti 2 : Ikrar Wakaf
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
        Schema::drop('Perwakafan');
    }
}
