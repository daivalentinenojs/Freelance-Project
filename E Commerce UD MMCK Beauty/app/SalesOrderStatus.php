<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\SalesOrderStatus;
use DB;

class SalesOrderStatus extends Model
{
    protected $table = 'StatusNotaJual';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'IsActive'];

    public function GetAjaxSalesOrderStatus()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'SalesOrderStatusName',
          2 => 'Status',
          3 => 'View',
          4 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT StatusNotaJual.ID AS 'ID', StatusNotaJual.ID AS 'View', StatusNotaJual.ID AS 'Edit',
        StatusNotaJual.Nama AS 'SalesOrderStatusName', StatusNotaJual.IsActive AS 'Status' From StatusNotaJual";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT StatusNotaJual.ID AS 'ID', StatusNotaJual.ID AS 'View', StatusNotaJual.ID AS 'Edit',
        StatusNotaJual.Nama AS 'SalesOrderStatusName', StatusNotaJual.IsActive AS 'Status' From StatusNotaJual";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( StatusNotaJual.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR StatusNotaJual.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR StatusNotaJual.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["SalesOrderStatusName"];
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

    public function GetSalesOrderStatus()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataSalesOrderStatus = "SELECT StatusNotaJual.ID AS 'ID', StatusNotaJual.Nama AS 'SalesOrderStatusName', StatusNotaJual.IsActive AS 'Status' From StatusNotaJual";
        $HasilQueryGetDataSalesOrderStatus = mysqli_query($MySQLi, $QueryGetDataSalesOrderStatus);
        $DataSalesOrderStatus = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSalesOrderStatus)) {
        $DataSalesOrderStatus[] = $Hasil;
        }
        return $DataSalesOrderStatus;
    }

    public function StoreSalesOrderStatus(Request $Request)
    {
        $unique_id = uniqid();
        $SalesOrderStatus = new SalesOrderStatus(array(
            'Nama' => $Request->get('NamaSalesOrderStatus'),
            'IsActive' => (1)
        ));
        $SalesOrderStatus->save();
    }

    public function UpdateSalesOrderStatus(Request $Request)
    {
        $IDSalesOrderStatus = $Request->get('IDSalesOrderStatus');
        DB::table('StatusNotaJual')
            ->where('ID', $IDSalesOrderStatus)
            ->update(['Nama' => $Request->get('NamaSalesOrderStatus'),
                    'IsActive' => $Request->get('Status')]);
    }
}
