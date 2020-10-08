<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\CatatNotaBeli;
//use App\Sepatu;
//use App\PesanPembelian;
use App\Penjualan;
use DB;
//use App\DetailSepatuCatatPesanPembelian;

class CatatNotaJualController extends Controller
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
        $Nota = new Penjualan();
        $DataPesanan = $Nota->GetNotaPesan();
        return view('NotaPesan.DataCatatNotaJual', compact('ID', 'Name', 'IDJabatan', 'Jabatan', 'DataPesanan'));
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

        $CatatNotaPenjualan = new Penjualan();
        $CatatNotaPenjualan->StoreNotaPenjualan($Request);
        return redirect('/DataNotaJual')->with('status', 'Data Nota Jual Anda Telah Disimpan!');
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
        $CatatNotaBeli = new CatatNotaBeli();
        $CatatNotaBeli->UpdateNotaBeli($Request);
        return redirect('/DataNotaTerima')->with('status', 'Data Nota Terima Anda Telah Diubah!');
    }*/

    public function PrintNotaJual($ID)
    {
        $Cetak = new Penjualan();
        $DataPenjualan = $Cetak->HeaderDetailNota($ID);
        $DataDetailSepatu = $Cetak->DataTable($ID);
        $Databaris = $Cetak->HitungBaris($ID);
        return view('NotaPesan.CetakNotaJual', compact('DataPenjualan', 'DataDetailSepatu', 'Databaris'));
    }

    public function PrintLaporan(Request $Request)
    {
        $PrintLaporan = new Penjualan();
        $DataDetailSepatu = $PrintLaporan->PrintLaporan($Request);
        $Total = $PrintLaporan->HitungTotalLaporan($Request);
        $BarisLaporan = $PrintLaporan->HitungBarisLaporan($Request);
        return view('NotaPesan.CetakLaporanNotaJual', compact('DataDetailSepatu', 'Total', 'BarisLaporan'));
    }

    public function LihatNota($ID){
      $Data = new Penjualan();
      $Data->DataNota($ID);
      $DataDetailSepatu = $Data->DataNota($ID);
      /*
      for($i = 0; $i < count($Data->DataNota($ID)); $i++){
        $j = $i+1;

        echo "<tr style='text-align:center'><td>".$j."</td>";
        echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['ID']."' name='IDSepatu[]'>".$DataDetailSepatu[$i]['Merek']." ".$DataDetailSepatu[$i]['Tipe']." ".$DataDetailSepatu[$i]['Warna']." ".$DataDetailSepatu[$i]['Ukuran']."</td>";
        echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Jumlah']."' name='Jumlah[]'>".$DataDetailSepatu[$i]['Jumlah']."</td>";
        echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Stoksaatini']."' name='Stoksaatini[]'>".$DataDetailSepatu[$i]['Stoksaatini']."</td>";
        echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Harga']."' name='Harga[]'> Rp ".formatMoney($DataDetailSepatu[$i]['Harga'])."</td>";
        if($DataDetailSepatu[$i]['Stoksaatini'] < $DataDetailSepatu[$i]['Jumlah']){
          echo "<td>"."<a href = '/Forecasting/public/DataKonversiDetail' target='_blank'>Klik disini</a>"."</td>";
        }
        else {
          echo "<td></td>";
        }
        echo "</tr>";

      }
      echo "<tr>";
      echo "<td style='text-align:Right;' colspan='4'>Total Harga</td>";
      echo "<td style='text-align:center;'>"."<input type='hidden' value='".$DataDetailSepatu[0]['Total']."' name='Total[]'> Rp ".formatMoney($DataDetailSepatu[0]['Total'])."</td>";
      echo "<td></td>";
      echo "</tr>";
      */
      echo json_encode($DataDetailSepatu);
      //echo "test";
      //echo "<input type='text'/>"."tets";
      //echo "<tr><td><input type='text'></td></tr>";
      //echo "<div class='form-group'>";
      //echo "<label class='col-md-10 control-label'>Total Biaya Barang</label>";
      //echo "<div class='col-md-2'>";
      //echo "<input type='text' id='TotalBiaya' name='TotalBiaya' readonly class='form-control'  value='".$DataDetailSepatu[0]['Harga']."' placeholder='0' style='background:white; color:black;'/>";

      //echo "<input type='hidden' id='BiayaTotal' name='BiayaTotal' value='0' readonly class='form-control' value='' placeholder='0' style='background:white; color:black;'/>";
      //echo "</div>";
      //echo "</div>";
      //print_r($Data);
      //for($i=0;$i<sizeof($Data);$i++){

      //}
    }
}

function formatMoney($number, $fractional = false){
  if($fractional){
    $number= sprintf('%.2f', $number);
  }
  while(true){
    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
    if ($replaced != $number){
      $number = $replaced;
    }
    else{
      break;
    }
  }
  return $number;
}

?>
