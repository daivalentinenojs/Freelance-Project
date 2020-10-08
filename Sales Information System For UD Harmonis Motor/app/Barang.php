<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Barang extends Model
{
    protected $primaryKey = "IDBarang";
  	protected $table = 'Barangs';
  	protected $guarded = ['IDBarang'];
  	protected $fillable = ['IDBarang', 'Nama','Tahun', 'Stok', 'HPP', 'HargaJual',
  	'StatusTerdaftar', 'KategoriID'];

  	public function GetBarang()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarang = "SELECT Barangs.Nama AS Nama, 
                                Barangs.IDBarang AS ID, 
                                Kategoris.Nama AS NamaKategori 
                             FROM Barangs INNER JOIN Kategoris 
                              ON Barangs.KategoriID = Kategoris.IDKategori";
      $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
      $DataBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
      }
      return $DataBarang;
    }

    public function StoreBarang(Request $Request)
  	{
        $unique_id = uniqid();
        $IDKategori = $Request->get('KategoriID');
     	  $Barang = new Barang(array(
          	'Nama' => $Request->get('Nama'),
            'Tahun' => $Request->get('Tahun'),
            'Stok' => (0),
            'HPP' => (0),
          	'HargaJual' => $Request->get('HargaJual'),
          	'StatusTerdaftar' => (1),
            'KategoriID' => $IDKategori
      	));
      	$Barang->save();
      	$ID = DB::table('Barangs')->max('IDBarang');
          	$IDFoto = $ID.'.jpg';
          	$Request->FotoBarang->move(public_path('foto/barang'), $IDFoto);
  	}

  	public function UpdateBarang(Request $Request)
  	{
      $IDBarang = $Request->get('IDBarang');
     	$ID = $Request->get('IDBarang').'.jpg';
      	DB::table('Barangs')
          	->where('IDBarang', $IDBarang)
          	->update(['Nama' => $Request->get('Nama'),
                    'Tahun' => $Request->get('Tahun'),
                  	'HargaJual' => $Request->get('HargaJual'),
                  	'StatusTerdaftar' => $Request->get('StatusTerdaftar'),
                    'KategoriID' => $Request->get('KategoriID')]);
      	if($Request->hasFile('FotoBarang')) {
          $Request->FotoBarang->move(public_path('foto/barang'), $ID);
      	}
  	}
}
