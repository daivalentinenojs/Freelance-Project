<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class CatatNotaPesan extends Model
{
  protected $table = 'DetailSepatuCatatPemesanan';
  //protected $guarded = ['ID'];
  protected $fillable = ['DetailSepatuID', 'PemesananID', 'Jumlah'];
}
