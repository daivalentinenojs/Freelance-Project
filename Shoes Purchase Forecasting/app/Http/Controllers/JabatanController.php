<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use DB;

class JabatanController extends Controller
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
        return view('MasterData.DataJabatan', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Jabatan = new Jabatan();
        $Jabatan->StoreJabatan($Request);
        return redirect('/DataJabatan')->with('status', 'Data Jabatan Anda Telah Disimpan!');
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
        $Jabatan = new Jabatan();
        $Jabatan->UpdateJabatan($Request);
        return redirect('/DataJabatan')->with('status', 'Data Jabatan Anda Telah Diubah!');
    }
}
