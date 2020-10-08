<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Role;

class RoleController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxRole = new Role();
        $DataAjaxRole = $AjaxRole->GetAjaxRole();
        return $DataAjaxRole;
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

        return view('MasterData.Role.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Role = new Role();
        $Role->StoreRole($Request);
        return redirect('/Role')->with('status', 'Your Role Data has been saved!');
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
        $Kategori = new Role();
        $Kategori->UpdateRole($Request);
        return redirect('/Role')->with('status', 'Your Role Data has been changed!');
    }
}
