<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class JadwalUkur extends Model
{
  protected $table = 'JadwalUkur';
  protected $guarded = ['ID'];
  protected $fillable = ['ID', 'TanggalMulai', 'TanggalSelesai', 'IDKaryawan', 'IDKaryawanPemetaan', 'IsActive'];

  public function StoreJadwalUkur(Request $Request) {
      $unique_id = uniqid();
      $JadwalUkur = new JadwalUkur(array(
          'TanggalMulai' => $Request->get('TanggalMulai'),
          'TanggalSelesai' => $Request->get('TanggalSelesai'),
          'IDKaryawan' => $Request->get('IDKaryawan'),
          'IDKaryawanPemetaan' => $Request->get('IDKaryawanPemetaan'),
          'IsActive' => (1)
      ));
      $JadwalUkur->save();
      $IDJadwalUkur = DB::table('JadwalUkur')->max('ID');
      return $IDJadwalUkur;
  }

  public function UpdateJadwalUkur(Request $Request) {
      $IDPersyaratan = $Request->get('IDFormulirPermohonan');
      DB::table('JadwalUkur')
          ->where('ID', $IDPersyaratan)
          ->update(['TanggalSelesai' => date('Y-m-d')]);
  }
}
