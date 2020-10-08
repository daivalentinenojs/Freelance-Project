<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiPerubahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NilaiPerubahan', function (Blueprint $table) {
            $table->smallInteger('VersiUbah');
            $table->primary('VersiUbah');

            $table->string('KodeMkBuka', 15);
            $table->foreign('KodeMkBuka')
                ->references('KodeMkBuka')->on('MkBuka')
                ->onDelete('cascade');
            
            $table->string('KP', 2);
           
            $table->date('TglUbah');
            $table->string('NoSurat', 30);
            $table->date('TglSurat');

            $table->smallInteger('NTSLama');
            $table->smallInteger('NASLama');
            $table->string('NisbiLama', 2);

            $table->smallInteger('NTSBaru');
            $table->smallInteger('NASBaru');        
            $table->string('KodeNisbiBaru', 2);

            $table->text('Keterangan');

            $table->string('NRP', 12);
            $table->foreign('NRP')
                ->references('NRP')->on('Mahasiswa')
                ->onDelete('cascade');

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
        Schema::drop('NilaiPerubahan');
    }
}
