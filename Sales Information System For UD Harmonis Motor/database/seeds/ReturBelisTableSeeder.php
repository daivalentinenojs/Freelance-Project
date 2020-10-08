<?php

use Illuminate\Database\Seeder;

class ReturBelisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ReturBelis = array(['NoNotaBeli'=>'20140101001', 'Tanggal'=>'2014-01-01', 'Total'=>24000, 
                             'SubTotal'=>100000, 'StatusTerdaftar'=>1, 'KaryawanID'=>1, 
                             'NotaBeliID'=>1],
        		            ['NoNotaBeli'=>'20130101002', 'Tanggal'=>'2013-01-01', 'Total'=>30000, 
                             'SubTotal'=>90000, 'StatusTerdaftar'=>1, 'KaryawanID'=>2, 
                             'NotaBeliID'=>2]);
		DB::table('ReturBelis')->insert($ReturBelis);
    }
}
