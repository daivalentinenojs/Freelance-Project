<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Brand;

class BrandController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxBrand = new Brand();
        $DataAjaxBrand = $AjaxBrand->GetAjaxBrand();
        return $DataAjaxBrand;
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

        return view('MasterData.Brand.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Brand = new Brand();
        $Brand->StoreBrand($Request);
        return redirect('/Brand')->with('status', 'Your Brand Data has been saved!');
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
        $Kategori = new Brand();
        $Kategori->UpdateBrand($Request);
        return redirect('/Brand')->with('status', 'Your Brand Data has been changed!');
    }
}
