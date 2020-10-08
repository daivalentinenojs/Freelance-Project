
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NotaJuals', function (Blueprint $table) {
            $table->increments('IDNotaJual');
            $table->string('NoNotaJual', 45);
            $table->date('TanggalBuat');
            $table->date('TanggalBayar');
            $table->integer('Total');
            $table->enum('StatusJual', array('Sudah Lunas', 'Belum Lunas'));
            $table->integer('StatusTerdaftar');
            $table->integer('KaryawanID')->unsigned();
            $table->foreign('KaryawanID')->references('IDKaryawan')->on('Karyawans');
            $table->integer('PembeliID')->unsigned();
            $table->foreign('PembeliID')->references('IDPembeli')->on('Pembelis');
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
        Schema::drop('NotaJuals');
    }
}
