<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Description extends Model
{
    public function GetDescription() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataDescription = "SELECT CompanyDescription.ID AS 'ID',
        CompanyDescription.Description AS 'Content',
        CompanyDescription.DeskripsiIndonesia AS 'ContentIndonesia',
        CompanyDescription.Home AS 'Home',
        CompanyDescription.HomeIndonesia AS 'HomeIndonesia',
        CompanyDescription.CompanyName AS 'CompanyName',
        CompanyDescription.Address AS 'Address',
        CompanyDescription.City AS 'City',
        CompanyDescription.Phone AS 'Phone',
        CompanyDescription.Email AS 'Email'
        FROM CompanyDescription WHERE CompanyDescription.IsActive = 1";
        $HasilQueryGetDataDescription = mysqli_query($MySQLi, $QueryGetDataDescription);
        $DataDescription = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDescription)) {
         $DataDescription[] = $Hasil;
        }
        return $DataDescription;
    }

    public function UpdateDescription(Request $Request)
    {
        $IDDescription = $Request->get('IDDescription');
        $Email = $Request->get('Email');
        $Domain = $Request->get('Domain');
        $EmailLengkap = $Email.$Domain;
        DB::table('CompanyDescription')
            ->where('ID', $IDDescription)
            ->update(['Description' => $Request->get('CompanyDescription'),
                        'DeskripsiIndonesia' => $Request->get('CompanyDescriptionIndonesia'),
                        'Home' => $Request->get('HomeDescription'),
                        'HomeIndonesia' => $Request->get('HomeDescriptionIndonesia'),
                        'CompanyName' => $Request->get('CompanyName'),
                        'Address' => $Request->get('Address'),
                        'City' => $Request->get('City'),
                        'Phone' => $Request->get('Phone'),
                        'Email' => $EmailLengkap]);
        $IDFoto = 'map.jpg';
        $IDLogo = 'logo.jpg';
        if($Request->hasFile('FotoPeta')) {
            $Request->FotoPeta->move(public_path('foto/map'), $IDFoto);
        }
        if($Request->hasFile('FotoLogo')) {
            $Request->FotoLogo->move(public_path('foto/logo'), $IDLogo);
        }
    }
}
