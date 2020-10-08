<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuktiWarisanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BuktiWarisan', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('Tanggal');
          $table->string('NamaPewaris', 200);
          $table->string('AlamatMeninggal', 200);
          $table->string('TahunMeninggal', 4);
          $table->integer('SuratWasiat'); // 1 : Ada 2 : Tidak Ada
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
        Schema::drop('BuktiWarisan');
    }
}
