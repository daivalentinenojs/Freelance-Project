<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Input;
use DB;
use Auth;
use Validator;
use Redirect;
use App\CompanyDescription;
use App\SocialMedia;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/Dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'LogoutWeb']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|alphanum|min:3',
            'password' => 'required|alphanum|min:3',
            'domain' => 'required'
        ]);
    }

    protected function LoginIndex()
    {
        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('Auth.Login', compact('Content', 'DataSocialMedia'));
    }

    protected function Error()
    {
        return view('Error.404');
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function LoginWeb(Request $Request)
    {
        $this->validate($Request,[
            'Email' => 'required',
            'Password' => 'required'
        ]);
        $Member = User::whereEmail($Request->input('Email'))->first();
        if($Member) {
            $ID = User::find($Member->ID);
            if (Auth::attempt(['email' =>$Request->input('Email'), 'password' => $Request->input('Password')])) {
                $ID = DB::table('users')
                        ->select('users.email AS Email', 'users.id AS ID')
                        ->where('users.email','=',$Request->input('Email'))
                        ->first();
                $Request->session()->put('Email', $ID->Email);

                $Nama = DB::table('Pembeli')
                        ->select('Pembeli.Nama AS Nama', 'Pembeli.ID AS ID')
                        ->where('Pembeli.IDUser','=', $ID->ID)
                        ->first();

                if (empty($Nama)) {
                    $Nama = DB::table('Karyawan')
                            ->select('Karyawan.Nama AS Nama', 'Karyawan.ID AS ID')
                            ->where('Karyawan.IDUser','=', $ID->ID)
                            ->first();
                    if (empty($Nama)) {
                        $Messages = "Your email and password didn't match !";
                        return Redirect::to('Login')
                            ->withErrors($Messages);
                    } else {
                        $Role = DB::table('Karyawan')
                                ->select('Karyawan.IDJabatan AS Role')
                                ->where('Karyawan.IDUser','=', $ID->ID)
                                ->first();
                        $Request->session()->put('ID', $Nama->ID);
                        $Request->session()->put('Nama', $Nama->Nama);
                        $Request->session()->put('Role', $Role->Role);
                    }
                } else {
                    $Role = 0;
                    $Request->session()->put('ID', $Nama->ID);
                    $Request->session()->put('Nama', $Nama->Nama);
                    $Request->session()->put('Role', $Role);
                }
                return Redirect::to('Dashboard');
            } else {
                $Messages = "Your email and password didn't match !";
                return Redirect::to('Login')
                    ->withErrors($Messages);
            }
        } else {
            $Messages = "Your email didn't register !";
            return Redirect::to('Login')
                ->withErrors($Messages);
        }
    }

    protected function LoginsWeb()
    {
        $Messages = "Please Log In !";
        return Redirect::to('Login')
            ->withErrors($Messages);
    }

    protected function LogoutWeb(Request $Request)
    {
        $Request->session()->forget('ID');
        $Request->session()->forget('Email');
        $Request->session()->forget('Nama');
        $Request->session()->forget('Role');
        $Request->session()->forget('Cart');
        $Request->session()->forget('JumlahBarang');
        Auth::logout();

        return Redirect::to('Login');
    }

    protected function LogoutsWeb(Request $Request)
    {
        $Request->session()->forget('ID');
        $Request->session()->forget('Email');
        $Request->session()->forget('Nama');
        $Request->session()->forget('Role');
        $Request->session()->forget('Cart');
        Auth::logout();

        $Messages = "You don't have the access !";
        return Redirect::to('Login')
            ->withErrors($Messages);
    }
}
