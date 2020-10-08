<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class StokOpname extends Model
{
    protected $primaryKey = "NoNotaStokOpname";
    protected $table = 'StokOpnames';
    protected $guarded = ['NoNotaStokOpname'];
    protected $fillable = ['NoNotaStokOpname', 'Tanggal', 'StatusTerdaftar', 'KaryawanID'];

    public function GetStokOpname()
    { 
     require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataStokOpname = "SELECT StokOpnames.NoNotaStokOpname AS NoNotaStokOpname, 
                                      StokOpnames.Tanggal AS Tanggal 
                                 FROM StokOpnames";
      $HasilQueryGetDataStokOpname = mysqli_query($MySQLi, $QueryGetDataStokOpname);
      $DataStokOpname = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataStokOpname)) {
        $DataStokOpname[] = $Hasil;
      }
      return $DataStokOpname;
    }

    public function GetStokBarang()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataStokBarang = "SELECT Barangs.Stok AS Stok, 
                                    Barangs.IDBarang AS IDBarang
                                 FROM Barangs
                                 WHERE Barangs.IDBarang = '$IDBarang'";
      $HasilQueryGetDataStokBarang = mysqli_query($MySQLi, $QueryGetDataStokBarang);
      $DataStokBarang = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataStokBarang)) {
        $DataStokBarang[] = $Hasil;
      }
      return $DataStokBarang;
    }

    public function Barangs(){
        return $this->belongsToMany(Barang::class, 'barangcatatstokopnames', 'NotaStokOpnameNo', 'BarangID')
        ->withPivot('JumlahSelisih', 'Alasan');
    }

    public function HeaderNota($NoNotaStokOpname)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataStokO = "SELECT StokOpnames.NoNotaStokOpname AS NoNotaStokOpname, 
                                   StokOpnames.Tanggal AS Tanggal, 
                                   Karyawans.Nama AS Nama, 
                                   StokOpnames.StatusTerdaftar AS StatusTerdaftar
                            FROM StokOpnames INNER JOIN Karyawans 
                              ON StokOpnames.KaryawanID = Karyawans.IDKaryawan
                            WHERE StokOpnames.NoNotaStokOpname = '$NoNotaStokOpname'";
       $HasilQueryGetDataStokO = mysqli_query($MySQLi, $QueryGetDataStokO);
       $DataStokO = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataStokO)) {
        $DataStokO[] = $Hasil;
       }
      return $DataStokO;
    }

    public function DataTable($NoNotaStokOpname)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDetailStokOpname = "SELECT BarangCatatStokOpnames.BarangID AS BarangID, 
                                          BarangCatatStokOpnames.JumlahSelisih AS JumlahSelisih, 
                                          BarangCatatStokOpnames.Alasan AS Alasan,
                                          Barangs.Nama AS Nama,
                                          Barangs.Stok AS StokDB
                                       FROM BarangCatatStokOpnames INNER JOIN Barangs 
                                          ON BarangCatatStokOpnames.BarangID = Barangs.IDBarang
                                       WHERE BarangCatatStokOpnames.NotaStokOpnameNo = '$NoNotaStokOpname'";
      $HasilQueryGetDataDetailStokOpname = mysqli_query($MySQLi, $QueryGetDataDetailStokOpname);
      $DataDetailStokOpname = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailStokOpname)) {
         $DataDetailStokOpname[] = $Hasil;
      }
      return $DataDetailStokOpname;
    }

    public function HitungBaris($NoNotaStokOpname)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBaris= "SELECT COUNT(BarangCatatStokOpnames.BarangID) AS Baris 
                            FROM BarangCatatStokOpnames
                            WHERE BarangCatatStokOpnames.NotaStokOpnameNo = '$NoNotaStokOpname'";
      $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
      $DataBaris = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
         $DataBaris[] = $Hasil;
      }
      return $DataBaris;
    }

    public function StoreStokOpname(Request $Request)
    {
        $unique_id = uniqid();
        $IDKaryawan = $Request->session()->get('ID');
        $StokOpname = new StokOpname(array(
            'Tanggal' => $Request->get('Tanggal'),
            'StatusTerdaftar' => (1),
            'KaryawanID' => $IDKaryawan
        ));
        $StokOpname->save();

        //CATAT BARANG DI BARANG CATAT STOK OPNAME
        $NoNotaStokOpname = DB::table('StokOpnames')->select('NoNotaStokOpname')->orderBy('NoNotaStokOpname', 'DESC')->first();//jika first hasilnya masih sebuah objek
        $IDBarang = $Request->get('IDBarang');

        $arrKodeBarang = json_decode($Request->get('arrKodeBarang'));
        $arrJumlahSelisih = json_decode($Request->get('arrJumlahSelisih'));
        $arrAlasan = json_decode($Request->get('arrAlasan'));
        
        for($i=0; $i < count($arrKodeBarang); $i++) {
          DB::table('BarangCatatStokOpnames')->insert([
              ['NotaStokOpnameNo' => $NoNotaStokOpname->NoNotaStokOpname,
              'BarangID' => $arrKodeBarang[$i],
              'JumlahSelisih' => $arrJumlahSelisih[$i],
              'Alasan' => $arrAlasan[$i]]
          ]);
        }
        
        //STOK DI BARANG BERKURANG / BERTAMBAH
        $stokOpname = StokOpname::where("NoNotaStokOpname", "=", $NoNotaStokOpname->NoNotaStokOpname)->first();  
        foreach($stokOpname->Barangs AS $Barang){
          $StokLama = $Barang->Stok;
          $Barang->Stok = $StokLama + $Barang->pivot->JumlahSelisih;
          $Barang->save();
        }
    }

    public function UpdateStokOpname(Request $Request)
    {
        $NoNotaStokOpname = $Request->get('NoNotaStokOpname');

        DB::table('StokOpnames')
            ->where('NoNotaStokOpname', $NoNotaStokOpname)
            ->update(['StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
    }
}