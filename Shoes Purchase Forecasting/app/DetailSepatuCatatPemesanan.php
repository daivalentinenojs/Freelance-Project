<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DetailSepatuCatatPemesanan extends Model
{
  protected $table = 'DetailSepatuCatatPemesanan';
  //protected $guarded = ['ID', 'SepatuID', 'PemesananID'];
  protected $fillable = ['DetailSepatuID', 'PemesananID', 'Jumlah'];

  // public function StoreSepatuCatatPemesanan(Request $Request)
  // {
  //     $unique_id = uniqid();
  //     $SepatuCatatPemesanan = new SepatuCatatPemesanan(array(
  //         'SepatuID' => $Request->get('IDSepatu'),
  //         'PemesananID' => $Request->get('IDPemesanan'),
  //         'Jumlah' => $Request->get('Jumlah')
  //     ));
  //     $SepatuCatatPemesanan->save();
  // }
  //
  // public function UpdateSepatuCatatPemesanan(Request $Request)
  // {
  //     $IDSepatuPesan = $Request->get('IDSepatuPesan');
  //     $IDSepatu = $Request->get('IDSepatu');
  //     $IDPemesanan = $Request->get('IDPemesanan');
  //     DB::table('SepatuCatatPemesanan')
  //         ->where('SepatuID', $IDSepatu)
  //         ->where('PemesananID', $IDPemesanan)
  //         ->update(['Jumlah' => $Request->get('Jumlah'),
  //                   'SepatuID' => $Request->get('IDSepatu'),
  //                   'PemesananID' => $Request->get('IDPemesanan')]);
  // }
}
