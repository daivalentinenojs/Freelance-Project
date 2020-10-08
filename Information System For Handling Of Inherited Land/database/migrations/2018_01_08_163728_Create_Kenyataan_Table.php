<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKenyataanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Kenyataan', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('KeteranganTahun', 500);
          $table->string('KeteranganCara', 500);
          $table->string('KeteranganAlih', 500);
          $table->integer('Jenis'); // 1 : Sawah 2 : Ladang 3 : Kebun 4 : Kolam Ikan 5 : Perumahan 6 : Industri 7 : Perkebunan 8 : Lapangan Umum
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
        Schema::drop('Kenyataan');
    }
}
