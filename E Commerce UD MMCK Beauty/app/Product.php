<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Product;
use DB;

class Product extends Model
{
    protected $table = 'Barang';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama','Keterangan', 'Stok', 'Berat', 'HargaBeli', 'HargaJual', 'HargaJualPromo', 'IDSubKategori',
                        'IDMerk', 'IDStatusBarang', 'IsPromo', 'IsActive'];

    public function GetAjaxProduct()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'Name',
          2 => 'Description',
          3 => 'Stock',
          4 => 'Berat',
          5 => 'PurchasingPrice',
          6 => 'SellingPrice',
          7 => 'SellingPricePromo',
          8 => 'SubCategoryName',
          9 => 'BrandName',
          10 => 'ProductStatusName',
          11 => 'Promo',
          12 => 'Status',
          13 => 'View',
          14 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                                 Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                                 Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                                 Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                                 SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                                 FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                                 INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                                 INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                                 Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                                 Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                                 Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                                 SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                                 FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                                 INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                                 INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Barang.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Barang.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.Stok LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.Berat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.HargaBeli LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.HargaJual LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.HargaJualPromo LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IDSubKategori LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IDMerk LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IDStatusBarang LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IsPromo LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SubKategori.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Merk.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR StatusBarang.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IsActive LIKE '%".$requestData['search']['value']."%' )";
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

          if ($row["Promo"] == 1) {
              $Promo = 'Discount';
          } else {
              $Promo = 'Undiscount';
          }

          $nestedData[] = $row["ID"];
          $nestedData[] = $row["Nama"];
          $nestedData[] = $row["Keterangan"];
          $nestedData[] = $row["Stok"];
          $nestedData[] = $row["Berat"];
          $nestedData[] = $row["HargaBeli"];
          $nestedData[] = $row["HargaJual"];
          $nestedData[] = $row["HargaJualPromo"];
          $nestedData[] = $row["NamaSubKategori"];
          $nestedData[] = $row["NamaMerk"];
          $nestedData[] = $row["StatusBarang"];
          $nestedData[] = $Promo;
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

    public function GetAjaxInventoryProduct()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'Name',
          2 => 'Description',
          3 => 'Stock',
          4 => 'Berat',
          5 => 'PurchasingPrice',
          6 => 'SellingPrice',
          7 => 'SellingPricePromo',
          8 => 'SubCategoryName',
          9 => 'BrandName',
          10 => 'ProductStatusName',
          11 => 'Promo',
          12 => 'Status',
          13 => 'View',
          14 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                                 Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                                 Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                                 Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                                 SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                                 FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                                 INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                                 INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                                 Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                                 Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                                 Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                                 SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                                 FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                                 INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                                 INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Barang.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Barang.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.Stok LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.Berat LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.HargaBeli LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.HargaJual LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.HargaJualPromo LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IDSubKategori LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IDMerk LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IDStatusBarang LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IsPromo LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SubKategori.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Merk.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR StatusBarang.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Barang.IsActive LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY Barang.Stok ASC, ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          if ($row["Status"] == 1) {
              $Status = 'Active';
          } else {
              $Status = 'InActive';
          }

          if ($row["Promo"] == 1) {
              $Promo = 'Discount';
          } else {
              $Promo = 'Undiscount';
          }

          $nestedData[] = $row["ID"];
          $nestedData[] = $row["Nama"];
          $nestedData[] = $row["Keterangan"];
          $nestedData[] = $row["Stok"];
          $nestedData[] = $row["Berat"];
          $nestedData[] = $row["HargaBeli"];
          $nestedData[] = $row["HargaJual"];
          $nestedData[] = $row["HargaJualPromo"];
          $nestedData[] = $row["NamaSubKategori"];
          $nestedData[] = $row["NamaMerk"];
          $nestedData[] = $row["StatusBarang"];
          $nestedData[] = $Promo;
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

    public function GetProduct()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                               Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                               Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                               Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                               SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                               FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                               INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                               INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang";
      $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
      $DataBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
      }
      return $DataBarang;
    }

    public function GetProductDetail($ID)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                               Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                               Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                               Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                               SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                               FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                               INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                               INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                               WHERE Barang.ID = '$ID'";
      $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
      $DataBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
      }
      return $DataBarang;
    }

    public function GetProductSearch($ID)
    {
        // require '../connection/Init.php';
        // $MySQLi = mysqli_connect($domain, $username, $password, $database);
        //
        // $QueryGetDataProduct = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
        //                          Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
        //                          Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
        //                          Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
        //                          SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang', Kategori.Nama AS 'NamaKategori'
        //                          FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
        //                          INNER JOIN Merk ON Merk.ID = Barang.IDMerk
        //                          INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
        //                          INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
        //                          WHERE Barang.IsActive = '1' AND (Merk.Nama LIKE '%$ID%' OR Barang.Nama LIKE '%$ID%' OR SubKategori.Nama LIKE '%$ID%' OR Kategori.Nama LIKE '%$ID%') AND Barang.Stok > 0";
        // $HasilQueryGetDataProduct = mysqli_query($MySQLi, $QueryGetDataProduct);
        // $DataProduct = array();
        // while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataProduct)) {
        //     $DataProduct[] = $Hasil;
        // } ini yul yang atas diubah jdi bawah, yang atsa udah bner
        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'SubKategori.ID AS IDSubKategori',
                                 'Merk.ID AS IDMerk', 'StatusBarang.ID AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                ->whereRaw('Merk.Nama LIKE "%'.$ID.'%" OR Barang.Nama LIKE "%'.$ID.'%" OR SubKategori.Nama LIKE "%'.$ID.'%" OR Kategori.Nama LIKE "%'.$ID.'%"')
                                ->paginate(6);

        // $DataBrand = DB::table('Barang AS B')
        //                         ->join('SubKategori AS SB', 'B.IDSubKategori', '=', 'SB.ID')
        //                         ->join('Merk AS M', 'M.ID', '=', 'B.IDMerk')
        //                         ->join('Kategori AS K', 'K.ID', '=', 'SB.IDKategori')
        //                         ->join('StatusBarang AS SS', 'SS.ID', '=', 'B.IDStatusBarang')
        //                         ->select('B.ID AS ID', 'B.ID AS View', 'B.ID AS Edit', 'B.Nama AS Nama', 'B.Keterangan AS Keterangan',
        //                          'B.Stok AS Stok', 'B.HargaBeli AS HargaBeli', 'B.HargaJual AS HargaJual',
        //                          'B.HargaJualPromo AS HargaJualPromo', 'SB.ID AS IDSubKategori',
        //                          'M.ID AS IDMerk', 'SS.ID AS IDStatusBarang', 'B.IsPromo AS Promo', 'B.IsActive AS Status',
        //                          'SB.Nama AS NamaSubKategori', 'M.Nama AS NamaMerk', 'SS.Nama AS SS', 'K.Nama AS NamaKategori')
        //                         ->where('M.Nama', 'LIKE', '%$ID%')
        //                         ->paginate(6);
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function GetBarangSale()
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
        //                          INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
        //                          WHERE Barang.IsActive = '1' AND Barang.IDMerk = '$ID' AND Barang.Stok > 0";
        // $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
        // $DataBrand = array();
        // while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
        //     $DataBrand[] = $Hasil;
        // }

        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang')
                                ->where('Barang.IsActive', '=', '1')
                                ->where('Barang.IsPromo', '=', '1')
                                ->orwhere('Barang.IDStatusBarang', '=', '3')
                                ->where('Barang.Stok', '>', 0)
                                ->paginate(6);
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function GetProductRecommendedItems()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                               Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                               Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                               Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                               SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                               FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                               INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                               INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                               WHERE Barang.Stok > 0
                               ORDER BY Barang.Stok DESC LIMIT 3";
      $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
      $DataBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
      }
      return $DataBarang;
    }

    public function GetProductNew()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                               Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                               Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                               Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                               SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                               FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                               INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                               INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                               WHERE Barang.Stok > 0
                               ORDER BY Barang.Updated_At DESC LIMIT 3";
      $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
      $DataBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
      }
      return $DataBarang;
    }

    public function GetProductSale()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                               Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                               Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                               Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                               SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                               FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                               INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                               INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                               WHERE Barang.IDStatusBarang = '3' AND Barang.IsPromo = '1' AND Barang.Stok > 0
                               ORDER BY Barang.Updated_At DESC LIMIT 3";
      $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
      $DataBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
      }
      return $DataBarang;
    }

    public function GetProductShopingCart($Cart)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $DataTemp = array();
      for ($i=0; $i < count($Cart); $i++) {
          $TempID = $Cart[$i];
          $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                                   Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                                   Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                                   Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                                   SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                                   FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                                   INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                                   INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                                   WHERE Barang.ID = '$TempID'";
          $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
          $DataBarang = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
            $DataBarang[] = $Hasil;
          }
          array_push($DataTemp, $DataBarang);
      }
      return $DataTemp;
    }

    public function StoreProduct(Request $Request)
    {
        $unique_id = uniqid();
        $Barang = new Product(array(
            'Nama' => $Request->get('Nama'),
            'Keterangan' => $Request->get('Keterangan'),
            'Stok' => $Request->get('Stok'),
            'Berat' => $Request->get('Berat'),
            'HargaBeli' => $Request->get('HargaBeli'),
            'HargaJual' => $Request->get('HargaJual'),
            'HargaJualPromo' => $Request->get('HargaJualPromo'),
            'IDSubKategori' => $Request->get('IDSubKategori'),
            'IDMerk' => $Request->get('IDMerk'),
            'IDStatusBarang' => $Request->get('IDStatusBarang'),
            'IsPromo' => $Request->get('IsPromo'),
            'IsActive' => (1)
        ));
        $Barang->save();
        $ID = DB::table('Barang')->max('ID');
        $IDFoto = $ID.'.jpg';
        $Request->FotoBarang->move(public_path('foto/barang'), $IDFoto);
    }

    public function UpdateProduct(Request $Request)
    {
        $IDBarang = $Request->get('IDBarang');
        $ID = $Request->get('IDBarang').'.jpg';
        DB::table('Barang')
            ->where('ID', $IDBarang)
            ->update(['Nama' => $Request->get('Nama'),
                    'Keterangan' => $Request->get('Keterangan'),
                    'Stok' => $Request->get('Stok'),
                    'Berat' => $Request->get('Berat'),
                    'HargaBeli' => $Request->get('HargaBeli'),
                    'HargaJual' => $Request->get('HargaJual'),
                    'HargaJualPromo' =>  $Request->get('HargaJualPromo'),
                    'IDSubKategori' => $Request->get('IDSubKategori'),
                    'IDMerk' => $Request->get('IDMerk'),
                    'IDStatusBarang' => $Request->get('IDStatusBarang'),
                    'IsPromo' => $Request->get('IsPromo'),
                    'IsActive' => $Request->get('Status')]);
        if($Request->hasFile('FotoBarang')) {
            $Request->FotoBarang->move(public_path('foto/barang'), $ID);
        }
    }

    public function UpdateProductInventory(Request $Request)
    {
        $IDBarang = $Request->get('IDBarang');
        DB::table('Barang')
            ->where('ID', $IDBarang)
            ->update(['Nama' => $Request->get('Nama'),
                    'Stok' => $Request->get('Stok')]);
    }

    public function UpdateMinusStock(Request $Request)
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $IDNotaJual = $Request->get('IDNotaJual');
        $QueryGetDataBarangXNotaJual = "SELECT BarangXNotaJual.ID AS ID, BarangXNotaJual.IDBarang AS IDBarang,
          BarangXNotaJual.IDNotaJual AS IDNotaJual, BarangXNotaJual.Jumlah AS Jumlah, Barang.Nama AS NamaBarang,
          BarangXNotaJual.HargaReal AS HargaReal, BarangXNotaJual.SubTotal AS SubTotal
          FROM BarangXNotaJual INNER JOIN NotaJual ON BarangXNotaJual.IDNotaJual = NotaJual.ID
          INNER JOIN Barang ON BarangXNotaJual.IDBarang = Barang.ID
          WHERE BarangXNotaJual.IDNotaJual = '$IDNotaJual'";
        $HasilQueryGetDataBarangXNotaJual = mysqli_query($MySQLi, $QueryGetDataBarangXNotaJual);
        $DataBarangXNotaJual = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarangXNotaJual)) {
          $DataBarangXNotaJual[] = $Hasil;
        }

        for ($i=0; $i < count($DataBarangXNotaJual); $i++) {
            $IDBarang = $DataBarangXNotaJual[$i]['IDBarang'];
            $MinusStock = $DataBarangXNotaJual[$i]['Jumlah'];

            $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                                     Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                                     Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                                     Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                                     SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                                     FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                                     INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                                     INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                                     WHERE Barang.ID = '$IDBarang'";
            $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
            $DataBarang = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
              $DataBarang[] = $Hasil;
            }

            $StockSekarang = $DataBarang[0]['Stok'];
            $TotalAkhir = intval($MinusStock) + intval($StockSekarang);

            DB::table('Barang')
                ->where('ID', $IDBarang)
                ->update(['Stok' => $TotalAkhir]);
        }
    }

    public function SortNewArrival($KodeFilter, $IDFilter, $Keyword)
    {
    //   require '../connection/Init.php';
    //   $MySQLi = mysqli_connect($domain, $username, $password, $database);
    //
    //   if ($KodeFilter = 'B') {
    //      $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                               Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                               Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                               Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                               SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                               FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                               INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                               INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                               WHERE Barang.IsActive = '1' AND Barang.IDMerk = '$IDFilter' AND Barang.Stok > 0
    //                               ORDER BY Barang.created_at DESC";
    //   } else if ($KodeFilter = 'C') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Kategori.ID = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.created_at DESC";
    //   } else if ($KodeFilter = 'S') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDSubKategori = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.created_at DESC";
    //   }
    //   $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
    //   $DataBarang = array();
    //   while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
    //     $DataBarang[] = $Hasil;
    //   }

    if ($Keyword == ':') {
        if ($KodeFilter == 'XB') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IDMerk', '=', $IDFilter)
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.created_at', 'DESC')
                                    ->paginate(6);
        } else if ($KodeFilter == 'XC') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Kategori.ID', '=', $IDFilter)
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.created_at', 'DESC')
                                    ->paginate(6);
        } else if ($KodeFilter == 'XS') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IDSubKategori', '=', $IDFilter)
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.created_at', 'DESC')
                                    ->paginate(6);
        } else if ($KodeFilter == 'XL') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IsPromo', '=', '1')
                                    ->orwhere('Barang.IDStatusBarang', '=', '3')
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.created_at', 'DESC')
                                    ->paginate(6);
        }
    } else {
        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                ->where('Barang.IsActive', '=', '1')
                                ->whereRaw('Merk.Nama LIKE "%'.$Keyword.'%" OR Barang.Nama LIKE "%'.$Keyword.'%" OR SubKategori.Nama LIKE "%'.$Keyword.'%" OR Kategori.Nama LIKE "%'.$Keyword.'%"')
                                // ->orwhere('Merk.Nama', 'LIKE', '%$Keyword%')->orwhere('Barang.Nama', 'LIKE', '%$Keyword%')->orwhere('SubKategori.Nama', 'LIKE', '%$Keyword%')->orwhere('Kategori.Nama', 'LIKE', '%$Keyword%')
                                // ->where('Barang.Stok', '>', 0)
                                ->orderBy('Barang.created_at', 'DESC')
                                ->paginate(6);
    }
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function SortPriceLTH($KodeFilter, $IDFilter, $Keyword)
    {
    //   require '../connection/Init.php';
    //   $MySQLi = mysqli_connect($domain, $username, $password, $database);
      //
    //   if ($KodeFilter = 'B') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDMerk = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.HargaJual ASC";
    //   } else if ($KodeFilter = 'C') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Kategori.ID = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.HargaJual ASC";
    //   } else if ($KodeFilter = 'S') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDSubKategori = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.HargaJual ASC";
    //   }
    //   $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
    //   $DataBarang = array();
    //   while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
    //     $DataBarang[] = $Hasil;
    //   }

    if ($Keyword == ':') {
        if ($KodeFilter == 'XB') {
        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                ->where('Barang.IsActive', '=', '1')
                                ->where('Barang.IDMerk', '=', $IDFilter)
                                // ->where('Barang.Stok', '>', 0)
                                ->orderBy('Barang.HargaJual', 'ASC')
                                ->paginate(6);
        } else if ($KodeFilter == 'XC') {
        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                ->where('Barang.IsActive', '=', '1')
                                ->where('Kategori.ID', '=', $IDFilter)
                                // ->where('Barang.Stok', '>', 0)
                                ->orderBy('Barang.HargaJual', 'ASC')
                                ->paginate(6);
        } else if ($KodeFilter == 'XS') {
        $DataBrand = DB::table('Barang')
                                ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                ->where('Barang.IsActive', '=', '1')
                                ->where('Barang.IDSubKategori', '=', $IDFilter)
                                // ->where('Barang.Stok', '>', 0)
                                ->orderBy('Barang.HargaJual', 'ASC')
                                ->paginate(6);
        } else if ($KodeFilter == 'XL') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IsPromo', '=', '1')
                                    ->orwhere('Barang.IDStatusBarang', '=', '3')
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.HargaJual', 'ASC')
                                    ->paginate(6);
        }
    } else {
       $DataBrand = DB::table('Barang')
                               ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                               ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                               ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                               ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                               ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                               ->where('Barang.IsActive', '=', '1')
                               ->whereRaw('Merk.Nama LIKE "%'.$Keyword.'%" OR Barang.Nama LIKE "%'.$Keyword.'%" OR SubKategori.Nama LIKE "%'.$Keyword.'%" OR Kategori.Nama LIKE "%'.$Keyword.'%"')
                            //    ->where('Barang.Stok', '>', 0)
                               ->orderBy('Barang.HargaJual', 'ASC')
                               ->paginate(6);
   }

        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function SortPriceHTL($KodeFilter, $IDFilter, $Keyword)
    {
    //   require '../connection/Init.php';
    //   $MySQLi = mysqli_connect($domain, $username, $password, $database);
      //
    //   if ($KodeFilter = 'B') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDMerk = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.HargaJual DESC";
    //   } else if ($KodeFilter = 'C') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Kategori.ID = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.HargaJual DESC";
    //   } else if ($KodeFilter = 'S') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDSubKategori = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.HargaJual DESC";
    //   }
    //   $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
    //   $DataBarang = array();
    //   while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
    //     $DataBarang[] = $Hasil;
    //   }

    if ($Keyword == ':') {
        if ($KodeFilter == 'XB') {
        $DataBrand = DB::table('Barang')
                            ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                            ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                            ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                            ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                            ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                             'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                             'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                             'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                             'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                            ->where('Barang.IsActive', '=', '1')
                            ->where('Barang.IDMerk', '=', $IDFilter)
                            // ->where('Barang.Stok', '>', 0)
                            ->orderBy('Barang.HargaJual', 'DESC')
                            ->paginate(6);
        } else if ($KodeFilter == 'XC') {
        $DataBrand = DB::table('Barang')
                            ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                            ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                            ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                            ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                            ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                             'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                             'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                             'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                             'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                            ->where('Barang.IsActive', '=', '1')
                            ->where('Kategori.ID', '=', $IDFilter)
                            // ->where('Barang.Stok', '>', 0)
                            ->orderBy('Barang.HargaJual', 'DESC')
                            ->paginate(6);
        } else if ($KodeFilter == 'XS') {
        $DataBrand = DB::table('Barang')
                            ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                            ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                            ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                            ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                            ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                             'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                             'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                             'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                             'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                            ->where('Barang.IsActive', '=', '1')
                            ->where('Barang.IDSubKategori', '=', $IDFilter)
                            // ->where('Barang.Stok', '>', 0)
                            ->orderBy('Barang.HargaJual', 'DESC')
                            ->paginate(6);
        } else if ($KodeFilter == 'XL') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IsPromo', '=', '1')
                                    ->orwhere('Barang.IDStatusBarang', '=', '3')
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.HargaJual', 'DESC')
                                    ->paginate(6);
        }
    } else {
       $DataBrand = DB::table('Barang')
                               ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                               ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                               ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                               ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                               ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                               ->where('Barang.IsActive', '=', '1')
                               ->whereRaw('Merk.Nama LIKE "%'.$Keyword.'%" OR Barang.Nama LIKE "%'.$Keyword.'%" OR SubKategori.Nama LIKE "%'.$Keyword.'%" OR Kategori.Nama LIKE "%'.$Keyword.'%"')
                            //    ->orwhere('Merk.Nama', 'LIKE', '%$Keyword%')->orwhere('Barang.Nama', 'LIKE', '%$Keyword%')->orwhere('SubKategori.Nama', 'LIKE', '%$Keyword%')->orwhere('Kategori.Nama', 'LIKE', '%$Keyword%')
                            //    ->where('Barang.Stok', '>', 0)
                               ->orderBy('Barang.HargaJual', 'DESC')
                               ->paginate(6);
   }
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function SortNameATZ($KodeFilter, $IDFilter, $Keyword)
    {
    //   require '../connection/Init.php';
    //   $MySQLi = mysqli_connect($domain, $username, $password, $database);
      //
    //   if ($KodeFilter = 'B') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDMerk = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.Nama ASC";
    //   } else if ($KodeFilter = 'C') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Kategori.ID = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.Nama ASC";
    //   } else if ($KodeFilter = 'S') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDSubKategori = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.Nama ASC";
    //   }
    //   $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
    //   $DataBarang = array();
    //   while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
    //     $DataBarang[] = $Hasil;
    //   }

    if ($Keyword == ':') {
        if ($KodeFilter == 'XB') {
        $DataBrand = DB::table('Barang')
                        ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                        ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                        ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                        ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                        ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                         'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                         'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                         'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                         'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                        ->where('Barang.IsActive', '=', '1')
                        ->where('Barang.IDMerk', '=', $IDFilter)
                        // ->where('Barang.Stok', '>', 0)
                        ->orderBy('Barang.Nama', 'ASC')
                        ->paginate(6);
        } else if ($KodeFilter == 'XC') {
        $DataBrand = DB::table('Barang')
                        ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                        ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                        ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                        ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                        ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                         'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                         'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                         'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                         'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                        ->where('Barang.IsActive', '=', '1')
                        ->where('Kategori.ID', '=', $IDFilter)
                        // ->where('Barang.Stok', '>', 0)
                        ->orderBy('Barang.Nama', 'ASC')
                        ->paginate(6);
        } else if ($KodeFilter == 'XS') {
        $DataBrand = DB::table('Barang')
                        ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                        ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                        ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                        ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                        ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                         'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                         'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                         'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                         'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                        ->where('Barang.IsActive', '=', '1')
                        ->where('Barang.IDSubKategori', '=', $IDFilter)
                        // ->where('Barang.Stok', '>', 0)
                        ->orderBy('Barang.Nama', 'ASC')
                        ->paginate(6);
        } else if ($KodeFilter == 'XL') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IsPromo', '=', '1')
                                    ->orwhere('Barang.IDStatusBarang', '=', '3')
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.Nama', 'ASC')
                                    ->paginate(6);
        }
    } else {
       $DataBrand = DB::table('Barang')
                               ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                               ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                               ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                               ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                               ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                               ->where('Barang.IsActive', '=', '1')
                               ->whereRaw('Merk.Nama LIKE "%'.$Keyword.'%" OR Barang.Nama LIKE "%'.$Keyword.'%" OR SubKategori.Nama LIKE "%'.$Keyword.'%" OR Kategori.Nama LIKE "%'.$Keyword.'%"')
                            //    ->orwhere('Merk.Nama', 'LIKE', '%$Keyword%')->orwhere('Barang.Nama', 'LIKE', '%$Keyword%')->orwhere('SubKategori.Nama', 'LIKE', '%$Keyword%')->orwhere('Kategori.Nama', 'LIKE', '%$Keyword%')
                            //    ->where('Barang.Stok', '>', 0)
                               ->orderBy('Barang.Nama', 'ASC')
                               ->paginate(6);
   }
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function SortNameZTA($KodeFilter, $IDFilter, $Keyword)
    {
    //   require '../connection/Init.php';
    //   $MySQLi = mysqli_connect($domain, $username, $password, $database);
      //
    //   if ($KodeFilter = 'B') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDMerk = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.Nama DESC";
    //   } else if ($KodeFilter = 'C') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Kategori.ID = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.Nama DESC";
    //   } else if ($KodeFilter = 'S') {
    //       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
    //                                Barang.Stok AS Stok, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
    //                                Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
    //                                Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
    //                                SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
    //                                FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
    //                                INNER JOIN Merk ON Merk.ID = Barang.IDMerk
    //                                INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
    //                                INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
    //                                WHERE Barang.IsActive = '1' AND Barang.IDSubKategori = '$IDFilter' AND Barang.Stok > 0
    //                                ORDER BY Barang.Nama DESC";
    //   }
    //   $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
    //   $DataBarang = array();
    //   while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
    //     $DataBarang[] = $Hasil;
    //   }

    if ($Keyword == ':') {
        if ($KodeFilter == 'XB') {
        $DataBrand = DB::table('Barang')
                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                    ->where('Barang.IsActive', '=', '1')
                    ->where('Barang.IDMerk', '=', $IDFilter)
                    // ->where('Barang.Stok', '>', 0)
                    ->orderBy('Barang.Nama', 'DESC')
                    ->paginate(6);
        } else if ($KodeFilter == 'XC') {
        $DataBrand = DB::table('Barang')
                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                    ->where('Barang.IsActive', '=', '1')
                    ->where('Kategori.ID', '=', $IDFilter)
                    // ->where('Barang.Stok', '>', 0)
                    ->orderBy('Barang.Nama', 'DESC')
                    ->paginate(6);
        } else if ($KodeFilter == 'XS') {
        $DataBrand = DB::table('Barang')
                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                    ->where('Barang.IsActive', '=', '1')
                    ->where('Barang.IDSubKategori', '=', $IDFilter)
                    // ->where('Barang.Stok', '>', 0)
                    ->orderBy('Barang.Nama', 'DESC')
                    ->paginate(6);
        } else if ($KodeFilter == 'XL') {
            $DataBrand = DB::table('Barang')
                                    ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                                    ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                                    ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                                    ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                                    ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                     'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                     'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                     'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                     'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                                    ->where('Barang.IsActive', '=', '1')
                                    ->where('Barang.IsPromo', '=', '1')
                                    ->orwhere('Barang.IDStatusBarang', '=', '3')
                                    // ->where('Barang.Stok', '>', 0)
                                    ->orderBy('Barang.Nama', 'DESC')
                                    ->paginate(6);
        }
    } else {
       $DataBrand = DB::table('Barang')
                               ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
                               ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
                               ->join('Kategori', 'Kategori.ID', '=', 'SubKategori.IDKategori')
                               ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
                               ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
                                'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang', 'Kategori.Nama AS NamaKategori')
                               ->where('Barang.IsActive', '=', '1')
                               ->whereRaw('Merk.Nama LIKE "%'.$Keyword.'%" OR Barang.Nama LIKE "%'.$Keyword.'%" OR SubKategori.Nama LIKE "%'.$Keyword.'%" OR Kategori.Nama LIKE "%'.$Keyword.'%"')
                            //    ->orwhere('Merk.Nama', 'LIKE', '%$Keyword%')->orwhere('Barang.Nama', 'LIKE', '%$Keyword%')->orwhere('SubKategori.Nama', 'LIKE', '%$Keyword%')->orwhere('Kategori.Nama', 'LIKE', '%$Keyword%')
                            //    ->where('Barang.Stok', '>', 0)
                               ->orderBy('Barang.Nama', 'DESC')
                               ->paginate(6);
   }
        $DataBrand->setPath('');
        return $DataBrand;
    }
}
