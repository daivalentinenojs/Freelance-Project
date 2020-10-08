<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class NotaJual extends Model
{
    protected $primaryKey = "NoNotaJual";
    protected $table = 'NotaJuals';
    protected $guarded = ['NoNotaJual'];
    protected $fillable = ['NoNotaJual', 'TanggalBuat', 'TanggalBayar', 'Total', 'StatusJual', 
    'StatusTerdaftar', 'KaryawanID', 'PembeliID'];

    public function GetNotaJual()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaJual = "SELECT NotaJuals.NoNotaJual AS NoNotaJual,
                                    BarangCatatNotaJuals.BarangID AS ID,
                                    Barangs.Nama AS Nama
                               FROM NotaJuals 
                                INNER JOIN BarangCatatNotaJuals ON NotaJuals.NoNotaJual = BarangCatatNotaJuals.NotaJualNo
                                INNER JOIN Barangs ON BarangCatatNotaJuals.BarangID = Barangs.IDBarang";
      $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
      $DataNotaJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
        $DataNotaJual[] = $Hasil;
      }
      return $DataNotaJual;
    }

    public function Barangs(){
        return $this->belongsToMany(Barang::class, 'barangcatatnotajuals', 'NotaJualNo', 'BarangID')
        ->withPivot('Kuantiti', 'HargaJual', 'SubTotal');
    }

    public function HeaderNota($NoNotaJual)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaJ = "SELECT NotaJuals.NoNotaJual AS NoNotaJual, 
                                  NotaJuals.TanggalBuat AS TanggalBuat, 
                                  NotaJuals.TanggalBayar AS TanggalBayar, 
                                  NotaJuals.Total AS TotalAkhir, 
                                  NotaJuals.StatusJual AS StatusJual, 
                                  NotaJuals.StatusTerdaftar AS StatusTerdaftar, 
                                  Karyawans.Nama AS NamaKaryawan, 
                                  Pembelis.Nama AS NamaPembeli, 
                                  Pembelis.Kota AS Kota, 
                                  Pembelis.Bank AS Bank,
                                  Pembelis.StatusLangganan AS StatusLangganan
                               FROM Karyawans 
                                  INNER JOIN NotaJuals ON Karyawans.IDKaryawan = NotaJuals.KaryawanID 
                                  INNER JOIN Pembelis ON NotaJuals.PembeliID = Pembelis.IDPembeli
                               WHERE NotaJuals.NoNotaJual = '$NoNotaJual'";
      $HasilQueryGetDataNotaJ = mysqli_query($MySQLi, $QueryGetDataNotaJ);
      $DataNotaJ = array();

      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJ)) {
        $DataNotaJ[] = $Hasil;
      }
      return $DataNotaJ;
    }

    public function DataTable($NoNotaJual)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDetailNotaJual = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatNotaJuals.BarangID AS BarangID,
                                          BarangCatatNotaJuals.Kuantiti AS Kuantiti, 
                                          BarangCatatNotaJuals.HargaJual AS HargaJual,
                                          BarangCatatNotaJuals.SubTotal AS SubTotal
                                      FROM BarangCatatNotaJuals INNER JOIN Barangs 
                                          ON BarangCatatNotaJuals.BarangID = Barangs.IDBarang
                                      WHERE BarangCatatNotaJuals.NotaJualNo = '$NoNotaJual'";
      $HasilQueryGetDataDetailNotaJual = mysqli_query($MySQLi, $QueryGetDataDetailNotaJual);
      $DataDetailNotaJual = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailNotaJual)) {
         $DataDetailNotaJual[] = $Hasil;
      }
      return $DataDetailNotaJual;
    }

    public function HitungBaris($NoNotaJual)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBaris= "SELECT COUNT(BarangCatatNotaJuals.BarangID) AS Baris
                            FROM BarangCatatNotaJuals 
                            WHERE BarangCatatNotaJuals.NotaJualNo = '$NoNotaJual'";
      $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
      $DataBaris = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
         $DataBaris[] = $Hasil;
      }
      return $DataBaris;
    }

    public function StoreNotaJual(Request $Request)
    {
        $unique_id = uniqid();
        $IDKaryawan = $Request->session()->get('ID');
        $NotaJual = new NotaJual(array(
            'TanggalBuat' => $Request->get('TanggalBuat'),
            'TanggalBayar' => $Request->get('TanggalBayar'),
            'Total' => $Request->get('TotalAkhir'),
            'StatusJual' => ('Belum Lunas'),
            'StatusTerdaftar' => (1),
            'KaryawanID' => $IDKaryawan,
            'PembeliID' => $Request->get('IDPembeli')
        ));
        $NotaJual->save();

        //CATAT BARANG DI BARANG CATAT NOTA JUAL
        $NoNotaJual = DB::table('NotaJuals')->select('NoNotaJual')->orderBy('NoNotaJual', 'DESC')->first();

        $arrKodeBarang = json_decode($Request->get('arrKodeBarang'));
        $arrQty = json_decode($Request->get('arrQty'));
        $arrHargaJual = json_decode($Request->get('arrHargaJual'));
        $arrSubTotal = json_decode($Request->get('arrSubTotal'));

        for($i=0; $i < count($arrKodeBarang); $i++) {
          DB::table('BarangCatatNotaJuals')->insert([
              ['NotaJualNo' => $NoNotaJual->NoNotaJual,
              'BarangID' => $arrKodeBarang[$i],
              'Kuantiti' => $arrQty[$i],
              'HargaJual' => $arrHargaJual[$i],
              'SubTotal' => $arrSubTotal[$i]]
          ]);
        }
    }

    public function UpdateNotaJual(Request $Request)
    {
        $NoNotaJual = $Request->get('NoNotaJual');
        DB::table('NotaJuals')
            ->where('NoNotaJual', $NoNotaJual)
            ->update(['StatusJual' => $Request->get('StatusJual'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);

        //STOK DI BARANG BERKURANG
        $notaJual = NotaJual::where("NoNotaJual", "=", $NoNotaJual)->first();
        $StatusJual = $notaJual->StatusJual;    
                         
        if($StatusJual == "Sudah Lunas"){
          //dd($notaBeli->Barangs);
          foreach($notaJual->Barangs AS $Barang){
            //$Kode = $Barang->IDBarang;
            $QtyYangDibeli = $Barang->pivot->Kuantiti; 
            $StokLama = $Barang->Stok;
            $Barang->Stok = $StokLama - $QtyYangDibeli;
            $Barang->save();
          }
        }   
    }
}
