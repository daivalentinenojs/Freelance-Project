<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKesimpulanStatusTanahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('KesimpulanStatusTanah', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('Nama', 200);
          $table->string('Uraian', 500);
          $table->integer('Jenis'); // 1 : Hak Milik 2 : Hak Guna Bangunan 3 : Hak Pakai
          $table->integer('Usulan'); // 1 : Dapat Diusulkan 2 : Tidak Dapat Diusulkan
          $table->string('NamaPenempat', 200);
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
        Schema::drop('KesimpulanStatusTanah');
    }
}
