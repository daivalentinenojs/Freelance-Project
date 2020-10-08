<?php

use Illuminate\Database\Seeder;

class BarangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Barangs = array(['Nama'=>'AAA', 'Tahun'=>'2017', 'Stok'=>100, 'HargaBeli'=>70000, 
                          'HargaJual'=>80000, 'StatusTerdaftar'=>1, 'KategoriID'=>1],
        		         ['Nama'=>'BBB', 'Tahun'=>'2016', 'Stok'=>80, 'HargaBeli'=>60000, 
                          'HargaJual'=>70000, 'StatusTerdaftar'=>1, 'KategoriID'=>2]);
		DB::table('Barangs')->insert($Barangs);
    }
}
