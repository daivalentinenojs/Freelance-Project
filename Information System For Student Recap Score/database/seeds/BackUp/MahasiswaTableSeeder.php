<?php

use Illuminate\Database\Seeder;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Mahasiswas = 	array(
                            // ['NRP'=>'6134059','Nama'=>'Daivalentineno Janitra Salim','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>11],
                            // ['NRP'=>'6134111','Nama'=>'Steven Brian Susantio','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>12],
                            // ['NRP'=>'6134115','Nama'=>'Eduardus Aldo','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>13],
                            // ['NRP'=>'6134087','Nama'=>'Ika Suryani Kusuma','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>14],
                            // ['NRP'=>'6134108','Nama'=>'Christine Tandiwijaya','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>15],
                            // ['NRP'=>'6134030','Nama'=>'Aloysius Wiranata','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>16],
                            // ['NRP'=>'6134021','Nama'=>'Michael Poernomo','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>17],
                            // ['NRP'=>'6134040','Nama'=>'Christian Alexander','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>18],
                            // ['NRP'=>'6134004','Nama'=>'Andreas Teja','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>19],
                            // ['NRP'=>'6134020','Nama'=>'Hadi Kusuma Poernomo','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>20],

                            // ['NRP'=>'6134066','Nama'=>'Wanandi Suryanata','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>22],
                            // ['NRP'=>'6134042','Nama'=>'Febrianto Ramadhan','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>23],
                            // ['NRP'=>'6137034','Nama'=>'Meliza Fatmawati','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>24],
                            // ['NRP'=>'6138015','Nama'=>'Kevin Juniawan','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>25],
                            // ['NRP'=>'6134001','Nama'=>'Fendy Budi Kusuma','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>26],

                            // ['NRP'=>'6134130','Nama'=>'Dyah','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>27],
                            // ['NRP'=>'160414009','Nama'=>'Evin','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>28],
                            // ['NRP'=>'6137010','Nama'=>'Yohanes Brianata','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>29],

                            // ['NRP'=>'6134110','Nama'=>'David Setiawan','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>30],
                            // ['NRP'=>'6134015','Nama'=>'Anthony Wijaya','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>31],

                            // ['NRP'=>'6138019','Nama'=>'Mikhael Johnson','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>32],

                            // ['NRP'=>'160415057','Nama'=>'Edwin','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>33],
                            // ['NRP'=>'160415147','Nama'=>'Altdho','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>34],
                            // ['NRP'=>'6134082','Nama'=>'Adrian Djitro','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>35],

                            // ['NRP'=>'6134034','Nama'=>'Calvin','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>36],

                            // ['NRP'=>'160414016','Nama'=>'Gabriella','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>37],
                            // ['NRP'=>'6137006','Nama'=>'Rendy Gunawan','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>38],
                            // ['NRP'=>'6134096','Nama'=>'Erwin','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>39],
                            //
                            // ['NRP'=>'6134109','Nama'=>'Welly','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>40],
                            // ['NRP'=>'160415090','Nama'=>'Roy Wongkar','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>41],

                            // ['NRP'=>'6134061','Nama'=>'Lisania Ayu','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>42],
                            // ['NRP'=>'6134065','Nama'=>'Christiana Fransisca','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>43],
                            // ['NRP'=>'6138038','Nama'=>'Marcellinus','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>44],

                            // ['NRP'=>'6134002','Nama'=>'Murdiyono','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>45],

                            // ['NRP'=>'6124095','Nama'=>'Kelvin Ko','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>46],
                            // ['NRP'=>'6134037','Nama'=>'Daniel Alexsander','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>47],

                            // ['NRP'=>'6134070','Nama'=>'Steven Imanuel','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>48],
                            // ['NRP'=>'6134035','Nama'=>'Yolanda Sutanto','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>49],
                            // ['NRP'=>'6124034','Nama'=>'Victor Halim','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>50],

                            // ['NRP'=>'6134093','Nama'=>'Revaldy Aji Himawan','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>51],
                            // ['NRP'=>'6134107','Nama'=>'Nandya Cahya Puspita','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>52],

                            // ['NRP'=>'6134114','Nama'=>'Reynaldo Liander','ThnAkademikTerima'=>'2012','SemesterTerima'=>'Gasal','IdUser'=>53],
					);
		DB::table('Mahasiswa')->insert($Mahasiswas);
    }
}
