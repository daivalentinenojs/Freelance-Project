<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Supplier;
use App\DetailSepatu;
use App\SepatuCatatPembelian;
use App\PesanPembelian;
use DB;

class PenjualanController extends Controller
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
        return view('MasterData.DataPembelian', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Pembelian = new Pembelian();
        $Pembelian->StorePembelian($Request);
        return redirect('/DataPembelian')->with('status', 'Data Pembelian Anda Telah Disimpan!');
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
      $Pembelian= new Pembelian();
      $Pembelian->updatePembeliann($Request);
      return redirect('/DataPembelian')->with('status', 'Data Pembelian Anda Telah Diubah!');
    }
}
