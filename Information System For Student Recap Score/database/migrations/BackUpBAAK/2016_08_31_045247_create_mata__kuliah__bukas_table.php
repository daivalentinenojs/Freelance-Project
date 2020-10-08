<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMataKuliahBukasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MkBuka', function (Blueprint $table) {
            $table->string('KodeMkBuka', 15);
            $table->primary('KodeMkBuka');

            $table->string('KodeMk', 10);
            $table->foreign('KodeMk')
                ->references('KodeMk')->on('MataKuliah')
                ->onDelete('cascade');
            
            $table->char('ThnAkademik', 4);
            $table->foreign('ThnAkademik')
                ->references('ThnAkademik')->on('SemesterAktif')
                ->onDelete('cascade');
            
            $table->enum('Semester', array('Gasal', 'Genap', 'Pendek', 'Trimester3'));

            $table->char('NPK', 10);
            $table->foreign('NPK')
                ->references('NPK')->on('Karyawan')
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
        Schema::drop('MkBuka');
    }
}
