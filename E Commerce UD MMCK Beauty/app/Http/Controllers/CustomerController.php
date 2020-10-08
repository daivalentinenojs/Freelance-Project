<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Customer;
use App\User;
use Redirect;
use DB;

class CustomerController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxCustomer = new Customer();
        $DataAjaxCustomer = $AjaxCustomer->GetAjaxCustomer();
        return $DataAjaxCustomer;
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

        return view('MasterData.Customer.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexCustomer(Request $Request)
    {
        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('MasterData.RegisterCustomer.Index', compact('Content', 'DataSocialMedia'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexUpdateCustomer(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Customer = new Customer();
        $DataCustomer = $Customer->GetCustomerProfile($ID);

        return view('MasterData.Profile.IndexCustomer', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role', 'DataCustomer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Email = DB::table('users')
                  ->select('users.email AS Email', 'users.id AS ID')
                  ->where('users.email','=',$Request->get('Email'))
                  ->first();

        if (empty($Email)) {
            $User = new User();
            $IDUser = $User->StoreUser($Request);

            $Customer = new Customer();
            $Customer->StoreCustomer($Request, $IDUser);
            return redirect('/Customer')->with('status', 'Your Customer Data has been saved!');
        } else {
            return Redirect::to('Customer')
                ->withErrors('Your email has been used!');
            // return redirect('/Customer')->with('error', 'Your email has been used!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function StoreCustomer(Request $Request)
    {
        $Email = DB::table('users')
                  ->select('users.email AS Email', 'users.id AS ID')
                  ->where('users.email','=',$Request->get('Email'))
                  ->first();

        if (empty($Email)) {
            $User = new User();
            $IDUser = $User->StoreUser($Request);

            $Customer = new Customer();
            $Customer->StoreCustomer($Request, $IDUser);
            return redirect('/Login');
        } else {
            return Redirect::to('Login')
                ->withErrors('Your email has been used!');
            // return redirect('/Login')->with('error', 'Your email has been used!');
        }
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
        $IDUser = $User->UpdateUser($Request);

        $Customer = new Customer();
        $Customer->UpdateCustomer($Request, $IDUser);
        return redirect('/Customer')->with('status', 'Your Customer Data has been changed!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function UpdateCustomer(Request $Request)
    {
        $User = new User();
        $IDUser = $User->UpdateProfileUser($Request);

        $Customer = new Customer();
        $Customer->UpdateProfileCustomer($Request);
        return redirect('/UpdateCustomer')->with('status', 'Your profile data has been changed!');
    }
}
