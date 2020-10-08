<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Pembeli extends Model
{
    protected $table = 'Pembelis';
    protected $guarded = ['IDPembeli'];
    protected $fillable = ['IDPembeli', 'Nama', 'NoTelepon', 'Kota', 'Bank', 'StatusLangganan', 
    'StatusJual', 'StatusTerdaftar'];
    
    public function GetPembeli()
    { 
     require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataPembeli = "SELECT Pembelis.Nama AS Nama, Pembelis.IDPembeli AS ID 
                              FROM Pembelis";
      $HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
      $DataPembeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
        $DataPembeli[] = $Hasil;
      }
      return $DataPembeli;
    }
    
    public function StorePembeli(Request $Request)
    {
        $unique_id = uniqid();
        $Pembeli = new Pembeli(array(
            'Nama' => $Request->get('Nama'),
            'NoTelepon' => $Request->get('NoTelepon'),
            'Kota' => $Request->get('Kota'),
            'Bank' => $Request->get('Bank'),
            'StatusLangganan' => (1),
            'StatusJual' => (1), 
            'StatusTerdaftar' => (1)
        ));
        $Pembeli->save();
        $ID = DB::table('Pembelis')->max('IDPembeli');
        $IDFoto = $ID.'.jpg';
        $Request->FotoPembeli->move(public_path('foto/pembeli'), $IDFoto);
    }

    public function UpdatePembeli(Request $Request)
    {
        $IDPembeli = $Request->get('IDPembeli');
        $ID = $Request->get('IDPembeli').'.jpg';
        DB::table('Pembelis')
            ->where('IDPembeli', $IDPembeli)
            ->update(['Nama' => $Request->get('Nama'),
                    'NoTelepon' => $Request->get('NoTelepon'),
                    'Kota' => $Request->get('Kota'),
                    'Bank' => $Request->get('Bank'),
                    'StatusLangganan' => $Request->get('StatusLangganan'),
                    'StatusJual' => $Request->get('StatusJual'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
        if($Request->hasFile('FotoPembeli')) {
            $Request->FotoPembeli->move(public_path('foto/pembeli'), $ID);
        }
    }
}
