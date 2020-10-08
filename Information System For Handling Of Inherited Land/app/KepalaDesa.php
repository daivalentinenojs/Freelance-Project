<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class KepalaDesa extends Model
{
  protected $table = 'KepalaDesa';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'Nama', 'IDUser', 'IDDesa', 'IsActive'];

  public function GetAjaxKepalaDesa()
  {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $requestData= $_REQUEST;
      $columns = array(
        0 => 'ID',
        1 => 'Nama',
        2 => 'NamaDesa',
        3 => 'Status',
        4 => 'View',
        5 => 'Edit',
      );

      // Ambil Semua Baris Data
      $sql = "SELECT KepalaDesa.ID AS ID, KepalaDesa.ID AS View, KepalaDesa.ID AS Edit, KepalaDesa.Nama AS Nama, KepalaDesa.IDUser AS IDUser,
                               KepalaDesa.IDDesa AS IDDesa, Desa.Nama AS NamaDesa,
                               users.email AS 'Email', KepalaDesa.IsActive AS 'Status'
                               FROM KepalaDesa INNER JOIN users ON users.id = KepalaDesa.IDUser INNER JOIN Desa ON Desa.ID = KepalaDesa.IDDesa";
      $query=mysqli_query($MySQLi, $sql);
      $totalData = mysqli_num_rows($query);
      $totalFiltered = $totalData;

      // Proses Cari
      $sql = "SELECT KepalaDesa.ID AS ID, KepalaDesa.ID AS View, KepalaDesa.ID AS Edit, KepalaDesa.Nama AS Nama, KepalaDesa.IDUser AS IDUser,
                               KepalaDesa.IDDesa AS IDDesa, Desa.Nama AS NamaDesa,
                               users.email AS 'Email', KepalaDesa.IsActive AS 'Status'
                               FROM KepalaDesa INNER JOIN users ON users.id = KepalaDesa.IDUser INNER JOIN Desa ON Desa.ID = KepalaDesa.IDDesa";
      if( !empty($requestData['search']['value']) ) {
        $sql.=" WHERE ( KepalaDesa.ID LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR KepalaDesa.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR KepalaDesa.IDUser LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR KepalaDesa.IDDesa LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR users.email LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Desa.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR KepalaDesa.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
        $nestedData[] = $row["Nama"];
        $nestedData[] = $row["NamaDesa"];
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

  public function GetKepalaDesa($ID)
  {
    require '../connection/Init.php';
    $MySQLi = mysqli_connect($domain, $username, $password, $database);

    $QueryGetDataKepalaDesa = "SELECT KepalaDesa.ID AS ID, KepalaDesa.ID AS View, KepalaDesa.ID AS Edit, KepalaDesa.Nama AS Nama, KepalaDesa.IDUser AS IDUser,
                             KepalaDesa.IDDesa AS IDDesa, Desa.Nama AS NamaDesa, users.password AS Password,
                             users.email AS Email, KepalaDesa.IsActive AS Status, users.name AS Username
                             FROM KepalaDesa INNER JOIN users ON users.id = KepalaDesa.IDUser INNER JOIN Desa ON Desa.ID = KepalaDesa.IDDesa WHERE KepalaDesa.ID = '$ID'";
    $HasilQueryGetDataKepalaDesa = mysqli_query($MySQLi, $QueryGetDataKepalaDesa);
    $DataKepalaDesa = array();
    while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKepalaDesa)) {
      $DataKepalaDesa[] = $Hasil;
    }
    return $DataKepalaDesa;
  }

  public function StoreKepalaDesa(Request $Request, $IDUser)
  {
      $unique_id = uniqid();
      $KepalaDesa = new KepalaDesa(array(
          'Nama' => $Request->get('Nama'),
          'IDUser' => $IDUser,
          'IDDesa' => $Request->get('IDDesa'),
          'IsActive' => (1)
      ));
      $KepalaDesa->save();
      $ID = DB::table('KepalaDesa')->max('ID');

      if($Request->hasFile('FotoKepalaDesa')) {
          $IDFoto = $ID.'.jpg';
          $Request->FotoKepalaDesa->move(public_path('foto/KepalaDesa'), $IDFoto);
      }
  }

  public function UpdateKepalaDesa(Request $Request, $IDUser)
  {
      $IDKepalaDesa = $Request->get('IDKepalaDesa');
      $ID = $Request->get('IDKepalaDesa').'.jpg';
      DB::table('KepalaDesa')
          ->where('ID', $IDKepalaDesa)
          ->update(['Nama' => $Request->get('Nama'),
                  'IDUser' =>  $Request->get('IDUser'),
                  'IDDesa' => $Request->get('IDDesa'),
                  'IsActive' => 1]);
      if($Request->hasFile('FotoKepalaDesa')) {
          $Request->FotoKepalaDesa->move(public_path('foto/KepalaDesa'), $ID);
      }
  }
}
