<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\KXGU;
use DB;

class KXGU extends Model
{
    protected $table = 'KaryawanXGambarUkur';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'IDKaryawan', 'NomorGambarUkur', 'IsActive'];

    public function StoreKXGU(Request $Request, $IDGambarUkur) {
      $unique_id = uniqid();
      $KXGU = new KXGU(array(
          'NomorGambarUkur' => $IDGambarUkur,
          'IDKaryawan' => $Request->get('IDKaryawan'),
          'IsActive' => (1)
      ));
      $KXGU->save();

      // $KXGU = new KXGU(array(
      //     'NomorGambarUkur' => $IDGambarUkur,
      //     'IDKaryawan' => $Request->get('IDKaryawanPengukuranDua'),
      //     'IsActive' => (1)
      // ));
      // $KXGU->save();
    }

    public function UpdateKXGU(Request $Request) {
        $IDGambarUkur = $Request->get('IDGambarUkur');
        DB::table('KaryawanXGambarUkur')
            ->where('NomorGambarUkur', $IDGambarUkur)
            ->where('IDKaryawan', $Request->get('IDKaryawanPengukuranSatuLama'))
            ->update(['IDKaryawan' => $Request->get('IDKaryawanPengukuranSatu')]);

        DB::table('KaryawanXGambarUkur')
            ->where('NomorGambarUkur', $IDGambarUkur)
            ->where('IDKaryawan', $Request->get('IDKaryawanPengukuranDuaLama'))
            ->update(['IDKaryawan' => $Request->get('IDKaryawanPengukuranDua')]);
    }
}
