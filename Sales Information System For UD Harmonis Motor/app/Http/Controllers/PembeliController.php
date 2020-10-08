<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembeli;

class PembeliController extends Controller
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
        return view('MasterData.Pembeli', compact('ID', 'Nama'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $this->validate($Request, [
            'FotoPembeli' => 'required|image|max:2048',
        ]);

        $Pembeli = new Pembeli();
        $Pembeli->StorePembeli($Request);

        return redirect('/Pembeli')->with('status', 'Data Pembeli di Perusahaan Anda Telah Disimpan!');
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
        if($Request->hasFile('FotoPembeli')) {
            $this->validate($Request, [
                'FotoPembeli' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
        }
        
        $Pembeli = new Pembeli();
        $Pembeli->UpdatePembeli($Request);
        return redirect('/Pembeli')->with('status', 'Data Pembeli di Perusahaan Anda Telah Diubah!');
    }
}
