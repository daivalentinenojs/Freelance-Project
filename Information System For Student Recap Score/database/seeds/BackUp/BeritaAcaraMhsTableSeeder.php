<?php

use Illuminate\Database\Seeder;

class BeritaAcaraMhsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BeritaAcaraMhs = 	array(	['NRP'=>'6134020','IdBeritaAcara'=>'21','Jenis'=>'Tidak Hadir','NoSuratIjin'=>'','TglSuratIjin'=>''],
				['NRP'=>'6134004','IdBeritaAcara'=>'21','Jenis'=>'Tidak Hadir','NoSuratIjin'=>'','TglSuratIjin'=>''],


				['NRP'=>'6134111','IdBeritaAcara'=>'36','Jenis'=>'Tidak Hadir','NoSuratIjin'=>'','TglSuratIjin'=>''],
				['NRP'=>'6134115','IdBeritaAcara'=>'36','Jenis'=>'Izin','NoSuratIjin'=>'FX/02/01/2016','TglSuratIjin'=>'2016-12-10'],
				['NRP'=>'6134004','IdBeritaAcara'=>'36','Jenis'=>'Tidak Hadir','NoSuratIjin'=>'','TglSuratIjin'=>''],

				);
		DB::table('BeritaAcaraMhs')->insert($BeritaAcaraMhs);
    }
}
