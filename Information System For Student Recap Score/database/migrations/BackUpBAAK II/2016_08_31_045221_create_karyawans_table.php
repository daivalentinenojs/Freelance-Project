<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Karyawan', function (Blueprint $table) {
            $table->char('NPK', 10);
            $table->primary('NPK');
            
            $table->string('Nama', 40);
           
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
        Schema::drop('Karyawan');
    }
}
