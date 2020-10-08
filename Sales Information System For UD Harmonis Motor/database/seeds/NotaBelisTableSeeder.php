<?php

use Illuminate\Database\Seeder;

class NotaBelisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NotaBelis = array(['NoNotaBeli'=>'20170129001', 'TanggalBuat'=>'2017-01-29', 
                            'JatuhTempo'=>'2017-02-28', 'Total'=>100000, 
                            'StatusBeli'=>'Pesan', 'StatusTerdaftar'=>1, 'KaryawanID'=>1, 
                            'PemasokID'=>1],
        				   ['NoNotaBeli'=>'20160129002', 'TanggalBuat'=>'2016-01-29', 
                            'JatuhTempo'=>'2016-02-28', 'TotalAkhir'=>70000, 
                            'StatusBeli'=>'Dikirim', 'StatusTerdaftar'=>1, 'KaryawanID'=>2, 
                            'PemasokID'=>2]);
		DB::table('NotaBelis')->insert($NotaBelis);
    }
}
