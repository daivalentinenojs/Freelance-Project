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
        Schema::create('Nilai', function (Blueprint $table) {
            $table->char('KodeNilai', 21);
            $table->primary('KodeNilai');

            $table->string('KodeMkBuka', 15);
            $table->string('KP', 2);
            $table->enum('Jenis', array('QuizUTS', 'QuizUAS', 'TugasUTS', 'TugasUAS', 'ProyekUTS', 'ProyekUAS', 'KeaktifanUTS’', 'KeaktifanUAS’', 'UTS', 'UAS'));   
            
            $table->double('Bobot', 6,3);
            $table->date('WaktuBuat');
            $table->date('WaktuValidasiDosen');
            $table->date('WaktuValidasiAdmik');
            $table->char('DosenPembuat', 10);

            $table->char('AdmikValidator', 10);        
            $table->enum('Status', array('BelumInput', 'Daftar', 'TelahDiKalkulasi', 'SiapUpload', 'TelahDiUpload'));
            $table->smallInteger('Syarat');
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
        Schema::drop('Nilai');
    }
}
