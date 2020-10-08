<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Daerah;
use DB;

class Daerah extends Model
{
  protected $table = 'Daerah';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'Nama', 'IsActive'];

  public function GetAjaxDaerah()
  {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $requestData= $_REQUEST;
      $columns = array(
        0 => 'ID',
        1 => 'NamaDaerah',
        2 => 'Status',
        3 => 'View',
        4 => 'Edit',
      );

      // Ambil Semua Baris Data
      $sql = "SELECT Daerah.ID AS 'ID', Daerah.ID AS 'View', Daerah.ID AS 'Edit', Daerah.Nama AS 'NamaDaerah', Daerah.IsActive AS 'Status' FROM Daerah";
      $query=mysqli_query($MySQLi, $sql);
      $totalData = mysqli_num_rows($query);
      $totalFiltered = $totalData;

      // Proses Cari
      $sql = "SELECT Daerah.ID AS 'ID', Daerah.ID AS 'View', Daerah.ID AS 'Edit', Daerah.Nama AS 'NamaDaerah', Daerah.IsActive AS 'Status' FROM Daerah";
      if( !empty($requestData['search']['value']) ) {
        $sql.=" WHERE ( Daerah.ID LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR Daerah.Nama LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Daerah.IsActive LIKE '%".$requestData['search']['value']."%' )";
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

  public function GetDaerah()
  {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDaerah = "SELECT Daerah.ID AS 'ID', Daerah.ID AS 'View', Daerah.ID AS 'Edit', Daerah.Nama AS 'NamaDaerah', Daerah.IsActive AS 'Status' FROM Daerah";
      $HasilQueryGetDataDaerah = mysqli_query($MySQLi, $QueryGetDataDaerah);
      $DataDaerah = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDaerah)) {
      $DataDaerah[] = $Hasil;
      }
      return $DataDaerah;
  }

  public function StoreDaerah(Request $Request)
  {
      $unique_id = uniqid();
      $Daerah = new Daerah(array(
          'Nama' => $Request->get('NamaDaerah'),
          'IsActive' => (1)
      ));
      $Daerah->save();
  }

  public function UpdateDaerah(Request $Request)
  {
      $IDDaerah = $Request->get('IDDaerah');
      DB::table('Daerah')
          ->where('ID', $IDDaerah)
          ->update(['Nama' => $Request->get('NamaDaerah'),
                  'IsActive' => $Request->get('Status')]);
  }
}
