<?php

use Illuminate\Database\Seeder;

class BarangCatatStokOpnamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BarangCatatStokOpnames = array(['StokOpnameID'=>1, 'BarangID'=>1, 'JumlahSelisih'=>3, 
                                         'Alasan'=>'Barang rusak'],
        		         			    ['StokOpnameID'=>2, 'BarangID'=>2, 'JumlahSelisih'=>2, 
        		         			     'Alasan'=>'Barang cacat']);
		DB::table('BarangCatatStokOpnames')->insert($BarangCatatStokOpnames);
    }
}
