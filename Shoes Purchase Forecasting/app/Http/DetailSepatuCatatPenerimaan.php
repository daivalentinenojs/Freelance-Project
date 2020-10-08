<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class CatatNotaBeli extends Model
{
  protected $table = 'DetailSepatuCatatPenerimaan';
  protected $guarded = ['ID'];
  protected $fillable = ['DetailSepatuID', 'PenerimaanID', 'Jumlah', 'Harga'];
}
