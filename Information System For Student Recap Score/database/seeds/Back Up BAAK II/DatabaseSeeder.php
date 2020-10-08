<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call('SemesterAktifTableSeeder');

        //$this->call('UserTableSeeder');
        //$this->call('KaryawanTableSeeder');
        //$this->call('MahasiswaTableSeeder');

        //$this->call('MataKuliahTableSeeder');
        //$this->call('MataKuliahBukaTableSeeder');

        //$this->call('DosenAjarMkTableSeeder');
        //$this->call('MhsAmbilMkTableSeeder');

        //$this->call('NilaiTableSeeder');
        //$this->call('NilaiMahasiswaTableSeeder');
        //$this->call('NilaiPerubahanTableSeeder');

        //$this->call('BeritaAcaraTableSeeder');
        $this->call('BeritaAcaraMhsTableSeeder');

        Model::reguard();
    }
}
