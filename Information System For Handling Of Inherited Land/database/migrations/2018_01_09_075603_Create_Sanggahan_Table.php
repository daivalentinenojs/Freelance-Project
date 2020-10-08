<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanggahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BuktiSanggahan', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->string('NamaPenyanggah', 200);
          $table->string('AlamatPenyanggah', 500);
          $table->string('AlasanPenyanggah', 2000);
          $table->integer('Status'); // 1 : Ada 2 : Tidak Ada
          $table->integer('HakTanah'); // 1 : Ditegaskan 2 : Diakui
          $table->string('NamaSengketa', 200);
          $table->string('Solusi', 2000);
          $table->string('File', 50);
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
        Schema::drop('BuktiSanggahan');
    }
}
