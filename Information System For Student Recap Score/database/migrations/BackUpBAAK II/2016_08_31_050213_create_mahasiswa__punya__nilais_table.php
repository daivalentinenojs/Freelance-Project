<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaPunyaNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NilaiMahasiswa', function (Blueprint $table) {
            $table->char('KodeNilai', 21);
            $table->foreign('KodeNilai')
                ->references('KodeNilai')->on('Nilai')
                ->onDelete('cascade');
            
            $table->string('NRP', 12); 
            $table->foreign('NRP')
                ->references('NRP')->on('Mahasiswa')
                ->onDelete('cascade');

            $table->smallInteger('Nilai');
            $table->string('KodeNisbi', 2);

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
        Schema::drop('NilaiMahasiswa');
    }
}
