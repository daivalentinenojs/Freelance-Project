<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosenAjarMksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DosenAjarMk', function (Blueprint $table) {
            $table->char('NPK', 10);
            $table->foreign('NPK')
                ->references('NPK')->on('Karyawan')
                ->onDelete('cascade');
            
            $table->string('KodeMkBuka', 15);
            $table->foreign('KodeMkBuka')
                ->references('KodeMkBuka')->on('MkBuka')
                ->onDelete('cascade');            
            
            $table->string('KP', 2);

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
        Schema::drop('DosenAjarMk');
    }
}
