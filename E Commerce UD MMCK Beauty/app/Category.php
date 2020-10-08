<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Category;
use DB;

class Category extends Model
{
    protected $table = 'Kategori';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'Keterangan', 'IsActive'];

    public function GetAjaxCategory()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'CategoryName',
          2 => 'Description',
          3 => 'Status',
          4 => 'View',
          5 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Kategori.ID AS 'ID', Kategori.ID AS 'View', Kategori.ID AS 'Edit',
        Kategori.Nama AS 'CategoryName', Kategori.Keterangan AS 'Description', Kategori.IsActive AS 'Status' FROM Kategori";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Kategori.ID AS 'ID', Kategori.ID AS 'View', Kategori.ID AS 'Edit',
        Kategori.Nama AS 'CategoryName', Kategori.Keterangan AS 'Description', Kategori.IsActive AS 'Status' FROM Kategori";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Kategori.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Kategori.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Kategori.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Kategori.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["CategoryName"];
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

    public function GetCategory()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataKategori = "SELECT Kategori.ID AS 'ID', Kategori.Nama AS 'CategoryName', Kategori.Keterangan AS 'Description', Kategori.IsActive AS 'Status' FROM Kategori";
        $HasilQueryGetDataKategori = mysqli_query($MySQLi, $QueryGetDataKategori);
        $DataKategori = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKategori)) {
        $DataKategori[] = $Hasil;
        }
        return $DataKategori;
    }

    public function GetNamaCategory($ID)
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataKategori = "SELECT Kategori.ID AS 'ID', Kategori.Nama AS 'CategoryName', Kategori.Keterangan AS 'Description', Kategori.IsActive AS 'Status' FROM Kategori WHERE Kategori.ID = '$ID'";
        $HasilQueryGetDataKategori = mysqli_query($MySQLi, $QueryGetDataKategori);
        $DataKategori = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKategori)) {
        $DataKategori[] = $Hasil;
        }
        return $DataKategori;
    }

    public function GetFilterCategory($ID)
    {
        // require '../connection/Init.php';
        // $MySQLi = mysqli_connect($domain, $username, $password, $database);

        // $QueryGetDataBrand = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
        //                          Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
        //                          Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
        //                          Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
        //                          SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
        //                          FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
        //                          INNER JOIN Merk ON Merk.ID = Barang.IDMerk
        //                          INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
        //                          INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
        //                          WHERE Barang.IsActive = '1' AND Kategori.ID = '$ID' AND Barang.Stok > 0";
        // $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
        // $DataBrand = array();
        // while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
        //     $DataBrand[] = $Hasil;
        // }

        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual', 'Kategori.Nama AS NamaKategori',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang')
                                ->where('Barang.IsActive', '=', '1')
                                ->where('Kategori.ID', '=', $ID)
                                ->where('Barang.Stok', '>', 0)
                                ->paginate(6);
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function StoreCategory(Request $Request)
    {
        $unique_id = uniqid();
        $Kategori = new Category(array(
            'Nama' => $Request->get('NamaKategori'),
            'Keterangan' => $Request->get('Deskripsi'),
            'IsActive' => (1)
        ));
        $Kategori->save();
    }

    public function UpdateCategory(Request $Request)
    {
        $IDKategori = $Request->get('IDKategori');
        DB::table('Kategori')
            ->where('ID', $IDKategori)
            ->update(['Nama' => $Request->get('NamaKategori'),
                    'Keterangan' => $Request->get('Deskripsi'),
                    'IsActive' => $Request->get('Status')]);
    }
}
