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
            $table->bigInteger('VersiUbah');
            $table->primary('VersiUbah');

            $table->string('KodeMkBuka', 15);
            
            $table->string('KP', 2);
           
            $table->date('TglUbah');
            $table->string('NoSurat', 30);
            $table->date('TglSurat');

            $table->smallInteger('NilaiLama');
            $table->smallInteger('NilaiBaru');
            
            $table->char('KodeNilai', 21);
            $table->foreign('KodeNilai')
                ->references('KodeNilai')->on('Nilai')
                ->onDelete('cascade');
       
            $table->string('KodeNisbiLama', 2);
            $table->string('KodeNisbiBaru', 2);

            $table->text('Keterangan');

            $table->string('NRP', 12);

            $table->char('NPK', 10);

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
