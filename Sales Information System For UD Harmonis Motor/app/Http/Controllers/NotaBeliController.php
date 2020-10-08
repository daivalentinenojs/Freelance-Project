<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotaBeli;
use App\Karyawan;
use App\Pemasok;
use App\Barang;

class NotaBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $Request)
    {
        $Pemasok = new Pemasok();
        $DataPemasok = $Pemasok->GetPemasok();
        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawan();
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('NotaBeli.Index', compact('DataPemasok', 'DataKaryawan', 'ID', 'Nama'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Create(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawan();
        $Pemasok = new Pemasok();
        $DataPemasok = $Pemasok->GetPemasok();
        $Barang = new Barang();
        $DataBarang = $Barang->GetBarang();
        return view('NotaBeli.Create', compact('ID', 'Nama', 'DataKaryawan', 'DataPemasok', 'DataBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        $NotaBeli = new NotaBeli();
        $NotaBeli->StoreNotaBeli($Request);
        return redirect('/BuatNotaBeli')->with('status', 'Data Nota Beli di Perusahaan Anda Telah Disimpan!');
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
        $NotaBeli = new NotaBeli();
        $NotaBeli->UpdateNotaBeli($Request);
        return redirect('/BuatNotaBeli')->with('status', 'Data Nota Beli di Perusahaan Anda Telah Diubah!');
    }

    public function Cetak($ID)
    {
        $Cetak = new NotaBeli();
        $DataNotaB = $Cetak->HeaderNota($ID);
        $DataDetailNotaBeli = $Cetak->DataTable($ID);
        $DataBaris = $Cetak->HitungBaris($ID);
        return view('NotaBeli.CetakNotaBeli', compact('DataNotaB', 'DataDetailNotaBeli', 'DataBaris'));
    }
}
