<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BerkasPermohonan', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('TanggalBerkasMasuk');
          $table->datetime('TanggalBerkasValid');
          $table->string('NIB', 500);
          $table->string('Disposisi', 500);
          $table->integer('NomorSuratPengantar')->unsigned();
          $table->foreign('NomorSuratPengantar')->references('Nomor')->on('SuratPengantar');
          $table->integer('NomorBerkasPengumuman')->unsigned();
          $table->foreign('NomorBerkasPengumuman')->references('NomorFisik')->on('BerkasPengumuman');
          $table->integer('IDKaryawan')->unsigned();
          $table->foreign('IDKaryawan')->references('ID')->on('Karyawan');
          $table->integer('IDJadwalUkur')->unsigned();
          $table->foreign('IDJadwalUkur')->references('ID')->on('JadwalUkur');
          $table->integer('NomorGambarUkur')->unsigned();
          $table->foreign('NomorGambarUkur')->references('Nomor')->on('GambarUkur');
          $table->integer('IDPembayaran')->unsigned();
          $table->foreign('IDPembayaran')->references('ID')->on('Pembayaran');
          $table->integer('IDPersyaratan')->unsigned();
          $table->foreign('IDPersyaratan')->references('ID')->on('Persyaratan');
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
        Schema::drop('BerkasPermohonan');
    }
}
