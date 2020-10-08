<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Pembayaran;
use DB;

class Pembayaran extends Model
{
    protected $table = 'Pembayaran';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Tanggal', 'NamaBank', 'NamaPemegangKartu', 'NomorKartu', 'IDFormulirPermohonan', 'IsActive'];

    public function StorePembayaran(Request $Request)
    {
        $unique_id = uniqid();
        $Pembayaran = new Pembayaran(array(
            'Tanggal' => $Request->get('Tanggal'),
            'NamaBank' => $Request->get('NamaBank'),
            'NamaPemegangKartu' => $Request->get('NamaPemegangKartu'),
            'NomorKartu' => $Request->get('NomorKartu'),
            'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),
            'IsActive' => (1)
        ));
        $Pembayaran->save();
        $ID = DB::table('Pembayaran')->max('ID');
        if($Request->hasFile('FileBuktiPembayaran')) {
            $IDFoto = $ID.'.jpg';
            $Request->FileBuktiPembayaran->move(public_path('foto/BuktiPembayaran'), $IDFoto);
        }
    }

    public function RevisiPembayaran(Request $Request) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('Pembayaran')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['Tanggal' => $Request->get('Tanggal'),
                      'NamaBank' => $Request->get('NamaBank'),
                      'NamaPemegangKartu' => $Request->get('NamaPemegangKartu'),
                      'NomorKartu' => $Request->get('NomorKartu')]);
    }

    public function GetPembayaran($IDFormulirPermohonan) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataPembayaran = "SELECT Pembayaran.ID AS 'ID', Pembayaran.ID AS 'View', Pembayaran.Tanggal AS 'Tanggal',
                  Pembayaran.NamaBank AS 'NamaBank', Pembayaran.NamaPemegangKartu AS 'NamaPemegangKartu',
                  Pembayaran.NomorKartu AS 'NomorKartu', Pembayaran.IDFormulirPermohonan AS 'IDFormulirPermohonan'
                  FROM Pembayaran WHERE Pembayaran.IDFormulirPermohonan = '$IDFormulirPermohonan'";
        $HasilQueryGetDataPembayaran = mysqli_query($MySQLi, $QueryGetDataPembayaran);
        $DataPembayaran = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembayaran)) {
        $DataPembayaran[] = $Hasil;
        }
        return $DataPembayaran;
    }
}
