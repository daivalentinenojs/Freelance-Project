<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Customer;
use DB;

class Customer extends Model
{
    protected $table = 'Pembeli';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama','Alamat', 'Kota', 'Telepon', 'Handphone', 'IDUser', 'IsActive'];

    public function GetAjaxCustomer()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'Name',
          2 => 'Address',
          3 => 'City',
          4 => 'Phone',
        //   5 => 'Handphone',
          5 => 'Email',
          6 => 'Status',
          7 => 'View',
          8 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Pembeli.ID AS ID, Pembeli.ID AS View, Pembeli.ID AS Edit, Pembeli.Nama AS Nama, Pembeli.Alamat AS Alamat, Pembeli.Kota AS Kota,
                                 Pembeli.Telepon AS Telepon, Pembeli.Handphone AS Handphone, Pembeli.IDUser AS IDUser,
                                 users.email AS 'Email', Pembeli.IsActive AS 'Status'
                                 FROM Pembeli INNER JOIN users ON users.id = Pembeli.IDUser";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Pembeli.ID AS ID, Pembeli.ID AS View, Pembeli.ID AS Edit, Pembeli.Nama AS Nama, Pembeli.Alamat AS Alamat, Pembeli.Kota AS Kota,
                                 Pembeli.Telepon AS Telepon, Pembeli.Handphone AS Handphone, Pembeli.IDUser AS IDUser,
                                 users.email AS 'Email', Pembeli.IsActive AS 'Status'
                                 FROM Pembeli INNER JOIN users ON users.id = Pembeli.IDUser";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Pembeli.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Pembeli.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.Alamat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.Kota LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.Telepon LIKE '%".$requestData['search']['value']."%'";
        //   $sql.=" OR Pembeli.Handphone LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.IDUser LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR users.email LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Pembeli.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["Nama"];
          $nestedData[] = $row["Alamat"];
          $nestedData[] = $row["Kota"];
          $nestedData[] = $row["Telepon"];
        //   $nestedData[] = $row["Handphone"];
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

    public function GetCustomer()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataPembeli = "SELECT Pembeli.ID AS ID, Pembeli.ID AS View, Pembeli.ID AS Edit, Pembeli.Nama AS Nama, Pembeli.Alamat AS Alamat, Pembeli.Kota AS Kota,
                               Pembeli.Telepon AS Telepon, Pembeli.Handphone AS Handphone, Pembeli.IDUser AS IDUser,
                               User.Email AS 'Email', Pembeli.IsActive AS 'Status'
                               FROM Pembeli INNER JOIN User ON User.ID = Pembeli.IDUser";
      $HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
      $DataPembeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
        $DataPembeli[] = $Hasil;
      }
      return $DataPembeli;
    }

    public function GetCustomerProfile($ID)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataPembeli = "SELECT Pembeli.ID AS ID, Pembeli.ID AS View, Pembeli.ID AS Edit, Pembeli.Nama AS Nama, Pembeli.Alamat AS Alamat, Pembeli.Kota AS Kota,
                               Pembeli.Telepon AS Telepon, Pembeli.Handphone AS Handphone, Pembeli.IDUser AS IDUser,
                               users.email AS 'Email', Pembeli.IsActive AS 'Status'
                               FROM Pembeli INNER JOIN users ON users.id = Pembeli.IDUser
                               WHERE Pembeli.ID = '$ID'";
      $HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
      $DataPembeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
        $DataPembeli[] = $Hasil;
      }
      return $DataPembeli;
    }

    public function StoreCustomer(Request $Request, $IDUser)
    {
        $unique_id = uniqid();
        $Pembeli = new Customer(array(
            'Nama' => $Request->get('Nama'),
            'Alamat' => $Request->get('Alamat'),
            'Kota' => $Request->get('Kota'),
            'Telepon' => $Request->get('Telepon'),
            'Handphone' => (0),
            'IDUser' => $IDUser,
            'IsActive' => (1)
        ));
        $Pembeli->save();
        $ID = DB::table('Pembeli')->max('ID');
        if($Request->hasFile('FotoPembeli')) {
            $IDFoto = $ID.'.jpg';
            $Request->FotoPembeli->move(public_path('foto/pembeli'), $IDFoto);
        }
    }

    public function UpdateCustomer(Request $Request, $IDUser)
    {
        $IDPembeli = $Request->get('IDPembeli');
        $ID = $Request->get('IDPembeli').'.jpg';
        DB::table('Pembeli')
            ->where('ID', $IDPembeli)
            ->update(['Nama' => $Request->get('Nama'),
                    'Alamat' => $Request->get('Alamat'),
                    'Kota' => $Request->get('Kota'),
                    'Telepon' => $Request->get('Telepon'),
                    'Handphone' => (0),
                    'IDUser' =>  $Request->get('IDUser'),
                    'IsActive' => $Request->get('Status')]);
        if($Request->hasFile('FotoPembeli')) {
            $Request->FotoPembeli->move(public_path('foto/pembeli'), $ID);
        }
    }

    public function UpdateProfileCustomer(Request $Request)
    {
        $IDPembeli = $Request->get('IDPembeli');
        $ID = $Request->get('IDPembeli').'.jpg';
        DB::table('Pembeli')
            ->where('ID', $IDPembeli)
            ->update(['Nama' => $Request->get('Nama'),
                    'Alamat' => $Request->get('Alamat'),
                    'Kota' => $Request->get('Kota'),
                    'Telepon' => $Request->get('Telepon'),
                    'Handphone' => (0),
                    'IDUser' =>  $Request->get('IDUser')]);
        if($Request->hasFile('FotoPembeli')) {
            $Request->FotoPembeli->move(public_path('foto/pembeli'), $ID);
        }
    }
}
