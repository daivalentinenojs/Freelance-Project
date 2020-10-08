<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Bank;
use DB;

class Bank extends Model
{
  protected $table = 'Bank';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'NamaPemilikRekening', 'NomorRekening', 'IsActive'];

    public function GetAjaxBank()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'BankName',
          2 => 'NamaPemilikRekening',
          3 => 'NomorRekening',
          4 => 'Status',
          5 => 'View',
          6 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Bank.ID AS 'ID', Bank.ID AS 'View', Bank.ID AS 'Edit', Bank.NamaPemilikRekening AS 'NamaPemilikRekening', Bank.NomorRekening AS 'NomorRekening',
        Bank.Nama AS 'BankName', Bank.IsActive AS 'Status' FROM Bank";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Bank.ID AS 'ID', Bank.ID AS 'View', Bank.ID AS 'Edit', Bank.NamaPemilikRekening AS 'NamaPemilikRekening', Bank.NomorRekening AS 'NomorRekening',
        Bank.Nama AS 'BankName', Bank.IsActive AS 'Status' FROM Bank";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Bank.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Bank.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Bank.NamaPemilikRekening LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Bank.NomorRekening LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Bank.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["BankName"];
          $nestedData[] = $row["NamaPemilikRekening"];
          $nestedData[] = $row["NomorRekening"];
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

    public function GetBank()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBank = "SELECT Bank.ID AS 'ID', Bank.Nama AS 'BankName', Bank.NamaPemilikRekening AS 'NamaPemilikRekening', Bank.NomorRekening AS 'NomorRekening', Bank.IsActive AS 'Status' FROM Bank";
        $HasilQueryGetDataBank = mysqli_query($MySQLi, $QueryGetDataBank);
        $DataBank = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBank)) {
        $DataBank[] = $Hasil;
        }
        return $DataBank;
    }

    public function StoreBank(Request $Request)
    {
        $unique_id = uniqid();
        $Bank = new Bank(array(
            'Nama' => $Request->get('NamaBank'),
            'NamaPemilikRekening' => $Request->get('NamaPemilikRekening'),
            'NomorRekening' => $Request->get('NomorRekening'),
            'IsActive' => (1)
        ));
        $Bank->save();
    }

    public function UpdateBank(Request $Request)
    {
        $IDBank = $Request->get('IDBank');
        DB::table('Bank')
            ->where('ID', $IDBank)
            ->update(['Nama' => $Request->get('NamaBank'),
                    'NamaPemilikRekening' => $Request->get('NamaPemilikRekening'),
                    'NomorRekening' => $Request->get('NomorRekening'),
                    'IsActive' => $Request->get('Status')]);
    }
}
