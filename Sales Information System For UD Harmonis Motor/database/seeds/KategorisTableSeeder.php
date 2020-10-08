<?php

use Illuminate\Database\Seeder;

class KategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Kategoris = array(['Nama'=>'Toyota', 'StatusTerdaftar'=>1],
        				   ['Nama'=>'Mitsubishi', 'StatusTerdaftar'=>1],
                           ['Nama'=>'KYB', 'StatusTerdaftar'=>1],
                           ['Nama'=>'KW', 'StatusTerdaftar'=>1]);
		DB::table('Kategoris')->insert($Kategoris);
    }
}
