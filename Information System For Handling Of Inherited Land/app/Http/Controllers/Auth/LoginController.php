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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function LoginIndex()
    {
        return view('Auth.Login');
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

                $Nama = DB::table('Pemohon')
                        ->select('Pemohon.Nama AS Nama', 'Pemohon.ID AS ID')
                        ->where('Pemohon.IDUser','=', $ID->ID)
                        ->first();

                if (empty($Nama)) {
                    $Nama = DB::table('Karyawan')
                            ->select('Karyawan.Nama AS Nama', 'Karyawan.ID AS ID', 'Karyawan.Jabatan AS Jabatan')
                            ->where('Karyawan.IDUser','=', $ID->ID)
                            ->first();
                    if (empty($Nama)) {
                      $Nama = DB::table('KepalaDesa')
                              ->select('KepalaDesa.Nama AS Nama', 'KepalaDesa.ID AS ID')
                              ->where('KepalaDesa.IDUser','=', $ID->ID)
                              ->first();
                          if (empty($Nama)) {
                              $Messages = "Your email and password didn't match !";
                              return Redirect::to('Login')
                                  ->withErrors($Messages);
                          } else {
                              $Request->session()->put('ID', $Nama->ID);
                              $Request->session()->put('Nama', $Nama->Nama);
                              $Request->session()->put('Role', 'Kepala Desa');
                          }
                    } else {
                        $Request->session()->put('ID', $Nama->ID);
                        $Request->session()->put('Nama', $Nama->Nama);
                        // $Request->session()->put('Role', 'Karyawan');

                        if($Nama->Jabatan == 1) {
                          $Request->session()->put('Role', 'Penerima Setoran PNBP');
                        } else if($Nama->Jabatan == 2) {
                          $Request->session()->put('Role', 'Kepala Sub Bagian TU');
                        } else if($Nama->Jabatan == 3) {
                          $Request->session()->put('Role', 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah');
                        } else if($Nama->Jabatan == 4) {
                          $Request->session()->put('Role', 'Kepala Seksi Pengukuran dan Pemetaan');
                        } else if($Nama->Jabatan == 5) {
                          $Request->session()->put('Role', 'Petugas Pengumpul Data Yuridis');
                        } else if($Nama->Jabatan == 6) {
                          $Request->session()->put('Role', 'Kepala Seksi Hub Hukum Pertanahan');
                        } else if($Nama->Jabatan == 7) {
                          $Request->session()->put('Role', 'Sekretaris Bukan Anggota');
                        } else if($Nama->Jabatan == 8) {
                          $Request->session()->put('Role', 'Anggota');
                        } else if($Nama->Jabatan == 9) {
                          $Request->session()->put('Role', 'Ketua');
                        } else if($Nama->Jabatan == 10) {
                          $Request->session()->put('Role', 'Koordinator');
                        } else if($Nama->Jabatan == 11) {
                          $Request->session()->put('Role', 'Kepala Seksi Infrastruktur Pertanahan');
                        } else if($Nama->Jabatan == 12) {
                          $Request->session()->put('Role', 'Kepala Sub Bagian Seksi Peralihan Hak');
                        } else if($Nama->Jabatan == 13) {
                          $Request->session()->put('Role', 'Staff Hubungan Hukum Pertanahan');
                        }
                    }
                } else {
                    $Request->session()->put('ID', $Nama->ID);
                    $Request->session()->put('Nama', $Nama->Nama);
                    $Request->session()->put('Role', 'Pemohon');
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

    protected function LogoutWeb(Request $Request)
    {
        $Request->session()->forget('ID');
        $Request->session()->forget('Email');
        $Request->session()->forget('Nama');
        $Request->session()->forget('Role');
        Auth::logout();

        return Redirect::to('Login');
    }
}
