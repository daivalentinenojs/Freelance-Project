<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulirPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('FormulirPermohonan', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('NamaKuasa', 250);
          $table->string('AlamatKuasa', 500);
          $table->string('AlamatTanah', 500);
          $table->integer('Status'); // 1 : Pengajuan 2 : Validasi Pengajuan 3 : Telah Dibayar 4 : Validasi Pembayaran
          $table->string('File', 50);
          $table->integer('IDPemohon')->unsigned();
          $table->foreign('IDPemohon')->references('ID')->on('Pemohon');
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
        Schema::drop('FormulirPermohonan');
    }
}
