<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use App\Karyawan;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $Request)
    {
        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawan();
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('MasterData.Pengeluaran', compact('DataKaryawan', 'ID', 'Nama'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        $Pengeluaran = new Pengeluaran();
        $Pengeluaran->StorePengeluaran($Request);
        return redirect('/Pengeluaran')->with('status', 'Data Pengeluaran di Perusahaan Anda Telah Disimpan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $Request)
    {
        $Pengeluaran = new Pengeluaran();
        $Pengeluaran->UpdatePengeluaran($Request);
        return redirect('/Pengeluaran')->with('status', 'Data Pengeluaran di Perusahaan Anda Telah Diubah!');
    }
}
