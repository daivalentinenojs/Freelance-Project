<?php

use Illuminate\Database\Seeder;

class PemasoksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Pemasoks = array(['NoRekening'=>'090098390', 'NamaRekening'=>'Daiva', 'Bank'=>'BCA',
                           'Alamat'=>'Jalan Tenggilis 78 B', 'NoTelepon'=>'082335677809', 
                           'StatusBeli'=>1, 'StatusTerdaftar'=>1],
        				          ['NoRekening'=>'090098389', 'NamaRekening'=>'Tjandra', 'Bank'=>'Mandiri',
                           'Alamat'=>'Jalan Tenggilis 79 B', 'NoTelepon'=>'082335677888', 
                           'StatusBeli'=>1, 'StatusTerdaftar'=>1]);
		    DB::table('Pemasoks')->insert($Pemasoks);
    }
}
