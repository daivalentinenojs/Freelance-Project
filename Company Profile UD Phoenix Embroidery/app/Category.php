<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Category extends Model
{
    public function GetCategory($ID) {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataCategory = "SELECT Category.ID AS 'ID', Category.Name AS 'Name',
          Category.NamaIndonesia AS 'NamaIndonesia', Category.DeskripsiIndonesia AS 'DeskripsiIndonesia',
          Category.Description AS 'Description'
          FROM Category WHERE Category.ID = '$ID'";
          $HasilQueryGetDataCategory = mysqli_query($MySQLi, $QueryGetDataCategory);
          $DataCategory = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataCategory)) {
          	$DataCategory[] = $Hasil;
          }
          return $DataCategory;
    }

    public function UpdateCategory(Request $Request)
    {
        $IDCategory = $Request->get('IDCategory');
        DB::table('Category')
            ->where('ID', $IDCategory)
            ->update(['NamaIndonesia' => $Request->get('NamaIndonesia'),
                    'Description' => $Request->get('Description'),
                    'DeskripsiIndonesia' => $Request->get('DeskripsiIndonesia')]);
    }
}
