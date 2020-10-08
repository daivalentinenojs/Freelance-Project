<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\FPXP;
use DB;

class FPXP extends Model
{
  protected $table = 'FPXP';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'IDPersyaratan', 'IDFormulirPermohonan', 'IsActive'];

  public function StoreFPXP($IDFormulirPermohonan, $IDPersyaratan)
  {
      $unique_id = uniqid();
      $FPXP = new FPXP(array(
          'IDPersyaratan' => $IDPersyaratan,
          'IDFormulirPermohonan' => $IDFormulirPermohonan,
          'IsActive' => (1)
      ));
      $FPXP->save();
  }
}
