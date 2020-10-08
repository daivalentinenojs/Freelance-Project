<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemesterAktifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SemesterAktif', function (Blueprint $table) {
            $table->char('ThnAkademik', 4);

            $table->enum('Semester', array('Gasal', 'Genap', 'Pendek', 'Trimester3'));
            $table->primary(['ThnAkademik','Semester']);

            $table->enum('GenerateBayar', array('Y', 'N'));
            
            $table->date('TglAwalKuliah');
            $table->date('TglAkhirKuliah');
            $table->date('TglAwalLulus');
            $table->date('TglAkhirLulus');
            $table->date('TglPembagianKHS');

            $table->enum('SudahProsesTilang', array('Y', 'N'));
            
            $table->date('BatasInputNTS');
            $table->date('BatasInputNAS');

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
        Schema::drop('SemesterAktif');
    }
}
