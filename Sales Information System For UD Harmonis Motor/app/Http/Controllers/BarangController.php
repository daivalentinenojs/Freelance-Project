<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Kategori;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $Request)
    {
        $Kategori = new Kategori();
        $DataKategori = $Kategori->GetKategori();
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('MasterData.Barang', compact('DataKategori', 'ID', 'Nama'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(Request $Request)
    {
        $this->validate($Request, [
            'FotoBarang' => 'required|image|max:2048',
        ]);

        $Barang = new Barang();
        $Barang->StoreBarang($Request);
        return redirect('/Barang')->with('status', 'Data Barang di Perusahaan Anda Telah Disimpan!');
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
        if($Request->hasFile('FotoBarang')) {
            $this->validate($Request, [
                'FotoBarang' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
        }

        $Barang = new Barang();
        $Barang->UpdateBarang($Request);
        return redirect('/Barang')->with('status', 'Data Barang di Perusahaan Anda Telah Diubah!');
    }
}
