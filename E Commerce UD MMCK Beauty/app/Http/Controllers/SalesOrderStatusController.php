<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\SalesOrderStatus;

class SalesOrderStatusController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxSalesOrderStatus = new SalesOrderStatus();
        $DataAjaxSalesOrderStatus = $AjaxSalesOrderStatus->GetAjaxSalesOrderStatus();
        return $DataAjaxSalesOrderStatus;
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

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('MasterData.SalesOrderStatus.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $SalesOrderStatus = new SalesOrderStatus();
        $SalesOrderStatus->StoreSalesOrderStatus($Request);
        return redirect('/SalesOrderStatus')->with('status', 'Your Sales Order Status Data has been saved!');
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
        $Kategori = new SalesOrderStatus();
        $Kategori->UpdateSalesOrderStatus($Request);
        return redirect('/SalesOrderStatus')->with('status', 'Your Sales Order Status Data has been changed!');
    }
}
