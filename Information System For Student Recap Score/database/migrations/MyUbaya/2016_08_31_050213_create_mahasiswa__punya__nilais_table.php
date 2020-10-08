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
        Schema::create('baak_NilaiMahasiswa', function (Blueprint $table) {
            $table->char('KodeNilai', 21);
            $table->foreign('KodeNilai')
                ->references('KodeNilai')->on('baak_Nilai')
                ->onDelete('cascade');
            
            $table->string('NRP', 12); 

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
        Schema::drop('baak_NilaiMahasiswa');
    }
}
