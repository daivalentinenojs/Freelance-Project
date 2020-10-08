<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Sepatu extends Model
{
    protected $table = 'Mereksepatu';
    protected $guarded = ['ID'];
    protected $fillable = ['Nama', 'idDelete'];

    public function GetBarang()
    {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          /*$QueryGetDataBarang = "SELECT DetailSepatu.ID AS 'ID', DetailSepatu.MerekSepatuID AS 'IDMerkSepatu', MerekSepatu.Nama AS 'NamaMerk',
          DetailSepatu.WarnaID AS 'IDWarna', Warna.Nama AS 'NamaWarna', DetailSepatu.SizeSepatuID AS 'IDSizeSepatu', SizeSepatu.Nama AS 'NamaSize',
          DetailSepatu.TipeID AS 'IDTipe', Tipe.Nama AS 'NamaTipe', SizeSepatu.BoxsizeID AS 'IDBoxsize', Boxsize.Nama as 'NamaBoxsize', DetailSepatu.HargaBeli AS 'Harga'
          FROM DetailSepatu INNER JOIN MerekSepatu ON DetailSepatu.MerekSepatuID = MerekSepatu.ID
          INNER JOIN Warna ON DetailSepatu.WarnaID = Warna.ID
          INNER JOIN SizeSepatu ON DetailSepatu.SizeSepatuID = SizeSepatu.ID
          INNER JOIN Tipe ON DetailSepatu.TipeID = Tipe.ID
          INNER JOIN Boxsize ON SizeSepatu.BoxsizeID = Boxsize.ID
          WHERE DetailSepatu.isDelete = 1
          Group By Boxsize.Nama, Mereksepatu.Nama, Tipe.nama, Warna.nama";*/
          $QueryGetDataBarang = "SELECT * From DetailSepatu";
          /*
          $QueryGetDataBarang = "SELECT ds.ID AS 'ID', m.Nama AS 'NamaMerk', t.Nama AS 'NamaTipe',	w.Nama AS 'NamaWarna',
          bs.Nama as 'NamaBoxsize' FROM DetailSepatu ds,  Mereksepatu m, Warna w, Tipe t, Sizesepatu sp, Boxsize bs Where ds.SizeSepatuID = sp.ID
          and sp.BoxsizeID = bs.ID and t.ID = ds.TipeID and ds.MereksepatuID = m.ID  and w.ID = ds.WarnaID and ds.isDelete = 1";
          */
          $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
          $DataBarang = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
          	$DataBarang[] = $Hasil;
          }
          return $DataBarang;
    }

    public function StoreSepatu(Request $Request)
    {
        $unique_id = uniqid();
        $Sepatu = new Sepatu(array(
            'Nama' => $Request->get('NamaSepatu'),
            'idDelete' => (1)
        ));
        $Sepatu->save();
    }

    public function UpdateSepatu(Request $Request)
    {
        $IDSepatu = $Request->get('IDSepatu');
        DB::table('Mereksepatu')
            ->where('ID', $IDSepatu)
            ->update(['Nama' => $Request->get('NamaSepatu'),
                      'idDelete' => $Request->get('isDeleteSepatu')]);
    }
}
