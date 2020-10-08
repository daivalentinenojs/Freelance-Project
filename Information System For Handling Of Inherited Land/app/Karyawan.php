<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Karyawan extends Model
{
  protected $table = 'Karyawan';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'NIK', 'Nama', 'Telepon', 'Alamat', 'Jabatan', 'IDUser', 'IDDaerah', 'IsActive'];

  public function GetAjaxKaryawan()
  {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $requestData= $_REQUEST;
      $columns = array(
        0 => 'ID',
        1 => 'NIK',
        2 => 'Nama',
        3 => 'Telepon',
        4 => 'Alamat',
        5 => 'Email',
        6 => 'Jabatan',
        7 => 'NamaDaerah',
        8 => 'Status',
        9 => 'View',
        10 => 'Edit',
      );

      // Ambil Semua Baris Data
      $sql = "SELECT Karyawan.ID AS ID, Karyawan.ID AS View, Karyawan.ID AS Edit, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
                               Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, Karyawan.IDDaerah AS IDDaerah, Daerah.Nama AS NamaDaerah, Karyawan.Jabatan AS Jabatan,
                               users.email AS 'Email', Karyawan.IsActive AS 'Status'
                               FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah";
      $query=mysqli_query($MySQLi, $sql);
      $totalData = mysqli_num_rows($query);
      $totalFiltered = $totalData;

      // Proses Cari
      $sql = "SELECT Karyawan.ID AS ID, Karyawan.ID AS View, Karyawan.ID AS Edit, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
                               Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, Karyawan.IDDaerah AS IDDaerah, Daerah.Nama AS NamaDaerah, Karyawan.Jabatan AS Jabatan,
                               users.email AS 'Email', Karyawan.IsActive AS 'Status'
                               FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah";
      if( !empty($requestData['search']['value']) ) {
        $sql.=" WHERE ( Karyawan.ID LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Karyawan.NIK LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.Alamat LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.Telepon LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.Jabatan LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.IDUser LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.IDDaerah LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR users.email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Daerah.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Karyawan.IsActive LIKE '%".$requestData['search']['value']."%' )";
      }

      $query=mysqli_query($MySQLi, $sql);
      $totalFiltered = mysqli_num_rows($query);
      $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
      $query=mysqli_query($MySQLi, $sql);
      $data = array();

      while( $row=mysqli_fetch_array($query) ) {
        $nestedData=array();

        if ($row["Status"] == 1) {
            $Status = 'Aktif';
        } else {
            $Status = 'Tidak Aktif';
        }

        if ($row["Jabatan"] == 1) {
          $Jabatan = 'Penerima Setoran PNBP';
        } elseif ($row["Jabatan"] == 2) {
          $Jabatan = 'Kepala Sub Bagian TU';
        } elseif ($row["Jabatan"] == 3) {
          $Jabatan = 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah';
        } elseif ($row["Jabatan"] == 4) {
          $Jabatan = 'Kepala Seksi Pengukuran dan Pemetaan';
        } elseif ($row["Jabatan"] == 5) {
          $Jabatan = 'Petugas Pengumpul Data Yuridis';
        } elseif ($row["Jabatan"] == 6) {
          $Jabatan = 'Kepala Seksi Hub Hukum Pertanahan';
        }

        $nestedData[] = $row["ID"];
        $nestedData[] = $row["NIK"];
        $nestedData[] = $row["Nama"];
        $nestedData[] = $row["Alamat"];
        $nestedData[] = $row["Telepon"];
        $nestedData[] = $row["Email"];
        $nestedData[] = $Jabatan;
        $nestedData[] = $row["NamaDaerah"];
        $nestedData[] = $Status;
        $nestedData[] = $row["View"];
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

  public function GetKaryawan($ID)
  {
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
                             Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, users.name AS Username, users.password AS Password, Karyawan.Jabatan AS Jabatan,
                             Karyawan.IDDaerah AS IDDaerah, users.email AS Email, Daerah.Nama AS NamaDaerah
                             FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah WHERE Karyawan.ID = '$ID'";
    $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
    $DataKaryawan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
      $DataKaryawan[] = $Hasil;
    }
    return $DataKaryawan;
  }

  public function StoreKaryawan(Request $Request, $IDUser)
  {
      $unique_id = uniqid();
      $Karyawan = new Karyawan(array(
          'NIK' => $Request->get('NIK'),
          'Nama' => $Request->get('Nama'),
          'Alamat' => $Request->get('Alamat'),
          'Telepon' => $Request->get('Telepon'),
          'Jabatan' => $Request->get('Jabatan'),
          'IDUser' => $IDUser,
          'IDDaerah' => $Request->get('IDDaerah'),
          'IsActive' => (1)
      ));
      $Karyawan->save();
      $ID = DB::table('Karyawan')->max('ID');

      if($Request->hasFile('FotoKaryawan')) {
          $IDFoto = $ID.'.jpg';
          $Request->FotoKaryawan->move(public_path('foto/Karyawan'), $IDFoto);
      }
  }

  public function UpdateKaryawan(Request $Request, $IDUser)
  {
      $IDKaryawan = $Request->get('IDKaryawan');
      $ID = $Request->get('IDKaryawan').'.jpg';
      DB::table('Karyawan')
          ->where('ID', $IDKaryawan)
          ->update(['Nama' => $Request->get('Nama'),
                  'Alamat' => $Request->get('Alamat'),
                  'Telepon' => $Request->get('Telepon'),
                  'Jabatan' => $Request->get('Jabatan'),
                  'IDUser' =>  $Request->get('IDUser'),
                  'IDDaerah' => $Request->get('IDDaerah'),
                  'IsActive' => 1]);
      if($Request->hasFile('FotoKaryawan')) {
          $Request->FotoKaryawan->move(public_path('foto/Karyawan'), $ID);
      }
  }

  public function GetKaryawanUkur($Jabatan)
  {
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
                             Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, users.name AS Username, users.password AS Password, Karyawan.Jabatan AS Jabatan,
                             Karyawan.IDDaerah AS IDDaerah, users.email AS Email, Daerah.Nama AS NamaDaerah
                             FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah WHERE Karyawan.Jabatan = '$Jabatan'";
    $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
    $DataKaryawan = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
      $DataKaryawan[] = $Hasil;
    }
    return $DataKaryawan;
  }
}
