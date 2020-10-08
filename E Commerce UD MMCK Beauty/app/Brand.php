<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Brand;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination;
use Illuminate\Pagination\Factory;
use App\Response;
use DB;

class Brand extends Model
{
    protected $table = 'Merk';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'Keterangan', 'IsActive'];

    public function GetAjaxBrand()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'BrandName',
          2 => 'Description',
          3 => 'Status',
          4 => 'View',
          5 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Merk.ID AS 'ID', Merk.ID AS 'View', Merk.ID AS 'Edit',
        Merk.Nama AS 'BrandName', Merk.Keterangan AS 'Description', Merk.IsActive AS 'Status' FROM Merk";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Merk.ID AS 'ID', Merk.ID AS 'View', Merk.ID AS 'Edit',
        Merk.Nama AS 'BrandName', Merk.Keterangan AS 'Description', Merk.IsActive AS 'Status' FROM Merk";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Merk.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Merk.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Merk.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Merk.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["BrandName"];
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

    public function GetBrand()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBrand = "SELECT Merk.ID AS 'ID', Merk.Nama AS 'BrandName', Merk.Keterangan AS 'Description', Merk.IsActive AS 'Status' FROM Merk";
        $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
        $DataBrand = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
            $DataBrand[] = $Hasil;
        }
        return $DataBrand;
    }

    public function GetNamaBrand($ID)
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBrand = "SELECT Merk.ID AS 'ID', Merk.Nama AS 'BrandName', Merk.Keterangan AS 'Description', Merk.IsActive AS 'Status' FROM Merk WHERE Merk.ID = '$ID'";
        $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
        $DataBrand = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
            $DataBrand[] = $Hasil;
        }
        return $DataBrand;
    }

    public function GetSumBrand()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataBrand = "SELECT Merk.ID AS 'ID', Merk.Nama AS 'BrandName', COUNT(Barang.IDMerk) AS 'Jumlah' FROM Barang INNER JOIN Merk ON Barang.IDMerk = Merk.ID WHERE Barang.IsActive = '1' GROUP BY Barang.IDMerk;";
        $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
        $DataBrand = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
            $DataBrand[] = $Hasil;
        }
        return $DataBrand;
    }

    public function GetFilterBrand($ID)
    {
        // require '../connection/Init.php';
        // $MySQLi = mysqli_connect($domain, $username, $password, $database);
        //
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

        // $page = Input::get('page', 1);
        // $paginate = 5;

        // $DataBrandAdaStok = DB::table('Barang')
        //                         ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
        //                         ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
        //                         ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
        //                         ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
        //                          'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
        //                          'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
        //                          'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
        //                          'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang')
        //                         ->where('Barang.IsActive', '=', '1')
        //                         ->where('Barang.IDMerk', '=', $ID)
        //                         ->where('Barang.Stok', '>', 0)
        //                         ->paginate(6);

        // $DataBrandTidakAdaStok = DB::table('Barang')
        //                         ->join('SubKategori', 'Barang.IDSubKategori', '=', 'SubKategori.ID')
        //                         ->join('Merk', 'Merk.ID', '=', 'Barang.IDMerk')
        //                         ->join('StatusBarang', 'StatusBarang.ID', '=', 'Barang.IDStatusBarang')
        //                         ->select('Barang.ID AS ID', 'Barang.ID AS View', 'Barang.ID AS Edit', 'Barang.Nama AS Nama', 'Barang.Keterangan AS Keterangan',
        //                          'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
        //                          'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
        //                          'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
        //                          'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang')
        //                         ->where('Barang.IsActive', '=', '1')
        //                         ->where('Barang.IDMerk', '=', $ID)
        //                         ->where('Barang.Stok', '=', 0)
        //                         ->union($DataBrandAdaStok)
        //                         ->get();
        //                         ->paginate(6);

        // $slice = array_slice($DataBrand, $paginate * ($page - 1), $paginate);
        // $DataBrand = Paginator::make($slice, count($DataBrandTidakAdaStok), $paginate);
        // $DataBrand = Paginator::make($slice, count($DataBrandTidakAdaStok), $paginate);
        // $DataBrand->setPath('');

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
                                ->where('Barang.IDMerk', '=', $ID)
                                ->paginate(6);
        return $DataBrand;
    }

    public function StoreBrand(Request $Request)
    {
        $unique_id = uniqid();
        $Brand = new Brand(array(
            'Nama' => $Request->get('NamaBrand'),
            'Keterangan' => $Request->get('Deskripsi'),
            'IsActive' => (1)
        ));
        $Brand->save();
    }

    public function UpdateBrand(Request $Request)
    {
        $IDBrand = $Request->get('IDBrand');
        DB::table('Merk')
            ->where('ID', $IDBrand)
            ->update(['Nama' => $Request->get('NamaBrand'),
                    'Keterangan' => $Request->get('Deskripsi'),
                    'IsActive' => $Request->get('Status')]);
    }
}
