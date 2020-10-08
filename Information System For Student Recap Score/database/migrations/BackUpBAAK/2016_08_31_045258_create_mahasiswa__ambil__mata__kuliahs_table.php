<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaAmbilMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MhsAmbilMk', function (Blueprint $table) {
            $table->string('NRP', 12);
            $table->foreign('NRP')
                ->references('NRP')->on('Mahasiswa')
                ->onDelete('cascade');
            
            $table->string('KodeMkBuka', 15);
            $table->foreign('KodeMkBuka')
                ->references('KodeMkBuka')->on('MkBuka')
                ->onDelete('cascade');            
            
            $table->string('KP', 2);
            
            $table->smallInteger('NTS');
            $table->smallInteger('NAS');
            $table->double('NA', 6, 3);

            $table->string('KodeNisbi', 2);

            $table->enum('HadirUTS', array('Y', 'N'));
            $table->enum('HadirUAS', array('Y', 'N'));
            $table->enum('StatusTilangPresensi', array('Y', 'N'));
            $table->enum('PesertaUTS', array('Y', 'N'));
            $table->enum('PesertaUAS', array('Y', 'N'));
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
        Schema::drop('MhsAmbilMk');
    }
}
