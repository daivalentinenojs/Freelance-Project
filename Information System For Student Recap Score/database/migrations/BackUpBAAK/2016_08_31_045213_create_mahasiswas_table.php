<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Mahasiswa', function (Blueprint $table) {
            $table->string('NRP', 12);
            $table->primary('NRP');
            
            $table->string('Nama', 40);
            $table->char('ThnAkademikTerima', 4);
            $table->enum('SemesterTerima', array('Gasal', 'Genap'));

            $table->integer('IdUser')->unsigned();
            $table->foreign('IdUser')
                ->references('id')->on('User')
                ->onDelete('cascade');

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
        Schema::drop('Mahasiswa');
    }
}
