<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReturBeli;
use App\Karyawan;
use App\Pemasok;
use App\NotaBeli;
use App\Barang;

class ReturBeliController extends Controller
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
        $NotaBeli = new NotaBeli();
        $DataNotaBeli = $NotaBeli->GetNotaBeli();
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('ReturBeli.Index', compact('DataKaryawan', 'DataNotaBeli', 'ID', 'Nama'));
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
        $NotaBeli = new NotaBeli();
        $DataNotaBeli = $NotaBeli->GetNotaBeli();
        $Barang = new Barang();
        $DataBarang = $Barang->GetBarang();
        return view('ReturBeli.Create', compact('ID', 'Nama', 'DataKaryawan', 'DataPemasok', 'DataNotaBeli', 'DataBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        $ReturBeli = new ReturBeli();
        $ReturBeli->StoreReturBeli($Request);
        return redirect('/BuatReturBeli')->with('status', 'Data Retur Beli di Perusahaan Anda Telah Disimpan!');
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
        $ReturBeli = new ReturBeli();
        $ReturBeli->UpdateReturBeli($Request);
        return redirect('/BuatReturBeli')->with('status', 'Data Retur Beli di Perusahaan Anda Telah Diubah!');
    }

    public function Cetak($ID)
    {
        $Cetak = new ReturBeli();
        $DataReturB = $Cetak->HeaderNota($ID);
        $DataDetailReturBeli = $Cetak->DataTable($ID);
        $DataBaris = $Cetak->HitungBaris($ID);
        return view('ReturBeli.CetakReturBeli', compact('DataReturB', 'DataDetailReturBeli', 'DataBaris'));
    }
}
