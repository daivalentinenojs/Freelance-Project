<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Customer', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('NamaPemilik', 50);
          $table->string('NamaToko', 50);
          $table->string('Alamat');
          $table->string('Telepon', 15);
          $table->tinyInteger('isDelete');
          $table->rememberToken();
          $table->timestamps();

          $table->integer('UserID')->unsigned();
          $table->foreign('UserID')->references('IDUser')
          ->on('User')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
