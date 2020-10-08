<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class ReturJual extends Model
{
    protected $primaryKey = "IDReturJual";
    protected $table = 'ReturJuals';
    protected $guarded = ['IDReturJual'];
    protected $fillable = ['IDReturJual', 'Tanggal', 'StatusTerdaftar', 'KaryawanID', 'NotaJualNo'];

    public function GetReturJual()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataReturJual = "SELECT ReturJuals.Tanggal AS Tanggal, 
                                    ReturJuals.NoNotaJual AS NoNotaJual 
                                FROM ReturJuals";
      $HasilQueryGetDataReturJual = mysqli_query($MySQLi, $QueryGetDataReturJual);
      $DataReturJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataReturJual)) {
        $DataReturJual[] = $Hasil;
      }
      return $DataReturJual;
    }

    public function Barangs(){
        return $this->belongsToMany(Barang::class, 'barangcatatreturjuals', 'ReturJualID', 'BarangID')
        ->withPivot('KuantitiBarangAsal', 'KuantitiBarangGanti');
    }

    public function HeaderNota($IDReturJual)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataReturJ = "SELECT ReturJuals.IDReturJual AS IDReturJual,
                                  ReturJuals.Tanggal AS Tanggal,
                                  Karyawans.Nama AS NamaKaryawan, 
                                  ReturJuals.StatusTerdaftar AS StatusTerdaftar
                             FROM ReturJuals 
                                  INNER JOIN Karyawans ON ReturJuals.KaryawanID = Karyawans.IDKaryawan
                             WHERE ReturJuals.IDReturJual = '$IDReturJual'";
       $HasilQueryGetDataReturJ = mysqli_query($MySQLi, $QueryGetDataReturJ);
       $DataReturJual = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataReturJ)) {
        $DataReturJ[] = $Hasil;
       }
      return $DataReturJ;
    }

    public function DataTable($IDReturJual)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDetailReturJual = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatReturJuals.BarangID AS BarangID,
                                          BarangCatatReturJuals.KuantitiBarangAsal AS KuantitiBarangAsal, 
                                          BarangCatatReturJuals.KuantitiBarangGanti AS KuantitiBarangGanti
                                      FROM ReturJuals INNER JOIN BarangCatatReturJuals 
                                          ON ReturJuals.IDReturJual = BarangCatatReturJuals.ReturJualID
                                          INNER JOIN Barangs ON BarangCatatReturJuals.BarangID = Barangs.IDBarang
                                      WHERE BarangCatatReturJuals.ReturJualID = '$IDReturJual'";
      $HasilQueryGetDataDetailReturJual = mysqli_query($MySQLi, $QueryGetDataDetailReturJual);
      $DataDetailReturJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailReturJual)) {
         $DataDetailReturJual[] = $Hasil;
      }
      return $DataDetailReturJual;
    }

    public function HitungBaris($IDReturJual)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBaris= "SELECT COUNT(BarangCatatReturJuals.BarangID) AS Baris 
                           FROM BarangCatatReturJuals
                           WHERE BarangCatatReturJuals.ReturJualID = '$IDReturJual'";
      $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
      $DataBaris = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
         $DataBaris[] = $Hasil;
      }
      return $DataBaris;
    }

    public function StoreReturJual(Request $Request)
    {
        $unique_id = uniqid();
        $IDKaryawan = $Request->session()->get('ID');
        $splittedNoNotaJual = explode("-", $Request->get('NoNotaJual'));
        $NoNotaJual = $splittedNoNotaJual[0];
        $ReturJual = new ReturJual(array(
            'Tanggal' => $Request->get('TanggalBuat'),
            'StatusTerdaftar' => (1),
            'KaryawanID' => $IDKaryawan,
            'NotaJualNo' => $NoNotaJual
        ));
        $ReturJual->save();

        //CATAT BARANG DI BARANG CATAT RETUR JUAL
        $IDReturJual = DB::table('ReturJuals')->select('IDReturJual')->orderBy('IDReturJual', 'DESC')->first();

        $arrKodeBarang = json_decode($Request->get('arrKodeBarang'));
        $arrQtyBarang = json_decode($Request->get('arrQtyBarang'));

        for($i=0; $i < count($arrKodeBarang); $i++) {
          DB::table('BarangCatatReturJuals')->insert([
              ['ReturJualID' => $IDReturJual->IDReturJual,
              'BarangID' => $arrKodeBarang[$i],
              'KuantitiBarangAsal' => $arrQtyBarang[$i],
              'KuantitiBarangGanti' => $arrQtyBarang[$i]]
          ]);
        }

        //STOK DI BARANG BERKURANG, BARANG YANG LAMA JADI KERUGIAN TOKO
        $returJual = ReturJual::where("IDReturJual", "=", $IDReturJual->IDReturJual)->first();  
        //dd($notaBeli->Barangs);
        foreach($returJual->Barangs AS $Barang){
          $StokLama = $Barang->Stok;
          $Barang->Stok = $StokLama - $Barang->pivot->KuantitiBarangGanti;
          $Barang->save();
        }
    }

    public function UpdateReturJual(Request $Request)
    {
        $IDReturJual = $Request->get('IDReturJual');

        DB::table('ReturJuals')
            ->where('IDReturJual', $IDReturJual)
            ->update(['StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
    }
}
