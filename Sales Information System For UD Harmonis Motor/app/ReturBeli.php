<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class ReturBeli extends Model
{
    protected $primaryKey = "IDReturBeli";
    protected $table = 'ReturBelis';
    protected $guarded = ['IDReturBeli'];
    protected $fillable = ['IDReturBeli', 'Tanggal', 'StatusTerdaftar', 'KaryawanID', 'NotaBeliNo'];

    public function GetReturBeli()
    { 
     require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataReturBeli = "SELECT ReturBelis.Tanggal AS Tanggal, 
                                    ReturBelis.NoNotaBeli AS NoNotaBeli 
                                FROM ReturBelis";
      $HasilQueryGetDataReturBeli = mysqli_query($MySQLi, $QueryGetDataReturBeli);
      $DataReturBeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataReturBeli)) {
        $DataReturBeli[] = $Hasil;
      }
      return $DataReturBeli;
    }

    public function Barangs(){
        return $this->belongsToMany(Barang::class, 'barangcatatreturbelis', 'ReturBeliID', 'BarangID')
        ->withPivot('KuantitiBarangAsal', 'KuantitiBarangGanti');
    }

    public function HeaderNota($IDReturBeli)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataReturB = "SELECT ReturBelis.IDReturBeli AS IDReturBeli, 
                                  ReturBelis.Tanggal AS Tanggal, 
                                  Karyawans.Nama AS NamaKaryawan, 
                                  ReturBelis.StatusTerdaftar AS StatusTerdaftar
                             FROM ReturBelis 
                                  INNER JOIN Karyawans ON ReturBelis.KaryawanID = Karyawans.IDKaryawan
                             WHERE ReturBelis.IDReturBeli = '$IDReturBeli'";
      $HasilQueryGetDataReturB = mysqli_query($MySQLi, $QueryGetDataReturB);
      $DataReturB = array();

      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataReturB)) {
        $DataReturB[] = $Hasil;
      }
      return $DataReturB;
    }

    public function DataTable($IDReturBeli)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDetailReturBeli = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatReturBelis.BarangID AS BarangID,
                                          BarangCatatReturBelis.KuantitiBarangAsal AS KuantitiBarangAsal, 
                                          BarangCatatReturBelis.KuantitiBarangGanti AS KuantitiBarangGanti
                                      FROM ReturBelis INNER JOIN BarangCatatReturBelis 
                                          ON ReturBelis.IDReturBeli = BarangCatatReturBelis.ReturBeliID
                                          INNER JOIN Barangs ON BarangCatatReturBelis.BarangID = Barangs.IDBarang
                                      WHERE BarangCatatReturBelis.ReturBeliID = '$IDReturBeli'";
      $HasilQueryGetDataDetailReturBeli = mysqli_query($MySQLi, $QueryGetDataDetailReturBeli);
      $DataDetailReturBeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailReturBeli)) {
         $DataDetailReturBeli[] = $Hasil;
      }
      return $DataDetailReturBeli;
    }

    public function HitungBaris($IDReturBeli)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBaris= "SELECT COUNT(BarangCatatReturBelis.BarangID) AS Baris 
                           FROM BarangCatatReturBelis
                           WHERE BarangCatatReturBelis.ReturBeliID = '$IDReturBeli'";
      $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
      $DataBaris = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
         $DataBaris[] = $Hasil;
      }
      return $DataBaris;
    }

    public function StoreReturBeli(Request $Request)
    {
        $unique_id = uniqid();
        $IDKaryawan = $Request->session()->get('ID');
        $splittedNoNotaBeli = explode("-", $Request->get('NoNotaBeli'));
        $NoNotaBeli = $splittedNoNotaBeli[0];
        $ReturBeli = new ReturBeli(array(
            'Tanggal' => $Request->get('TanggalBuat'),
            'StatusTerdaftar' => (1),
            'KaryawanID' => $IDKaryawan,
            'NotaBeliNo' => $NoNotaBeli
        ));
        $ReturBeli->save();

        //CATAT BARANG DI BARANG CATAT RETUR BELI
        $IDReturBeli = DB::table('ReturBelis')->select('IDReturBeli')->orderBy('IDReturBeli', 'DESC')
        ->first();

        $arrKodeBarang = json_decode($Request->get('arrKodeBarang'));
        $arrQtyBarang = json_decode($Request->get('arrQtyBarang'));
        
        for($i=0; $i < count($arrKodeBarang); $i++) {
          DB::table('BarangCatatReturBelis')->insert([
              ['ReturBeliID' => $IDReturBeli->IDReturBeli,
              'BarangID' => $arrKodeBarang[$i],
              'KuantitiBarangAsal' => $arrQtyBarang[$i],
              'KuantitiBarangGanti' => $arrQtyBarang[$i]]
          ]);
        }

        //STOK DI BARANG BERTAMBAH
        $returBeli = ReturBeli::where("IDReturBeli", "=", $IDReturBeli->IDReturBeli)->first(); 
        foreach($returBeli->Barangs AS $Barang){
          $StokLama = $Barang->Stok;
          $Barang->Stok = $StokLama + $Barang->pivot->KuantitiBarangGanti;
          $Barang->save();
        }
    }

    public function UpdateReturBeli(Request $Request)
    {
        $IDReturBeli = $Request->get('IDReturBeli');

        DB::table('ReturBelis')
            ->where('IDReturBeli', $IDReturBeli)
            ->update(['StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
    }
}
