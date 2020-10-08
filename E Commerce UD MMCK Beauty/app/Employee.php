<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Employee;
use DB;

class Employee extends Model
{
    protected $table = 'Karyawan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama','Alamat', 'Kota', 'Telepon', 'Handphone', 'IDUser', 'IDJabatan', 'IsActive'];

    public function GetAjaxEmployee()
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
          6 => 'Role',
          7 => 'Status',
          8 => 'View',
          9 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Karyawan.ID AS ID, Karyawan.ID AS View, Karyawan.ID AS Edit, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat, Karyawan.Kota AS Kota,
                                 Karyawan.Telepon AS Telepon, Karyawan.Handphone AS Handphone, Karyawan.IDUser AS IDUser,
                                 Karyawan.IDJabatan AS IDJabatan, users.email AS 'Email', Jabatan.Nama AS 'NamaJabatan', Karyawan.IsActive AS 'Status'
                                 FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Jabatan ON Jabatan.ID = Karyawan.IDJabatan";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Karyawan.ID AS ID, Karyawan.ID AS View, Karyawan.ID AS Edit, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat, Karyawan.Kota AS Kota,
                                 Karyawan.Telepon AS Telepon, Karyawan.Handphone AS Handphone, Karyawan.IDUser AS IDUser,
                                 Karyawan.IDJabatan AS IDJabatan, users.email AS 'Email', Jabatan.Nama AS 'NamaJabatan', Karyawan.IsActive AS 'Status'
                                 FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Jabatan ON Jabatan.ID = Karyawan.IDJabatan";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Karyawan.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Karyawan.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.Alamat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.Kota LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.Telepon LIKE '%".$requestData['search']['value']."%'";
        //   $sql.=" OR Karyawan.Handphone LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.IDUser LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Karyawan.IDJabatan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR users.email LIKE '%".$requestData['search']['value']."%'";
           $sql.=" OR Jabatan.Nama LIKE '%".$requestData['search']['value']."%'";
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
          $nestedData[] = $row["NamaJabatan"];
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

    public function GetEmployee()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat, Karyawan.Kota AS Kota,
                               Karyawan.Telepon AS Telepon, Karyawan.Handphone AS Handphone, Karyawan.IDUser AS IDUser,
                               Karyawan.IDJabatan AS IDJabatan, users.email AS 'Email', Jabatan.Nama AS 'NamaJabatan'
                               FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Jabatan ON Jabatan.ID = Karyawan.IDJabatan";
      $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
      $DataKaryawan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
        $DataKaryawan[] = $Hasil;
      }
      return $DataKaryawan;
    }

    public function GetEmployeeProfile($ID)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.ID AS View, Karyawan.ID AS Edit, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat, Karyawan.Kota AS Kota,
                               Karyawan.Telepon AS Telepon, Karyawan.Handphone AS Handphone, Karyawan.IDUser AS IDUser,
                               users.email AS 'Email', Karyawan.IsActive AS 'Status'
                               FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser
                               WHERE Karyawan.ID = '$ID'";
      $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
      $DataKaryawan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
        $DataKaryawan[] = $Hasil;
      }
      return $DataKaryawan;
    }

    public function StoreEmployee(Request $Request, $IDUser)
    {
        $unique_id = uniqid();
        $Karyawan = new Employee(array(
            'Nama' => $Request->get('Nama'),
            'Alamat' => $Request->get('Alamat'),
            'Kota' => $Request->get('Kota'),
            'Telepon' => $Request->get('Telepon'),
            'Handphone' => (0),
            'IDUser' => $IDUser,
            'IDJabatan' => $Request->get('IDJabatan'),
            'IsActive' => (1)
        ));
        $Karyawan->save();
        $ID = DB::table('Karyawan')->max('ID');

        if($Request->hasFile('FotoKaryawan')) {
            $IDFoto = $ID.'.jpg';
            $Request->FotoKaryawan->move(public_path('foto/karyawan'), $IDFoto);
        }
    }

    public function UpdateEmployee(Request $Request, $IDUser)
    {
        $IDKaryawan = $Request->get('IDKaryawan');
        $ID = $Request->get('IDKaryawan').'.jpg';
        DB::table('Karyawan')
            ->where('ID', $IDKaryawan)
            ->update(['Nama' => $Request->get('Nama'),
                    'Alamat' => $Request->get('Alamat'),
                    'Kota' => $Request->get('Kota'),
                    'Telepon' => $Request->get('Telepon'),
                    'Handphone' => (0),
                    'IDUser' =>  $Request->get('IDUser'),
                    'IDJabatan' => $Request->get('IDJabatan'),
                    'IsActive' => $Request->get('Status')]);
        if($Request->hasFile('FotoKaryawan')) {
            $Request->FotoKaryawan->move(public_path('foto/karyawan'), $ID);
        }
    }

    public function UpdateProfileEmployee(Request $Request)
    {
        $IDKaryawan = $Request->get('IDKaryawan');
        $ID = $Request->get('IDKaryawan').'.jpg';
        DB::table('Karyawan')
            ->where('ID', $IDKaryawan)
            ->update(['Nama' => $Request->get('Nama'),
                    'Alamat' => $Request->get('Alamat'),
                    'Kota' => $Request->get('Kota'),
                    'Telepon' => $Request->get('Telepon'),
                    'Handphone' => (0),
                    'IDUser' =>  $Request->get('IDUser')]);
        if($Request->hasFile('FotoKaryawan')) {
            $Request->FotoKaryawan->move(public_path('foto/karyawan'), $ID);
        }
    }
}
