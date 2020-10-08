<?php

use Illuminate\Database\Seeder;

class SemesterAktifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SemesterAktifs = 	array(
							['ThnAkademik'=>'2016','Semester'=>'Gasal','GenerateBayar'=>'T','TglAwalKuliah'=>'2016-08-15','TglAkhirKuliah'=>'2016-12-02','TglAwalLulus'=>'2016-08-19','TglAkhirLulus'=>'2017-02-10','TglPembagianKHS'=>'','SudahProsesTilang'=>'T','BatasInputNts'=>'2016-11-20','BatasInputNas'=>'2017-01-06'], 

							['ThnAkademik'=>'2015','Semester'=>'Genap','GenerateBayar'=>'T','TglAwalKuliah'=>'2016-02-15','TglAkhirKuliah'=>'2016-06-03','TglAwalLulus'=>'2016-05-24','TglAkhirLulus'=>'2016-08-12','TglPembagianKHS'=>'','SudahProsesTilang'=>'T','BatasInputNts'=>'2016-07-25','BatasInputNas'=>'2016-07-25'],

                            ['ThnAkademik'=>'2015','Semester'=>'Gasal','GenerateBayar'=>'T','TglAwalKuliah'=>'2015-08-18','TglAkhirKuliah'=>'2015-12-04','TglAwalLulus'=>'2015-08-17','TglAkhirLulus'=>'2016-05-12','TglPembagianKHS'=>'','SudahProsesTilang'=>'T','BatasInputNts'=>'2016-01-19','BatasInputNas'=>'2016-01-19'], 
					);
		DB::table('SemesterAktif')->insert($SemesterAktifs);
    }
}
