<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
//use App\User;

class KaryawanController extends Controller
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
        return view('MasterData.Karyawan', compact('ID', 'Nama'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        // $Password = $Request->get('Password');
        // $UlangiPassword = $Request->get('UlangiPassword');

        // if($Password == $UlangiPassword) {
            $this->validate($Request, [
                'FotoKaryawan' => 'required|image|max:2048',
            ]);

            $Karyawan = new Karyawan();
            $Karyawan->StoreKaryawan($Request);

            return redirect('/Karyawan')->with('status', 'Data Karyawan di Perusahaan Anda Telah Disimpan!');
        // } else {
        //      return redirect('/Karyawan')->with('statuserror', 'Password dan Ulangi Password harus sama!');
        // }
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
        // $Password = $Request->get('Password');
        // $UlangiPassword = $Request->get('UlangiPassword');

        // if($Password == $UlangiPassword) {
           if($Request->hasFile('FotoKaryawan')) {
            $this->validate($Request, [
                'FotoKaryawan' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
        }

        $Karyawan = new Karyawan();
        $Karyawan->UpdateKaryawan($Request);
        return redirect('/Karyawan')->with('status', 'Data Karyawan di Perusahaan Anda Telah Diubah!');     
        // } else {
        //      return redirect('/Karyawan')->with('statuserror', 'Password dan Ulangi Password harus sama!');
        // }
    }
}
