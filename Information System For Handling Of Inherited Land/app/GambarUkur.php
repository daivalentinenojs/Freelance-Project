<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\GambarUkur;
use DB;

class GambarUkur extends Model
{
    protected $table = 'GambarUkur';
    protected $guarded = ['Nomor'];
    protected $fillable = ['Nomor', 'NomorSuratTugasUkur', 'NomorPetaPendaftaran', 'Tanggal', 'TanggalUkur', 'TanggalPemetaan', 'PetaGrafikal', 'Sanggahan', 'Status', 'IDKaryawan', 'IDKaryawanPemetaan', 'IsActive'];

    public function StoreGambarUkur(Request $Request) {
      $unique_id = uniqid();
      $GambarUkur = new GambarUkur(array(
          'NomorSuratTugasUkur' => $Request->get('NomorSuratTugasUkur'),
          'NomorPetaPendaftaran' => $Request->get('NomorPetaPendaftaran'),
          'Tanggal' => $Request->get('Tanggal'),
          'TanggalUkur' => $Request->get('TanggalUkur'),
          'TanggalPemetaan' => $Request->get('TanggalPemetaan'),
          'PetaGrafikal' => $Request->get('PetaGrafikal'),
          'Status' => (1),
          'IDKaryawan' => $Request->get('IDKaryawan'),
          'IDKaryawanPemetaan' => $Request->get('IDKaryawanPemetaan'),
          'IsActive' => (1)
      ));
      $GambarUkur->save();
      $IDGambarUkur = DB::table('GambarUkur')->max('Nomor');
      return $IDGambarUkur;
    }

    public function UpdateSanggahanGambarUkur(Request $Request, $Status) {
        $IDGambarUkur = $Request->get('IDGambarUkur');
        DB::table('GambarUkur')
            ->where('Nomor', $IDGambarUkur)
            ->update(['Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => $Status]);
    }

    public function UpdateUbahGambarUkur(Request $Request, $Status) {
        $IDGambarUkur = $Request->get('IDGambarUkur');
        DB::table('GambarUkur')
            ->where('Nomor', $IDGambarUkur)
            ->update(['NomorSuratTugasUkur' => $Request->get('NomorSuratTugasUkur'),
                      'NomorPetaPendaftaran' => $Request->get('NomorPetaPendaftaran'),
                      'Tanggal' => $Request->get('Tanggal'),
                      'PetaGrafikal' => $Request->get('PetaGrafikal'),
                      'IDKaryawan' => $Request->get('IDKaryawan'),
                      'IDKaryawanPemetaan' => $Request->get('IDKaryawanPemetaan'),
                      'TanggalPemetaan' => $Request->get('TanggalPemetaan'),
                      'TanggalUkur' => $Request->get('TanggalUkur'),
                      'Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => $Status]);
    }

    public function UpdateValidasiGambarUkur(Request $Request, $Status) {
        $IDGambarUkur = $Request->get('IDGambarUkur');
        DB::table('GambarUkur')
            ->where('Nomor', $IDGambarUkur)
            ->update(['Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => $Status]);
    }
}
