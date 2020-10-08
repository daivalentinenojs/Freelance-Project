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

        //$this->call('SemesterAktifTableSeeder'); v

        //$this->call('UserTableSeeder'); v
        //$this->call('KaryawanTableSeeder'); v
        //$this->call('MahasiswaTableSeeder'); v

        //$this->call('MataKuliahTableSeeder'); v
        //$this->call('MataKuliahBukaTableSeeder'); v

        //$this->call('DosenAjarMkTableSeeder'); v
        //$this->call('MhsAmbilMkTableSeeder');

        //$this->call('NilaiTableSeeder');
        //$this->call('NilaiMahasiswaTableSeeder');
        //$this->call('NilaiPerubahanTableSeeder');

        //$this->call('BeritaAcaraTableSeeder'); v
        //$this->call('BeritaAcaraMhsTableSeeder'); v

        Model::reguard();
    }
}
