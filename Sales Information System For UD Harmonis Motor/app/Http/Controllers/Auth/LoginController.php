<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesKaryawanss;
use Illuminate\Http\Request;
use App\SocialMedia;
use Hash;
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
    | This controller handles authenticating Karyawanss for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect Karyawanss after login.
     *
     * @var string
     */
    protected $redirectTo = '/Auth/Login';

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
            'Email' => 'required|alphanum|min:3',
            'Password' => 'required|alphanum|min:3'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Index()
    {
        return view('Auth/Login');
    }

    /**
    * Create a new Karyawans instance after a valid registration.
    *
    * @param  array  $data
    * @return Karyawans
    */
    protected function LoginWeb(Request $Request)
    {
        $Messages = "Nama dan Password tidak sama!";//pesan yang dimunculkan
        $Nama = $Request->get('Nama');
        $Password = $Request->get('Password');
        $Login = $this->LoginCore($Nama, $Password);

        if ($Login == NULL) {//jika login tidak diisi
            return Redirect::to('Auth/Login')
                ->withErrors($Messages);//munculkan pesan
        } else {//jika semua terisi dan benar
            $Request->session()->put('ID', $Login->ID);
            $Request->session()->put('Nama', $Login->Nama);//menyimpan nama yang sedang aktif sekarang
            
            return Redirect::to('Beranda');
            // require '../connection/Init.php';
            // $MySQLi = mysqli_connect($domain, $username, $password, $database);
            // $QueryGetDataNama = "SELECT Karyawans.IDKaryawan AS ID, Karyawans.Nama AS Nama,  
            //                         Karyawans.Password AS Password 
            //                      FROM Karyawans 
            //                      WHERE Karyawans.StatusTerdaftar = 1";
            // $HasilQueryGetDataNama = mysqli_query($MySQLi, $QueryGetDataNama);
            // $DataNama = array();
            // while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNama)) {
            //     $DataNama[] = $Hasil;
            // }
            // $ID = $DataNama[0]['ID'];
            // $Nama = $DataNama[0]['Nama'];
            // // $Request->get('ID');
            // // $Request->get('Nama');
            // return view('Beranda', compact('ID', 'Nama'));
        }
    }

    protected function LoginCore($Nama, $Password)//Untuk mengambil data dari database
    {
        $Login = DB::table('Karyawans')
                ->select('Karyawans.IDKaryawan AS ID', 'Karyawans.Nama AS Nama', 'Karyawans.Password AS Password')
                ->where('Karyawans.Nama','=',$Nama)
                ->where('Karyawans.Password','=',$Password)
                ->where('Karyawans.StatusTerdaftar','=',1)
                ->first();
        return $Login;
    }

    protected function LogoutWeb(Request $Request)//Untuk keluar dari web
    {
        $Request->session()->forget('ID');
        $Request->session()->forget('Nama');
        return Redirect::to('Auth/Login');
    }
}
