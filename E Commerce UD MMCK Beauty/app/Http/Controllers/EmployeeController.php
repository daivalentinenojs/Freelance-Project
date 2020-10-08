<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Employee;
use App\Role;
use App\User;
use Redirect;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxEmployee = new Employee();
        $DataAjaxEmployee = $AjaxEmployee->GetAjaxEmployee();
        return $DataAjaxEmployee;
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

        $Roles = new Role();
        $DataRole = $Roles->GetRole();

        return view('MasterData.Employee.Index', compact('Content', 'DataSocialMedia', 'DataRole', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexUpdateEmployee(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Employee = new Employee();
        $DataEmployee = $Employee->GetEmployeeProfile($ID);

        return view('MasterData.Profile.IndexEmployee', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role', 'DataEmployee'));
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

            $Employee = new Employee();
            $Employee->StoreEmployee($Request, $IDUser);
            return redirect('/Employee')->with('status', 'Your Employee Data has been saved!');
        } else {
            return Redirect::to('Employee')
                ->withErrors('Your email has been used!');
            // return redirect('/Employee')->with('error', 'Your email has been used!');
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

        $Employee = new Employee();
        $Employee->UpdateEmployee($Request, $IDUser);
        return redirect('/Employee')->with('status', 'Your Employee Data has been changed!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function UpdateEmployee(Request $Request)
    {
        $User = new User();
        $IDUser = $User->UpdateProfileUser($Request);

        $Employee = new Employee();
        $Employee->UpdateProfileEmployee($Request);
        return redirect('/UpdateEmployee')->with('status', 'Your profile data has been changed!');
    }
}
