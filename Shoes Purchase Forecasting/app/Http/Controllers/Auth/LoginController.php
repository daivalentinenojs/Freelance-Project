<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Karyawan;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Input;
use DB;
use Auth;
use Validator;
use Redirect;

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
    protected $redirectTo = '/Beranda';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) // Checked
    {
        return Validator::make($data, [
            'email' => 'required|alphanum|min:3',
            'password' => 'required|alphanum|min:3',
            'domain' => 'required'
        ]);
    }

    protected function LoginIndex()
    {
        return view('Auth.Login');
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function LoginWeb(Request $Request)
    {
        $Messages = "Your NIK and Password didn't match !";
        $Email = $Request->get('Email');
        $Domain = $Request->get('Domain');
        $Password = $Request->get('Password');

        $LemparEmail = $Email.$Domain;

        $Login = $this->LoginCore($LemparEmail, $Password);

        // $Login = DB::select('SELECT STAFFS.STAFF_NIP AS NIP, STAFFS.STAFF_NAMA AS Nama, STAFFS.STAFF_PASSWORD AS Password FROM STAFFS WHERE STAFFS.STAFF_NIP WHERE STAFFS.STAFF_NIP = :NIP AND STAFFS.STAFF_PASSWORD = :PASS');
        if ($Login == NULL) {
            return Redirect::to('/')
                ->withErrors($Messages);
        } else {
            $Request->session()->put('ID', $Login->ID);
            $Request->session()->put('Name', $Login->Name);
            $Request->session()->put('IDJabatan', $Login->IDJabatan);
            $Request->session()->put('Jabatan', $Login->Jabatan);
            // return view('Beranda');
            return Redirect::to('Beranda');
        }
    }

    protected function LoginCore($LemparEmail, $Password)
    {
        $Login = DB::table('User')->join('Jabatan', 'User.JabatanID', '=', 'Jabatan.ID')
                ->select('User.Nama AS Name', 'User.Password AS Password', 'User.JabatanID AS IDJabatan', 'User.IDUser AS ID', 'Jabatan.Nama AS Jabatan')
                ->where('User.Email','=',$LemparEmail)
                ->where('User.Password','=',$Password)
                ->where('User.IsDelete','=',1)
                ->first();
        return $Login;
    }

    protected function LogoutWeb(Request $Request)
    {
        $Request->session()->forget('ID');
        $Request->session()->forget('Name');
        $Request->session()->forget('IDJabatan');
        $Request->session()->forget('Jabatan');
        return Redirect::to('/');
    }
}
