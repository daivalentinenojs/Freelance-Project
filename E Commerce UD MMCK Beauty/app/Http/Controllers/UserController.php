<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Description;

class UserController extends Controller
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

        $Description = new Description();
        $Content = $Description->GetDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('User.Index', compact('ID', 'Nama', 'Email', 'Role', 'Content', 'DataSocialMedia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $User = new User();
        $User->StoreUser($Request);
        return redirect('/Employee')->with('status', 'Your Employee Information Has Saved !');
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
        $User->UpdateUser($Request);
        return redirect('/Employee')->with('status', 'Your Employee Information Has Changed !');
    }
}
