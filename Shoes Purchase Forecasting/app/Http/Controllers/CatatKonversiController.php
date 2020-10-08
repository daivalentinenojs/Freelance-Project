<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Sepatu;
use App\Konversi;
//use App\Penerimaan;
use DB;

class CatatKonversiController extends Controller
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
        $Nota = new Konversi();
        $DataBarang = $Nota->GetBarang();
        return view('Konversi.DataCatatKonversi', compact('ID', 'Name', 'IDJabatan', 'Jabatan', 'DataBarang'));
    }

    public function GetStok($id){
      $Stok = new Konversi();
      $StokSaatIni = $Stok->GetStok($id);
      echo $StokSaatIni;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Konvert = new Konversi();
        $Konvert->StoreKonversi($Request);
        return redirect('/DataNotaBeli')->with('status', 'Data Nota Beli Anda Telah Disimpan!');
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
        return redirect('/DataNotaBeli')->with('status', 'Data Nota Beli Anda Telah Diubah!');
    }
}
