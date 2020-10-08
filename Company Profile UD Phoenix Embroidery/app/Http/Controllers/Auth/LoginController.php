<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Input;
use DB;
use Auth;
use Validator;
use Redirect;
use App\Description;

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
    protected $redirectTo = '/home';

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
        $Description = new Description();
        $Content = $Description->GetDescription();
        return view('Auth.Login', compact('Content'));
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function LoginWeb(Request $Request)
    {
        $Messages = "Your NIP and Password didn't match !";
        $NIP = $Request->get('NIP');
        $Password = $Request->get('Password');
        $Login = $this->LoginCore($NIP, $Password);

        // $Login = DB::select('SELECT STAFFS.STAFF_NIP AS NIP, STAFFS.STAFF_NAMA AS Nama, STAFFS.STAFF_PASSWORD AS Password FROM STAFFS WHERE STAFFS.STAFF_NIP WHERE STAFFS.STAFF_NIP = :NIP AND STAFFS.STAFF_PASSWORD = :PASS');
        if ($Login == NULL) {
            return Redirect::to('Login')
                ->withErrors($Messages);
        } else {
            $Request->session()->put('NIP', $Login->NIP);
            $Request->session()->put('Name', $Login->Name);

            $Description = new Description();
            $Content = $Description->GetDescription();
            // require '../connection/Init.php';
            // $MySQLi = mysqli_connect($domain, $username, $password, $database);
            // $QueryGetDataNama = "SELECT STAFFS.STAFF_NAMA AS 'Nama' FROM STAFFS WHERE STAFFS.STAFF_NIP = '$NIP' AND STAFFS.ISACTIVE = 1";
            // $HasilQueryGetDataNama = mysqli_query($MySQLi, $QueryGetDataNama);
            // $DataNama = array();
            // while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNama)) {
            // 	$DataNama[] = $Hasil;
            // }
            // $Nama = $DataNama[0]['Nama'];
            return view('Dashboard', compact('Content'));
            // return Redirect::to('/');
        }
    }

    protected function LoginCore($NIP, $Password)
    {
        $Login = DB::table('User')
                ->select('User.NIP AS NIP', 'User.Name AS Name', 'User.Password AS Password')
                ->where('User.NIP','=',$NIP)
                ->where('User.Password','=',$Password)
                ->where('User.IsActive','=',1)
                ->first();
        return $Login;
    }

    protected function LogoutWeb(Request $Request)
    {
        $Request->session()->forget('NIP');
        $Request->session()->forget('Nama');

        $Description = new Description();
        $Content = $Description->GetDescription();
        return view('Auth.Login', compact('Content'));
        // return Redirect::to('Login');
    }
}
