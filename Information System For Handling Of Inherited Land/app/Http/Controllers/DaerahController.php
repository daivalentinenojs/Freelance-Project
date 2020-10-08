<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Daerah;

class DaerahController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function Ajax()
  {
      $AjaxDaerah = new Daerah();
      $DataAjaxDaerah = $AjaxDaerah->GetAjaxDaerah();
      return $DataAjaxDaerah;
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

      return view('MasterData.Daerah.Index', compact('ID', 'Nama', 'Email', 'Role'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request $request
   * @return Response
   */
  public function Store(Request $Request)
  {
      $Daerah = new Daerah();
      $Daerah->StoreDaerah($Request);
      return redirect('/Daerah')->with('status', 'Data Daerah telah disimpan !');
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
      $Daerah = new Daerah();
      $Daerah->UpdateDaerah($Request);
      return redirect('/Daerah')->with('status', 'Data Daerah telah diubah !');
  }
}
