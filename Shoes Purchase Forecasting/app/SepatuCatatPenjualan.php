<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class SepatuCatatPenjualan extends Model
{
  protected $table = 'SepatuCatatPenjualan';
  protected $guarded = ['ID', 'SepatuID', 'PenjualanID'];
  protected $fillable = ['SepatuID', 'PenjualanID', 'Jumlah'];

  public function StoreSepatuCatatPenjualan(Request $Request)
  {
      $unique_id = uniqid();
      $Penjualan = new Penjualan(array(
            'CustomerID' => $Request->get('IDCustomerPenjualan'),
      ));
      $Penjualan->save();
      $IDPenjualan = DB::Table('Penjualan')->max('Nomor');

      $SepatuCatatPenjualan = new SepatuCatatPenjualan(array(
          'SepatuID' => $Request->get('IDSepatu'),
          'PenjualanID' => $IDPenjualan,
          'Jumlah' => $Request->get('Jumlah')
      ));
      $SepatuCatatPenjualan->save();

      $stok = DB::Table('Sepatu')->get('stok');
      $IDSepatu = $Request->get('IDSepatu');
      $jumlah = $Request->get('Jumlah');
      $stokupdate = $stok-$jumlah;
      DB::table('Sepatu')
          ->where('SepatuID', $IDSepatu)
          ->update(['Stok' => $stokupdate]);
  }

  public function UpdateSepatuCatatPenjualan(Request $Request)
  {
      $IDSepatuJual = $Request->get('IDSepatuJual');
      $IDSepatu = $Request->get('IDSepatu');
      $IDPenjualan = $Request->get('IDPenjualan');
      DB::table('SepatuCatatPenjualan')
          ->where('SepatuID', $IDSepatu)
          ->where('PenjualanID', $IDPenjualan)
          ->update(['Jumlah' => $Request->get('Jumlah'),
                    'SepatuID' => $Request->get('IDSepatu'),
                    'PenjualanID' => $Request->get('IDPenjualan')]);
  }
}
