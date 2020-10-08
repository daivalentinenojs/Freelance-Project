<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTanahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('StatusTanah', function (Blueprint $table) {
          $table->increments('ID');
          $table->integer('Nama'); // 1 : Tanah Dengan Hak Adat Perorangan 2 : Tanah Bagi Kepentingan Umum 3 : Lain-Lain
          $table->string('KeteranganNama', 1000);
          $table->string('Uraian', 1000);
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
        Schema::drop('StatusTanah');
    }
}
