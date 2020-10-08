<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaJualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NotaJual', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nomor', 30);
            $table->datetime('TanggalBuat');
            $table->integer('TotalBarang');
            $table->integer('BiayaKirim');
            $table->integer('TotalAkhir');

            $table->string('NamaPenerima', 50);
            $table->string('AlamatPenerima', 100);
            $table->string('IDKota', 30);
            // $table->integer('IDKota')->unsigned();
            // $table->foreign('IDKota')->references('ID')->on('Kota');
            $table->string('TeleponPenerima', 15);
            $table->string('HandphonePenerima', 20);

            $table->string('NomorRekening', 50);
            $table->string('NamaPemilikRekening', 100);

            $table->datetime('TanggalTransfer');
            $table->datetime('TanggalKirim');
            $table->datetime('TanggalTerima');

            $table->string('NamaDropshipper', 100);
            $table->string('TeleponDropshipper', 100);
            $table->string('HandphoneDropshipper', 100);

            $table->integer('IDBank')->unsigned();
            $table->foreign('IDBank')->references('ID')->on('Bank');
            $table->integer('IDStatusNotaJual')->unsigned();
            $table->foreign('IDStatusNotaJual')->references('ID')->on('StatusNotaJual');
            $table->integer('IDPembeli')->unsigned();
            $table->foreign('IDPembeli')->references('ID')->on('Pembeli');
            $table->integer('IDKaryawan')->unsigned();
            $table->foreign('IDKaryawan')->references('ID')->on('Karyawan');
            $table->integer('IsDropship');
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
        Schema::drop('NotaJual');
    }
}
