<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Karyawan extends Model
{
    protected $table = 'Karyawans';
    protected $guarded = ['IDKaryawan'];
    protected $fillable = ['IDKaryawan', 'Nama', 'Alamat', 'Email', 'NoTelepon', 'Password', 
    'StatusTerdaftar'];

    public function GetKaryawan()
    { 
     require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataKaryawan = "SELECT Karyawans.Nama AS Nama, Karyawans.IDKaryawan AS ID
                               FROM Karyawans";
      $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
      $DataKaryawan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
        $DataKaryawan[] = $Hasil;
      }
      return $DataKaryawan;
    }

    public function StoreKaryawan(Request $Request)
    {
        $unique_id = uniqid();
        // $Password = $Request->get('Password');
        // $UlangiPassword = $Request->get('UlangiPassword');
        // if($Password == $UlangiPassword) {
            $Karyawan = new Karyawan(array(
                'Nama' => $Request->get('Nama'),
                'Alamat' => $Request->get('Alamat'),
                'Email' => $Request->get('Email'),
                'NoTelepon' => $Request->get('NoTelepon'),
                'Password' => $Request->get('Password'),
                'StatusTerdaftar' => (1)
            ));
            $Karyawan->save();
            $ID = DB::table('Karyawans')->max('IDKaryawan');
            $IDFoto = $ID.'.jpg';
            $Request->FotoKaryawan->move(public_path('foto/karyawan'), $IDFoto);
        // }
    }

    public function UpdateKaryawan(Request $Request)
    {
        $IDKaryawan = $Request->get('IDKaryawan');
        $ID = $Request->get('IDKaryawan').'.jpg';
        DB::table('Karyawans')
            ->where('IDKaryawan', $IDKaryawan)
            ->update(['Nama' => $Request->get('Nama'),
                    'Alamat' => $Request->get('Alamat'),
                    'Email' => $Request->get('Email'),
                    'NoTelepon' => $Request->get('NoTelepon'),
                    'Password' => $Request->get('Password'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
        if($Request->hasFile('FotoKaryawan')) {
            $Request->FotoKaryawan->move(public_path('foto/karyawan'), $ID);
        }
    }
}
