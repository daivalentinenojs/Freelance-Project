<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeritaAcarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BeritaAcara', function (Blueprint $table) {
            $table->bigInteger('IdBeritaAcara', 20);

            $table->string('KodeMkBuka', 15);
            $table->foreign('KodeMkBuka')
                ->references('KodeMkBuka')->on('MkBuka')
                ->onDelete('cascade');
            
            $table->string('KP', 2);
            $table->string('KodeRuang', 10);
            
            $table->smallInteger('MhsTerdaftar');
            $table->smallInteger('MhsHadir');
            $table->smallInteger('MhsTilang');

            $table->enum('UtsUas', array('UTS', 'UAS'));
            $table->date('TglUjian');

            $table->enum('JamKe', array('1', '2', '3', '4', '5', '6', '7', '8', '9'));
            $table->smallInteger('JmlMenit');

            $table->enum('JenisSoal', array('Ganda', 'Esai', 'Kombinasi'));

            $table->text('KejadianPenting');
            $table->datetime('WaktuUpdate');
            $table->string('LastUpdater', 20);
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
        Schema::drop('BeritaAcara');
    }
}
