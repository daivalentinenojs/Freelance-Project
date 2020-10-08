<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuktiPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('BuktiPembelian', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('Tanggal');
          $table->string('NamaPenjual', 200);
          $table->string('NoAktaPPAT', 500);
          $table->string('File', 50);
          $table->integer('Jenis'); // 1 : Surat Di Bawah Tangan 2 : Kwitansi 3 : Akta PPAT 4 : Lisan
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
        Schema::drop('BuktiPembelian');
    }
}
