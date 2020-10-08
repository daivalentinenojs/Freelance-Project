<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Pemasok extends Model
{
    protected $table = 'Pemasoks';
    protected $guarded = ['IDPemasok'];
    protected $fillable = ['IDPemasok', 'NoRekening', 'NamaRekening', 'Bank', 'Alamat', 'NoTelepon',
    'StatusBeli', 'StatusTerdaftar'];

    public function GetPemasok()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataPemasok = "SELECT Pemasoks.NamaRekening AS Nama, Pemasoks.IDPemasok AS ID 
                              FROM Pemasoks";
      $HasilQueryGetDataPemasok = mysqli_query($MySQLi, $QueryGetDataPemasok);
      $DataPemasok = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemasok)) {
        $DataPemasok[] = $Hasil;
      }
      return $DataPemasok;
    }

    public function StorePemasok(Request $Request)
    {
        $unique_id = uniqid();
        $Pemasok = new Pemasok(array(
            'NoRekening' => $Request->get('NoRekening'),
            'NamaRekening' => $Request->get('NamaRekening'),
            'Bank' => $Request->get('Bank'),
            'Alamat' => $Request->get('Alamat'),
            'NoTelepon' => $Request->get('NoTelepon'),
            'StatusBeli' => (1), // 0 Blokir, 1 Belum Pesan, 2 Pesan Lunas, 3 Pesan Belum Lunas
            'StatusTerdaftar' => (1)
        ));
        $Pemasok->save();
        $ID = DB::table('Pemasoks')->max('IDPemasok');
            $IDFoto = $ID.'.jpg';
            $Request->FotoPemasok->move(public_path('foto/pemasok'), $IDFoto);
    }

    public function UpdatePemasok(Request $Request)
    {
        $IDPemasok = $Request->get('IDPemasok');
        $ID = $Request->get('IDPemasok').'.jpg';
        DB::table('Pemasoks')
            ->where('IDPemasok', $IDPemasok)
            ->update(['NoRekening' => $Request->get('NoRekening'),
                    'NamaRekening' => $Request->get('NamaRekening'),
                    'Bank' => $Request->get('Bank'),
                    'Alamat' => $Request->get('Alamat'),
                    'Alamat' => $Request->get('Alamat'),
                    'NoTelepon' => $Request->get('NoTelepon'),
                    'StatusBeli' => $Request->get('StatusBeli'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
      if($Request->hasFile('FotoPemasok')) {
          $Request->FotoPemasok->move(public_path('foto/pemasok'), $ID);
      }
    }
}
