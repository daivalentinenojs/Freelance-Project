<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class CatatNotaBeli extends Model
{
  protected $table = 'DetailSepatuCatatPesanPembelian';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'DetailSepatuID', 'PembelianID', 'Jumlah', 'Harga'];
}
