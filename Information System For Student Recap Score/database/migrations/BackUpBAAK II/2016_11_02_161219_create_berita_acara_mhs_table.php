<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeritaAcaraMhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BeritaAcaraMhs', function (Blueprint $table) {
            $table->string('NRP', 12);
            $table->foreign('NRP')
                ->references('NRP')->on('Mahasiswa')
                ->onDelete('cascade');
            
            $table->bigInteger('IdBeritaAcara', 20);
            $table->foreign('IdBeritaAcara')
                ->references('IdBeritaAcara')->on('BeritaAcara')
                ->onDelete('cascade');            

            $table->enum('Jenis', array('Tidak Hadir', 'Izin'));
            $table->string('NoSuratIzin', 100);
            $table->date('TglSuratIzin');
               
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
        Schema::drop('BeritaAcaraMhs');
    }
}
