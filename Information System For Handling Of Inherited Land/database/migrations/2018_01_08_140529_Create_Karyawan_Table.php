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
          $table->string('NIK', 20);
          $table->string('Nama', 250);
          $table->string('Telepon', 20);
          $table->string('Alamat', 250);
          $table->integer('Jabatan'); // 1 : Penerima Setoran PNBP 2 : Kepala Sub Bagian TU 3 : Kepala Seksi Hak Tanah dan Pendaftaran Tanah
                                      // 4 : Kepala Seksi Pengukuran dan Pemetaan 5 : Petugas Pengumpul Data Yuridis 6 : Kepala Seksi Hub Hukum Pertanahan
          $table->integer('IDUser')->unsigned();
          $table->foreign('IDUser')->references('id')->on('users');
          $table->integer('IDDaerah')->unsigned();
          $table->foreign('IDDaerah')->references('ID')->on('Daerah');
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
