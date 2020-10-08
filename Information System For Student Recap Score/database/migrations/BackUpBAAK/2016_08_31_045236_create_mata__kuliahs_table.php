<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MataKuliah', function (Blueprint $table) {
            $table->string('KodeMk', 10);
            $table->primary('KodeMk');
         
            $table->string('Nama', 40);
            $table->string('NamaEng', 40);
            $table->smallInteger('Sks');

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
        Schema::drop('MataKuliah');
    }
}
