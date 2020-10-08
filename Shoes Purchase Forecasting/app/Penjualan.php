<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
//use App\DetailSepatuCatatPenerimaan;
use App\PesanPembelian;
use App\DetailSepatu;

class Penjualan extends Model
{
  protected $table = 'Penjualan';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Tanggal', 'Total', 'NomorPemesanan', 'CustomerID', 'UserID'];

  public function GetNotaPesan(){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataPesanan = "SELECT p.Nomor as 'Nomor', p.Tanggal as 'Tanggal', c.NamaToko as 'Customer'
    FROM pemesanan p, customer c WHERE p.CustomerID = c.ID and p.Status = 0";
    $HasilQueryGetDataPesanan = mysqli_query($MySQLi, $QueryGetDataPesanan);
    $DataPesanan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPesanan)) {
      $DataPesanan[] = $Hasil;
    }
    return $DataPesanan;
  }

  public function DataNota($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataDetailSepatu= "SELECT ds.ID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', w.Nama as 'Warna', sob.Nama as 'Ukuran', dscp.Jumlah as 'Jumlah', ds.HargaJual as 'Harga', p.Total as 'Total', ds.Stok as 'Stoksaatini'
    FROM detailsepatucatatpemesanan dscp, detailsepatu ds, mereksepatu ms, tipe t, warna w, sizeorbox sob, pemesanan p
    WHERE dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and ds.WarnaID = w.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and p.Nomor = dscp.PemesananID and dscp.PemesananID  = '$IDNota'";
    $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
    $DataDetailSepatu = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
      $DataDetailSepatu[] = $Hasil;
    }
    return $DataDetailSepatu;

    //return $QueryGetDataDetailSepatu;
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

  public function HeaderDetailNota($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataPenjualan= "SELECT DISTINCT pj.Nomor as 'Nomor', pm.Tanggal as 'TanggalPesan', pj.Tanggal as 'TanggalKirim', c.NamaToko 'NamaToko', u.Nama as 'Karyawan', pm.Status as 'Status', pj.Total as 'Total'
    FROM pemesanan pm, penjualan pj, detailsepatucatatpenjualan dscpj, customer c, user u
    where pj.NomorPemesanan = pm.Nomor and pj.Nomor = dscpj.PenjualanID and pj.UserID = u.IDUser and pm.CustomerID = c.ID and pj.Nomor = '$IDNota'";
    $HasilQueryGetDataPenjualan = mysqli_query($MySQLi, $QueryGetDataPenjualan);
    $DataPenjualan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPenjualan)) {
      $DataPenjualan[] = $Hasil;
    }
    return $DataPenjualan;
  }

  public function DataTable($IDNota){
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);
    $QueryGetDataDetailSepatu= "SELECT t.Nama as 'Tipe', ms.Nama as 'Merek', sob.Nama as 'Ukuran', w.Nama as 'Warna', dscp.Jumlah as 'Jumlah', dscp.Harga as 'Harga'
    FROM detailsepatu ds, detailsepatucatatpenjualan dscp, tipe t, warna w, sizeorbox sob, mereksepatu ms
    WHERE ms.ID = t.MerekSepatuID and ds.TipeID = t.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID and dscp.DetailSepatuID = ds.ID and dscp.PenjualanID = '$IDNota'";
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
    $QueryGetDatabaris= "SELECT COUNT(dspp.PenjualanID) as baris FROM detailsepatucatatpenjualan dspp WHERE dspp.PenjualanID = '$IDNota'";
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
    $QueryGetDataDetailSepatu= "SELECT pp.Nomor as 'NomorNota', pp.Tanggal as 'TanggalKirim', u.Nama as 'Karyawan', c.NamaToko as 'NamaToko',
    concat(ms.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBarang', dscp.Jumlah as 'Jumlah', dscp.harga as 'HargaBeli'
    FROM penjualan pp, detailsepatucatatpenjualan dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, user u, pemesanan pem, customer c
    WHERE pp.Nomor = dscp.PenjualanID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.UserID = u.IDUser and pp.NomorPemesanan = pem.Nomor and pem.CustomerID = c.ID
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
    FROM penjualan pp, detailsepatucatatpenjualan dscp
    WHERE pp.Nomor = dscp.PenjualanID and pp.Tanggal between '$tanggalAwal' and '$tanggalAkhir'";
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
    FROM penjualan pp, detailsepatucatatpenjualan dscp, detailsepatu ds, tipe t, mereksepatu ms,
    sizeorbox sob, warna w, user u
    WHERE pp.Nomor = dscp.PenjualanID and dscp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID
    and ds.SizeorBoxID = sob.ID and ds.WarnaID = w.ID and pp.UserID = u.IDUser
    and pp.Tanggal BETWEEN '$tanggalAwal' and '$tanggalAkhir' ORDER BY pp.Nomor asc";
    $HasilQueryGetTotal = mysqli_query($MySQLi, $QueryGetTotal);
    $Total = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetTotal)) {
      $Total[] = $Hasil;
    }
    return $Total;
  }

  public function StoreNotaPenjualan(Request $Request)
  {
    $IDPesanan = $Request->get('DataPesanan');
    $ID = $Request->session()->get('ID');
    $DataPesanan =  DB::table('DetailSepatuCatatPemesanan')->Where('PemesananID','=',$IDPesanan)->get();
    $total = 0;
    //$DataHarga = DB::('DetailSepatu')->Where
    for ($i=0;$i<count($DataPesanan);$i++)
    {
      $harga = DB::table('DetailSepatu')
                ->join('DetailSepatuCatatPemesanan', 'DetailSepatuCatatPemesanan.DetailSepatuID', '=', 'DetailSepatu.ID')
                ->select('DetailSepatu.HargaJual')
                ->Where('DetailSepatuCatatPemesanan.PemesananID', '=', $IDPesanan)
                ->get();
      $price = array();
      foreach($harga as $h){
        array_push($price, $h->HargaJual);
      }
                //dd($price);
      //$harga = $harga;
      $detail = $DataPesanan[$i];
      $stokInput = $detail->Jumlah;
      $stok = DB::table('detailsepatu')->Where("ID","=",$detail->DetailSepatuID)->first();
      if ($detail->Jumlah > $stok->Stok)
      {
        $stokInput=$stok->Stok;
      }
      else{
        $stokInput = $detail->Jumlah;
      }
      $total+=($stokInput*$price[$i]);
    }

    $unique_id = uniqid();
    $NotaJual = new Penjualan(array(
        'Tanggal' => $Request->get('TanggalJual'),
        'NomorPemesanan' => $Request->get('DataPesanan'),
        'Total' => $total,
        'UserID' => $ID
    ));
    $NotaJual->save();

    $IDPenjualan = DB::table('Penjualan')->select('Nomor')->orderBy('Nomor', 'DESC')->first();
    for ($i=0;$i<count($DataPesanan);$i++)
    {
      $harga = DB::table('DetailSepatu')
                ->join('DetailSepatuCatatPemesanan', 'DetailSepatuCatatPemesanan.DetailSepatuID', '=', 'DetailSepatu.ID')
                ->select('DetailSepatu.HargaJual')
                ->Where('DetailSepatuCatatPemesanan.PemesananID', '=', $IDPesanan)
                ->get();
      $price = array();
      foreach($harga as $h){
        array_push($price, $h->HargaJual);
      }
      $detail = $DataPesanan[$i];
      $stokInput = $detail->Jumlah;
      $stok = DB::table('detailsepatu')->Where("ID","=",$detail->DetailSepatuID)->first();
      if ($detail->Jumlah > $stok->Stok)
      {
        $stokInput = $stok->Stok;
      }
      else{
        $stokInput = $detail->Jumlah;
      }
      DB::table('DetailSepatuCatatPenjualan')->insert([
        ['DetailSepatuID' => $detail->DetailSepatuID,
        'PenjualanID' => $IDPenjualan->Nomor,
        'Jumlah' => $stokInput,
        'harga' =>$price[$i]]
      ]);

      $JumlahSebelum = DB::table('DetailSepatu')->select('Stok')
      ->Where('ID','=',$detail->DetailSepatuID)->first();
      $JumlahSebelum = $JumlahSebelum->Stok;

      //$JumlahSebelum = DetailSepatu::Where('ID','=',$IDDetailSepatu[$i])->first();
      //$akhir = $JumlahSebelum->Stok;
      $JumlahBaru = $JumlahSebelum - $stokInput;

      DB::table('DetailSepatu')
          ->where('ID', $detail->DetailSepatuID)
          ->update(['Stok' => $JumlahBaru]);
    }

    $Status = 1;
    $IDNotaPesan = $Request->get('DataPesanan');
    DB::table('Pemesanan')
        ->where('Nomor', $IDNotaPesan)
        ->update(['Status' => $Status]);
  }

  public function StoreNotaPenjualan2(Request $Request)
  {
    // $arrKode= json_decode($Request->get('arrKode'));
    // $arrJumlah= json_decode($Request->get('arrJumlah'));
    // $arrHarga= json_decode($Request->get('arrHarga'));
    // $arrTotal= json_decode($Request->get('arrTotal'));
      //Store ke Pesan Pembelian
      $IDPesanan = $Request->get('DataPesanan');
      $totalharga =  DB::table('Pemesanan')->select('Total')
                      ->Where('Nomor','=',$IDPesanan)->first();
      $totalharga = $totalharga->Total;
      $unique_id = uniqid();
      $NotaJual = new Penjualan(array(
          'Tanggal' => $Request->get('TanggalJual'),
          'NomorPemesanan' => $Request->get('DataPesanan'),
          //'Total' => $totalharga,
          'Total' => $Request->get('arrTotal'),
          'UserID' => (2)
      ));
      $NotaJual->save();

      $IDDetailSepatu = $Request->get('IDSepatu');
      $Jumlah = $Request->get('Jumlah');
      $IDPenjualan = DB::table('Penjualan')->select('Nomor')->orderBy('Nomor', 'DESC')->first();
      for($i=0; $i < sizeof($IDDetailSepatu); $i++){
        $harga = DB::table('DetailSepatuCatatPenjualan')
                  ->join('Penjualan', 'DetailSepatuCatatPenjualan.PenjualanID', '=', 'Penjualan.Nomor')
                  ->select('detailsepatucatatpenjualan.harga')
                  ->Where('detailsepatucatatpenjualan.DetailSepatuID', '=', $IDDetailSepatu[$i])
                  ->Where('Penjualan.Nomor', '=', $IDPesanan)
                  ->first();
        $stokada = DB::table('DetailSepatu')
                    ->select('Stok')
                    ->Where('ID', '=', $arrKode[$i])
                    ->first();
        //$harga= $harga->harga;

        if($arrJumlah > $stokada){
          DB::table('DetailSepatuCatatPenjualan')->insert([
          ['DetailSepatuID' => $arrKode[$i],
          'PenjualanID' => $IDPenjualan->Nomor,
          'Jumlah' => $stokada,
          'harga' =>$arrHarga[$i]]
        ]);
        }

        else{
          DB::table('DetailSepatuCatatPenjualan')->insert([
          ['DetailSepatuID' => $arrKode[$i],
          'PenjualanID' => $IDPenjualan->Nomor,
          'Jumlah' => $arrJumlah[$i],
          'harga' =>$arrHarga[$i]]
        ]);
        }


      $JumlahSebelum = DB::table('DetailSepatu')->select('Stok')
      ->Where('ID','=',$IDDetailSepatu[$i])->first();
      $JumlahSebelum = $JumlahSebelum->Stok;

      //$JumlahSebelum = DetailSepatu::Where('ID','=',$IDDetailSepatu[$i])->first();
      //$akhir = $JumlahSebelum->Stok;
      $JumlahBaru = $JumlahSebelum - $Jumlah[$i];

      DB::table('DetailSepatu')
          ->where('ID', $IDDetailSepatu[$i])
          ->update(['Stok' => $JumlahBaru]);
      }
      $Status = 1;
      $IDNotaJual = $Request->get('DataPesanan');
      DB::table('Penjualan')
          ->where('Nomor', $IDNotaJual)
          ->update(['Status' => $Status]);


    //}
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
