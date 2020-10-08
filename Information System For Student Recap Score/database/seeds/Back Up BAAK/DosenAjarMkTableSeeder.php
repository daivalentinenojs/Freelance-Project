<?php

use Illuminate\Database\Seeder;

class DosenAjarMkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DosenAjarMk = 	array(
				['KodeMkBuka'=>'1604A01120161','KP'=>'A','NPK'=>'197030'], // ALRPO SUSANA
        ['KodeMkBuka'=>'1604A01120161','KP'=>'B','NPK'=>'204027'], // ALRPO MONICA
				['KodeMkBuka'=>'1604A01120161','KP'=>'Z','NPK'=>'209023'], // ALRPO RICHARD

				['KodeMkBuka'=>'1604A02120161','KP'=>'-','NPK'=>'204027'], // PBO MONICA

				['KodeMkBuka'=>'1607A02120161','KP'=>'A','NPK'=>'209344'], // BASDAT DANIEL
				['KodeMkBuka'=>'1607A02120161','KP'=>'B','NPK'=>'199013'], // BASDAT LISANA

				['KodeMkBuka'=>'1604A05120161','KP'=>'A','NPK'=>'208020'], // PETER ANDRE
				['KodeMkBuka'=>'1604A05120161','KP'=>'B','NPK'=>'209345'], // PETER FERDI

				['KodeMkBuka'=>'1604A03220161','KP'=>'A','NPK'=>'215027'], // JARKOM	MAYA

				['KodeMkBuka'=>'1604A03120161','KP'=>'-','NPK'=>'209345'], // STRUKDAT FERDI

				['KodeMkBuka'=>'1600A10420161','KP'=>'A','NPK'=>'204027'], // MATEMATIKA B MONICA
				['KodeMkBuka'=>'1600A10420161','KP'=>'B','NPK'=>'197030'], // MATEMATIKA B SUSANA
				['KodeMkBuka'=>'1600A10420161','KP'=>'C','NPK'=>'203014'], // MATEMATIKA B ELLYSA
				['KodeMkBuka'=>'1600A10420161','KP'=>'D','NPK'=>'197030'], // MATEMATIKA B SUSANA

				['KodeMkBuka'=>'1604A05520161','KP'=>'A','NPK'=>'202017'], // STATISTIKA B DHIANI

				['KodeMkBuka'=>'1604A03320161','KP'=>'A','NPK'=>'208020'], // DESAIN WEB P ANDRE
				['KodeMkBuka'=>'1604A03320161','KP'=>'B','NPK'=>'209344'], // DESAIN WEB P DANIEL



				['KodeMkBuka'=>'1604A03220152','KP'=>'A','NPK'=>'209345'], // JARKOM P FERDI

				['KodeMkBuka'=>'1604A03120152','KP'=>'A','NPK'=>'197030'], // STRUKDAT B SUSANA

				['KodeMkBuka'=>'1600A10420152','KP'=>'A','NPK'=>'204027'], // MATEMATIKA B MONICA
				['KodeMkBuka'=>'1600A10420152','KP'=>'B','NPK'=>'197030'], // MATEMATIKA B SUSANA

				['KodeMkBuka'=>'1604A05520152','KP'=>'-','NPK'=>'204027'], // STATISTIKA B MONICA

				['KodeMkBuka'=>'1604A03320152','KP'=>'A','NPK'=>'208020'], // DESAIN WEB P ANDRE
				['KodeMkBuka'=>'1604A03320152','KP'=>'B','NPK'=>'209344'], // DESAIN WEB P DANIEL



				['KodeMkBuka'=>'1604A03220151','KP'=>'-','NPK'=>'215027'], // JARKOM	B MAYA
				['KodeMkBuka'=>'1600A10420151','KP'=>'A','NPK'=>'204027'], // MATEMATIKA B MONICA
				['KodeMkBuka'=>'1604A05520151','KP'=>'A','NPK'=>'197030'], // STATISTIKA B SUSANA

				['KodeMkBuka'=>'1604A07220161','KP'=>'-','NPK'=>'198032'], // PESIM P JOKO

				['KodeMkBuka'=>'1604A10320161','KP'=>'-','NPK'=>'203016'], // WSRPL P DANIELH

				['KodeMkBuka'=>'1604A04520161','KP'=>'ZA','NPK'=>'206020'], // DIS B LILI
				['KodeMkBuka'=>'1604A04520161','KP'=>'ZB','NPK'=>'210034'], // DIS P HENDRA

				['KodeMkBuka'=>'1607A05220161','KP'=>'A','NPK'=>'195012'], // TIS P BUDI
				['KodeMkBuka'=>'1607A05220161','KP'=>'B','NPK'=>'216037'], // TIS P NAUFAL

				['KodeMkBuka'=>'1604A05420161','KP'=>'A','NPK'=>'203016'], // MTT P DANIELH

				['KodeMkBuka'=>'1604A05220161','KP'=>'A','NPK'=>'210034'], // ISA P HENDRA

				['KodeMkBuka'=>'1604A04420161','KP'=>'A','NPK'=>'201026'], // MSAINS P NYOTO
				['KodeMkBuka'=>'1604A04420161','KP'=>'B','NPK'=>'199020'], // MSAINS B FITRI
				['KodeMkBuka'=>'1604A04420161','KP'=>'C','NPK'=>'201007'], // MSAINS B ENDAH

				['KodeMkBuka'=>'1604A07120161','KP'=>'A','NPK'=>'216037'], // PMN P NAUFAL

				['KodeMkBuka'=>'1604A06420161','KP'=>'-','NPK'=>'195012'], // E - COMMERCE P BUDI

				['KodeMkBuka'=>'1604A20120161','KP'=>'-','NPK'=>'200046'], // GAMEPROG B MELISSA

				['KodeMkBuka'=>'1608A30220161','KP'=>'A','NPK'=>'200046'], // STOP MOTION B MELISSA
				['KodeMkBuka'=>'1608A30220161','KP'=>'B','NPK'=>'210113'], // STOP MOTION P ONGKO

				['KodeMkBuka'=>'1608A06320161','KP'=>'A','NPK'=>'210134'], // GAMEDEV B TYRZA

				['KodeMkBuka'=>'1608A04320161','KP'=>'-','NPK'=>'210134'], // DESAIN GRAFIS B TYRZA

				['KodeMkBuka'=>'1608A04120161','KP'=>'A','NPK'=>'210113'], // DIGITAL AUDIO P ONGKO
				['KodeMkBuka'=>'1608A04120161','KP'=>'B','NPK'=>'210134'], // DIGITAL AUDIO B TYRZA

				['KodeMkBuka'=>'1608A20220161','KP'=>'A','NPK'=>'210113'], // RENDERING P ONGKO
				['KodeMkBuka'=>'1608A20220161','KP'=>'B','NPK'=>'210134'], // RENDERING B TYRZA

				);
		DB::table('DosenAjarMk')->insert($DosenAjarMk);
    }
}
