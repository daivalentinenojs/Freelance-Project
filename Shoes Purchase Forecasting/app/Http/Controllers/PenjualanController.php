<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Customer;
use App\Sepatu;
use App\SepatuCatatPenjualan;
use App\Penjualan;
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
        return view('MasterData.DataPenjualan', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $SepatuCatatPenjualan = new SepatuCatatPenjualan();
        $SepatuCatatPenjualan->StoreSepatuCatatPenjualan($Request);
        return redirect('/DataPenjualan')->with('status', 'Data Penjualan Anda Telah Disimpan!');
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
      $SepatuCatatPenjualan= new SepatuCatatPenjualan();
      $SepatuCatatPenjualan->updateSepatuCatatTahun($Request);
      return redirect('/DataPenjualan')->with('status', 'Data Penjualan Anda Telah Diubah!');
    }
}
