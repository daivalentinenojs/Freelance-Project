<?php

use Illuminate\Database\Seeder;

class MhsAmbilMkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MhsAmbilMk = 	array(
    	// JARKOM FERDI = MICHAEL CHRISTIAN = QUIZ UTS PROYEKUAS UAS = (80 70 80 85)(80 70 85 85) [30 70] [40 60]
		['KodeMkBuka'=>'1604A03220152','KP'=>'A','NRP'=>'6134021', 'NTS'=>73, 'NAS'=>83, 'NA'=>79, 'KodeNisbi'=>'AB'], // NTS = 73    NAS =  83   NA = 79
		['KodeMkBuka'=>'1604A03220152','KP'=>'A','NRP'=>'6134040', 'NTS'=>73, 'NAS'=>85, 'NA'=>80.2, 'KodeNisbi'=>'AB'], // NTS = 73    NAS =  85   NA = 80.2

		// STRUKDAT SUSANA = DAIVA STEVEN = UTS UAS = (100 100)(100 90) [100] [100]
		['KodeMkBuka'=>'1604A03120152','KP'=>'A','NRP'=>'6134059', 'NTS'=>100, 'NAS'=>100, 'NA'=>100, 'KodeNisbi'=>'A'], // NTS = 100    NAS = 100   NA = 100
		['KodeMkBuka'=>'1604A03120152','KP'=>'A','NRP'=>'6134111', 'NTS'=>100, 'NAS'=>90, 'NA'=>94, 'KodeNisbi'=>'A'], // NTS = 100    NAS = 90    NA = 94

		// MATEMATIKA MONICA = DAIVA CHRISTIAN = QUIZ UTS QUIZ UAS (70 80 70 85)(70 85 85 70) [30 70] [30 70]
		['KodeMkBuka'=>'1600A10420152','KP'=>'A','NRP'=>'6134059', 'NTS'=>77, 'NAS'=>80.5, 'NA'=>79.1, 'KodeNisbi'=>'AB'], // NTS = 77      NAS = 80.5    NA = 79.1
		['KodeMkBuka'=>'1600A10420152','KP'=>'A','NRP'=>'6134040', 'NTS'=>80.5, 'NAS'=>74.5, 'NA'=>76.9, 'KodeNisbi'=>'AB'], // NTS = 80.5    NAS = 74.5    NA = 76.9

		// MATEMATIKA SUSANA = STEVEN HADI = QUIZ UTS QUIZ UAS(80 80 80 80)(75 75 75 75) [30 70] [30 70]
		['KodeMkBuka'=>'1600A10420152','KP'=>'B','NRP'=>'6134111', 'NTS'=>80, 'NAS'=>80, 'NA'=>80, 'KodeNisbi'=>'AB'], // NTS = 80    NAS = 80    NA = 80
		['KodeMkBuka'=>'1600A10420152','KP'=>'B','NRP'=>'6134020', 'NTS'=>75, 'NAS'=>75, 'NA'=>75, 'KodeNisbi'=>'AB'], // NTS = 75    NAS = 75    NA = 75

		// STATISTIKA MONICA = MICHAEL DAIVA = UTS UAS(90 70)(70 70) [100] [100]
		['KodeMkBuka'=>'1604A05520152','KP'=>'A','NRP'=>'6134021', 'NTS'=>90, 'NAS'=>70, 'NA'=>78, 'KodeNisbi'=>'AB'], // NTS = 90    NAS = 70    NA = 78
		['KodeMkBuka'=>'1604A05520152','KP'=>'A','NRP'=>'6134059', 'NTS'=>70, 'NAS'=>70, 'NA'=>70, 'KodeNisbi'=>'B'], // NTS = 70    NAS = 70    NA = 70

		// DESAIN WEB ANDRE = ANDREAS DAIVA = PROYEKUTS PROYEKUAS(80 80)(90 90) [100] [100]
		['KodeMkBuka'=>'1604A03320152','KP'=>'A','NRP'=>'6134004', 'NTS'=>80, 'NAS'=>80, 'NA'=>80, 'KodeNisbi'=>'AB'], // NTS = 80    NAS = 80    NA = 80
		['KodeMkBuka'=>'1604A03320152','KP'=>'A','NRP'=>'6134059', 'NTS'=>90, 'NAS'=>90, 'NA'=>90, 'KodeNisbi'=>'A'], // NTS = 90    NAS = 90    NA = 90

		// DESAIN WEB DANIEL = CHRISTINE IKA = PROYEKUTS PROYEKUAS(80 85)(70 75) [100] [100]
		['KodeMkBuka'=>'1604A03320152','KP'=>'B','NRP'=>'6134108', 'NTS'=>80, 'NAS'=>85, 'NA'=>83, 'KodeNisbi'=>'A'], // NTS = 80    NAS = 85    NA = 83
		['KodeMkBuka'=>'1604A03320152','KP'=>'B','NRP'=>'6134087', 'NTS'=>70, 'NAS'=>75, 'NA'=>73, 'KodeNisbi'=>'AB'], // NTS = 70    NAS = 75    NA = 73



		// JARKOM MAYA = DAIVA STEVEN = UTS UAS(90 95)(80 85) [100] [100]
		['KodeMkBuka'=>'1604A03220151','KP'=>'-','NRP'=>'6134059', 'NTS'=>90, 'NAS'=>95, 'NA'=>93, 'KodeNisbi'=>'A'], // NTS = 90    NAS = 95    NA = 93
		['KodeMkBuka'=>'1604A03220151','KP'=>'-','NRP'=>'6134111', 'NTS'=>80, 'NAS'=>85, 'NA'=>83, 'KodeNisbi'=>'A'], // NTS = 80    NAS = 85    NA = 83

		// MATEMATIKA MONICA = DAIVA ALDO = QUIZ UTS QUIZ UAS(80 85 85 80)(70 75 82 83) [30 70] [30 70]
		['KodeMkBuka'=>'1600A10420151','KP'=>'A','NRP'=>'6134059', 'NTS'=>83.5, 'NAS'=>81.5, 'NA'=>82.3, 'KodeNisbi'=>'A'], // NTS = 83.5  NAS = 81.5  NA = 82.3
		['KodeMkBuka'=>'1600A10420151','KP'=>'A','NRP'=>'6134115', 'NTS'=>73.5, 'NAS'=>82.7, 'NA'=>79.02, 'KodeNisbi'=>'AB'], // NTS = 73.5  NAS = 82.7  NA = 79.02

		// STATISTIKA SUSANA = STEVEN ALDO = UTS UAS(73 75)(75 70) [100] [100]
		['KodeMkBuka'=>'1604A05520151','KP'=>'A','NRP'=>'6134111', 'NTS'=>73, 'NAS'=>75, 'NA'=>74.2, 'KodeNisbi'=>'AB'], // NTS = 73    NAS = 75    NA = 74.2
		['KodeMkBuka'=>'1604A05520151','KP'=>'A','NRP'=>'6134115', 'NTS'=>75, 'NAS'=>70, 'NA'=>72, 'KodeNisbi'=>'B'], // NTS = 75    NAS = 70    NA = 72
		);
		DB::table('MhsAmbilMk')->insert($MhsAmbilMk);
    }
}
