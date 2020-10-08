<?php

use Illuminate\Database\Seeder;

class ReturJualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ReturJuals = array(['NoNotaJual'=>'20170101001', 'Tanggal'=>'2017-01-01', 
                             'Total'=>24000, 'SubTotal'=>100000, 'StatusTerdaftar'=>0, 'KaryawanID'=>1, 'NotaJualID'=>1],
                            ['NoNotaJual'=>'20160101002', 'Tanggal'=>'2016-01-01', 
                             'Total'=>30000, 'SubTotal'=>90000, 'StatusTerdaftar'=>1, 'KaryawanID'=>2, 'NotaJualID'=>2]);
		DB::table('ReturJuals')->insert($ReturJuals);
    }
}
