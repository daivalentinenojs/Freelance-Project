<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemohon;
use App\User;
use App\Desa;
use Redirect;
use DB;

class PemohonController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Ajax()
  {
      $AjaxPemohon = new Pemohon();
      $DataAjaxPemohon = $AjaxPemohon->GetAjaxPemohon();
      return $DataAjaxPemohon;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Index(Request $Request)
  {
      $ID = $Request->session()->get('ID');
      $Email = $Request->session()->get('Email');
      $Nama = $Request->session()->get('Nama');
      $Role = $Request->session()->get('Role');

      $Desa = new Desa();
      $DataDesa = $Desa->GetDesa();

      return view('MasterData.Pemohon.Index', compact('ID', 'Nama', 'Email', 'Role', 'DataDesa'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request $request
   * @return Response
   */
  public function Store(Request $Request)
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
        return redirect('/Pemohon')->with('status', 'Data Pemohon telah disimpan !');
    } else {
        return Redirect::to('Pemohon')
            ->withErrors('Email telah digunakan!');
    }
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
      $User = new User();
      $IDUser = $User->UpdateUser($Request);

      $Pemohon = new Pemohon();
      $Pemohon->UpdatePemohon($Request, $IDUser);
      return redirect('/Pemohon')->with('status', 'Data Pemohon telah diubah !');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function ProfilPemohon(Request $Request)
  {
      $ID = $Request->session()->get('ID');
      $Email = $Request->session()->get('Email');
      $Nama = $Request->session()->get('Nama');
      $Role = $Request->session()->get('Role');

      $Pemohon = new Pemohon();
      $DataPemohon = $Pemohon->GetPemohon($ID);

      $Desa = new Desa();
      $DataDesa = $Desa->GetDesa();

      return view('Profil.Pemohon', compact('ID', 'Nama', 'Email', 'Role', 'DataPemohon', 'DataDesa'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function UpdatePemohon(Request $Request)
  {
      $User = new User();
      $IDUser = $User->UpdateUser($Request);

      $Pemohon = new Pemohon();
      $Pemohon->UpdatePemohon($Request, $IDUser);
      return redirect('/ProfilPemohon')->with('status', 'Data Anda telah diubah !');
  }
}
