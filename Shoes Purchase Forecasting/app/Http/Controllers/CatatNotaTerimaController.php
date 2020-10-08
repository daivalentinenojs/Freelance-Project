<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatNotaBeli;
//use App\Sepatu;
//use App\PesanPembelian;
use App\Penerimaan;
use DB;
//use App\DetailSepatuCatatPesanPembelian;

class CatatNotaTerimaController extends Controller
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
        $Nota = new Penerimaan();
        $DataPembelian = $Nota->GetNotaPesanPembelian();
        return view('NotaBeli.DataCatatNotaTerima', compact('ID', 'Name', 'IDJabatan', 'Jabatan', 'DataPembelian')); //, 'DataBarang', 'DataSupplier', 'DataUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
      //print_r($Request->get());

        $CatatNotaPenerimaan = new Penerimaan();
        $CatatNotaPenerimaan->StoreNotaTerima($Request);
        return redirect('/DataNotaTerima')->with('status', 'Data Nota Terima Anda Telah Disimpan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function Update(Request $Request)
    {
        $CatatNotaBeli = new CatatNotaBeli();
        $CatatNotaBeli->UpdateNotaBeli($Request);
        return redirect('/DataNotaTerima')->with('status', 'Data Nota Terima Anda Telah Diubah!');
    }

    public function PrintNotaTerima($ID)
    {
        $Cetak = new Penerimaan();
        $DataPesanPembelian = $Cetak->HeaderDetailNota($ID);
        $DataDetailSepatu = $Cetak->DataTable($ID);
        $Databaris = $Cetak->HitungBaris($ID);
        return view('NotaBeli.CetakNotaTerima', compact('DataPesanPembelian', 'DataDetailSepatu', 'Databaris'));
    }

    public function PrintLaporan(Request $Request)
    {
        $PrintLaporan = new Penerimaan();
        $DataDetailSepatu = $PrintLaporan->PrintLaporanPembelian($Request);
        $Total = $PrintLaporan->HitungTotalLaporan($Request);
        $BarisLaporan = $PrintLaporan->HitungBarisLaporan($Request);
        return view('NotaBeli.CetakLaporanNotaTerima', compact('DataDetailSepatu', 'Total', 'BarisLaporan'));
    }

    public function LihatNota($ID){
      $Data = new Penerimaan();
      $Data->DataNota($ID);
      $DataDetailSepatu = $Data->DataNota($ID);
      for($i = 0; $i < count($Data->DataNota($ID)); $i++){
        $j = $i+1;
        echo "<tr style='text-align:center'><td>".$j."</td>";
        echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['ID']."' name='IDSepatu[]'>".$DataDetailSepatu[$i]['Merek']." ".$DataDetailSepatu[$i]['Tipe']." ".$DataDetailSepatu[$i]['Warna']." ".$DataDetailSepatu[$i]['Ukuran']."</td>";
        echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Jumlah']."' name='Jumlah[]'>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Harga']."' name='Harga[]'>".$DataDetailSepatu[$i]['Jumlah']."</td>";
        echo "</tr>";
      }
      //print_r($Data);
      //for($i=0;$i<sizeof($Data);$i++){

      //}
    }
}
