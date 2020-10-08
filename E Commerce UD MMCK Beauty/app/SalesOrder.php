<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\SalesOrder;
use DB;

class SalesOrder extends Model
{
    protected $table = 'NotaJual';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'TanggalBuat', 'TotalBarang', 'TotalBerat', 'BiayaKirim', 'TotalAkhir',
    'NamaPenerima', 'AlamatPenerima', 'Provinsi', 'Kota', 'TeleponPenerima', 'HandphonePenerima', 'NomorRekening', 'NamaPemilikRekening',
    'TanggalTransfer', 'TanggalKirim', 'TanggalTerima', 'NamaDropshipper', 'TeleponDropshipper', 'HandphoneDropshipper',
    'IDBank', 'IDStatusNotaJual', 'IDPembeli', 'IDNotaJual', 'IsDropship', 'IsActive', 'Kecamatan', 'Kelurahan', 'KodePos', 'Keterangan', 'NomorResi'];

    public function GetAjaxSalesOrderCustomer($ID)
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'TotalBerat',
          2 => 'TanggalBuat',
          3 => 'BiayaKirim',
          4 => 'TotalAkhir',
          5 => 'NamaPenerima',
          6 => 'AlamatPenerima',
          7 => 'Provinsi',
          8 => 'Kota',
          9 => 'Kecamatan',
          10 => 'Kelurahan',
          11 => 'KodePos',
          12 => 'Keterangan',
          13 => 'NomorResi',
          14 => 'TeleponPenerima',
        //   15 => 'HandphonePenerima',
          15 => 'NomorRekening',
          16 => 'NamaPemilikRekening',
          17 => 'TanggalTransfer',
          18 => 'TanggalKirim',
          19 => 'TanggalTerima',
          20 => 'NamaDropshipper',
          21 => 'TeleponDropshipper',
        //   23 => 'HandphoneDropshipper',
          22 => 'IDBank',
          23 => 'NamaBank',
          24 => 'IDStatusNotaJual',
          25 => 'IDPembeli',
          26 => 'NamaPembeli',
          27 => 'IDKaryawan',
          28 => 'NamaKaryawan',
          29 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT NotaJual.ID AS ID, NotaJual.ID AS Edit, NotaJual.TotalBerat AS TotalBerat, NotaJual.created_at AS TanggalBuat,
          NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
          NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
          NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
          NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
          NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
          NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
          NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
          NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
          NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
          FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
          LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
          INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
          INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
          WHERE Pembeli.ID = '$ID' AND (NotaJual.IDStatusNotaJual = '2' OR NotaJual.IDStatusNotaJual = '3' OR NotaJual.IDStatusNotaJual = '4')";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT NotaJual.ID AS ID, NotaJual.ID AS Edit, NotaJual.TotalBerat AS TotalBerat, NotaJual.created_at AS TanggalBuat,
          NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
          NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
          NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
          NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
          NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
          NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
          NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
          NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
          NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
          FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
          LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
          INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
          INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
          WHERE Pembeli.ID = '$ID' AND (NotaJual.IDStatusNotaJual = '2' OR NotaJual.IDStatusNotaJual = '3' OR NotaJual.IDStatusNotaJual = '4')";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( NotaJual.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR NotaJual.TotalBerat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalBuat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TotalBarang LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.BiayaKirim LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TotalAkhir LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NamaPenerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.AlamatPenerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Provinsi LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Kota LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Kecamatan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Kelurahan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.KodePos LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NomorResi LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TeleponPenerima LIKE '%".$requestData['search']['value']."%'";
        //   $sql.=" OR NotaJual.HandphonePenerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NomorRekening LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NamaPemilikRekening LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalTransfer LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalKirim LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalTerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NamaDropshipper LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TeleponDropshipper LIKE '%".$requestData['search']['value']."%'";
        //   $sql.=" OR NotaJual.HandphoneDropshipper LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDBank LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Bank.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDStatusNotaJual LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR StatusNotaJual.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDPembeli LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDKaryawan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.Nama LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          $nestedData[] = $row["ID"];
          $nestedData[] = date('d M Y', strtotime($row["TanggalBuat"]));
          $nestedData[] = $row["NamaPenerima"];
          $nestedData[] = $row["AlamatPenerima"];
        //   $nestedData[] = $row["HandphonePenerima"];
          $nestedData[] = $row["Kota"];
          $nestedData[] = $row["Provinsi"];
          $nestedData[] = $row["TotalAkhir"];
          $nestedData[] = $row["StatusNotaJual"];
          $nestedData[] = $row["Edit"];
          $data[] = $nestedData;
        }

        $json_data = array(
                  "draw"            => intval( $requestData['draw'] ),
                  "recordsTotal"    => intval( $totalData ),
                  "recordsFiltered" => intval( $totalFiltered ),
                  "data"            => $data
                  );

        echo json_encode($json_data);
    }

    public function GetAjaxSalesOrderEmployee()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'TotalBerat',
          2 => 'TanggalBuat',
          3 => 'BiayaKirim',
          4 => 'TotalAkhir',
          5 => 'NamaPenerima',
          6 => 'AlamatPenerima',
          7 => 'Provinsi',
          8 => 'Kota',
          9 => 'Kecamatan',
          10 => 'Kelurahan',
          11 => 'KodePos',
          12 => 'Keterangan',
          13 => 'NomorResi',
          14 => 'TeleponPenerima',
        //   15 => 'HandphonePenerima',
          15 => 'NomorRekening',
          16 => 'NamaPemilikRekening',
          17 => 'TanggalTransfer',
          18 => 'TanggalKirim',
          19 => 'TanggalTerima',
          20 => 'NamaDropshipper',
          21 => 'TeleponDropshipper',
        //   23 => 'HandphoneDropshipper',
          22 => 'IDBank',
          23 => 'NamaBank',
          24 => 'IDStatusNotaJual',
          25 => 'IDPembeli',
          26 => 'NamaPembeli',
          27 => 'IDKaryawan',
          28 => 'NamaKaryawan',
          29 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT NotaJual.ID AS ID, NotaJual.ID AS Edit, NotaJual.TotalBerat AS TotalBerat, NotaJual.created_at AS TanggalBuat,
          NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
          NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
          NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
          NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
          NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
          NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
          NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
          NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
          NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
          FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
          LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
          INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
          INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
          WHERE NotaJual.IDStatusNotaJual = '2' OR NotaJual.IDStatusNotaJual = '3' OR NotaJual.IDStatusNotaJual = '4'";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT NotaJual.ID AS ID, NotaJual.ID AS Edit, NotaJual.TotalBerat AS TotalBerat, NotaJual.created_at AS TanggalBuat,
          NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
          NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
          NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
          NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
          NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
          NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
          NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
          NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
          NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
          FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
          LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
          INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
          INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
          WHERE NotaJual.IDStatusNotaJual = '2' OR NotaJual.IDStatusNotaJual = '3' OR NotaJual.IDStatusNotaJual = '4'";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( NotaJual.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR NotaJual.TotalBerat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalBuat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TotalBarang LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.BiayaKirim LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TotalAkhir LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NamaPenerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.AlamatPenerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Provinsi LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Kota LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Kecamatan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Kelurahan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.KodePos LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NomorResi LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TeleponPenerima LIKE '%".$requestData['search']['value']."%'";
        //   $sql.=" OR NotaJual.HandphonePenerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NomorRekening LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NamaPemilikRekening LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalTransfer LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalKirim LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TanggalTerima LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.NamaDropshipper LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.TeleponDropshipper LIKE '%".$requestData['search']['value']."%'";
        //   $sql.=" OR NotaJual.HandphoneDropshipper LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDBank LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Bank.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDStatusNotaJual LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR StatusNotaJual.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDPembeli LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR NotaJual.IDKaryawan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.Nama LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          $nestedData[] = $row["ID"];
          $nestedData[] = date('d M Y h:i:sa', strtotime($row["TanggalBuat"]));
          $nestedData[] = $row["NamaPenerima"];
          $nestedData[] = $row["AlamatPenerima"];
        //   $nestedData[] = $row["HandphonePenerima"];
          $nestedData[] = $row["Kota"];
          $nestedData[] = $row["Provinsi"];
          $nestedData[] = $row["TotalAkhir"];
          $nestedData[] = $row["StatusNotaJual"];
          $nestedData[] = $row["Edit"];
          $data[] = $nestedData;
        }

        $json_data = array(
                  "draw"            => intval( $requestData['draw'] ),
                  "recordsTotal"    => intval( $totalData ),
                  "recordsFiltered" => intval( $totalFiltered ),
                  "data"            => $data
                  );

        echo json_encode($json_data);
    }

    public function GetNotaJual()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaJual = "SELECT NotaJual.ID AS ID, NotaJual.TotalBerat AS TotalBerat, NotaJual.TanggalBuat AS TanggalBuat,
        NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
        NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
        NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
        NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
        NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
        NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
        NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
        NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
        NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
        FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
        INNER JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
        INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
        INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID";
      $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
      $DataNotaJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
        $DataNotaJual[] = $Hasil;
      }
      return $DataNotaJual;
    }

    public function GetNotaJualSatu($ID)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaJual = "SELECT NotaJual.ID AS ID, NotaJual.TotalBerat AS TotalBerat, NotaJual.TanggalBuat AS TanggalBuat,
        NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
        NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
        NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
        NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
        NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
        NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
        NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
        NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
        NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
        FROM NotaJual LEFT JOIN Bank ON NotaJual.IDBank = Bank.ID
        LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
        LEFT JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
        LEFT JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
        WHERE NotaJual.ID = '$ID'";

      $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
      $DataNotaJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
        $DataNotaJual[] = $Hasil;
      }
      return $DataNotaJual;
    }

    public function GetNotaJualCustomer($ID)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaJual = "SELECT NotaJual.ID AS ID, NotaJual.TotalBerat AS TotalBerat, NotaJual.TanggalBuat AS TanggalBuat,
        NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
        NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
        NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
        NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
        NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
        NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank,
        NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
        NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
        NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
        FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
        LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
        INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
        INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
        WHERE Pembeli.ID = '$ID'";
      $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
      $DataNotaJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
        $DataNotaJual[] = $Hasil;
      }
      return $DataNotaJual;
    }

    public function StoreNotaJual(Request $Request)
    {
        $unique_id = uniqid();
        $NotaJual = new SalesOrder(array(
            'TanggalBuat' => date("Y-m-d"),
            'TotalBarang' => $Request->get('TotalBarang'),
            'TotalBerat' => $Request->get('TotalBerat'),
            'BiayaKirim' => $Request->get('BiayaKirim'),
            'TotalAkhir' => $Request->get('GrandTotal'),
            'NamaPenerima' => $Request->get('NamaPenerima'),
            'AlamatPenerima' => $Request->get('AlamatPenerima'),
            'Provinsi' => $Request->get('Provinsi'),
            'Kota' => $Request->get('Kota'),

            'Kecamatan' => $Request->get('Kecamatan'),
            'Kelurahan' => $Request->get('Kelurahan'),
            'KodePos' => $Request->get('KodePos'),
            'Keterangan' => $Request->get('Keterangan'),

            'TeleponPenerima' => $Request->get('TeleponPenerima'),
            'HandphonePenerima' => (0),
            'NomorRekening' => $Request->get('NomorRekening'),
            'NamaPemilikRekening' => $Request->get('NamaRekening'),

            'NamaDropshipper' => $Request->get('NamaDropshipper'),
            'TeleponDropshipper' => $Request->get('TeleponDropshipper'),
            'HandphoneDropshipper' => (0),

            'IDBank' => $Request->get('IDBank'),

            'IDStatusNotaJual' => (2),
            'IDPembeli' => $Request->get('IDPembeli'),
            'IsDropship' => $Request->get('IsDropship'),
            'IsActive' => (1)
        ));
        $NotaJual->save();
        $ID = DB::table('NotaJual')->max('ID');
        return $ID;
    }

    public function UpdateSalesOrderCustomer(Request $Request)
    {
        $IDNotaJual = $Request->get('IDNotaJual');
        if ($Request->get('IDStatusNotaJual') == 2) {
            DB::table('NotaJual')
                ->where('ID', $IDNotaJual)
                ->update(['NomorRekening' => $Request->get('NomorRekening'),
                        'NamaPemilikRekening' => $Request->get('NamaPemilikRekening'),
                        'IDBank' => $Request->get('IDBank'),
                        'TanggalTransfer' => date("Y-m-d"),
                        'IDStatusNotaJual' =>(3)]);
        } else if ($Request->get('IDStatusNotaJual') == 4){
            DB::table('NotaJual')
                ->where('ID', $IDNotaJual)
                ->update(['TanggalTerima' => date("Y-m-d"),
                        'IDStatusNotaJual' =>(5)]);
        }

    }

    public function UpdateSalesOrderEmployee(Request $Request, $ID)
    {
        $IDNotaJual = $Request->get('IDNotaJual');
        $IDStatusNotaJualBaru = $Request->get('IDStatusNotaJualBaru');
        if ($IDStatusNotaJualBaru == 1) {
            DB::table('NotaJual')
                ->where('ID', $IDNotaJual)
                ->update(['TanggalTransfer' => date("Y-m-d"),
                        'TanggalKirim' => date("Y-m-d"),
                        'TanggalTerima' => date("Y-m-d"),
                        'IDKaryawan' => $ID,
                        'IDStatusNotaJual' =>(1)]);
        } else if ($IDStatusNotaJualBaru == 4){
            DB::table('NotaJual')
                ->where('ID', $IDNotaJual)
                ->update(['TanggalKirim' => date("Y-m-d"),
                        'NomorResi' => $Request->get('NomorResi'),
                        'IDKaryawan' => $ID,
                        'IDStatusNotaJual' =>(4)]);
        } else if ($IDStatusNotaJualBaru == 5){
            DB::table('NotaJual')
                ->where('ID', $IDNotaJual)
                ->update(['TanggalTerima' => date("Y-m-d"),
                        'IDKaryawan' => $ID,
                        'IDStatusNotaJual' =>(5)]);
        }
    }
}
