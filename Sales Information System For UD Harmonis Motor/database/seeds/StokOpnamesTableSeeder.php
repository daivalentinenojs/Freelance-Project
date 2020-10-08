<?php

use Illuminate\Database\Seeder;

class StokOpnamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $StokOpnames = array(['NoNotaStokOpname'=>'20170101001', 'Tanggal'=>'2017-01-01', 
                              'StatusTerdaftar'=>1, 'KaryawanID'=>1],
                             ['NoNotaStokOpname'=>'20160101002', 'Tanggal'=>'2016-01-01', 
                              'StatusTerdaftar'=>1, 'KaryawanID'=>1]);
		DB::table('StokOpnames')->insert($StokOpnames);
    }
}
