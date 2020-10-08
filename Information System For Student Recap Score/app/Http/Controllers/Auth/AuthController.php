<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Illuminate\Http\Request;

use App\Karyawan;
use App\JenisNilai;
use Input;
use Auth;
use Validator;
use Redirect;
use Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';
    protected $loginPath = '/auth/login';

    private $mysqli = "";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'getLogout']);
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function LoginWeb(Request $Request)  // Checked V
    {
      $Rules = array(
          'email' => 'required|min:3',
          'domain' => 'required'
      );

      // $Rules = array(
      //     'email' => 'required|alphanum|min:3',
      //     'password' => 'required|alphanum|min:3',
      //     'domain' => 'required'
      // );

      $Messages = "Silahkan memasukkan Email dan Password Anda dengan benar !";
      $Validator = Validator::make(Input::all(), $Rules);

      if($Validator->fails())
      {
          return Redirect::to('auth/login')
          ->withErrors($Messages)
          ->withInput(Input::except('password'));
      }
      else
      {
          // $Email = Input::get('email');
          // $EmailSakti = Input::get('email');
          // $Password = Input::get('password');
          //
          // $Email = "s6134059";
          // // $Password = "guling240195";
          //
          // $Domain = Input::get('domain');
          //
          // $ds = ldap_connect("192.168.20.15");  //alamat server LDAP Ubaya
          // ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); //wajib disetting
          //
          // if ($ds) { //kalau berhasil connect ke server LDAP
          //   $sr = ldap_search($ds, "ou=people,dc=ubaya,dc=ac,dc=id", "uid=$Email");
          //   $entry = ldap_first_entry($ds, $sr);
          //   $dn = ldap_get_dn($ds, $entry);
          //   $r = @ldap_bind($ds, "$dn", $Password);
          //
          //   // apa yang di echo untuk membedakan mahasiswa dan karyawan ?
          //
          //   if ($r) { //kalau berhasil login dengan password tersebut
          //
          //     $sr = ldap_search($ds, "ou=people, dc=ubaya, dc=ac, dc=id", "uid=$Email");
          //     $info = ldap_get_entries($ds, $sr);
          //     $jumlah_hasil = ldap_count_entries($ds, $sr);
          //
          //     //proses ambil data
          //     //   if ($Domain == "@staff.ubaya.ac.id") {
          //     //       // $givenname = $info[0]["x-ubaya-npk"][0];
          //     //       $givenname = substr($EmailSakti,1);
          //     //   } else {
          //     //       // $givenname = $info[0]["x-ubaya-nrp"][0];
          //     //       $givenname = substr($EmailSakti,1);
          //     //   }
          //     $givenname = substr($EmailSakti,1);
          //     // $Nama = $info[0]["cn"][0];
          //     $EmailLengkap = $EmailSakti.$Domain;
          //
          //       require realpath(base_path('connection/Init.php'));
          //       $MySQLi = mysqli_connect($domain, $username, $password, $database);
          //
          //     $QueryCheckJabatan = "SELECT Mahasiswa.NRP AS NPK, User.ID AS ID, Mahasiswa.NAMA AS Nama, '1' AS Jabatan FROM User INNER JOIN Mahasiswa
          //        ON Mahasiswa.IdUser = User.ID WHERE User.Email = '$EmailLengkap' AND User.Status = 1
          //        UNION
          //        SELECT Karyawan.NPK AS NPK, User.ID AS ID, Karyawan.NAMA AS Nama, '0' AS Jabatan FROM User INNER JOIN Karyawan
          //        ON Karyawan.IdUser = User.ID WHERE User.Email = '$EmailLengkap' AND User.Status = 1";
          //
          //     $HasilQueryCheckJabatan = mysqli_query($MySQLi, $QueryCheckJabatan);
          //     $CheckJabatan = array();
          //   while($Hasil = mysqli_fetch_assoc($HasilQueryCheckJabatan))
          //   {
          //     $CheckJabatan[] = $Hasil;
          //   }
          //
          //   if ($CheckJabatan == NULL)
          //   {
          //     return Redirect::to('auth/login')
          //     ->withErrors($Messages)
          //     ->withInput(Input::except('password'));
          //   }
          //   else
          //   {
          //     $Jabatan = $CheckJabatan[0]['Jabatan'];
          //     if ($Jabatan == 1)
          //     {
          //       $Request->session()->put('ID', $CheckJabatan[0]['ID']);
          //       $Request->session()->put('NRP', $CheckJabatan[0]['NPK']);
          //       $Request->session()->put('Nama', $CheckJabatan[0]['Nama']);
          //       $Request->session()->put('Semester', $Semester);
          //       $Request->session()->put('ThnAkademik', $ThnAkademik);
          //
          //       // return Redirect::to('InformasiMahasiswa/'.$Semester.'/'.$ThnAkademik);
          //       return Redirect::to('InformasiMahasiswa');
          //     }
          //     else if ($Jabatan == 0)
          //     {
          //       $Request->session()->put('ID', $CheckJabatan[0]['ID']);
          //       $Request->session()->put('NPK', $CheckJabatan[0]['NPK']);
          //       $Request->session()->put('Nama', $CheckJabatan[0]['Nama']);
          //       return Redirect::to('Beranda');
          //     }
          //     else
          //     {
          //       return Redirect::to('auth/login')
          //       ->withErrors($Messages)
          //       ->withInput(Input::except('password'));
          //     }
            // }

              // require realpath(base_path('connection/Init.php'));
              // $MySQLi = mysqli_connect($domain, $username, $password, $database);
              //
              // $Request->session()->put('ID', $givenname);
              // $Request->session()->put('NRP', $givenname);
              // $Request->session()->put('Nama', $Nama);
              // $Request->session()->put('Semester', $Semester);
              // $Request->session()->put('ThnAkademik', $ThnAkademik);
              //
              // if ($Domain == "@staff.ubaya.ac.id") {
              //     return Redirect::to('Beranda');
              // } else {
              //     return Redirect::to('InformasiMahasiswa');
              // } tidak dipakai

          //   } else {
          //     //username tidak ada atau password salah
          //     return Redirect::to('auth/login')
          //       ->withErrors("Username Tidak Ada Atau Password Salah")
          //       ->withInput(Input::except('password'));
          //   }
          // } else {
          //     //tidak bisa connect ke LDAP server
          //     return Redirect::to('auth/login')
          //       ->withErrors("Tidak Bisa Connect ke LDAP Server")
          //       ->withInput(Input::except('password'));
          // }

          $Email = Input::get('email');
          $Password = Input::get('password');
          $Domain = Input::get('domain');
          $EmailLengkap = $Email.$Domain;


          require realpath(base_path('connection/Init.php'));
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryCheckJabatan = "SELECT Mahasiswa.NRP AS NPK, User.ID AS ID, Mahasiswa.NAMA AS Nama, '1' AS Jabatan FROM User INNER JOIN Mahasiswa
          ON Mahasiswa.IdUser = User.ID WHERE User.Email = '$EmailLengkap' AND User.Password = '$Password' AND User.Status = 1
          UNION
          SELECT Karyawan.NPK AS NPK, User.ID AS ID, Karyawan.NAMA AS Nama, '0' AS Jabatan FROM User INNER JOIN Karyawan
          ON Karyawan.IdUser = User.ID WHERE User.Email = '$EmailLengkap' AND User.Password = '$Password' AND User.Status = 1";

          $HasilQueryCheckJabatan = mysqli_query($MySQLi, $QueryCheckJabatan);
          $CheckJabatan = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryCheckJabatan))
          {
            $CheckJabatan[] = $Hasil;
          }

          if ($CheckJabatan == NULL)
          {
            return Redirect::to('auth/login')
            ->withErrors($Messages)
            ->withInput(Input::except('password'));
          }
          else
          {
            $Jabatan = $CheckJabatan[0]['Jabatan'];
            if ($Jabatan == 1)
            {
              $Request->session()->put('ID', $CheckJabatan[0]['ID']);
              $Request->session()->put('NRP', $CheckJabatan[0]['NPK']);
              $Request->session()->put('Nama', $CheckJabatan[0]['Nama']);
              $Request->session()->put('Semester', $Semester);
              $Request->session()->put('ThnAkademik', $ThnAkademik);

              // return Redirect::to('InformasiMahasiswa/'.$Semester.'/'.$ThnAkademik);
              return Redirect::to('InformasiMahasiswa');
            }
            else if ($Jabatan == 0)
            {
              $Request->session()->put('ID', $CheckJabatan[0]['ID']);
              $Request->session()->put('NPK', $CheckJabatan[0]['NPK']);
              $Request->session()->put('Nama', $CheckJabatan[0]['Nama']);
              return Redirect::to('Beranda');
            }
            else
            {
              return Redirect::to('auth/login')
              ->withErrors($Messages)
              ->withInput(Input::except('password'));
            }
          }
      }
    }

    protected function LogoutWeb(Request $Request) // Checked V
    {
        $Request->session()->forget('ID');
        $Request->session()->forget('NRP');
        $Request->session()->forget('Semester');
        $Request->session()->forget('ThnAkademik');
        $Request->session()->forget('NPK');
        $Request->session()->forget('Nama');
        return Redirect::to('auth/login');
    }
}
