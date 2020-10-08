<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class BarangCatatNotaBeli extends Model
{
    protected $table = 'BarangCatatNotaBelis';
    protected $guarded = ['NotaBeliID'];
    protected $fillable = ['NotaBeliID', 'BarangID', 'Kuantiti', 'HargaBeli', 'SubTotal'];

    
    public function GetBarangCatatNotaBeli()
    { 
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataBarangCatatNotaBeli = "SELECT Barangs.Nama AS NamaBarang,
                                            Barangs.IDBarang
                                          FROM Barangs INNER JOIN BarangCatatNotaBelis 
                                            ON Barangs.IDBarang = BarangCatatNotaBelis.BarangID
                                          WHERE BarangCatatNotaBelis.NotaBeliID = '$IDNotaBeli'";
      $HasilQueryGetDataBarangCatatNotaBeli = mysqli_query($MySQLi, $QueryGetDataBarangCatatNotaBeli);
      $DataBarangCatatNotaBeli = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarangCatatNotaBeli)) {
        $DataBarangCatatNotaBeli[] = $Hasil;
      }
      return $DataBarangCatatNotaBeli;
    }
    
    public function StoreBarangCatatNotaBeli(Request $Request)
    {
        $unique_id = uniqid();
        $BarangCatatNotaBeli = new BarangCatatNotaBeli(array(
            'NotaBeliID' => $Request->get('NotaBeliID'),
            'BarangID' => $Request->get('BarangID'),
            'Kuantiti' => $Request->get('Kuantiti'),
            'HargaBeli' => $Request->get('HargaBeli'),
            'SubTotal' => $Request->get('SubTotal'))
        ));
        $BarangCatatNotaBeli->save();
    }

    public function UpdateBarangCatatNotaBeli(Request $Request)
    {
        DB::table('BarangCatatNotaBelis')
            ->where('NotaBeliID', $NotaBeliID)
            ->where('BarangID', $BarangID)
            ->update(['Kuantiti' => $Request->get('Kuantiti'),
            		'HargaBeli' => $Request->get('HargaBeli'),
            		'SubTotal' => $Request->get('SubTotal')]);
    }
}
