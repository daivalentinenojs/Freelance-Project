<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\SalesOrderXProduct;
use DB;

class SalesOrderXProduct extends Model
{
    protected $table = 'BarangXNotaJual';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'IDBarang', 'IDNotaJual', 'Jumlah', 'HargaReal', 'SubTotal'];

    public function GetBarangXNotaJual()
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarangXNotaJual = "SELECT BarangXNotaJual.ID AS ID, BarangXNotaJual.IDBarang AS IDBarang,
        BarangXNotaJual.IDNotaJual AS IDNotaJual, BarangXNotaJual.Jumlah AS Jumlah, Barang.Nama AS NamaBarang,
        BarangXNotaJual.HargaReal AS HargaReal, BarangXNotaJual.SubTotal AS SubTotal
        FROM BarangXNotaJual INNER JOIN NotaJual ON BarangXNotaJual.IDNotaJual = NotaJual.ID
        INNER JOIN Barang ON BarangXNotaJual.IDBarang = Barang.ID";
      $HasilQueryGetDataBarangXNotaJual = mysqli_query($MySQLi, $QueryGetDataBarangXNotaJual);
      $DataBarangXNotaJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarangXNotaJual)) {
        $DataBarangXNotaJual[] = $Hasil;
      }
      return $DataBarangXNotaJual;
    }

    public function StoreNotaJualXProduct(Request $Request, $IDN)
    {
        $unique_id = uniqid();
        $IDBarang = $Request->get('IDFinal');
        $IDNotaJual = $IDN;
        $Jumlah = $Request->get('Quantity');
        $HargaReal =  $Request->get('Price');

        for ($i=0; $i < count($IDBarang); $i++) {
            $SubTotal = $Jumlah[$i] * $HargaReal[$i];
            $BarangXNotaJual = new SalesOrderXProduct(array(
                'IDBarang' => $IDBarang[$i],
                'IDNotaJual' => $IDNotaJual,
                'Jumlah' => $Jumlah[$i],
                'HargaReal' => $HargaReal[$i],
                'SubTotal' => $SubTotal
            ));
            $BarangXNotaJual->save();

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
                                     WHERE Barang.ID = '$IDBarang[$i]'";
            $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
            $DataBarang = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
              $DataBarang[] = $Hasil;
            }

            $StokSekarang = $DataBarang[0]['Stok'];
            $StokBeli = $Jumlah[$i];
            $StokBaru = $StokSekarang - $StokBeli;
            DB::table('Barang')
                ->where('ID', $IDBarang[$i])
                ->update(['Stok' => $StokBaru]);
        }
    }
}
