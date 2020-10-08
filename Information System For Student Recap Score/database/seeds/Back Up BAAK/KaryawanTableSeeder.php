<?php

use Illuminate\Database\Seeder;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Karyawans = 	array(
                            ['NPK'=>'202017','Nama'=>'Dhiani Tresna Absari, S.T., M.Kom.','IdUser'=>1],
                            ['NPK'=>'187018','Nama'=>'Ir. Bambang Prijambodo, M.MT.','IdUser'=>2],
                            ['NPK'=>'197030','Nama'=>'Susana Limanto, S.T., M.Si.','IdUser'=>3],
                            ['NPK'=>'215027','Nama'=>'Maya Hilda Lestari Louk, S.T., M.Sc.','IdUser'=>4],
                            ['NPK'=>'203014','Nama'=>'Ellysa Tjandra, S.T., M.MT.','IdUser'=>5],
                            ['NPK'=>'208020','Nama'=>'Andre, S.T., M.Sc.','IdUser'=>6],
                            ['NPK'=>'209344','Nama'=>'Daniel Soesanto, S.T., M.M','IdUser'=>7],
                            ['NPK'=>'204027','Nama'=>'Monica Widiasri, S.Kom., M.Kom.','IdUser'=>8],
                            ['NPK'=>'209345','Nama'=>'Marcellinus Ferdinand Suciadi, S.T., M.Comp.','IdUser'=>9],
                            ['NPK'=>'199013','Nama'=>'Lisana, S.Kom., M.Inf.Tech.','IdUser'=>10],

                            ['NPK'=>'195012','Nama'=>'Dr. Budi Hartanto, S.T., M.Sc.','IdUser'=>53],
                            ['NPK'=>'198032','Nama'=>'Dr. Joko Siswantoro, S.Si., M.Si.','IdUser'=>54],
                            ['NPK'=>'201026','Nama'=>'Njoto Benarkah, S.T., M.Sc.','IdUser'=>55],
                            ['NPK'=>'201007','Nama'=>'Endah Asmawati, S.Si., M.Si.','IdUser'=>56],
                            ['NPK'=>'216037','Nama'=>'Mohammad Farid Naufal, S.Kom., M.Kom.','IdUser'=>57],

                            ['NPK'=>'210034','Nama'=>'Hendra Dinata, S.T., M.Kom.','IdUser'=>58],
                            ['NPK'=>'206020','Nama'=>'Liliana, S.T., M.MSI.','IdUser'=>59],
                            ['NPK'=>'210134','Nama'=>'Tyrza Adelia, S.Sn., M.Inf.Tech.','IdUser'=>60],
                            ['NPK'=>'203016','Nama'=>'Daniel Hary Prasetyo, S.Kom., M.Sc.','IdUser'=>61],
                            ['NPK'=>'199020','Nama'=>'Fitri Dwi Kartikasari, S.Si., M.Si.','IdUser'=>62],

                            ['NPK'=>'210113','Nama'=>'Ongko Citrowinoto, S.Sos.','IdUser'=>63],
                            ['NPK'=>'200046','Nama'=>'Melissa Angga, S.T., M.M.Comp.','IdUser'=>64],
                            ['NPK'=>'209023','Nama'=>'Richard Pramono, S.Kom., M.Sc.','IdUser'=>65],
					);
		DB::table('Karyawan')->insert($Karyawans);
    }
}
