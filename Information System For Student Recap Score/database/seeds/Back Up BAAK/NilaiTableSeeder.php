<?php

use Illuminate\Database\Seeder;

class NilaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Nilais = 	array(

      	['KodeNilai'=>'001604A032201520AT001','KodeMkBuka'=>'1604A03220152','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'209345','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A032201520AA002','KodeMkBuka'=>'1604A03220152','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'209345','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001604A031201520AT001','KodeMkBuka'=>'1604A03120152','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'197030','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A031201520AA002','KodeMkBuka'=>'1604A03120152','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'197030','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001600A104201520AT001','KodeMkBuka'=>'1600A10420152','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001600A104201520AA002','KodeMkBuka'=>'1600A10420152','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001600A104201520BT001','KodeMkBuka'=>'1600A10420152','KP'=>'B','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001600A104201520BA002','KodeMkBuka'=>'1600A10420152','KP'=>'B','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'197030','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001604A055201520AT001','KodeMkBuka'=>'1604A05520152','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A055201520AA002','KodeMkBuka'=>'1604A05520152','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001604A033201520AT001','KodeMkBuka'=>'1604A03320152','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'208020','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A033201520AA002','KodeMkBuka'=>'1604A03320152','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'208020','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001604A033201520BT001','KodeMkBuka'=>'1604A03320152','KP'=>'B','Jenis'=>'NTS','WaktuBuat'=>'2016-04-28','WaktuValidasiDosen'=>'2016-06-25','WaktuValidasiAdmik'=>'2016-06-26','DosenPembuat'=>'208020','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A033201520BA002','KodeMkBuka'=>'1604A03320152','KP'=>'B','Jenis'=>'NAS','WaktuBuat'=>'2016-06-11','WaktuValidasiDosen'=>'2016-06-28','WaktuValidasiAdmik'=>'2016-06-29','DosenPembuat'=>'208020','AdmikValidator'=>'','Status'=>'ValidAdmik'],



      	['KodeNilai'=>'001604A032201510-T001','KodeMkBuka'=>'1604A03220151','KP'=>'-','Jenis'=>'NTS','WaktuBuat'=>'2015-10-11','WaktuValidasiDosen'=>'2015-09-18','WaktuValidasiAdmik'=>'2016-01-24','DosenPembuat'=>'215027','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A032201510-A002','KodeMkBuka'=>'1604A03220151','KP'=>'-','Jenis'=>'NAS','WaktuBuat'=>'2015-10-11','WaktuValidasiDosen'=>'2015-11-18','WaktuValidasiAdmik'=>'2016-01-24','DosenPembuat'=>'215027','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001600A104201510AT001','KodeMkBuka'=>'1600A10420151','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2015-10-11','WaktuValidasiDosen'=>'2015-09-18','WaktuValidasiAdmik'=>'2016-01-24','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001600A104201510AA002','KodeMkBuka'=>'1600A10420151','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2015-10-11','WaktuValidasiDosen'=>'2015-11-18','WaktuValidasiAdmik'=>'2016-01-24','DosenPembuat'=>'204027','AdmikValidator'=>'','Status'=>'ValidAdmik'],

      	['KodeNilai'=>'001604A055201510AT001','KodeMkBuka'=>'1604A05520151','KP'=>'A','Jenis'=>'NTS','WaktuBuat'=>'2015-10-11','WaktuValidasiDosen'=>'2015-09-18','WaktuValidasiAdmik'=>'2016-01-24','DosenPembuat'=>'197030','AdmikValidator'=>'','Status'=>'ValidAdmik'],
      	['KodeNilai'=>'001604A055201510AA002','KodeMkBuka'=>'1604A05520151','KP'=>'A','Jenis'=>'NAS','WaktuBuat'=>'2015-10-11','WaktuValidasiDosen'=>'2015-11-18','WaktuValidasiAdmik'=>'2016-01-24','DosenPembuat'=>'197030','AdmikValidator'=>'','Status'=>'ValidAdmik'],
		);
		DB::table('Nilai')->insert($Nilais);
    }
}
