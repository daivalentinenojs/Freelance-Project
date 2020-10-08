<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Daerah;
use App\User;
use Redirect;
use DB;

class KaryawanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Ajax()
  {
      $AjaxKaryawan = new Karyawan();
      $DataAjaxKaryawan = $AjaxKaryawan->GetAjaxKaryawan();
      return $DataAjaxKaryawan;
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

      $Daerah = new Daerah();
      $DataDaerah = $Daerah->GetDaerah();

      return view('MasterData.Karyawan.Index', compact('DataDaerah', 'ID', 'Nama', 'Email', 'Role'));
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

        $Karyawan = new Karyawan();
        $Karyawan->StoreKaryawan($Request, $IDUser);
        return redirect('/Karyawan')->with('status', 'Data Karyawan telah disimpan !');
    } else {
        return Redirect::to('Karyawan')
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

      $Karyawan = new Karyawan();
      $Karyawan->UpdateKaryawan($Request, $IDUser);
      return redirect('/Karyawan')->with('status', 'Data Karyawan telah diubah !');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function ProfilKaryawan(Request $Request)
  {
      $ID = $Request->session()->get('ID');
      $Email = $Request->session()->get('Email');
      $Nama = $Request->session()->get('Nama');
      $Role = $Request->session()->get('Role');

      $Daerah = new Daerah();
      $DataDaerah = $Daerah->GetDaerah();

      $Karyawan = new Karyawan();
      $DataKaryawan = $Karyawan->GetKaryawan($ID);
      return view('Profil.Karyawan', compact('ID', 'Nama', 'Email', 'Role', 'DataDaerah', 'DataKaryawan'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function UpdateKaryawan(Request $Request)
  {
      $User = new User();
      $IDUser = $User->UpdateUser($Request);

      $Karyawan = new Karyawan();
      $Karyawan->UpdateKaryawan($Request, $IDUser);
      return redirect('/ProfilKaryawan')->with('status', 'Data Anda telah diubah !');
  }
}
