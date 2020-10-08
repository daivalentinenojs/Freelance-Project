<?php

use Illuminate\Database\Seeder;

class PembelisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Pembelis = array(['Nama'=>'Tjandra', 'NoTelepon'=>'081990876543', 
                           'Kota'=>'Surabaya', 'Bank'=>'BCA', 'StatusLangganan'=>1, 'StatusJual'=>1, 
                           'StatusTerdaftar'=>1],
        				          ['Nama'=>'Felix', 'NoTelepon'=>'081990876540', 
                           'Kota'=>'Surabaya', 'Bank'=>'Mandiri', 'StatusLangganan'=>1, 'StatusJual'=>1, 
                           'StatusTerdaftar'=>1]);
		    DB::table('Pembelis')->insert($Pembelis);
    }
}
