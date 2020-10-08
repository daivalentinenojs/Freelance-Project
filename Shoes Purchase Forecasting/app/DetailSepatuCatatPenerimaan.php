<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DetailSepatuCatatPenerimaan extends Model
{
  protected $table = 'DetailSepatuCatatPenerimaan';
  //protected $guarded = ['ID', 'SepatuID', 'PemesananID'];
  protected $fillable = ['DetailSepatuID', 'PenerimaanID', 'Jumlah', 'harga'];
}
