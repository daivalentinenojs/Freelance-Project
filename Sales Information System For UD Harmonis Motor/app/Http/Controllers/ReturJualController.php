<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReturJual;
use App\Karyawan;
use App\Pembeli;
use App\NotaJual;
use App\Barang;

class ReturJualController extends Controller
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
        $NotaJual = new NotaJual();
        $DataNotaJual = $NotaJual->GetNotaJual();
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('ReturJual.Index', compact('DataKaryawan', 'DataNotaJual', 'ID', 'Nama'));
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
        $Pembeli = new Pembeli();
        $DataPembeli = $Pembeli->GetPembeli(); 
        $NotaJual = new NotaJual();
        $DataNotaJual = $NotaJual->GetNotaJual();
        $Barang = new Barang();
        $DataBarang = $Barang->GetBarang();
        return view('ReturJual.Create', compact('ID', 'Nama', 'DataKaryawan', 'DataPembeli', 'DataNotaJual', 'DataBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        $ReturJual = new ReturJual();
        $ReturJual->StoreReturJual($Request);
        return redirect('/BuatReturJual')->with('status', 'Data Retur Jual di Perusahaan Anda Telah Disimpan!');
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
        $ReturJual = new ReturJual();
        $ReturJual->UpdateReturJual($Request);
        return redirect('/BuatReturJual')->with('status', 'Data Retur Jual di Perusahaan Anda Telah Diubah!');
    }

    public function Cetak($ID)
    {
        $Cetak = new ReturJual();
        $DataReturJ = $Cetak->HeaderNota($ID);
        $DataDetailReturJual = $Cetak->DataTable($ID);
        $DataBaris = $Cetak->HitungBaris($ID);
        return view('ReturJual.CetakReturJual', compact('DataReturJ', 'DataDetailReturJual', 'DataBaris'));
    }
}
