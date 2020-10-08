<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DetailSepatuCatatPesanPembelian extends Model
{
  protected $table = 'DetailSepatuCatatPesanPembelian';
  //protected $guarded = ['ID', 'SepatuID', 'PemesananID'];
  protected $fillable = ['DetailSepatuID', 'PembelianID', 'Jumlah', 'harga'];
}
