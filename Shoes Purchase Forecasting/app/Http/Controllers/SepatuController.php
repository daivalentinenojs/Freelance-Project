<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sepatu;
use DB;

class SepatuController extends Controller
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
        return view('MasterData.DataSepatu', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Sepatu = new Sepatu();
        $Sepatu->StoreSepatu($Request);
        return redirect('/DataSepatu')->with('status', 'Data Sepatu Sepatu Anda Telah Disimpan!');
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
        $Sepatu = new Sepatu();
        $Sepatu->UpdateSepatu($Request);
        return redirect('/DataSepatu')->with('status', 'Data Sepatu Sepatu Anda Telah Diubah!');
    }
}
