<?php

use Illuminate\Database\Seeder;

class BarangCatatReturJualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BarangCatatReturJuals = array(['ReturJualID'=>1, 'BarangID'=>1, 'KuantitiBarangAsal'=>35, 
                                        'KuantitiBarangGanti'=>13],
        		         			   ['ReturJualID'=>2, 'BarangID'=>2, 'KuantitiBarangAsal'=>20, 
        		         			    'KuantitiBarangGanti'=>12]);
		DB::table('BarangCatatReturJuals')->insert($BarangCatatReturJuals);
    }
}
