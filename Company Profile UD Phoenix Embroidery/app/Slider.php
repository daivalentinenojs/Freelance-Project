<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Slider extends Model
{
    public function GetSlider() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataSlider = "SELECT Slider.ID AS 'ID', Slider.ID AS 'View', Slider.ID AS 'Edit', Slider.Nama AS 'Name' FROM Slider";
        $HasilQueryGetDataSlider = mysqli_query($MySQLi, $QueryGetDataSlider);
        $DataSlider = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSlider)) {
         $DataSlider[] = $Hasil;
        }
        return $DataSlider;
    }

    public function UpdateSlider(Request $Request)
    {
        $IDSlider = $Request->get('IDSlider');
        $IDFoto = $IDSlider.'.jpg';
        if($Request->hasFile('FotoSlider')) {
            $Request->FotoSlider->move(public_path('foto/slider'), $IDFoto);
        }
    }
}
