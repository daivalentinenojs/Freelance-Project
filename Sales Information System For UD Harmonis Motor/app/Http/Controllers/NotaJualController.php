<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotaJual;
use App\Karyawan;
use App\Pembeli;
use App\Barang;

class NotaJualController extends Controller
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
        $Pembeli = new Pembeli();
        $DataPembeli = $Pembeli->GetPembeli();
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('NotaJual.Index', compact('DataKaryawan', 'DataPembeli', 'ID', 'Nama'));
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
        $Barang = new Barang();
        $DataBarang = $Barang->GetBarang();
        return view('NotaJual.Create', compact('ID', 'Nama', 'DataKaryawan', 'DataPembeli', 'DataBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        $NotaJual = new NotaJual();
        $NotaJual->StoreNotaJual($Request);
        return redirect('/BuatNotaJual')->with('status', 'Data Nota Jual di Perusahaan Anda Telah Disimpan!');
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
        $NotaJual = new NotaJual();
        $NotaJual->UpdateNotaJual($Request);
        return redirect('/BuatNotaJual')->with('status', 'Data Nota Jual di Perusahaan Anda Telah Diubah!');
    }

    public function Cetak($ID)
    {
        $Cetak = new NotaJual();
        $DataNotaJ = $Cetak->HeaderNota($ID);
        $DataDetailNotaJual = $Cetak->DataTable($ID);
        $DataBaris = $Cetak->HitungBaris($ID);
        return view('NotaJual.CetakNotaJual', compact('DataNotaJ', 'DataDetailNotaJual', 'DataBaris'));
    }
}
