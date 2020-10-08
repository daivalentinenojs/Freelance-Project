<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\ProductStatus;
use DB;

class ProductStatus extends Model
{
    protected $table = 'StatusBarang';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'IsActive'];

    public function GetAjaxProductStatus()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'ProductStatusName',
          2 => 'Status',
          3 => 'View',
          4 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT StatusBarang.ID AS 'ID', StatusBarang.ID AS 'View', StatusBarang.ID AS 'Edit',
        StatusBarang.Nama AS 'ProductStatusName', StatusBarang.IsActive AS 'Status' From StatusBarang";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT StatusBarang.ID AS 'ID', StatusBarang.ID AS 'View', StatusBarang.ID AS 'Edit',
        StatusBarang.Nama AS 'ProductStatusName', StatusBarang.IsActive AS 'Status' From StatusBarang";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( StatusBarang.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR StatusBarang.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR StatusBarang.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["ProductStatusName"];
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

    public function GetProductStatus()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataProductStatus = "SELECT StatusBarang.ID AS 'ID', StatusBarang.Nama AS 'ProductStatusName', StatusBarang.IsActive AS 'Status' From StatusBarang";
        $HasilQueryGetDataProductStatus = mysqli_query($MySQLi, $QueryGetDataProductStatus);
        $DataProductStatus = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataProductStatus)) {
            $DataProductStatus[] = $Hasil;
        }
        return $DataProductStatus;
    }

    public function StoreProductStatus(Request $Request)
    {
        $unique_id = uniqid();
        $ProductStatus = new ProductStatus(array(
            'Nama' => $Request->get('NamaProductStatus'),
            'IsActive' => (1)
        ));
        $ProductStatus->save();
    }

    public function UpdateProductStatus(Request $Request)
    {
        $IDProductStatus = $Request->get('IDProductStatus');
        DB::table('StatusBarang')
            ->where('ID', $IDProductStatus)
            ->update(['Nama' => $Request->get('NamaProductStatus'),
                    'IsActive' => $Request->get('Status')]);
    }
}
