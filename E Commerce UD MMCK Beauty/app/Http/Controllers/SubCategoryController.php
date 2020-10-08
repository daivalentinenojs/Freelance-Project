<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\SubCategory;
use App\Category;

class SubCategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxSubCategory = new SubCategory();
        $DataAjaxSubCategory = $AjaxSubCategory->GetAjaxSubCategory();
        return $DataAjaxSubCategory;
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

        $Category = new Category();
        $DataCategory = $Category->GetCategory();

        return view('MasterData.SubCategory.Index', compact('Content', 'DataSocialMedia', 'DataCategory', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $SubCategory = new SubCategory();
        $SubCategory->StoreSubCategory($Request);
        return redirect('/SubCategory')->with('status', 'Your Sub Category Data has been saved!');
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
        $SubCategory = new SubCategory();
        $SubCategory->UpdateSubCategory($Request);
        return redirect('/SubCategory')->with('status', 'Your Sub Category Data has been changed!');
    }
}
