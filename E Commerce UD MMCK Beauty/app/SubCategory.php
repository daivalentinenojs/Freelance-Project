<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\SubCategory;
use DB;

class SubCategory extends Model
{
    protected $table = 'SubKategori';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama','Keterangan', 'IDKategori', 'IsActive'];

    public function GetAjaxSubCategory()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'Nama',
          2 => 'Keterangan',
          3 => 'NamaKategori',
          4 => 'Status',
          5 => 'View',
          6 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT SubKategori.ID AS ID, SubKategori.ID AS View, SubKategori.ID AS Edit, SubKategori.Nama AS Nama, SubKategori.Keterangan AS Keterangan,
                                 SubKategori.IDKategori AS IDKategori, Kategori.Nama AS 'NamaKategori', SubKategori.IsActive AS 'Status'
                                 FROM SubKategori INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT SubKategori.ID AS ID, SubKategori.ID AS View, SubKategori.ID AS Edit, SubKategori.Nama AS Nama, SubKategori.Keterangan AS Keterangan,
                                 SubKategori.IDKategori AS IDKategori, Kategori.Nama AS 'NamaKategori', SubKategori.IsActive AS 'Status'
                                 FROM SubKategori INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( SubKategori.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR SubKategori.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SubKategori.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SubKategori.IDKategori LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Kategori.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SubKategori.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["Keterangan"];
          $nestedData[] = $row["NamaKategori"];
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

    public function GetSubCategory()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataSubKategori = "SELECT SubKategori.ID AS ID, SubKategori.ID AS View, SubKategori.ID AS Edit, SubKategori.Nama AS Nama, SubKategori.Keterangan AS Keterangan,
                               SubKategori.IDKategori AS IDKategori, Kategori.Nama AS 'NamaKategori', SubKategori.IsActive AS 'Status'
                               FROM SubKategori INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori";
      $HasilQueryGetDataSubKategori = mysqli_query($MySQLi, $QueryGetDataSubKategori);
      $DataSubKategori = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSubKategori)) {
        $DataSubKategori[] = $Hasil;
      }
      return $DataSubKategori;
    }

    public function GetNamaSubCategory($ID)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataSubKategori = "SELECT SubKategori.ID AS ID, SubKategori.ID AS View, SubKategori.ID AS Edit, SubKategori.Nama AS Nama, SubKategori.Keterangan AS Keterangan,
                               SubKategori.IDKategori AS IDKategori, Kategori.Nama AS 'NamaKategori', SubKategori.IsActive AS 'Status'
                               FROM SubKategori INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
                               WHERE SubKategori.ID = '$ID'";
      $HasilQueryGetDataSubKategori = mysqli_query($MySQLi, $QueryGetDataSubKategori);
      $DataSubKategori = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSubKategori)) {
        $DataSubKategori[] = $Hasil;
      }
      return $DataSubKategori;
    }

    public function GetFilterSubCategory($ID)
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
        //                          WHERE Barang.IsActive = '1' AND Barang.IDSubKategori = '$ID' AND Barang.Stok > 0";
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
                                 'Barang.Stok AS Stok', 'Barang.HargaBeli AS HargaBeli', 'Barang.HargaJual AS HargaJual',
                                 'Barang.HargaJualPromo AS HargaJualPromo', 'Barang.IDSubKategori AS IDSubKategori',
                                 'Barang.IDMerk AS IDMerk', 'Barang.IDStatusBarang AS IDStatusBarang', 'Barang.IsPromo AS Promo', 'Barang.IsActive AS Status',
                                 'SubKategori.Nama AS NamaSubKategori', 'Merk.Nama AS NamaMerk', 'StatusBarang.Nama AS StatusBarang')
                                ->where('Barang.IsActive', '=', '1')
                                ->where('Barang.IDSubKategori', '=', $ID)
                                ->where('Barang.Stok', '>', 0)
                                ->paginate(6);
        $DataBrand->setPath('');
        return $DataBrand;
    }

    public function StoreSubCategory(Request $Request)
    {
        $unique_id = uniqid();
        $SubKategori = new SubCategory(array(
            'Nama' => $Request->get('Nama'),
            'Keterangan' => $Request->get('Keterangan'),
            'IDKategori' => $Request->get('IDKategori'),
            'IsActive' => (1)
        ));
        $SubKategori->save();
    }

    public function UpdateSubCategory(Request $Request)
    {
        $IDSubKategori = $Request->get('IDSubKategori');
        DB::table('SubKategori')
            ->where('ID', $IDSubKategori)
            ->update(['Nama' => $Request->get('Nama'),
                    'Keterangan' => $Request->get('Keterangan'),
                    'IDKategori' => $Request->get('IDKategori'),
                    'IsActive' => $Request->get('Status')]);
    }
}
