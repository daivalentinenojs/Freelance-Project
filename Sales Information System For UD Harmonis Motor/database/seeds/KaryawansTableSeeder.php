<?php

use Illuminate\Database\Seeder;

class KaryawansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Karyawans = array(['Nama'=>'nick', 'Alamat'=>'Jalan RMS No 90', 'Email'=>'nick@gmail.com', 
                            'Password'=>'nick', 'NoTelepon'=>'082335625802', 'StatusTerdaftar'=>1],
        				   ['Nama'=>'andi', 'Alamat'=>'Jalan RMS No 88', 'Email'=>'andi@gmail.com', 
                            'Password'=>'andi', 'NoTelepon'=>'081334654321', 'StatusTerdaftar'=>1]);
		DB::table('Karyawans')->insert($Karyawans);
    }
}
