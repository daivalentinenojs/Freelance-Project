<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Desa;
use DB;

class Desa extends Model
{
  protected $table = 'Desa';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'Nama', 'IsActive'];

  public function GetAjaxDesa()
  {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $requestData= $_REQUEST;
      $columns = array(
        0 => 'ID',
        1 => 'NamaDesa',
        2 => 'Status',
        3 => 'View',
        4 => 'Edit',
      );

      // Ambil Semua Baris Data
      $sql = "SELECT Desa.ID AS 'ID', Desa.ID AS 'View', Desa.ID AS 'Edit', Desa.Nama AS 'NamaDesa', Desa.IsActive AS 'Status' FROM Desa";
      $query=mysqli_query($MySQLi, $sql);
      $totalData = mysqli_num_rows($query);
      $totalFiltered = $totalData;

      // Proses Cari
      $sql = "SELECT Desa.ID AS 'ID', Desa.ID AS 'View', Desa.ID AS 'Edit', Desa.Nama AS 'NamaDesa', Desa.IsActive AS 'Status' FROM Desa";
      if( !empty($requestData['search']['value']) ) {
        $sql.=" WHERE ( Desa.ID LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Desa.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Desa.IsActive LIKE '%".$requestData['search']['value']."%' )";
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

  public function GetDesa()
  {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDesa = "SELECT Desa.ID AS 'ID', Desa.ID AS 'View', Desa.ID AS 'Edit', Desa.Nama AS 'NamaDesa', Desa.IsActive AS 'Status' FROM Desa";
      $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDataDesa);
      $DataDesa = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
      $DataDesa[] = $Hasil;
      }
      return $DataDesa;
  }

  public function StoreDesa(Request $Request)
  {
      $unique_id = uniqid();
      $Desa = new Desa(array(
          'Nama' => $Request->get('NamaDesa'),
          'IsActive' => (1)
      ));
      $Desa->save();
  }

  public function UpdateDesa(Request $Request)
  {
      $IDDesa = $Request->get('IDDesa');
      DB::table('Desa')
          ->where('ID', $IDDesa)
          ->update(['Nama' => $Request->get('NamaDesa'),
                  'IsActive' => $Request->get('Status')]);
  }
}
