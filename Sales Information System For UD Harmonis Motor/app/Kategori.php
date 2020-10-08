<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Kategori extends Model
{
    protected $table = 'Kategoris';
    protected $guarded = ['IDKategori'];
    protected $fillable = ['IDKategori', 'Nama', 'StatusTerdaftar'];

    public function GetKategori()
    { 
     require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataKategori = "SELECT Kategoris.Nama AS Nama, Kategoris.IDKategori AS ID 
                               FROM Kategoris";
      $HasilQueryGetDataKategori = mysqli_query($MySQLi, $QueryGetDataKategori);
      $DataKategori = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKategori)) {
        $DataKategori[] = $Hasil;
      }
      return $DataKategori;
    }

    public function StoreKategori(Request $Request)
    {
        $unique_id = uniqid();
        $Kategori = new Kategori(array(
            'Nama' => $Request->get('NamaKategori'),
            'StatusTerdaftar' => (1)
        ));
        $Kategori->save();
    }

    public function UpdateKategori(Request $Request)
    {
        $IDKategori = $Request->get('IDKategori');

        DB::table('Kategoris')
            ->where('IDKategori', $IDKategori)
            ->update(['Nama' => $Request->get('NamaKategori'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
    }
}
