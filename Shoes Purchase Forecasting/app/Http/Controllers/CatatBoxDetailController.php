<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailSepatuCatatDetailSepatu;
use DB;

class CatatBoxDetailController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return Response
      */
    public function Index(Request $Request)
    {
        $Merek = new DetailSepatuCatatDetailSepatu();
        //$DataMerek = $Merek->GetMerek();
        $DataBox = $Merek->GetBox();
        $DataUkuran = $Merek->GetUkuran(1);
        $ID = $Request->session()->get('ID'); // 3
        $Name = $Request->session()->get('Name'); // 4
        $IDJabatan = $Request->session()->get('IDJabatan');
        $Jabatan = $Request->session()->get('Jabatan');
        return view('MasterData/BoxDetail', compact('ID', 'Name', 'IDJabatan', 'Jabatan', 'DataMerek', 'DataBox', 'DataUkuran'));
    }

    public function GetSepatu($id){
      $Merek = new DetailSepatuCatatDetailSepatu();
      //$DataMerek = $Merek->GetMerek();
      $DataUkuran = $Merek->GetUkuran($id);
      //print_r($DataUkuran);
      //echo "<option value=''>Silahkan Pilih Ukuran Sepatu</option>";
      for ($i=0; $i < count($DataUkuran) ; $i++) {
         //$DataBarang[$i]['Harga'];
         echo '<option value="'.$DataUkuran[$i]['ID'].'">'.$DataUkuran[$i]['Merek'].' '.$DataUkuran[$i]['Tipe'].' '.$DataUkuran[$i]['Warna'].' '.$DataUkuran[$i]['Ukuran'].'</option>';
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $BoxDetail = new DetailSepatuCatatDetailSepatu();
        $BoxDetail->StoreBoxDetail($Request);

        return redirect('/DataBoxDetail')->with('status', 'Data Box Detail Anda Telah Disimpan!');
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
      $BoxDetail = new DetailSepatuCatatDetailSepatu();
      $BoxDetail->UpdateBoxDetail($Request);

      return redirect('/DataBoxDetail')->with('status', 'Data Box Detail Anda Telah Disimpan!');
    }
}
