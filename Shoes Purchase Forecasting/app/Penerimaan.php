<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\DetailSepatuCatatPenerimaan;
use App\PesanPembelian;
use App\DetailSepatu;

class Penerimaan extends Model
{
  protected $table = 'Penerimaan';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Tanggal', 'Total', 'NomorPesanPembelian', 'SupplierID', 'UserID'];

  public function GetNotaPesanPembelian(){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataPembelian = "SELECT pp.Nomor as 'Nomor', pp.Tanggal as 'Tanggal', sup.Nama as 'Supplier'
    FROM pesanpembelian pp, supplier sup WHERE pp.SupplierID = sup.ID and pp.Status = 0";
    $HasilQueryGetDataPembelian = mysqli_query($MySQLi, $QueryGetDataPembelian);
    $DataPembelian = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembelian)) {
      $DataPembelian[] = $Hasil;
    }
    return $DataPembelian;
  }

  public function DataNota($IDNota){
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

  public function HeaderDetailNota($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataPesanPembelian= "SELECT DISTINCT p.Nomor as 'Nomor', p.Tanggal as 'TanggalTerima', s.Nama as 'Supplier', u.Nama as 'Karyawan', p.Total as 'Total', pp.Status as 'Status'
    FROM penerimaan p, detailsepatucatatpenerimaan dscp, supplier s, user u, pesanpembelian pp
    WHERE p.Nomor = dscp.PenerimaanID and pp.SupplierID = s.ID and p.UserID = u.IDUser and p.NomorPesanPembelian = pp.Nomor and p.Nomor = '$IDNota'";
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
    $QueryGetDataDetailSepatu= "SELECT t.Nama as 'Tipe', ms.Nama as 'Merek', sob.Nama as 'Ukuran', w.Nama as 'Warna', dscp.Jumlah as 'Jumlah', dscp.Harga as 'Harga'
    FROM detailsepatu ds, detailsepatucatatpenerimaan dscp, tipe t, warna w, sizeorbox sob, mereksepatu ms
    WHERE ms.ID = t.MerekSepatuID and ds.TipeID = t.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID and dscp.DetailSepatuID = ds.ID and dscp.PenerimaanID = '$IDNota'";
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
    $QueryGetDatabaris= "SELECT COUNT(dspp.PenerimaanID) as baris FROM detailsepatucatatpenerimaan dspp WHERE dspp.PenerimaanID = '$IDNota'";
    $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
    $Databaris = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
      $Databaris[] = $Hasil;
    }
    return $Databaris;
  }

  public function GetBarang()
  {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBarang = "SELECT ds.ID as 'ID', ms.Nama as 'Merek', tp.Nama as 'Tipe', w.Nama as 'Warna',
        ds.JenisUkuran as 'JenisUkuran' From Tipe tp, mereksepatu ms, detailsepatu ds, warna w
        Where tp.MerekSepatuID = ms.ID and tp.ID = ds.TipeID and w.ID = ds.WarnaID and ds.isDelete = 1
        and (ds.JenisUkuran = 'Kecil' or ds.JenisUkuran = 'Sedang' or ds.JenisUkuran = 'Besar') ORDER BY ds.ID";
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

  public function PrintLaporanPembelian(Request $Request)
  {
    $tanggalAwal = $Request->get('tanggalAwal');
    $tanggalAkhir = $Request->get('tanggalAkhir');
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataDetailSepatu= "SELECT pp.Nomor as 'NomorNota', pp.Tanggal as 'TanggalDatang', u.Nama as 'Karyawan', s.Nama as 'Supplier',
    concat(ms.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBarang', dscp.Jumlah as 'Jumlah', dscp.harga as 'HargaBeli'
    FROM penerimaan pp, detailsepatucatatpenerimaan dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, user u, pesanpembelian pem, supplier s
    WHERE pp.Nomor = dscp.PenerimaanID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.UserID = u.IDUser and pp.NomorPesanPembelian = pem.Nomor and pem.SupplierID = s.ID
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
    FROM penerimaan pp, detailsepatucatatpenerimaan dscp
    WHERE pp.Nomor = dscp.PenerimaanID and pp.Tanggal between '$tanggalAwal' and '$tanggalAkhir'";
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
    FROM penerimaan pp, detailsepatucatatpenerimaan dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, user u
    WHERE pp.Nomor = dscp.PenerimaanID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.UserID = u.IDUser
    and pp.Tanggal BETWEEN '$tanggalAwal' and '$tanggalAkhir' ORDER BY pp.Nomor asc";
    $HasilQueryGetTotal = mysqli_query($MySQLi, $QueryGetTotal);
    $Total = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetTotal)) {
      $Total[] = $Hasil;
    }
    return $Total;
  }

  public function StoreNotaTerima(Request $Request)
  {
      //Store ke Pesan Pembelian
      $IDPesanPembelian = $Request->get('DataPembelian');
      $ID = $Request->session()->get('ID');
      $totalharga =  DB::table('PesanPembelian')->select('Total')
                      ->Where('Nomor','=',$IDPesanPembelian)->first();
      $totalharga = $totalharga->Total;
      $unique_id = uniqid();
      $NotaBeli = new Penerimaan(array(
          'Tanggal' => $Request->get('TanggalTerima'),
          'NomorPesanPembelian' => $Request->get('DataPembelian'),
          'Total' => $totalharga,
          'UserID' => $ID
      ));
      $NotaBeli->save();

      $IDDetailSepatu = $Request->get('IDSepatu');
      $Jumlah = $Request->get('Jumlah');

      $IDPenerimaan = DB::table('Penerimaan')->select('Nomor')->orderBy('Nomor', 'DESC')->first();
      for($i=0; $i < sizeof($Jumlah); $i++){
        $harga = DB::table('DetailSepatuCatatPesanPembelian')
                  ->join('PesanPembelian', 'DetailSepatuCatatPesanPembelian.PembelianID', '=', 'PesanPembelian.Nomor')
                  ->select('detailsepatucatatpesanpembelian.harga')
                  ->Where('detailsepatucatatpesanpembelian.DetailSepatuID', '=', $IDDetailSepatu[$i])
                  ->Where('PesanPembelian.Nomor', '=', $IDPesanPembelian)
                  ->first();
        //$harga = DB::table('')
        $harga= $harga->harga;
        DB::table('DetailSepatuCatatPenerimaan')->insert([
        ['DetailSepatuID' => $IDDetailSepatu[$i],
        'PenerimaanID' => $IDPenerimaan->Nomor,
        'Jumlah' => $Jumlah[$i],
        'harga' =>$harga]
      ]);

      $JumlahSebelum = DB::table('DetailSepatu')->select('Stok')
      ->Where('ID','=',$IDDetailSepatu[$i])->first();
      $JumlahSebelum = $JumlahSebelum->Stok;

      //$JumlahSebelum = DetailSepatu::Where('ID','=',$IDDetailSepatu[$i])->first();
      //$akhir = $JumlahSebelum->Stok;
      $JumlahBaru = $JumlahSebelum + $Jumlah[$i];

      DB::table('DetailSepatu')
          ->where('ID', $IDDetailSepatu[$i])
          ->update(['Stok' => $JumlahBaru,
                    'HargaBeliTerakhir' => $harga]);
      }
      $Status = 1;
      $IDNotaBeli = $Request->get('DataPembelian');
      DB::table('PesanPembelian')
          ->where('Nomor', $IDNotaBeli)
          ->update(['Status' => $Status]);
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
