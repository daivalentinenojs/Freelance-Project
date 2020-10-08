<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Product extends Model
{
    protected $table = 'Product';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Name', 'IsActive', 'Description', 'ProductFormat', 'NamaIndonesia', 'Urutan', 'DeskripsiIndonesia'];

    public function GetFashion() {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataFashion = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
      				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName', Product.Description AS 'Description',
                    Product.ProductFormat AS 'ProductFormat',
                    Product.NamaIndonesia AS 'NamaIndonesia', Product.DeskripsiIndonesia AS 'DeskripsiIndonesia',
      				ProductXCategory.IDProductXCategory AS 'View', ProductXCategory.IDProductXCategory AS 'Edit'
      				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
      				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID
                    WHERE ProductXCategory.IDCategory = 1 AND Product.IsActive = 1 AND ProductXCategory.IsActive = 1
                    ORDER BY Product.Urutan ASC";
          $HasilQueryGetDataFashion = mysqli_query($MySQLi, $QueryGetDataFashion);
          $DataFashion = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFashion)) {
          	$DataFashion[] = $Hasil;
          }
          return $DataFashion;
    }

    public function GetHomeDecoration() {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataHomeDecoration = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
      				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName', Product.Description AS 'Description',
                    Product.ProductFormat AS 'ProductFormat',
                    Product.NamaIndonesia AS 'NamaIndonesia', Product.DeskripsiIndonesia AS 'DeskripsiIndonesia',
      				ProductXCategory.IDProductXCategory AS 'View', ProductXCategory.IDProductXCategory AS 'Edit'
      				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
      				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID
                    WHERE ProductXCategory.IDCategory = 2 AND Product.IsActive = 1 AND ProductXCategory.IsActive = 1
                    ORDER BY Product.Urutan ASC";
          $HasilQueryGetDataHomeDecoration = mysqli_query($MySQLi, $QueryGetDataHomeDecoration);
          $DataHomeDecoration = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataHomeDecoration)) {
          	$DataHomeDecoration[] = $Hasil;
          }
          return $DataHomeDecoration;
    }

    public function GetEmbroidery() {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataEmbroidery = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
      				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName', Product.Description AS 'Description',
                    Product.ProductFormat AS 'ProductFormat',
                    Product.NamaIndonesia AS 'NamaIndonesia', Product.DeskripsiIndonesia AS 'DeskripsiIndonesia',
      				ProductXCategory.IDProductXCategory AS 'View', ProductXCategory.IDProductXCategory AS 'Edit'
      				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
      				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID
                    WHERE ProductXCategory.IDCategory = 3 AND Product.IsActive = 1 AND ProductXCategory.IsActive = 1
                    ORDER BY Product.Urutan ASC";
          $HasilQueryGetDataEmbroidery = mysqli_query($MySQLi, $QueryGetDataEmbroidery);
          $DataEmbroidery = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataEmbroidery)) {
          	$DataEmbroidery[] = $Hasil;
          }
          return $DataEmbroidery;
    }

    public function GetSouvenir() {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataEmbroidery = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
      				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName', Product.Description AS 'Description',
                    Product.ProductFormat AS 'ProductFormat',
                    Product.NamaIndonesia AS 'NamaIndonesia', Product.DeskripsiIndonesia AS 'DeskripsiIndonesia',
      				ProductXCategory.IDProductXCategory AS 'View', ProductXCategory.IDProductXCategory AS 'Edit'
      				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
      				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID
                    WHERE ProductXCategory.IDCategory = 4 AND Product.IsActive = 1 AND ProductXCategory.IsActive = 1
                    ORDER BY Product.Urutan ASC";
          $HasilQueryGetDataEmbroidery = mysqli_query($MySQLi, $QueryGetDataEmbroidery);
          $DataEmbroidery = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataEmbroidery)) {
          	$DataEmbroidery[] = $Hasil;
          }
          return $DataEmbroidery;
    }

    public function StoreProduct(Request $Request)
    {
        $unique_id = uniqid();
        $Product = new Product(array(
            'Name' => $Request->get('ProductName'),
            'Description' => $Request->get('Description'),
            'ProductFormat' => $Request->get('ProductFormat'),
            'NamaIndonesia' => $Request->get('NamaIndonesia'),
            'DeskripsiIndonesia' => $Request->get('DeskripsiIndonesia'),
            'Urutan' => $Request->get('Urutan'),
            'IsActive' => (1)
        ));
        $Product->save();
        $ID = DB::table('Product')->max('ID');
        if ($Request->get('ProductFormat') == 0) {
            $IDFoto = $ID.'.jpg';
        } else {
            $IDFoto = $ID.'.mp4';
        }
        $Request->FotoProduct->move(public_path('foto/product'), $IDFoto);
        return $ID;
    }

    public function UpdateProduct(Request $Request)
    {
        $IDProduct = $Request->get('IDProduct');
        DB::table('ProductXCategory')->where('IDProduct', '=', $IDProduct)->delete();
        DB::table('Product')->where('ID', '=', $IDProduct)->delete();
        $Product = new Product(array(
            'Name' => $Request->get('ProductName'),
            'Description' => $Request->get('Description'),
            'NamaIndonesia' => $Request->get('NamaIndonesia'),
            'DeskripsiIndonesia' => $Request->get('DeskripsiIndonesia'),
            'ProductFormat' => $Request->get('ProductFormat'),
            'Urutan' => $Request->get('Urutan'),
            'IsActive' => (1)
        ));
        $Product->save();
        $ID = DB::table('Product')->max('ID');
        if ($Request->get('ProductFormat') == 0) {
            $IDFoto = $ID.'.jpg';
        } else {
            $IDFoto = $ID.'.mp4';
        }
        $Request->FotoProduct->move(public_path('foto/product'), $IDFoto);
        return $ID;
    }
}
