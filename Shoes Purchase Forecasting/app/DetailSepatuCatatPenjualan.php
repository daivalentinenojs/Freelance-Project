<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DetailSepatuCatatPenjualan extends Model
{
  protected $table = 'DetailSepatuCatatPenjualan';
  //protected $guarded = ['ID', 'SepatuID', 'PemesananID'];
  protected $fillable = ['DetailSepatuID', 'PenjualanID', 'Jumlah', 'harga'];
}
