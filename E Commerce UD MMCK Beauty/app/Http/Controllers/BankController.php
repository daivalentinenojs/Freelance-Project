<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxBank = new Bank();
        $DataAjaxBank = $AjaxBank->GetAjaxBank();
        return $DataAjaxBank;
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

        return view('MasterData.Bank.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Bank = new Bank();
        $Bank->StoreBank($Request);
        return redirect('/Bank')->with('status', 'Your Bank Data has been saved!');
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
        $Bank = new Bank();
        $Bank->UpdateBank($Request);
        return redirect('/Bank')->with('status', 'Your Bank Data has been changed!');
    }
}
