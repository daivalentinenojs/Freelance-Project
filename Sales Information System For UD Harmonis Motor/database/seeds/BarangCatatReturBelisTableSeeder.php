<?php

use Illuminate\Database\Seeder;

class BarangCatatReturBelisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BarangCatatReturBelis = array(['ReturBeliID'=>1, 'BarangID'=>1, 'KuantitiBarangAsal'=>35,
                                        'KuantitiBarangGanti'=>13],
        		         			   ['ReturBeliID'=>2, 'BarangID'=>2, 'KuantitiBarangAsal'=>20, 
                                        'KuantitiBarangGanti'=>12]);
		DB::table('BarangCatatReturBelis')->insert($BarangCatatReturBelis);
    }
}
