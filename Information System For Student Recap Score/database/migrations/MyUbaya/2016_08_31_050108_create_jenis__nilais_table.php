<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baak_Nilai', function (Blueprint $table) {
            $table->char('KodeNilai', 21);
            $table->primary('KodeNilai');

            $table->string('KodeMkBuka', 15);
            $table->string('KP', 2);
            $table->enum('Jenis', array('NTS', 'NAS'));   
            $table->date('WaktuBuat');
            $table->date('WaktuValidasiDosen');
            $table->date('WaktuValidasiAdmik');
            $table->char('DosenPembuat', 10);

            $table->char('AdmikValidator', 10);        
            $table->enum('Status', array('Daftar', 'ValidDosen', 'ValidAdmik', 'Invalid'));
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
        Schema::drop('baak_Nilai');
    }
}
