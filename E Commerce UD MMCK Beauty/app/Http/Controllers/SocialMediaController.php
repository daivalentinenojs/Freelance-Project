<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxSocialMedia = new SocialMedia();
        $DataAjaxSocialMedia = $AjaxSocialMedia->GetAjaxSocialMedia();
        return $DataAjaxSocialMedia;
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

        return view('MasterData.SocialMedia.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $SocialMedia = new SocialMedia();
        $SocialMedia->StoreSocialMedia($Request);
        return redirect('/SocialMedia')->with('status', 'Your SocialMedia Data has been saved!');
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
        $Kategori = new SocialMedia();
        $Kategori->UpdateSocialMedia($Request);
        return redirect('/SocialMedia')->with('status', 'Your SocialMedia Data has been changed!');
    }
}
