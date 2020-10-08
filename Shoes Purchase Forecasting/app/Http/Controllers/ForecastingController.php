<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forecasting;
use DB;

class ForecastingController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return Response
      */
    public function Index(Request $Request)
    {
        $ID = $Request->session()->get('ID'); // 3
        $Name = $Request->session()->get('Name'); // 4
        $IDJabatan = $Request->session()->get('IDJabatan');
        $Jabatan = $Request->session()->get('Jabatan'); // 5
        return view('Forecasting.Index', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }

    /**
      * Display a listing of the resource.
      *
      * @return Response
      */
    public function Merek($id){
      $Forecasting = new Forecasting();
      $DataMerek = $Forecasting->GetMerek($id);
      echo "<option value=''>Silahkan Pilih Merek</option>";
      for ($i=0; $i < count($DataMerek) ; $i++) {
         echo '<option value="'.$DataMerek[$i]['ID'].'">'.$DataMerek[$i]['Merek'].'</option>';
      }
    }

    public function Tipe($id){
      $Forecasting = new Forecasting();
      $DataTipe = $Forecasting->GetTipe($id);
      echo "<option value=''>Silahkan Pilih Tipe</option>";
      for ($i=0; $i < count($DataTipe) ; $i++) {
         echo '<option value="'.$DataTipe[$i]['ID'].'">'.$DataTipe[$i]['Tipe'].'</option>';
      }
    }
    public function Create(Request $request)
    {
        $ID = $request->session()->get('ID'); // 3
        $Name = $request->session()->get('Name'); // 4
        $IDJabatan = $request->session()->get('IDJabatan');
        $Jabatan = $request->session()->get('Jabatan');
       require '../connection/Init.php';
       $dataDigunakan=$request->get('DataDigunakan');
       $merek=$request->get('Merek');
       $ctipe=$request->get('CheckTipe');
       $tipe=$request->get("Tipe");
       if ($ctipe==null || $ctipe=="")
       {

         $MySQLi = mysqli_connect($domain, $username, $password, $database);

         if($dataDigunakan == 'Pesanan' ){

           $QueryGetDataBarang = "SELECT DATE_FORMAT(p.Tanggal,'%Y-%m') AS periode,SUM(dscp.Jumlah) as jml
           FROM pemesanan p
           inner join detailsepatucatatpemesanan dscp on p.Nomor = dscp.PemesananID
           inner join detailsepatu ds on dscp.DetailSepatuID = ds.ID
           inner join tipe t on t.ID = ds.TipeID
           inner join mereksepatu ms on t.MerekSepatuID = ms.ID
           where ms.ID = '$merek' ".
           "GROUP BY DATE_FORMAT(p.Tanggal,'%Y-%m')";
         }
         else{
           $QueryGetDataBarang = "SELECT DATE_FORMAT(p.Tanggal,'%Y-%m') AS periode,SUM(dscp.Jumlah) as jml
           FROM penjualan p
           inner join detailsepatucatatpenjualan dscp on p.Nomor = dscp.PenjualanID
           inner join detailsepatu ds on dscp.DetailSepatuID = ds.ID
           inner join tipe t on t.ID = ds.TipeID
           inner join mereksepatu ms on t.MerekSepatuID = ms.ID
           where ms.ID = '$merek' ".
          "GROUP BY DATE_FORMAT(p.Tanggal,'%Y-%m')";
         }
         $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
         $DataBarang = array();
         while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
           $DataBarang[$Hasil["periode"]] = $Hasil["jml"];
         }
         //return $DataBarang;
       }
       else {

         $MySQLi = mysqli_connect($domain, $username, $password, $database);
         if($dataDigunakan == 'Pesanan' ){
           $QueryGetDataBarang = "SELECT DATE_FORMAT(p.Tanggal,'%Y-%m') AS periode,SUM(dscp.Jumlah) as jml
           FROM pemesanan p
           inner join detailsepatucatatpemesanan dscp on p.Nomor = dscp.PemesananID
           inner join detailsepatu ds on dscp.DetailSepatuID = ds.ID
           inner join tipe t on t.ID = ds.TipeID
           inner join mereksepatu ms on t.MerekSepatuID = ms.ID
           where ms.ID = '$merek' and t.ID = '$tipe' ".
          "GROUP BY DATE_FORMAT(p.Tanggal,'%Y-%m')";
         }
         else{
           $QueryGetDataBarang = "SELECT DATE_FORMAT(p.Tanggal,'%Y-%m') AS periode,SUM(dscp.Jumlah) AS jml
           FROM penjualan p
           inner join detailsepatucatatpenjualan dscp on p.Nomor = dscp.PenjualanID
           inner join detailsepatu ds on dscp.DetailSepatuID = ds.ID
           inner join tipe t on t.ID = ds.TipeID
           inner join mereksepatu ms on t.MerekSepatuID = ms.ID
           where ms.ID = '$merek' and t.ID = '$tipe' ".
           "GROUP BY DATE_FORMAT(p.Tanggal,'%Y-%m')";
         }
         $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
         $DataBarang = array();
         while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
           $DataBarang[$Hasil["periode"]] = $Hasil["jml"];
         }


         //return $DataBarang;
       }
       //echo "before";
       $dataDigunakan=array();
       $tgl=date("Y-m-d");
       if ($request->get("DataAwalPeramalan")!=null && $request->get("DataAwalPeramalan")!="")
       {
         $tgl=$request->get("DataAwalPeramalan")."-01";
       }
       $tglC=date("Y-m-d",strtotime("+1 month",strtotime($tgl)));
       $tahun=array();
       $dataPer=array();
       for ($i=0;$i<96;$i++)
       {

          $per=date("Y-m",strtotime($tgl));
          array_push($dataPer,$per);

          $tahunC=date("Y",strtotime($tgl));
          if (!in_array($tahunC,$tahun))
          {
            array_push($tahun,$tahunC);
          }
          $tgl = date("Y-m-d",strtotime("-1 month",strtotime($tgl)));
          //echo "in here <br/>";
          if (isset($DataBarang[$per]))
          {
            //echo $DataBarang[$per]."<br/>";
            array_push($dataDigunakan,$DataBarang[$per]);
          }
          else {
            array_push($dataDigunakan,0);
          }
       }

       $dataDigunakan=array_reverse($dataDigunakan);
       $tahun=array_reverse($tahun);
       $dataPer=array_reverse($dataPer);
       //
       $Forecasting = new Forecasting();

       // Musim Awal
       $DataAwal = $dataDigunakan;
       $TahunAwal = $tahun;
       $Hasil12MA = $Forecasting->Proses12MA($DataAwal);
       $Hasil2x12MA = $Forecasting->Proses2x12MA($Hasil12MA);
       $Ratio = $Forecasting->ProsesRatio($Hasil2x12MA, $DataAwal);
       $TabelAwal = $Forecasting->ProsesTabelAwal($Ratio);
       $Tabel3x3MA = $Forecasting->ProsesTabel3x3MA($TabelAwal);
       $TabelStandartDeviasi = $Forecasting->ProsesTabelStandartDeviasi($TabelAwal, $Tabel3x3MA);
       $RataRataStandartDeviasi = $Forecasting->ProsesRataRataStandartDeviasi($TabelStandartDeviasi);
       $TabelHasilCheck = $Forecasting->ProsesTabelCheck($Tabel3x3MA, $TabelAwal, $RataRataStandartDeviasi);
       $RataRataCheck = $Forecasting->ProsesRataRataCheck($TabelHasilCheck);
       $TabelHasilKuning = $Forecasting->ProsesTabelKuning($TabelHasilCheck, $RataRataCheck);
       $Tabel3x3MAFaktorMusimanAwal = $Forecasting->ProsesTabel3x3MAFaktorMusimanAwal($TabelHasilKuning);
       $TabelDeretAwalSetelahPenyesuaianMusimAwal = $Forecasting->ProsesTabelDeretAwalSetelahPenyesuaianMusimAwal($DataAwal, $Tabel3x3MAFaktorMusimanAwal);

       // Musim Akhir
       //$DataAkhir = $Forecasting->GetDataAkhir();

       $UbahDataAwalKeDataAkhir = $Forecasting->AwalKeAkhir($TabelDeretAwalSetelahPenyesuaianMusimAwal);
       $DataAwalMusimAkhir = $Forecasting->GetDataAwalMusimAwal($UbahDataAwalKeDataAkhir);
       $DataBantuan = $Forecasting->GetDataBantuan();
       $Tabel15SpancerAkhir = $Forecasting->ProsesTabel15SpancerAkhir($DataAwalMusimAkhir, $DataBantuan, $DataAwal);
       $TabelRatioAkhir = $Forecasting->ProsesTabelRatioAkhir($DataAwal, $Tabel15SpancerAkhir);
       $TabelTCAkhir = $Forecasting->ProsesTabelTCAkhir($TabelRatioAkhir);
       $IndexMusiman = $Forecasting->ProsesIndexMusiman($TabelTCAkhir);
       $Tabel3x3MAFaktorMusimanAkhir = $Forecasting->ProsesTabel3x3MAFaktorMusimanAkhir($TabelTCAkhir);
       $TabelStandartDeviasiAkhir = $Forecasting->ProsesTabelStandartDeviasiAkhir($TabelTCAkhir, $Tabel3x3MAFaktorMusimanAkhir);
       $TabelAkarStandartDeviasi = $Forecasting->ProsesAkarStandartDeviasi($TabelStandartDeviasiAkhir);
       $TabelBesarKecilMusimAkhir = $Forecasting->ProsesBesarKecilMusimAkhir($TabelTCAkhir, $Tabel3x3MAFaktorMusimanAkhir, $TabelAkarStandartDeviasi);
       $TabelRataBesarKecil = $Forecasting->ProsesRataBesarKecil($TabelBesarKecilMusimAkhir);
       $TabelKuningKuning = $Forecasting->ProsesTabelKuningKuning($TabelBesarKecilMusimAkhir, $TabelRataBesarKecil);
       $Tabel3x3MAFaktorMusimanAkhirFinal = $Forecasting->ProsesTabel3x3MAFaktorMusimanAkhirFinal($TabelKuningKuning);
       $Tabel3x3MARata = $Forecasting->ProsesTabel3x3MARata($Tabel3x3MAFaktorMusimanAkhirFinal);
       $TabelDeretAwalSetelahPenyesuaianMusimAkhir = $Forecasting->ProsesTabelDeretAwalSetelahPenyesuaianMusimAkhir($DataAwal, $Tabel3x3MAFaktorMusimanAkhirFinal);

       // Taksiran

       $UbahDataAkhirKeDataTaksiran=array();

         for ($j=0;$j<count($TabelDeretAwalSetelahPenyesuaianMusimAkhir[0]);$j++)
         {
           for ($i=0;$i<count($TabelDeretAwalSetelahPenyesuaianMusimAkhir);$i++)
           {
             if ($TabelDeretAwalSetelahPenyesuaianMusimAkhir[$i][$j]!=-1)
             {
              array_push($UbahDataAkhirKeDataTaksiran,$TabelDeretAwalSetelahPenyesuaianMusimAkhir[$i][$j]);
             }
           }
         }

       //echo "<br/>Ukuran data akhir :".count($UbahDataAkhirKeDataTaksiran)."<br/>";
       //$UbahDataAkhirKeDataTaksiran = $TabelDeretAwalSetelahPenyesuaianMusimAkhir;
       // $UbahDataAkhirKeDataTaksiran = $Forecasting->AkhirKeTaksiran($TabelDeretAwalSetelahPenyesuaianMusimAkhir);
       $DataAwalTaksiran = $Forecasting->GetDataAwalTaksiran($UbahDataAkhirKeDataTaksiran);

       $DataBantuan = $Forecasting->GetDataBantuan();

       $Tabel15Spancer = $Forecasting->ProsesTabel15Spancer($DataAwalTaksiran, $DataBantuan, $DataAwal);
       $TabelRatio = $Forecasting->ProsesTabelRatio($DataAwal, $Tabel15Spancer);
       $TabelTC = $Forecasting->ProsesTabelTC($Tabel15Spancer);
       $TabelDataAkhir = $Forecasting->GetTabelDataAkhir($UbahDataAkhirKeDataTaksiran);
       $TabelR = $Forecasting->ProsesTabelR($TabelDataAkhir, $TabelTC);

       // 3MA
       $Tabel3MAKomponenTCDenganBantuan0 = $Forecasting->ProsesTabel3MAKomponenTCBantuan0($UbahDataAkhirKeDataTaksiran);
       $Tabel3MAKomponenTCTanpa0 = $Forecasting->ProsesTabel3MAKomponenTCTanpa0($UbahDataAkhirKeDataTaksiran);
       $TabelRamalanTCI = $Forecasting->RamalanTCI($Tabel3MAKomponenTCDenganBantuan0, $Tabel3x3MARata);
       $TabelUjiProsesntaseDataAkhir = $Forecasting->UjiPresentaseDataAkhir($Tabel3MAKomponenTCDenganBantuan0);

       $last=count($Tabel3MAKomponenTCDenganBantuan0)-2;
       $TabelHasilRamalanMusimAkhirDanKomponenTC = $Forecasting->HasilRamalanMusimAkhirDanKomponenTC(end($UbahDataAkhirKeDataTaksiran),$TabelUjiProsesntaseDataAkhir,end($Tabel3MAKomponenTCDenganBantuan0),$Tabel3MAKomponenTCDenganBantuan0[$last]);
       $TabelHasilAkhirProsesPeramalan = $Forecasting->HasilAkhirProsesPeramalan($Tabel3x3MARata, $TabelHasilRamalanMusimAkhirDanKomponenTC["kembalian2"]);
       $TabelMSE = $Forecasting->MSE($DataAwal, $TabelRamalanTCI);



       $TabelRamalanTCDenganBantuan0 = $Forecasting->ProsesTabelRamalanTCBantuan0($Tabel3MAKomponenTCDenganBantuan0, $Tabel3x3MARata);
       $TabelRamalanTCTanpa0 = $Forecasting->ProsesTabelRamalanTCTanpa0($TabelRamalanTCDenganBantuan0);
       $TabelKuadratDenganBantuan0 = $Forecasting->ProsesTabelKuadratBantuan0($TabelRamalanTCDenganBantuan0, $DataAwal);
       $TabelKuadratTanpa0 = $Forecasting->ProsesTabelKuadratTanpa0($TabelKuadratDenganBantuan0);
       $RataRata = $Forecasting->ProsesTabelRataKuadrat($TabelKuadratTanpa0);
       $TabelTC3MA = $Forecasting->ProsesTabelTC3MA($Tabel3MAKomponenTCDenganBantuan0);
       $RataKurangBagi = $Forecasting->ProsesTabelRataKurangBagi($Tabel3MAKomponenTCTanpa0);
       $TabelHasil = $Forecasting->ProsesTabelHasil($RataKurangBagi);
       $RataRataAkhir = $Forecasting->ProsesTabelRataAkhir($RataKurangBagi);
       $HasilRamalan = $Forecasting->ProsesTabelRamalan($UbahDataAkhirKeDataTaksiran, $RataRataAkhir);
       // print_r($HasilRamalan);

       return view('Forecasting.Create', compact('tglC','dataPer','TabelAwal', 'Tabel3x3MA', 'TabelStandartDeviasi', 'RataRataStandartDeviasi', 'TabelHasilCheck', 'RataRataCheck', 'TabelHasilKuning', 'Tabel3x3MAFaktorMusimanAwal', 'TabelDeretAwalSetelahPenyesuaianMusimAwal',
                   'TabelTCAkhir', 'Tabel3x3MAFaktorMusimanAkhir', 'TabelStandartDeviasiAkhir', 'TabelBesarKecilMusimAkhir', 'TabelKuningKuning', 'Tabel3x3MAFaktorMusimanAkhirFinal', 'TabelDeretAwalSetelahPenyesuaianMusimAkhir',
                   'TabelTC', 'TabelR', 'ID', 'Jabatan', 'IDJabatan', 'Name',
                   'RataRata', 'TabelTC3MA', 'TabelHasil', 'RataRataAkhir', 'HasilRamalan',
                   'Tabel3MAKomponenTCDenganBantuan0', 'TabelRamalanTCI', 'TabelUjiProsesntaseDataAkhir', 'TabelHasilAkhirProsesPeramalan', 'TabelMSE','DataAwal','tahun'));
       //
    }
    public function Create2()
    {

        $Forecasting = new Forecasting();

        // Musim Awal
        $DataAwal = $Forecasting->GetDataAwal();
        $TahunAwal = $Forecasting->GetTahunAwal();
        $Hasil12MA = $Forecasting->Proses12MA($DataAwal);
        $Hasil2x12MA = $Forecasting->Proses2x12MA($Hasil12MA);
        $Ratio = $Forecasting->ProsesRatio($Hasil2x12MA, $DataAwal);
        $TabelAwal = $Forecasting->ProsesTabelAwal($Ratio);
        $Tabel3x3MA = $Forecasting->ProsesTabel3x3MA($TabelAwal);
        $TabelStandartDeviasi = $Forecasting->ProsesTabelStandartDeviasi($TabelAwal, $Tabel3x3MA);
        $RataRataStandartDeviasi = $Forecasting->ProsesRataRataStandartDeviasi($TabelStandartDeviasi);
        $TabelHasilCheck = $Forecasting->ProsesTabelCheck($Tabel3x3MA, $TabelAwal, $RataRataStandartDeviasi);
        $RataRataCheck = $Forecasting->ProsesRataRataCheck($TabelHasilCheck);
        $TabelHasilKuning = $Forecasting->ProsesTabelKuning($TabelHasilCheck, $RataRataCheck);
        $Tabel3x3MAFaktorMusimanAwal = $Forecasting->ProsesTabel3x3MAFaktorMusimanAwal($TabelHasilKuning);
        $TabelDeretAwalSetelahPenyesuaianMusimAwal = $Forecasting->ProsesTabelDeretAwalSetelahPenyesuaianMusimAwal($DataAwal, $Tabel3x3MAFaktorMusimanAwal);

        // Musim Akhir
        // $DataAkhir = $Forecasting->GetDataAkhir();
        $UbahDataAwalKeDataAkhir = $Forecasting->AwalKeAkhir($TabelDeretAwalSetelahPenyesuaianMusimAwal);
        $DataAwalMusimAkhir = $Forecasting->GetDataAwalMusimAwal($UbahDataAwalKeDataAkhir);
        $DataBantuan = $Forecasting->GetDataBantuan();
        $Tabel15SpancerAkhir = $Forecasting->ProsesTabel15SpancerAkhir($DataAwalMusimAkhir, $DataBantuan, $DataAwal);
        $TabelRatioAkhir = $Forecasting->ProsesTabelRatioAkhir($DataAwal, $Tabel15SpancerAkhir);
        $TabelTCAkhir = $Forecasting->ProsesTabelTCAkhir($TabelRatioAkhir);
        $IndexMusiman = $Forecasting->ProsesIndexMusiman($TabelTCAkhir);
        $Tabel3x3MAFaktorMusimanAkhir = $Forecasting->ProsesTabel3x3MAFaktorMusimanAkhir($TabelTCAkhir);
        $TabelStandartDeviasiAkhir = $Forecasting->ProsesTabelStandartDeviasiAkhir($TabelTCAkhir, $Tabel3x3MAFaktorMusimanAkhir);
        $TabelAkarStandartDeviasi = $Forecasting->ProsesAkarStandartDeviasi($TabelStandartDeviasiAkhir);
        $TabelBesarKecilMusimAkhir = $Forecasting->ProsesBesarKecilMusimAkhir($TabelTCAkhir, $Tabel3x3MAFaktorMusimanAkhir, $TabelAkarStandartDeviasi);
        $TabelRataBesarKecil = $Forecasting->ProsesRataBesarKecil($TabelBesarKecilMusimAkhir);
        $TabelKuningKuning = $Forecasting->ProsesTabelKuningKuning($TabelBesarKecilMusimAkhir, $TabelRataBesarKecil);
        $Tabel3x3MAFaktorMusimanAkhirFinal = $Forecasting->ProsesTabel3x3MAFaktorMusimanAkhirFinal($TabelKuningKuning);
        $Tabel3x3MARata = $Forecasting->ProsesTabel3x3MARata($Tabel3x3MAFaktorMusimanAkhirFinal);
        $TabelDeretAwalSetelahPenyesuaianMusimAkhir = $Forecasting->ProsesTabelDeretAwalSetelahPenyesuaianMusimAkhir($DataAwal, $Tabel3x3MAFaktorMusimanAkhirFinal);

        // Taksiran
        $UbahDataAkhirKeDataTaksiran = $Forecasting->GetDataAkhir();
        // $UbahDataAkhirKeDataTaksiran = $Forecasting->AkhirKeTaksiran($TabelDeretAwalSetelahPenyesuaianMusimAkhir);
        $DataAwalTaksiran = $Forecasting->GetDataAwalTaksiran($UbahDataAkhirKeDataTaksiran);
        $DataBantuan = $Forecasting->GetDataBantuan();
        $Tabel15Spancer = $Forecasting->ProsesTabel15Spancer($DataAwalTaksiran, $DataBantuan, $DataAwal);
        $TabelRatio = $Forecasting->ProsesTabelRatio($DataAwal, $Tabel15Spancer);
        $TabelTC = $Forecasting->ProsesTabelTC($Tabel15Spancer);
        $TabelDataAkhir = $Forecasting->GetTabelDataAkhir($UbahDataAkhirKeDataTaksiran);
        $TabelR = $Forecasting->ProsesTabelR($TabelDataAkhir, $TabelTC);

        // 3MA
        $Tabel3MAKomponenTCDenganBantuan0 = $Forecasting->ProsesTabel3MAKomponenTCBantuan0($UbahDataAkhirKeDataTaksiran);
        $Tabel3MAKomponenTCTanpa0 = $Forecasting->ProsesTabel3MAKomponenTCTanpa0($UbahDataAkhirKeDataTaksiran);
        $TabelRamalanTCI = $Forecasting->RamalanTCI($Tabel3MAKomponenTCDenganBantuan0, $Tabel3x3MARata);
        $TabelUjiProsesntaseDataAkhir = $Forecasting->UjiPresentaseDataAkhir($Tabel3MAKomponenTCDenganBantuan0);

        $last=count($Tabel3MAKomponenTCDenganBantuan0)-2;
        $TabelHasilRamalanMusimAkhirDanKomponenTC = $Forecasting->HasilRamalanMusimAkhirDanKomponenTC(end($UbahDataAkhirKeDataTaksiran),$TabelUjiProsesntaseDataAkhir,end($Tabel3MAKomponenTCDenganBantuan0),$Tabel3MAKomponenTCDenganBantuan0[$last]);
        $TabelHasilAkhirProsesPeramalan = $Forecasting->HasilAkhirProsesPeramalan($Tabel3x3MARata, $TabelHasilRamalanMusimAkhirDanKomponenTC["kembalian2"]);
        $TabelMSE = $Forecasting->MSE($DataAwal, $TabelRamalanTCI);



        $TabelRamalanTCDenganBantuan0 = $Forecasting->ProsesTabelRamalanTCBantuan0($Tabel3MAKomponenTCDenganBantuan0, $Tabel3x3MARata);
        $TabelRamalanTCTanpa0 = $Forecasting->ProsesTabelRamalanTCTanpa0($TabelRamalanTCDenganBantuan0);
        $TabelKuadratDenganBantuan0 = $Forecasting->ProsesTabelKuadratBantuan0($TabelRamalanTCDenganBantuan0, $DataAwal);
        $TabelKuadratTanpa0 = $Forecasting->ProsesTabelKuadratTanpa0($TabelKuadratDenganBantuan0);
        $RataRata = $Forecasting->ProsesTabelRataKuadrat($TabelKuadratTanpa0);
        $TabelTC3MA = $Forecasting->ProsesTabelTC3MA($Tabel3MAKomponenTCDenganBantuan0);
        $RataKurangBagi = $Forecasting->ProsesTabelRataKurangBagi($Tabel3MAKomponenTCTanpa0);
        $TabelHasil = $Forecasting->ProsesTabelHasil($RataKurangBagi);
        $RataRataAkhir = $Forecasting->ProsesTabelRataAkhir($RataKurangBagi);
        $HasilRamalan = $Forecasting->ProsesTabelRamalan($UbahDataAkhirKeDataTaksiran, $RataRataAkhir);
        // print_r($HasilRamalan);

        return view('Forecasting.Create', compact('TabelAwal', 'Tabel3x3MA', 'TabelStandartDeviasi', 'RataRataStandartDeviasi', 'TabelHasilCheck', 'RataRataCheck', 'TabelHasilKuning', 'Tabel3x3MAFaktorMusimanAwal', 'TabelDeretAwalSetelahPenyesuaianMusimAwal',
                    'TabelTCAkhir', 'Tabel3x3MAFaktorMusimanAkhir', 'TabelStandartDeviasiAkhir', 'TabelBesarKecilMusimAkhir', 'TabelKuningKuning', 'Tabel3x3MAFaktorMusimanAkhirFinal', 'TabelDeretAwalSetelahPenyesuaianMusimAkhir',
                    'TabelTC', 'TabelR',
                    'RataRata', 'TabelTC3MA', 'TabelHasil', 'RataRataAkhir', 'HasilRamalan',
                    'Tabel3MAKomponenTCDenganBantuan0', 'TabelRamalanTCI', 'TabelUjiProsesntaseDataAkhir', 'TabelHasilAkhirProsesPeramalan', 'TabelMSE'));
    }
}
