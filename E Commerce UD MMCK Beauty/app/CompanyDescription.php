<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class CompanyDescription extends Model
{
    public function GetCompanyDescription() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataDeskripsi = "SELECT DeskripsiPerusahaan.ID AS 'ID',
        DeskripsiPerusahaan.Nama AS 'Nama',
        DeskripsiPerusahaan.Keterangan AS 'Keterangan',
        DeskripsiPerusahaan.Alamat AS 'Alamat',
        DeskripsiPerusahaan.Kota AS 'Kota',
        DeskripsiPerusahaan.Negara AS 'Negara',
        DeskripsiPerusahaan.Telepon AS 'Telepon',
        DeskripsiPerusahaan.Handphone AS 'Handphone',
        DeskripsiPerusahaan.Email AS 'Email',
        DeskripsiPerusahaan.BatasStock AS 'BatasStock'
        FROM DeskripsiPerusahaan WHERE DeskripsiPerusahaan.IsActive = 1 AND DeskripsiPerusahaan.ID = '1'";
        $HasilQueryGetDataDeskripsi = mysqli_query($MySQLi, $QueryGetDataDeskripsi);
        $DataDeskripsi = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDeskripsi)) {
            $DataDeskripsi[] = $Hasil;
        }
        return $DataDeskripsi;
    }

    public function UpdateCompanyDescription(Request $Request)
    {
        $IDHome = 1;
        DB::table('DeskripsiPerusahaan')
            ->where('ID', $IDHome)
            ->update(['Nama' => $Request->get('Nama'),
                    'Keterangan' => $Request->get('Deskripsi'),
                    'Alamat' => $Request->get('Alamat'),
                    'Kota' => $Request->get('Kota'),
                    'Negara' => $Request->get('Negara'),
                    'Telepon' => $Request->get('Telepon'),
                    'Handphone' => $Request->get('Handphone'),
                    'Email' => $Request->get('Email'),
                    'BatasStock' => $Request->get('BatasStock'),
                    'IsActive' => 1]);

        $IDLogo = 'Logo.jpg';
        if($Request->hasFile('FotoLogo')) {
            $Request->FotoLogo->move(public_path('foto/logo'), $IDLogo);
        }
    }
}
