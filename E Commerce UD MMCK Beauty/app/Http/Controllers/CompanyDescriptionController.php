<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;

class CompanyDescriptionController extends Controller
{
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

        return view('MasterData.CompanyDescription.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
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
        $CompanyDescription = new CompanyDescription();
        $CompanyDescription->UpdateCompanyDescription($Request);
        return redirect('/CompanyDescription')->with('status', 'Your company description has been changed !');
    }

    public function GetCompanyDescription()
    {
        $CompanyDescription = new CompanyDescription();
        $DataCompanyDescription = $CompanyDescription->GetCompanyDescription();
        return $DataCompanyDescription;
    }
}
