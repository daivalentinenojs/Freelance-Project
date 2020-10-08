<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasok;

class PemasokController extends Controller
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
        return view('MasterData.Pemasok', compact('ID', 'Nama'));
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
            'FotoPemasok' => 'required|image|max:2048',
        ]);

        $Pemasok = new Pemasok();
        $Pemasok->StorePemasok($Request);

        return redirect('/Pemasok')->with('status', 'Data Pemasok di Perusahaan Anda Telah Disimpan!');
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
        if($Request->hasFile('FotoPemasok')) {
            $this->validate($Request, [
                'FotoPemasok' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
        }

        $Pemasok = new Pemasok();
        $Pemasok->UpdatePemasok($Request);
        return redirect('/Pemasok')->with('status', 'Data Pemasok di Perusahaan Anda Telah Diubah!');
    }
}
