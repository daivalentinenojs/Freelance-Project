<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class NotaBeli extends Model
{
    protected $primaryKey = "NoNotaBeli";
    protected $table = 'NotaBelis';
    protected $guarded = ['NoNotaBeli'];
    protected $fillable = ['NoNotaBeli', 'TanggalBuat', 'JatuhTempo', 'Total',
    'StatusBeli', 'StatusTerdaftar', 'KaryawanID', 'PemasokID'];

    public function GetNotaBeli()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaBeli = "SELECT NotaBelis.NoNotaBeli AS NoNotaBeli,
                                    Barangs.IDBarang AS ID,
                                    Barangs.Nama AS Nama
                               FROM NotaBelis 
                                INNER JOIN BarangCatatNotaBelis ON NotaBelis.NoNotaBeli = BarangCatatNotaBelis.NotaBeliNo 
                                INNER JOIN Barangs ON BarangCatatNotaBelis.BarangID = Barangs.IDBarang";
      $HasilQueryGetDataNotaBeli = mysqli_query($MySQLi, $QueryGetDataNotaBeli);
      $DataNotaBeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaBeli)) {
        $DataNotaBeli[] = $Hasil;
      }
      return $DataNotaBeli;
    }

    public function Barangs(){
        return $this->belongsToMany(Barang::class, 'barangcatatnotabelis', 'NotaBeliNo', 'BarangID')
        ->withPivot('Kuantiti', 'HargaBeli', 'SubTotal');
    }

    public function HeaderNota($NoNotaBeli)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataNotaB = "SELECT NotaBelis.TanggalBuat AS TanggalBuat, 
                                  NotaBelis.NoNotaBeli AS NoNotaBeli, 
                                  NotaBelis.JatuhTempo AS JatuhTempo,
                                  NotaBelis.Total AS Total, 
                                  NotaBelis.StatusBeli AS StatusBeli, 
                                  NotaBelis.StatusTerdaftar AS StatusTerdaftar, 
                                  Karyawans.Nama AS NamaKaryawan, 
                                  Pemasoks.NamaRekening AS NamaPemasok
                               FROM Karyawans 
                                  INNER JOIN NotaBelis ON Karyawans.IDKaryawan = NotaBelis.KaryawanID 
                                  INNER JOIN Pemasoks ON NotaBelis.PemasokID = Pemasoks.IDPemasok
                               WHERE NotaBelis.NoNotaBeli = '$NoNotaBeli'";
      $HasilQueryGetDataNotaB = mysqli_query($MySQLi, $QueryGetDataNotaB);
      $DataNotaB = array();

      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaB)) {
        $DataNotaB[] = $Hasil;
      }
      return $DataNotaB;
    }

    public function DataTable($NoNotaBeli)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataDetailNotaBeli = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatNotaBelis.BarangID AS BarangID,
                                          BarangCatatNotaBelis.Kuantiti AS Kuantiti, 
                                          BarangCatatNotaBelis.HargaBeli AS HargaBeli,
                                          BarangCatatNotaBelis.SubTotal AS SubTotal
                                      FROM BarangCatatNotaBelis INNER JOIN Barangs 
                                          ON BarangCatatNotaBelis.BarangID = Barangs.IDBarang
                                      WHERE BarangCatatNotaBelis.NotaBeliNo = '$NoNotaBeli'";
      $HasilQueryGetDataDetailNotaBeli = mysqli_query($MySQLi, $QueryGetDataDetailNotaBeli);
      $DataDetailNotaBeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailNotaBeli)) {
        $DataDetailNotaBeli[] = $Hasil;
      }
      return $DataDetailNotaBeli;
    }

    public function HitungBaris($NoNotaBeli)
    {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBaris= "SELECT COUNT(BarangCatatNotaBelis.BarangID) AS Baris 
                            FROM BarangCatatNotaBelis
                            WHERE BarangCatatNotaBelis.NotaBeliNo = '$NoNotaBeli'";
      $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
      $DataBaris = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
        $DataBaris[] = $Hasil;
      }
      return $DataBaris;
    }

    public function StoreNotaBeli(Request $Request)
    {
        $unique_id = uniqid();
        $IDKaryawan = $Request->session()->get('ID');
        $NotaBeli = new NotaBeli(array(
            'TanggalBuat' => $Request->get('TanggalBuat'),
            'JatuhTempo' => $Request->get('JatuhTempo'),
            'Total' => $Request->get('TotalAkhir'),
            'StatusBeli' => ('Pesan'),
            'StatusTerdaftar' => (1),
            'KaryawanID' => $IDKaryawan,
            'PemasokID' => $Request->get('IDPemasok')
        ));
        $NotaBeli->save();
        
        //CATAT BARANG DI BARANG CATAT NOTA BELI
        $NoNotaBeli = DB::table('NotaBelis')->select('NoNotaBeli')->orderBy('NoNotaBeli', 'DESC')->first();

        $arrKodeBarang = json_decode($Request->get('arrKodeBarang'));
        $arrQty = json_decode($Request->get('arrQty'));
        $arrHargaBeli = json_decode($Request->get('arrHargaBeli'));
        $arrSubTotal = json_decode($Request->get('arrSubTotal'));

        for($i=0; $i < count($arrKodeBarang); $i++) {
          DB::table('BarangCatatNotaBelis')->insert([
              ['NotaBeliNo' => $NoNotaBeli->NoNotaBeli,
              'BarangID' => $arrKodeBarang[$i],
              'Kuantiti' => $arrQty[$i],
              'HargaBeli' => $arrHargaBeli[$i],
              'SubTotal' => $arrSubTotal[$i]]
          ]);
        }
    }

    public function UpdateNotaBeli(Request $Request)
    {
        $NoNotaBeli = $Request->get('NoNotaBeli');
        DB::table('NotaBelis')
            ->where('NoNotaBeli', $NoNotaBeli)
            ->update(['StatusBeli' => $Request->get('StatusBeli'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
        //$notaBeli->StatusBeli = $Request->get('StatusBeli');
        
        //STOK DI BARANG BERTAMBAH
        /*$StatusBeli = DB::table('NotaBelis')
                          ->select('StatusBeli')
                          ->where('IDNotaBeli', $IDNotaBeli);*/
        
        //STOK DI BARANG BERTAMBAH
        $notaBeli = NotaBeli::where("NoNotaBeli", "=", $NoNotaBeli)->first();
        $StatusBeli = $notaBeli->StatusBeli;    
                         
        if($StatusBeli == "Dikirim"){
          //dd($notaBeli->Barangs);
          foreach($notaBeli->Barangs AS $Barang){
            //$Kode = $Barang->IDBarang;
            //MENGHITUNG HPP
            $Barang->HPP = ($Barang->HPP * $Barang->Stok + $Barang->pivot->Kuantiti * $Barang->pivot->HargaBeli) / ($Barang->Stok + $Barang->pivot->Kuantiti);
            $QtyYangDipesan = $Barang->pivot->Kuantiti; 
            $StokLama = $Barang->Stok;
            $Barang->Stok = $StokLama + $QtyYangDipesan;
            $Barang->save();
          }
        }
    }
}
