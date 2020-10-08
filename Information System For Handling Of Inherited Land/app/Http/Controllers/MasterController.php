<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemohon;
use App\User;
use App\Desa;
use Redirect;
use DB;

class MasterController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Beranda(Request $Request)
  {
      return view('Beranda');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function TentangKami(Request $Request)
  {
      return view('TentangKami');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Daftar(Request $Request)
  {
      $Desa = new Desa();
      $DataDesa = $Desa->GetDesa();

      return view('Daftar', compact('DataDesa'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request $request
   * @return Response
   */
  public function DaftarPemohon(Request $Request)
  {
    $Email = DB::table('users')
            ->select('users.email AS Email', 'users.id AS ID')
            ->where('users.email','=',$Request->get('Email'))
            ->first();

    if (empty($Email)) {
        $User = new User();
        $IDUser = $User->StoreUser($Request);

        $Pemohon = new Pemohon();
        $Pemohon->StorePemohon($Request, $IDUser);
        return redirect('/Login')->with('status', 'Data Anda telah disimpan !');
    } else {
        return Redirect::to('Pemohon')
            ->withErrors('Email telah digunakan!');
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Dashboard(Request $Request)
  {
      $ID = $Request->session()->get('ID');
      $Email = $Request->session()->get('Email');
      $Nama = $Request->session()->get('Nama');
      $Role = $Request->session()->get('Role');

      return view('Dashboard', compact('ID', 'Nama', 'Email', 'Role'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function ViewFormulirPermohonan(Request $Request, $IDFP)
  {
      $ID = $Request->session()->get('ID');
      $Email = $Request->session()->get('Email');
      $Nama = $Request->session()->get('Nama');
      $Role = $Request->session()->get('Role');

      return view('ViewFormulirPermohonan', compact('ID', 'Nama', 'Email', 'Role', 'IDFP'));
  }
}
