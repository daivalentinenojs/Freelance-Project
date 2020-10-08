<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Index(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('MasterData.Kategori', compact('ID', 'Nama'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Kategori = new Kategori();
        $Kategori->StoreKategori($Request);
        return redirect('/Kategori')->with('status', 'Data Kategori di Perusahaan Anda Telah Disimpan!');
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
        $Kategori = new Kategori();
        $Kategori->UpdateKategori($Request);
        return redirect('/Kategori')->with('status', 'Data Kategori di Perusahaan Anda Telah Diubah!');
    }
}
