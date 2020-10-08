<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desa;

class DesaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Ajax()
  {
      $AjaxDesa = new Desa();
      $DataAjaxDesa = $AjaxDesa->GetAjaxDesa();
      return $DataAjaxDesa;
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

      return view('MasterData.Desa.Index', compact('ID', 'Nama', 'Email', 'Role'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request $request
   * @return Response
   */
  public function Store(Request $Request)
  {
      $Desa = new Desa();
      $Desa->StoreDesa($Request);
      return redirect('/Desa')->with('status', 'Data desa telah disimpan !');
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
      $Desa = new Desa();
      $Desa->UpdateDesa($Request);
      return redirect('/Desa')->with('status', 'Data desa telah diubah !');
  }
}
