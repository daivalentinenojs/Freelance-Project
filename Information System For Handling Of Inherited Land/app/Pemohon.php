<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Pemohon extends Model
{
  protected $table = 'Pemohon';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'NIK', 'Nama', 'Telepon', 'Alamat', 'Pekerjaan', 'Umur', 'IDDesa', 'IDUser', 'IsActive'];

  public function GetAjaxPemohon()
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
        6 => 'Pekerjaan',
        7 => 'Umur',
        8 => 'Daerah',
        9 => 'Status',
        10 => 'View',
        11 => 'Edit',
      );

      // Ambil Semua Baris Data
      $sql = "SELECT Pemohon.ID AS ID, Pemohon.ID AS View, Pemohon.ID AS Edit, Pemohon.NIK AS NIK, Pemohon.Nama AS Nama, Pemohon.Alamat AS Alamat,
                               Pemohon.Pekerjaan AS Pekerjaan, Pemohon.Umur AS Umur,
                               Pemohon.Telepon AS Telepon, Pemohon.IDUser AS IDUser,
                               users.email AS 'Email', Pemohon.IsActive AS 'Status',
                               Pemohon.IDDesa AS 'IDDesa', Desa.Nama AS 'NamaDesa'
                               FROM Pemohon INNER JOIN users ON users.id = Pemohon.IDUser
                               INNER JOIN Desa ON Desa.ID = Pemohon.IDDesa";
      $query=mysqli_query($MySQLi, $sql);
      $totalData = mysqli_num_rows($query);
      $totalFiltered = $totalData;

      // Proses Cari
      $sql = "SELECT Pemohon.ID AS ID, Pemohon.ID AS View, Pemohon.ID AS Edit, Pemohon.NIK AS NIK, Pemohon.Nama AS Nama, Pemohon.Alamat AS Alamat,
                               Pemohon.Pekerjaan AS Pekerjaan, Pemohon.Umur AS Umur,
                               Pemohon.Telepon AS Telepon, Pemohon.IDUser AS IDUser,
                               users.email AS 'Email', Pemohon.IsActive AS 'Status',
                               Pemohon.IDDesa AS 'IDDesa', Desa.Nama AS 'NamaDesa'
                               FROM Pemohon INNER JOIN users ON users.id = Pemohon.IDUser
                               INNER JOIN Desa ON Desa.ID = Pemohon.IDDesa";
      if( !empty($requestData['search']['value']) ) {
        $sql.=" WHERE ( Pemohon.ID LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Pemohon.NIK LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.Alamat LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.Telepon LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.Pekerjaan LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.Umur LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Desa.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.IDUser LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR users.email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Pemohon.IsActive LIKE '%".$requestData['search']['value']."%' )";
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

        $nestedData[] = $row["ID"];
        $nestedData[] = $row["NIK"];
        $nestedData[] = $row["Nama"];
        $nestedData[] = $row["Alamat"];
        $nestedData[] = $row["Telepon"];
        $nestedData[] = $row["Pekerjaan"];
        $nestedData[] = $row["Umur"];
        $nestedData[] = $row["NamaDesa"];
        $nestedData[] = $row["Email"];
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

  public function GetPemohon($ID)
  {
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataPemohon = "SELECT Pemohon.ID AS ID, Pemohon.NIK AS NIK, Pemohon.Nama AS Nama, Pemohon.Alamat AS Alamat,
                             Pemohon.Telepon AS Telepon, Pemohon.IDUser AS IDUser, Pemohon.Pekerjaan AS Pekerjaan, Pemohon.Umur AS Umur,
                             users.email AS Email, Pemohon.IsActive AS Status, users.name AS Username, users.password AS Password
                             FROM Pemohon INNER JOIN users ON users.id = Pemohon.IDUser WHERE Pemohon.ID = '$ID'";
    $HasilQueryGetDataPemohon = mysqli_query($MySQLi, $QueryGetDataPemohon);
    $DataPemohon = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemohon)) {
      $DataPemohon[] = $Hasil;
    }
    return $DataPemohon;
  }

  public function StorePemohon(Request $Request, $IDUser)
  {
      $unique_id = uniqid();
      $Pemohon = new Pemohon(array(
          'NIK' => $Request->get('NIK'),
          'Nama' => $Request->get('Nama'),
          'Alamat' => $Request->get('Alamat'),
          'Telepon' => $Request->get('Telepon'),
          'Pekerjaan' => $Request->get('Pekerjaan'),
          'Umur' => $Request->get('Umur'),
          'IDDesa' => $Request->get('IDDesa'),
          'IDUser' => $IDUser,
          'IsActive' => (1)
      ));
      $Pemohon->save();
      $ID = DB::table('Pemohon')->max('ID');

      if($Request->hasFile('FotoPemohon')) {
          $IDFoto = $ID.'.jpg';
          $Request->FotoPemohon->move(public_path('foto/Pemohon'), $IDFoto);
      }
  }

  public function UpdatePemohon(Request $Request, $IDUser)
  {
      $IDPemohon = $Request->get('IDPemohon');
      $ID = $Request->get('IDPemohon').'.jpg';
      DB::table('Pemohon')
          ->where('ID', $IDPemohon)
          ->update(['Nama' => $Request->get('Nama'),
                  'Alamat' => $Request->get('Alamat'),
                  'Telepon' => $Request->get('Telepon'),
                  'Pekerjaan' => $Request->get('Pekerjaan'),
                  'Umur' => $Request->get('Umur'),
                  'IDUser' =>  $Request->get('IDUser'),
                  'IDDesa' =>  $Request->get('IDDesa'),
                  'IsActive' => 1]);
      if($Request->hasFile('FotoPemohon')) {
          $Request->FotoPemohon->move(public_path('foto/Pemohon'), $ID);
      }
  }
}
