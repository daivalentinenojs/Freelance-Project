<?php

use Illuminate\Database\Seeder;

class BarangCatatNotaJualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BarangCatatNotaJuals = array(['NotaJualID'=>1, 'BarangID'=>1, 'Kuantiti'=>10, 
                                       'HargaJual'=>120000, 'SubTotal'=>1200000],
        		         			  ['NotaJualID'=>2, 'BarangID'=>2, 'Kuantiti'=>15, 
                                       'HargaJual'=>90000, 'SubTotal'=>1350000]);
		DB::table('BarangCatatNotaJuals')->insert($BarangCatatNotaJuals);
    }
}
