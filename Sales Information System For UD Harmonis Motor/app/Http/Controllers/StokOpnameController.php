<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StokOpname;
use App\Barang;
use App\Karyawan;

class StokOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawan();
        return view('StokOpname.Index', compact('ID', 'Nama', 'DataKaryawan'));
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
        $Barang = new Barang();
        $DataBarang = $Barang->GetBarang();
        return view('StokOpname.Create', compact('ID', 'Nama', 'DataKaryawan', 'DataBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        //dd($Request);
        $StokOpname = new StokOpname();
        $StokOpname->StoreStokOpname($Request);
        return redirect('/BuatStokOpname')->with('status', 'Data Stok Opname di Perusahaan Anda Telah Disimpan!');
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
        $StokOpname = new StokOpname();
        $StokOpname->UpdateStokOpname($Request);
        return redirect('/BuatStokOpname')->with('status', 'Data Stok Opname di Perusahaan Anda Telah Diubah!');
    }

    public function Cetak($ID)
    {
        $Cetak = new StokOpname();
        $DataStokO = $Cetak->HeaderNota($ID);
        $DataDetailStokOpname = $Cetak->DataTable($ID);
        $DataBaris = $Cetak->HitungBaris($ID);
        return view('StokOpname.CetakStokOpname', compact('DataStokO', 'DataDetailStokOpname', 'DataBaris'));
    }
}
