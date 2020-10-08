<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DetailSepatu;
use DB;
use App\SepatuCatatPesanPembelian;

class PesanPembelian extends Model
{
  protected $table = 'PesanPembelian';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Tanggal', 'Total', 'Status', 'SupplierID', 'UserID'];

  public function GetBarang()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBarang = "SELECT ds.ID as 'ID', ms.Nama as 'Merek', tp.Nama as 'Tipe', w.Nama as 'Warna',
        sob.Nama as 'JenisUkuran' From Tipe tp, mereksepatu ms, detailsepatu ds, warna w, sizeorbox sob
        Where tp.MerekSepatuID = ms.ID and tp.ID = ds.TipeID and w.ID = ds.WarnaID and ds.SizeorBoxID = sob.ID
        and ds.isDelete = 1 and sob.Nama LIKE '%box%' ORDER BY ds.ID";
        $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
        $DataBarang = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
          $DataBarang[] = $Hasil;
        }
        return $DataBarang;
  }

  public function GetSupplier()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataSupplier = "SELECT s.ID as 'ID', s.Nama as 'Supplier' from Supplier s where s.isDelete = 1";
        $HasilQueryGetDataSupplier = mysqli_query($MySQLi, $QueryGetDataSupplier);
        $DataSupplier = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSupplier)) {
          $DataSupplier[] = $Hasil;
        }
        return $DataSupplier;
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
    $QueryGetDataPesanPembelian= "SELECT pp.Nomor AS 'Nomor', pp.Tanggal AS 'Tanggal', s.Nama AS 'Supplier', u.Nama AS 'Karyawan',
    pp.Total as 'Total', pp.Status as 'Status', pp.Nomor as 'View', pp.Nomor as 'Edit' FROM PesanPembelian pp, Supplier s, User u
    Where pp.SupplierID = s.id and pp.UserID = u.IDUser and pp.Nomor = '$IDNota'";
    $HasilQueryGetDataPesanPembelian = mysqli_query($MySQLi, $QueryGetDataPesanPembelian);
    $DataPesanPembelian = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPesanPembelian)) {
      $DataPesanPembelian[] = $Hasil;
    }
    return $DataPesanPembelian;
  }

  public function DataTable($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataDetailSepatu= "SELECT ds.ID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', w.Nama as 'Warna', sob.Nama as 'Ukuran', dspp.Jumlah as 'Jumlah', dspp.harga as 'Harga'
    FROM detailsepatucatatpesanpembelian dspp, detailsepatu ds, mereksepatu ms, tipe t, warna w, sizeorbox sob, pesanpembelian pp
    WHERE dspp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and ds.WarnaID = w.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and pp.Nomor = dspp.PembelianID and dspp.PembelianID  = '$IDNota'";
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
    $QueryGetDatabaris= "SELECT COUNT(dspp.PembelianID) as baris FROM detailsepatucatatpesanpembelian dspp WHERE dspp.PembelianID = '$IDNota'";
    $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
    $Databaris = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
      $Databaris[] = $Hasil;
    }
    return $Databaris;
  }

  public function PrintLaporanPembelian(Request $Request)
  {
    $tanggalAwal = $Request->get('tanggalAwal');
    $tanggalAkhir = $Request->get('tanggalAkhir');
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataDetailSepatu= "SELECT pp.Nomor as 'NomorNota', pp.Tanggal as 'TanggalBeli', s.Nama as 'Supplier', u.Nama as 'Karyawan',
    concat(ms.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBarang', dscp.Jumlah as 'Jumlah', dscp.harga as 'HargaBeli'
    FROM pesanpembelian pp, detailsepatucatatpesanpembelian dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, supplier s, user u
    WHERE pp.Nomor = dscp.PembelianID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.SupplierID = s.ID and pp.UserID = u.IDUser
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
    FROM pesanpembelian pp, detailsepatucatatpesanpembelian dscp
    WHERE pp.Nomor = dscp.PembelianID and pp.Tanggal between '$tanggalAwal' and '$tanggalAkhir'";
    $HasilQueryGetDataBarisLaporan = mysqli_query($MySQLi, $QueryGetDataBarisLaporan);
    $DataBarisLaporan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarisLaporan)) {
      $DataBarisLaporan[] = $Hasil;
    }
    //print_r($DataDetailSepatu);
    return $DataBarisLaporan;
  }

  public function HitungTotalLaporan(Request $Request)
  {
    $tanggalAwal = $Request->get('tanggalAwal');
    $tanggalAkhir = $Request->get('tanggalAkhir');
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetTotal= "SELECT sum(dscp.harga) as 'Total'
    FROM pesanpembelian pp, detailsepatucatatpesanpembelian dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, supplier s, user u
    WHERE pp.Nomor = dscp.PembelianID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.SupplierID = s.ID and pp.UserID = u.IDUser
    and pp.Tanggal BETWEEN '$tanggalAwal' and '$tanggalAkhir' ORDER BY pp.Nomor asc";
    $HasilQueryGetTotal = mysqli_query($MySQLi, $QueryGetTotal);
    $Total = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetTotal)) {
      $Total[] = $Hasil;
    }
    return $Total;
  }

  public function StoreNotaBeli(Request $Request)
  {
      $unique_id = uniqid();
      $harga = $Request->get('Harga');
      $ID = $Request->session()->get('ID');
      //$Total = $Request->get('BiayaTotal');
      $NotaBeli = new pesanpembelian(array(
          'Tanggal' => $Request->get('TanggalBuat'),
          'Total' => $Request->get('BiayaTotal'),
          'Status' => (0),//$Request->get('Status'),
          'SupplierID' => $Request->get('IDSupplier'),
          'UserID' => $ID
      ));
      $NotaBeli->save();

      $IDDetailSepatu = $Request->get('IDDetailSepatu');
      $IDPesanPembelian = DB::table('pesanpembelian')->select('Nomor')->orderBy('Nomor', 'DESC')->first();

      $arrKode= json_decode($Request->get('arrKode'));
      $arrJumlah= json_decode($Request->get('arrJumlah'));
      $arrHarga= json_decode($Request->get('arrHarga'));

        for($i=0; $i < count($arrKode); $i++){

          DB::table('DetailSepatuCatatPesanPembelian')->insert([
            ['DetailSepatuID' =>$arrKode[$i],
            'PembelianID' => $IDPesanPembelian->Nomor,
            'Jumlah' => $arrJumlah[$i],
            'harga'=>$arrHarga[$i]]
          ]);


      //$JumlahSebelum = DB::table('DetailSepatu')->select('Stok')

      /*$JumlahSebelum=DetailSepatu::where('ID','=',$IDDetailSepatu[$i])->first();
      $jumsebelum = $JumlahSebelum->Stok;
      $banyak = $Jumlah[$i];
      $JumlahBaru = $jumsebelum + $banyak;

      DB::table('DetailSepatu')
          ->where('ID', $IDDetailSepatu[$i])
          ->update(['Stok' => $JumlahBaru,
                    'HargaBeliTerakhir' => $Harga[$i]]);*/
    }
  }

  public function UpdateNotaBeli(Request $Request)
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
