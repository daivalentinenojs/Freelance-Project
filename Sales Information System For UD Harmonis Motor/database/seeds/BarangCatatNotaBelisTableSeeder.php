<?php

use Illuminate\Database\Seeder;

class BarangCatatNotaBelisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BarangCatatNotaBelis = array(['NotaBeliID'=>1, 'BarangID'=>1, 'Kuantiti'=>35, 
                                       'HargaBeli'=>120000, 'SubTotal'=>4200000, 
                                       'PerubahanJumlahBarang'=>35],
        		         			            ['NotaBeliID'=>2, 'BarangID'=>2, 'Kuantiti'=>50, 
                                       'HargaBeli'=>90000, 'SubTotal'=>4500000, 
                                       'PerubahanJumlahBarang'=>50]);
		    DB::table('BarangCatatNotaBelis')->insert($BarangCatatNotaBelis);
    }
}
