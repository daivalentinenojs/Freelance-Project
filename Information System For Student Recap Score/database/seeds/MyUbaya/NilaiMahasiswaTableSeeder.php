<?php

use Illuminate\Database\Seeder;

class NilaiMahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NilaiMahasiswas = 	array(

	        ['KodeNilai'=>'001604A032201520AT001','NRP'=>'6134021','Nilai'=>'73','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A032201520AT001','NRP'=>'6134040','Nilai'=>'73','KodeNisbi'=>'AB'],

	        ['KodeNilai'=>'001604A032201520AA001','NRP'=>'6134021','Nilai'=>'83','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A032201520AA001','NRP'=>'6134040','Nilai'=>'85','KodeNisbi'=>'AB'],



	        ['KodeNilai'=>'001604A031201520AT001','NRP'=>'6134059','Nilai'=>'100','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001604A031201520AT001','NRP'=>'6134111','Nilai'=>'100','KodeNisbi'=>'A'],

	        ['KodeNilai'=>'001604A031201520AA001','NRP'=>'6134059','Nilai'=>'100','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001604A031201520AA001','NRP'=>'6134111','Nilai'=>'90','KodeNisbi'=>'A'],



	        ['KodeNilai'=>'001600A104201520AT001','NRP'=>'6134059','Nilai'=>'77','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001600A104201520AT001','NRP'=>'6134040','Nilai'=>'80.5','KodeNisbi'=>'AB'],

	        ['KodeNilai'=>'001600A104201520AA001','NRP'=>'6134059','Nilai'=>'80.5','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001600A104201520AA001','NRP'=>'6134040','Nilai'=>'74.5','KodeNisbi'=>'AB'],



	        ['KodeNilai'=>'001600A104201520BT001','NRP'=>'6134111','Nilai'=>'80','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001600A104201520BT001','NRP'=>'6134020','Nilai'=>'75','KodeNisbi'=>'AB'],

	        ['KodeNilai'=>'001600A104201520BA001','NRP'=>'6134111','Nilai'=>'80','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001600A104201520BA001','NRP'=>'6134020','Nilai'=>'75','KodeNisbi'=>'AB'],



	        ['KodeNilai'=>'001604A055201520AT001','NRP'=>'6134021','Nilai'=>'90','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001604A055201520AT001','NRP'=>'6134059','Nilai'=>'70','KodeNisbi'=>'B'],

	        ['KodeNilai'=>'001604A055201520AA001','NRP'=>'6134021','Nilai'=>'70','KodeNisbi'=>'B'],
	        ['KodeNilai'=>'001604A055201520AA001','NRP'=>'6134059','Nilai'=>'70','KodeNisbi'=>'B'],



	        ['KodeNilai'=>'001604A033201520AT001','NRP'=>'6134004','Nilai'=>'80','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A033201520AT001','NRP'=>'6134059','Nilai'=>'90','KodeNisbi'=>'A'],

	        ['KodeNilai'=>'001604A033201520AA001','NRP'=>'6134004','Nilai'=>'80','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A033201520AA001','NRP'=>'6134059','Nilai'=>'90','KodeNisbi'=>'A'],



	        ['KodeNilai'=>'001604A033201520BT001','NRP'=>'6134108','Nilai'=>'80','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A033201520BT001','NRP'=>'6134087','Nilai'=>'70','KodeNisbi'=>'B'],

	        ['KodeNilai'=>'001604A033201520BA001','NRP'=>'6134108','Nilai'=>'85','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001604A033201520BA001','NRP'=>'6134087','Nilai'=>'75','KodeNisbi'=>'AB'],



	        ['KodeNilai'=>'001604A032201510-T001','NRP'=>'6134059','Nilai'=>'90','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001604A032201510-T001','NRP'=>'6134111','Nilai'=>'80','KodeNisbi'=>'AB'],

	        ['KodeNilai'=>'001604A032201510-A001','NRP'=>'6134059','Nilai'=>'95','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001604A032201510-A001','NRP'=>'6134111','Nilai'=>'85','KodeNisbi'=>'A'],



	        ['KodeNilai'=>'001600A104201510AT001','NRP'=>'6134059','Nilai'=>'83.5','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001600A104201510AT001','NRP'=>'6134115','Nilai'=>'73.5','KodeNisbi'=>'AB'],

	        ['KodeNilai'=>'001600A104201510AA001','NRP'=>'6134059','Nilai'=>'81.5','KodeNisbi'=>'A'],
	        ['KodeNilai'=>'001600A104201510AA001','NRP'=>'6134115','Nilai'=>'82.7','KodeNisbi'=>'A'],




	        ['KodeNilai'=>'001604A055201510AT001','NRP'=>'6134111','Nilai'=>'73','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A055201510AT001','NRP'=>'6134115','Nilai'=>'75','KodeNisbi'=>'AB'],

	        ['KodeNilai'=>'001604A055201510AA001','NRP'=>'6134111','Nilai'=>'75','KodeNisbi'=>'AB'],
	        ['KodeNilai'=>'001604A055201510AA001','NRP'=>'6134115','Nilai'=>'70','KodeNisbi'=>'B'],
	        
			);
		DB::table('baak_NilaiMahasiswa')->insert($NilaiMahasiswas);
    }
}
