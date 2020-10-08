<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Role;
use DB;

class Role extends Model
{
    protected $table = 'Jabatan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'Keterangan', 'IsActive'];

    public function GetAjaxRole()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'RoleName',
          2 => 'Description',
          3 => 'Status',
          4 => 'View',
          5 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Jabatan.ID AS 'ID', Jabatan.ID AS 'View', Jabatan.ID AS 'Edit',
        Jabatan.Nama AS 'RoleName', Jabatan.Keterangan AS 'Description', Jabatan.IsActive AS 'Status' FROM Jabatan";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Jabatan.ID AS 'ID', Jabatan.ID AS 'View', Jabatan.ID AS 'Edit',
        Jabatan.Nama AS 'RoleName', Jabatan.Keterangan AS 'Description', Jabatan.IsActive AS 'Status' FROM Jabatan";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Jabatan.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Jabatan.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Jabatan.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Jabatan.IsActive LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          if ($row["Status"] == 1) {
              $Status = 'Active';
          } else {
              $Status = 'InActive';
          }

          $nestedData[] = $row["ID"];
          $nestedData[] = $row["RoleName"];
          $nestedData[] = $row["Description"];
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

    public function GetRole()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataRole = "SELECT Jabatan.ID AS 'ID', Jabatan.Nama AS 'RoleName', Jabatan.Keterangan AS 'Description', Jabatan.IsActive AS 'Status' FROM Jabatan";
        $HasilQueryGetDataRole = mysqli_query($MySQLi, $QueryGetDataRole);
        $DataRole = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataRole)) {
            $DataRole[] = $Hasil;
        }
        return $DataRole;
    }

    public function StoreRole(Request $Request)
    {
        $unique_id = uniqid();
        $Role = new Role(array(
            'Nama' => $Request->get('NamaRole'),
            'Keterangan' => $Request->get('Deskripsi'),
            'IsActive' => (1)
        ));
        $Role->save();
    }

    public function UpdateRole(Request $Request)
    {
        $IDRole = $Request->get('IDRole');
        DB::table('Jabatan')
            ->where('ID', $IDRole)
            ->update(['Nama' => $Request->get('NamaRole'),
                    'Keterangan' => $Request->get('Deskripsi'),
                    'IsActive' => $Request->get('Status')]);
    }
}
