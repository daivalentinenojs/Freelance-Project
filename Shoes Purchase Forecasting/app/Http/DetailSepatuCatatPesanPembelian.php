<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DetailSepatuCatatPesanPembelian extends Model
{
  protected $table = 'DetailSepatuCatatPesanPembelian';
  protected $guarded = ['ID'];
  protected $fillable = ['DetailSepatuID', 'PembelianID', 'Jumlah', 'Harga'];

  public function StoreSepatuCatatPemesanan(Request $Request)
  {
      $unique_id = uniqid();
      $SepatuCatatPemesanan = new SepatuCatatPemesanan(array(
          'DetailSepatuID' => $Request->get('IDSepatu'),
          'PembelianID' => $Request->get('IDPembelian'),
          'Jumlah' => $Request->get('Jumlah'),
          'Harga' => $Request->get('Harga')
      ));
      $SepatuCatatPemesanan->save();
  }

  public function UpdateSepatuCatatPemesanan(Request $Request)
  {
      $IDSepatuPesan = $Request->get('IDSepatuPesan');
      $IDSepatu = $Request->get('IDSepatu');
      $IDPemesanan = $Request->get('IDPemesanan');
      DB::table('DetailSepatuCatatPesanPembelian')
          ->where('DetailSepatuID', $IDSepatu)
          ->where('PembelianID', $IDPembelian)
          ->update(['Jumlah' => $Request->get('Jumlah'),
                    'Harga' => $Request->get('Harga'),
                    'DetailSepatuID' => $Request->get('IDSepatu'),
                    'PembelianID' => $Request->get('IDPemesanan')]);
  }

  public function DetailSepatu(){
     return $this->belongsTo('App\DetailSepatu', 'IDDetailSepatu');
  }

  public function PesanPembelian(){
     return $this->belongsTo('App\PesanPembelian','PembelianID', 'Nomor');
  }

  public function DataNota(){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataDetailSepatu= "SELECT ds.ID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', w.Nama as 'Warna', ds.JenisUkuran as 'Ukuran',
    dspp.Jumlah as 'Jumlah', dspp.harga as 'Harga' FROM detailsepatucatatpesanpembelian dspp, detailsepatu ds, mereksepatu ms, tipe t, warna w
    WHERE dspp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and ds.WarnaID = w.ID and t.MerekSepatuID = ms.ID and dspp.PembelianID = '33'";
    $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
    $DataDetailSepatu = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
      $DataDetailSepatu[] = $Hasil;
    }
    return $DataDetailSepatu;

    //return $QueryGetDataDetailSepatu;
  }
}
