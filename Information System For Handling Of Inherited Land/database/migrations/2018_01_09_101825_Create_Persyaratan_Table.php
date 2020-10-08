<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersyaratanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Persyaratan', function (Blueprint $table) {
          $table->increments('ID');
          $table->string('NamaTerima', 200);
          $table->string('Nama', 200);
          $table->string('KelasLetterC', 200);
          $table->string('PersilNoLetterC', 200);
          $table->string('LuasDaerahLetterC', 200);
          $table->string('LuasTanahLetterC', 200);
          $table->string('JenisTanahLetterC', 200);
          $table->integer('StatusLetterC'); // 1 : Ditolak 2 : Dapat Dikabulkan 3 : Diproses
          $table->integer('StatusTanah'); // 1 : Hak Milik 2 : Hak Guna Bangunan 3 : Hak Pakai
          $table->string('File', 2000);
          $table->string('NomorDi', 200);
          $table->string('Terbilang', 1000);
          $table->string('NomorBukuHurufC', 200);
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
        Schema::drop('Persyaratan');
    }
}
