<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\ProductStatus;

class ProductStatusController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxProductStatus = new ProductStatus();
        $DataAjaxProductStatus = $AjaxProductStatus->GetAjaxProductStatus();
        return $DataAjaxProductStatus;
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

        return view('MasterData.ProductStatus.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $ProductStatus = new ProductStatus();
        $ProductStatus->StoreProductStatus($Request);
        return redirect('/ProductStatus')->with('status', 'Your Product Status Data has been saved!');
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
        $Kategori = new ProductStatus();
        $Kategori->UpdateProductStatus($Request);
        return redirect('/ProductStatus')->with('status', 'Your Product Status Data has been changed!');
    }
}
