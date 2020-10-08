<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatNotaBeli;
//use App\Sepatu;
use App\PesanPembelian;
//use App\Penerimaan;
use DB;

class CatatNotaBeliController extends Controller
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
        $Nota = new PesanPembelian();
        $DataBarang = $Nota->GetBarang();
        $DataSupplier = $Nota->GetSupplier();
        $DataUser = $Nota->GetUser();
        return view('NotaBeli.DataCatatNotaBeli', compact('ID', 'Name', 'IDJabatan', 'Jabatan', 'DataBarang', 'DataSupplier', 'DataUser'));
    }

    public function PrintNotaBeli($ID)
    {
        $Cetak = new PesanPembelian();
        $DataPesanPembelian = $Cetak->HeaderDetailNota($ID);
        $DataDetailSepatu = $Cetak->DataTable($ID);
        $Databaris = $Cetak->HitungBaris($ID);
        return view('NotaBeli.CetakNotaBeli', compact('DataPesanPembelian', 'DataDetailSepatu', 'Databaris'));
    }

    public function PrintLaporan(Request $Request)
    {
        $PrintLaporan = new PesanPembelian();
        $DataDetailSepatu = $PrintLaporan->PrintLaporanPembelian($Request);
        $Total = $PrintLaporan->HitungTotalLaporan($Request);
        $BarisLaporan = $PrintLaporan->HitungBarisLaporan($Request);
        return view('NotaBeli.CetakLaporanNotaBeli', compact('DataDetailSepatu', 'Total', 'BarisLaporan'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $CatatNotaBeli = new PesanPembelian();
        $CatatNotaBeli->StoreNotaBeli($Request);
        return redirect('/DataNotaBeli')->with('status', 'Data Nota Beli Anda Telah Disimpan!');
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
        $CatatNotaBeli = new CatatNotaBeli();
        $CatatNotaBeli->UpdateNotaBeli($Request);
        return redirect('/DataNotaBeli')->with('status', 'Data Nota Beli Anda Telah Diubah!');
    }
}
