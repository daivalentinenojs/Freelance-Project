<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductxcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductXCategory', function (Blueprint $table) {
            $table->increments('IDProductXCategory');
            $table->integer('IDProduct')->unsigned();
            $table->foreign('IDProduct')->references('ID')->on('Product');
            $table->integer('IDCategory')->unsigned();
            $table->foreign('IDCategory')->references('ID')->on('Category');
            $table->integer('IsActive');
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
        Schema::drop('ProductXCategory');
    }
}
