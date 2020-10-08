<?php

use Illuminate\Database\Seeder;

class PengeluaransTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Pengeluarans = array(['Tanggal'=>'2015-06-09', 'Nama'=>'Kas', 'Nominal'=>10000, 
        					   'Keterangan'=>'AAA', 'StatusTerdaftar'=>1, 'KaryawanID'=>1],
        		         	  ['Tanggal'=>'2016-10-10', 'Nama'=>'Hutang', 'Nominal'=>26000, 
        		         	   'Keterangan'=>'CCC', 'StatusTerdaftar'=>1, 'KaryawanID'=>2]);
		DB::table('Pengeluarans')->insert($Pengeluarans);
    }
}
