<?php

use Illuminate\Database\Seeder;

class NotaJualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NotaJuals = array(['NoNotaJual'=>'20170129001', 'TanggalBuat'=>'2017-01-29', 
                            'TanggalBayar'=>'2017-01-30', 'Total'=>75000, 
                            'StatusJual'=>'Sudah Lunas', 'StatusTerdaftar'=>1, 
                            'KaryawanID'=>1, 'PembeliID'=>1],
        				   ['NoNotaJual'=>'20160129002', 'TanggalBuat'=>'2016-01-29',  
                            'TanggalBayar'=>'2016-01-30', 'Total'=>75000, 
                            'StatusJual'=>'Belum Lunas', 'StatusTerdaftar'=>1, 
                            'KaryawanID'=>2, 'PembeliID'=>2]);
		DB::table('NotaJuals')->insert($NotaJuals);
    }
}
