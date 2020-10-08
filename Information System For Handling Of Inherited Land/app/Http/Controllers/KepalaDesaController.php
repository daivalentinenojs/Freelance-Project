<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KepalaDesa;
use App\Desa;
use App\User;
use Redirect;
use DB;

class KepalaDesaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Ajax()
  {
      $AjaxKepalaDesa = new KepalaDesa();
      $DataAjaxKepalaDesa = $AjaxKepalaDesa->GetAjaxKepalaDesa();
      return $DataAjaxKepalaDesa;
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

      return view('MasterData.KepalaDesa.Index', compact('DataDesa', 'ID', 'Nama', 'Email', 'Role'));
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

        $KepalaDesa = new KepalaDesa();
        $KepalaDesa->StoreKepalaDesa($Request, $IDUser);
        return redirect('/KepalaDesa')->with('status', 'Data Kepala Desa telah disimpan !');
    } else {
        return Redirect::to('KepalaDesa')
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

      $KepalaDesa = new KepalaDesa();
      $KepalaDesa->UpdateKepalaDesa($Request, $IDUser);
      return redirect('/KepalaDesa')->with('status', 'Data Kepala Desa telah diubah !');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function ProfilKepalaDesa(Request $Request)
  {
      $ID = $Request->session()->get('ID');
      $Email = $Request->session()->get('Email');
      $Nama = $Request->session()->get('Nama');
      $Role = $Request->session()->get('Role');

      $Desa = new Desa();
      $DataDesa = $Desa->GetDesa();

      $KepalaDesa = new KepalaDesa();
      $DataKepalaDesa = $KepalaDesa->GetKepalaDesa($ID);
      return view('Profil.KepalaDesa', compact('ID', 'Nama', 'Email', 'Role', 'DataDesa', 'DataKepalaDesa'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function UpdateKepalaDesa(Request $Request)
  {
      $User = new User();
      $IDUser = $User->UpdateUser($Request);

      $KepalaDesa = new KepalaDesa();
      $KepalaDesa->UpdateKepalaDesa($Request, $IDUser);
      return redirect('/ProfilKepalaDesa')->with('status', 'Data Anda telah diubah !');
  }
}
