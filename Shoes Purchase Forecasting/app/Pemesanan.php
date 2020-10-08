<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DetailSepatu;
use DB;
use App\DetailSepatuCatatPemesanan;
//use App\SepatuCatatPemesanan;

class Pemesanan extends Model
{
  protected $table = 'Pemesanan';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Tanggal', 'Total', 'Status', 'CustomerID', 'UserID'];

  public function GetBarang()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);
        $QueryGetDataBarang = "SELECT ds.ID as 'ID', ms.Nama as 'Merek', tp.Nama as 'Tipe'
        From Tipe tp, mereksepatu ms, detailsepatu ds
        Where tp.MerekSepatuID = ms.ID and tp.ID = ds.TipeID
        and ds.isDelete = 1 Group By ds.TipeID ORDER BY ms.Nama, tp.Nama";
        $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
        $DataBarang = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
          $DataBarang[] = $Hasil;
        }
        return $DataBarang;
  }

  public function GetUkuran($id)
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);
        $sql = "SELECT Distinct ds.TipeID FROM detailsepatu ds WHERE ds.ID =".$id;
        $hasilsql = mysqli_query($MySQLi, $sql);
        while($hasiltipewarna = mysqli_fetch_assoc($hasilsql)){
          $tipe = $hasiltipewarna['TipeID'];
        }

        $QueryGetDataUkuran = "SELECT ds.ID as 'ID', sob.Nama as 'Ukuran'
        FROM detailsepatu ds, sizeorbox sob
        WHERE ds.SizeorBoxID = sob.ID and ds.TipeID =".$tipe." Group BY sob.Nama";
        $HasilQueryGetDataUkuran = mysqli_query($MySQLi, $QueryGetDataUkuran);
        $DataUkuran = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUkuran)) {
          $DataUkuran[] = $Hasil;
        }
        return $DataUkuran;
  }

  public function GetWarna($id)
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $sql = "SELECT ds.TipeID, ds.SizeorBoxID FROM detailsepatu ds WHERE ds.ID =".$id;
        $hasilsql = mysqli_query($MySQLi, $sql);
        while($hasiltipeukuran = mysqli_fetch_assoc($hasilsql)){
          $tipe = $hasiltipeukuran['TipeID'];
          $ukuran = $hasiltipeukuran['SizeorBoxID'];
        }

        $QueryGetDataWarna = "SELECT ds.ID as 'ID', w.Nama as Warna
        FROM detailsepatu ds, warna w
        WHERE ds.TipeID =".$tipe." and ds.SizeOrBoxID =".$ukuran." and ds.WarnaID = w.ID group by w.Nama";

        $HasilQueryGetDataWarna = mysqli_query($MySQLi, $QueryGetDataWarna);
        $DataWarna = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataWarna)) {
          $DataWarna[] = $Hasil;
        }
        return $DataWarna;
  }

  public function GetPrice($id)
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $sql = "SELECT ds.ID as 'ID', t.nama as 'Tipe', ms.nama as 'Merek', w.Nama as 'Warna', sob.Nama as 'JenisUkuran', ds.HargaJual as 'HargaJual'
        FROM detailsepatu ds
        INNER JOIN tipe t ON (ds.TipeID = t.ID)
        INNER JOIN mereksepatu ms ON (ms.ID = t.MerekSepatuID)
        INNER JOIN warna w ON (w.ID = ds.WarnaID)
        INNER JOIN sizeorbox sob ON (sob.ID = ds.SizeorBoxID)
        WHERE ds.ID =".$id;
        $hasilsql = mysqli_query($MySQLi, $sql);
        $hasilHarga = mysqli_fetch_assoc($hasilsql);
        return $hasilHarga;
  }

  public function GetCustomer()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataCustomer = "SELECT s.ID as 'ID', s.NamaToko as 'pelanggan' from customer s where s.isDelete = 1";
        $HasilQueryGetDataCustomer = mysqli_query($MySQLi, $QueryGetDataCustomer);
        $DataCustomer = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataCustomer)) {
          $DataCustomer[] = $Hasil;
        }
        return $DataCustomer;
  }

  public function GetUser()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataUser = "SELECT u.IDUser as 'ID', u.Nama as 'User' from User u, Jabatan j
        where u.JabatanID = j.ID and u.isDelete = 1 and (j.Nama = 'Karyawan' or j.Nama = 'Pimpinan')";
        $HasilQueryGetDataUser = mysqli_query($MySQLi, $QueryGetDataUser);
        $DataUser = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUser)) {
          $DataUser[] = $Hasil;
        }
        return $DataUser;
  }

  public function HeaderDetailNota($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataPesanan= "SELECT p.Nomor AS 'Nomor', p.Tanggal AS 'Tanggal', c.NamaToko AS 'Pelanggan', u.Nama AS 'Karyawan',
   p.Total as 'Total', p.Status as 'Status', p.Nomor as 'View' FROM Pemesanan p, Customer c, User u
   Where p.CustomerID = c.id and p.UserID = u.IDUser and p.Nomor = '$IDNota'";
    $HasilQueryGetDataPesanan = mysqli_query($MySQLi, $QueryGetDataPesanan);
    $DataPesanan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPesanan)) {
      $DataPesanan[] = $Hasil;
    }
    return $DataPesanan;
  }

  public function DataTable($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataDetailSepatu= "SELECT dspp.PemesananID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', w.Nama as 'Warna', sob.Nama as 'Ukuran', dspp.Jumlah as 'Jumlah', ds.HargaJual as 'Harga'
    FROM detailsepatucatatpemesanan dspp, detailsepatu ds, mereksepatu ms, tipe t, warna w, sizeorbox sob, pemesanan pp
    WHERE dspp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and ds.WarnaID = w.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and pp.Nomor = dspp.PemesananID and dspp.PemesananID  = '$IDNota'";
    $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
    $DataDetailSepatu = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
      $DataDetailSepatu[] = $Hasil;
    }
    return $DataDetailSepatu;
  }

  public function HitungBaris($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDatabaris= "SELECT COUNT(dspp.PemesananID) as baris FROM detailsepatucatatpemesanan dspp WHERE dspp.PemesananID = '$IDNota'";
    $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
    $Databaris = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
      $Databaris[] = $Hasil;
    }
    return $Databaris;
  }

  public function PrintLaporan(Request $Request)
  {
    $tanggalAwal = $Request->get('tanggalAwal');
    $tanggalAkhir = $Request->get('tanggalAkhir');
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataDetailSepatu= "SELECT pp.Nomor as 'NomorNota', pp.Tanggal as 'TanggalBeli', c.NamaToko as 'NamaToko', u.Nama as 'Karyawan',
    concat(ms.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBarang', dscp.Jumlah as 'Jumlah'
    FROM pemesanan pp, detailsepatucatatpemesanan dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, customer c, user u
    WHERE pp.Nomor = dscp.PemesananID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.CustomerID = c.ID and pp.UserID = u.IDUser
    and pp.Tanggal BETWEEN '$tanggalAwal' and '$tanggalAkhir' ORDER BY pp.Nomor asc";
    $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
    $DataDetailSepatu = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
      $DataDetailSepatu[] = $Hasil;
    }
    //print_r($DataDetailSepatu);
    return $DataDetailSepatu;
  }

  public function HitungBarisLaporan(Request $Request)
  {
    $tanggalAwal = $Request->get('tanggalAwal');
    $tanggalAkhir = $Request->get('tanggalAkhir');

    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataBarisLaporan= "SELECT count(pp.Nomor) as 'Baris'
    FROM pemesanan pp, detailsepatucatatpemesanan dscp
    WHERE pp.Nomor = dscp.PemesananID and pp.Tanggal between '$tanggalAwal' and '$tanggalAkhir'";
    $HasilQueryGetDataBarisLaporan = mysqli_query($MySQLi, $QueryGetDataBarisLaporan);
    $DataBarisLaporan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarisLaporan)) {
      $DataBarisLaporan[] = $Hasil;
    }
    //print_r($DataDetailSepatu);
    return $DataBarisLaporan;
  }

  public function StoreNotaPesan(Request $Request)
  {
      $unique_id = uniqid();
      $harga = $Request->get('Harga');
      $ID = $Request->session()->get('ID');
      //$Total = $Request->get('BiayaTotal');
      $NotaPesan = new pemesanan(array(
          'Tanggal' => $Request->get('TanggalBuat'),
          'Total' => $Request->get('BiayaTotal'),
          'Status' => (0),//$Request->get('Status'),
          'CustomerID' => $Request->get('IDCustomer'),
          'UserID' => $ID
      ));
      $NotaPesan->save();

      //$row = $Request->get('JumlahPanel');
      $IDDetailSepatu = $Request->get('IDDetailSepatu');
      $Jumlah = $Request->get('Jumlah');
      $IDPemesanan = DB::table('pemesanan')->select('Nomor')->orderBy('Nomor', 'DESC')->first();

      $arrKode= json_decode($Request->get('arrKode'));
      $arrJumlah= json_decode($Request->get('arrJumlah'));
      $arrHarga= json_decode($Request->get('arrHarga'));

      for($i=0; $i < count($arrKode); $i++){
      DB::table('DetailSepatuCatatPemesanan')->insert([
        ['DetailSepatuID' => $arrKode[$i],
        'PemesananID' => $IDPemesanan->Nomor,
        'Jumlah' => $arrJumlah[$i]]
        //'harga'=>$Harga[$i]]
      ]);

      //$JumlahSebelum = DB::table('DetailSepatu')->select('Stok')

      /*$JumlahSebelum=DetailSepatu::where('ID','=',$IDDetailSepatu[$i])->first();
      $jumsebelum = $JumlahSebelum->Stok;
      $banyak = $Jumlah[$i];
      $JumlahBaru = $jumsebelum - $banyak;

      DB::table('DetailSepatu')
          ->where('ID', $IDDetailSepatu[$i])
          ->update(['Stok' => $JumlahBaru]);*/
                    //'HargaBeliTerakhir' => $Harga[$i]]);
    }
  }

  public function UpdateNotaPesan(Request $Request)
  {
      $IDNotaBeli = $Request->get('NomorNotaBeli');
      DB::table('PesanPembelian')
          ->where('Nomor', $IDNotaBeli)
          ->update(['Tanggal' => $Request->get('Tanggal'),
                    'Total' => $Request->get('Total'),
                    'Status' => $Request->get('Status'),
                    'SupplierID' => $Request->get('IDSupplier'),
                    'UserID' => $Request->get('IDUser')]);
  }
}
