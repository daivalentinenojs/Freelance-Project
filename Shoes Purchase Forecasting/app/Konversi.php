<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class Konversi extends Model
{
  protected $table = 'Konversi';
  protected $guarded = ['ID'];
  protected $fillable = ['Tanggal', 'Kuantiti', 'DetailSepatuID', 'UserID'];
  //$timestamps = false;
  public function GetBarang()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBarang = "SELECT DISTINCT dscds.BoxID as 'ID', m.Nama as 'Merek', t.Nama as 'Tipe', sob.Nama as 'JenisUkuran', w.Nama as 'Warna'
        FROM detailsepatucatatdetailsepatu dscds, detailsepatu ds, tipe t, mereksepatu m, warna w, sizeorbox sob
        where dscds.BoxID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = m.ID and ds.WarnaID = w.ID and ds.SizeOrBoxID = sob.ID";
        $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
        $DataBarang = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
          $DataBarang[] = $Hasil;
        }
        return $DataBarang;
  }

  public function GetStok($id)
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $sql = "SELECT ds.Stok FROM detailsepatu ds WHERE ds.ID =".$id;
        $hasilsql = mysqli_query($MySQLi, $sql);
        while($StokSaatIni = mysqli_fetch_assoc($hasilsql)){
          return $StokSaatIni['Stok'];
        }
  }

  public function StoreKonversi(Request $Request)
  {
      $unique_id = uniqid();
      $IDDetailSepatu = $Request->get('BoxSepatu');
      $JumlahBuka = $Request->get('JumlahBuka');
      $Konvert = new Konversi(array(
          'Tanggal' => $Request->get('TanggalBuat'),
          'Kuantiti' => $JumlahBuka,
          'DetailSepatuID' => $IDDetailSepatu,
          'UserID' => (2)
      ));
      $Konvert->save();

      //$JumlahSebelum = DB::table('DetailSepatu')->select('Stok')

      $JumlahBoxSebelum=DetailSepatu::where('ID','=',$IDDetailSepatu)->first();
      $jumboxsebelum = $JumlahBoxSebelum->Stok;
      //$banyak = $JumlahBuka;
      $JumlahBoxBaru = $jumboxsebelum - $JumlahBuka;

      DB::table('DetailSepatu')
          ->where('ID', $IDDetailSepatu)
          ->update(['Stok' => $JumlahBoxBaru//,
                    //'HargaBeliTerakhir' => $Harga[$i]
                  ]);
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $size=array();
      $jumlahsize = array();
      $stokS=array();
      $sql = "select ds.*,ds2.Stok ".
            "from detailsepatucatatdetailsepatu ds ".
            "INNER JOIN detailsepatu ds2 ON (ds2.ID=ds.SizeID) ".
            "where ds.BoxID='". $IDDetailSepatu."'";
      $hasilsql = mysqli_query($MySQLi, $sql);
      while($StokSaatIni = mysqli_fetch_assoc($hasilsql)){
            array_push($size,$StokSaatIni["SizeID"]);
            array_push($jumlahsize, $StokSaatIni['Jumlah']);
            array_push($stokS,$StokSaatIni['Stok']);
      }
      for ($i=0;$i<count($size);$i++)
      {
          $Jumlahtambah = $JumlahBuka * $jumlahsize[$i];
          DB::table('DetailSepatu')
            ->where('ID', $size[$i])
            ->update(['Stok' => $stokS[$i]+$Jumlahtambah
          ]);
      }
    }
}
