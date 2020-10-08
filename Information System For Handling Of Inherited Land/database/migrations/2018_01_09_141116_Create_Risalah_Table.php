<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRisalahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Risalah', function (Blueprint $table) {
          $table->increments('Nomor');
          $table->datetime('Tanggal');
          $table->integer('StatusSengketa'); // 1 : Sedang Dalam Sengketa 2 : Tidak Ada Sengketa
          $table->string('KeteranganSengketa', 500);
          $table->string('BebanAtasTanah', 500);
          $table->integer('StatusAlatBukti'); // 1 : Lengkap 2 : Tidak Lengkap 3 : Tidak Ada
          $table->integer('StatusPembebanan'); // 1 : Sedang Digunakan 2 : Tidak Digunakan
          $table->string('BangunanKepentingan', 500);
          $table->integer('StatusTanah'); // 1 : Tanah Milik 2 : Tanah Negara
          $table->integer('StatusBagunanAtasTanah'); // 1 : Rumah Hunian 2 : Toko 3 : Gudang 4 : Pagar 5 : Kantor 6 : Rumah Ibadah 7 : Bengkel 8 : Lain 9 : Tidak Ada
          $table->string('KeteranganBangunanAtasTanah', 500);
          $table->integer('IDKepalaDesa')->unsigned();
          $table->foreign('IDKepalaDesa')->references('ID')->on('KepalaDesa');
          $table->integer('IDKenyataan')->unsigned();
          $table->foreign('IDKenyataan')->references('ID')->on('Kenyataan');
          $table->integer('NomorBuktiPemilikan')->unsigned();
          $table->foreign('NomorBuktiPemilikan')->references('Nomor')->on('BuktiPemilikan');
          $table->integer('IDKesimpulanStatusTanah')->unsigned();
          $table->foreign('IDKesimpulanStatusTanah')->references('ID')->on('KesimpulanStatusTanah');
          $table->integer('NomorBuktiSanggahan')->unsigned();
          $table->foreign('NomorBuktiSanggahan')->references('Nomor')->on('BuktiSanggahan');
          $table->integer('NomorBuktiPerpajakan')->unsigned();
          $table->foreign('NomorBuktiPerpajakan')->references('Nomor')->on('BuktiPerpajakan');
          $table->integer('IDStatusTanah')->unsigned();
          $table->foreign('IDStatusTanah')->references('ID')->on('StatusTanah');
          $table->integer('IDFormulirPermohonan')->unsigned();
          $table->foreign('IDFormulirPermohonan')->references('ID')->on('FormulirPermohonan');
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
        Schema::drop('Risalah');
    }
}
