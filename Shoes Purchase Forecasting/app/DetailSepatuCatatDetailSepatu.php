<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use DetailSepatu;

class DetailSepatuCatatDetailSepatu extends Model
{
    protected $table = 'DetailSepatuCatatDetailSepatu';
    protected $fillable = ['SizeID', 'BoxID', 'Jumlah'];
    public $timestamps = false;

    /*public function GetMerek()
    {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataMerek = "SELECT ms.ID as 'ID', ms.Nama as 'Merek' From MerekSepatu ms";

          $HasilQueryGetDataMerek = mysqli_query($MySQLi, $QueryGetDataMerek);
          $DataMerek = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataMerek)) {
          	$DataMerek[] = $Hasil;
          }
          return $DataMerek;
    }*/

    public function GetBox()
    {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataBox = "SELECT distinct ds.ID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', sob.Nama as 'Ukuran', w.Nama as 'Warna'
          FROM detailsepatu ds, mereksepatu ms, tipe t, sizeorbox sob, warna w
          WHERE ds.TipeID = t.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and sob.Nama LIKE '%box%' and ds.StatusBox = 0 ORDER BY ms.Nama, t.Nama, w.Nama ASC";

          $HasilQueryGetDataBox = mysqli_query($MySQLi, $QueryGetDataBox);
          $DataBox = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBox)) {
          	$DataBox[] = $Hasil;
          }
          return $DataBox;
    }

    public function GetUkuran($id)
    {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $sql = "SELECT ds.TipeID, ds.WarnaID FROM detailsepatu ds WHERE ds.ID =".$id;
          $hasilsql = mysqli_query($MySQLi, $sql);
          while($hasiltipewarna = mysqli_fetch_assoc($hasilsql)){
            $tipe = $hasiltipewarna['TipeID'];
            $warna = $hasiltipewarna['WarnaID'];
          }

          $QueryGetDataUkuran = "SELECT ds.ID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', sob.Nama as 'Ukuran', w.Nama as 'Warna'
          FROM detailsepatu ds, mereksepatu ms, tipe t, sizeorbox sob, warna w
          WHERE ds.TipeID = t.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and sob.Nama LIKE '%ukuran%' and ds.TipeID =".$tipe." and ds.WarnaID = ".$warna;

          $HasilQueryGetDataUkuran = mysqli_query($MySQLi, $QueryGetDataUkuran);
          $DataUkuran = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUkuran)) {
          	$DataUkuran[] = $Hasil;
          }
          return $DataUkuran;
    }

    public function StoreBoxDetail(Request $Request)
    {
        $unique_id = uniqid();
        //$Boxsize = $Request->get('NamaBoxSize');
        $row = $Request->get('JumlahPanel');
        $SizeSepatu = $Request->get('SizeSepatu');
        $Jumlah = $Request->get('Jumlah');
        $Boxsize = $Request->get('Merek');

        for($i=0; $i<$row; $i++){
          $BoxDetail = new DetailSepatuCatatDetailSepatu(array(
              'SizeID' => $SizeSepatu[$i],
              'BoxID' => $Boxsize,
              'Jumlah' => $Jumlah[$i],
          ));
          
          $BoxDetail->save();

          /*$IDBoxDetail = DB::table('BoxDetail')->select('ID')->orderBy('ID', 'DESC')->first();
          DB::table('MerekCatatBoxDetail')->insert([
            ['MerekSepatuID' => $merek,
            'BoxDetailID' => $IDBoxDetail->ID,
            'isDelete' => (1)]
          ]);
        }
        var_dump($SizeSepatu);*/

        DB::table('DetailSepatu')
            ->where('ID', $Boxsize)
            ->update(['StatusBox' => 1]);
      }
    }

    public function UpdateBoxDetail(Request $Request)
    {
        $IDSizeSepatu = $Request->get('IDMerekCatatBox');
        DB::table('MerekCatatBoxDetail')
            ->where('ID', $IDSizeSepatu)
            ->update(['isDelete' => $Request->get('isDelete')]);
    }
}
