<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatNotaPesan;
//use App\Sepatu;
use App\Pemesanan;
//use App\Penerimaan;
use DB;

class CatatNotaPesanController extends Controller
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
        $Jabatan = $Request->session()->get('Jabatan');
        $Nota = new Pemesanan();
        $DataBarang = $Nota->GetBarang();
        $DataPelanggan = $Nota->GetCustomer();
        $DataUser = $Nota->GetUser();
        return view('NotaPesan.DataCatatNotaPesan', compact('ID', 'Name', 'IDJabatan', 'Jabatan', 'DataBarang', 'DataPelanggan', 'DataUser'));
    }

    public function PrintLaporan(Request $Request)
    {
        $PrintLaporan = new Pemesanan();
        $DataDetailSepatu = $PrintLaporan->PrintLaporan($Request);
        $BarisLaporan = $PrintLaporan->HitungBarisLaporan($Request);
        return view('NotaPesan.CetakLaporanNotaPesan', compact('DataDetailSepatu', 'BarisLaporan'));
    }

    public function PrintNotaPesan($ID)
    {
        $Cetak = new Pemesanan();
        $DataPesanan = $Cetak->HeaderDetailNota($ID);
        $DataDetailSepatu = $Cetak->DataTable($ID);
        $Databaris = $Cetak->HitungBaris($ID);
        return view('NotaPesan.CetakNotaPesan', compact('DataPesanan', 'DataDetailSepatu', 'Databaris'));
    }

    public function GetHarga($id){
      $Nota = new Pemesanan();
      $HargaBarang = $Nota->GetPrice($id);
      echo json_encode($HargaBarang);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $CatatNotaPesan = new Pemesanan();
        $CatatNotaPesan->StoreNotaPesan($Request);
        return redirect('/DataNotaPesan')->with('status', 'Data Nota Beli Anda Telah Disimpan!');
    }

    public function Ukuran($id){
      $Ukuran = new Pemesanan();
      $DataUkuran = $Ukuran->GetUkuran($id);
      echo "<option value=''>Pilih Ukuran</option>";
      for ($i=0; $i < count($DataUkuran) ; $i++) {
         echo '<option value="'.$DataUkuran[$i]['ID'].'">'.$DataUkuran[$i]['Ukuran'].'</option>';
      }
    }

    public function Warna($id){
      $Warna = new Pemesanan();
      $DataWarna = $Warna->GetWarna($id);
      echo "<option value=''>Pilih Warna</option>";
      for ($i=0; $i < count($DataWarna) ; $i++) {
         echo '<option value="'.$DataWarna[$i]['ID'].'">'.$DataWarna[$i]['Warna'].'</option>';
      }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    /*public function Update(Request $Request)
    {
        $CatatNotaBeli = new CatatNotaPesan();
        $CatatNotaBeli->UpdateNotaBeli($Request);
        return redirect('/DataNotaBeli')->with('status', 'Data Nota Beli Anda Telah Diubah!');
    }*/
}
