<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanKeuangan;

class LaporanKeuanganController extends Controller
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
        return view('LaporanKeuangan.Index', compact('ID', 'Nama'));
    }

    public function PrintLaporan(Request $Request)
    {
        $PrintLaporan = new LaporanKeuangan();
        $Pengeluaran = $PrintLaporan->PrintLaporan($Request);
        $NotaJual = $PrintLaporan->PrintLaporan($Request);
        $NotaBeli = $PrintLaporan->PrintLaporan($Request);
        $BarisLaporan = $PrintLaporan->HitungBarisLaporan($Request);
        return view('LaporanKeuangan.CetakLaporanKeuangan', compact('Pengeluaran', 'NotaJual', 'NotaBeli', 'BarisLaporan'));
    }
}
