<?php

use Illuminate\Database\Seeder;

class MataKuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MataKuliahs = 	array(
              // ['KodeMk'=>'1604A011','Nama'=>'ALGORITMA DAN PEMROGRAMAN','NamaEng'=>'ALGORITHM AND PROGRAMMING','Sks'=>6],
							// ['KodeMk'=>'1604A021','Nama'=>'PEMROGRAMAN BERORIENTASI OBJEK','NamaEng'=>'OBJECTED ORIENTED PROGRAMMING','Sks'=>6],
							// ['KodeMk'=>'1607A021','Nama'=>'BASIS DATA','NamaEng'=>'DATABASE PROGRAMMING','Sks'=>4],
							// ['KodeMk'=>'1604A051','Nama'=>'PEMROGRAMAN TERDISTRIBUSI','NamaEng'=>'DISTRIBUTED PROGRAMMING','Sks'=>4],
							// ['KodeMk'=>'1604A032','Nama'=>'JARINGAN KOMPUTER','NamaEng'=>'COMPUTER NETWORK','Sks'=>3],
							// ['KodeMk'=>'1604A031 ','Nama'=>'STRUKTUR DATA','NamaEng'=>'DATA STRUCTURE','Sks'=>4],
							// ['KodeMk'=>'1600A104','Nama'=>'MATEMATIKA','NamaEng'=>'MATHEMATICS','Sks'=>4],
							// ['KodeMk'=>'1600A002 ','Nama'=>'BAHASA INGGRIS','NamaEng'=>'ENGLISH ACADEMIC','Sks'=>2],
							// ['KodeMk'=>'1604A055 ','Nama'=>'STATISTIKA','NamaEng'=>'STATISTICS','Sks'=>3],
							// ['KodeMk'=>'1604A033','Nama'=>'DESAIN WEB','NamaEng'=>'WEB DESIGN','Sks'=>3],

              ['KodeMk'=>'1604A072','Nama'=>'PEMODELAN SIMULASI','NamaEng'=>'MODELING SIMULATION','Sks'=>3],
							['KodeMk'=>'1604A103','Nama'=>'WORKSHOP REKAYASA PERANGKAT LUNAK','NamaEng'=>'WORKSHOP SOFTWARE ENGINEERING','Sks'=>3],
							['KodeMk'=>'1604A045','Nama'=>'DESAIN DAN IMPLEMENTASI SISTEM','NamaEng'=>'DESIGN AND IMPLEMENTATION SYSTEM','Sks'=>3],
							['KodeMk'=>'1607A052','Nama'=>'SISTEM TESTING DAN IMPLEMENTASI','NamaEng'=>'SYSTEM TESTING AND IMPLEMENTATION','Sks'=>3],
							['KodeMk'=>'1604A054','Nama'=>'MANAGEMEN TEKNOLOGI TELEMATIKA','NamaEng'=>'MANAGEMENT TECHNOLOGY TELEMATIKA','Sks'=>3],

							['KodeMk'=>'1604A052','Nama'=>'INFORMATION SECURITY AND ASSURANCE','NamaEng'=>'INFORMATION SECURITY AND ASSURANCE','Sks'=>3],
							['KodeMk'=>'1604A044','Nama'=>'MANAJEMEN SAINTS','NamaEng'=>'MANAGEMENT SCIENCE','Sks'=>3],
							['KodeMk'=>'1604A071','Nama'=>'PEMROGRAMAN MULTIPLATFORM NIRKABEL','NamaEng'=>'MULTIPLATFORM NIRKABEL PROGRAMMING','Sks'=>2],
							['KodeMk'=>'1604A064','Nama'=>'E - COMMERCE','NamaEng'=>'E - COMMERCE','Sks'=>2],
							['KodeMk'=>'1604A201','Nama'=>'GAME PROGRAMMING','NamaEng'=>'GAME PROGRAMMING','Sks'=>3],

							['KodeMk'=>'1608A302','Nama'=>'STOP MOTION','NamaEng'=>'STOP MOTION','Sks'=>3],
							['KodeMk'=>'1608A063','Nama'=>'GAME DEVELOPMENT','NamaEng'=>'GAME DEVELOPMENT','Sks'=>3],
							['KodeMk'=>'1608A043','Nama'=>'DESAIN GRAFIS','NamaEng'=>'GRAPHICAL DESIGN','Sks'=>3],
							['KodeMk'=>'1608A041','Nama'=>'DIGITAL AUDIO','NamaEng'=>'DIGITAL AUDIO','Sks'=>3],
							['KodeMk'=>'1608A202','Nama'=>'RENDERING','NamaEng'=>'RENDERING','Sks'=>3],
					);
		DB::table('MataKuliah')->insert($MataKuliahs);
    }
}
