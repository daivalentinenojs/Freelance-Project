<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Persyaratan;
use DB;

class Persyaratan extends Model
{
    protected $table = 'Persyaratan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'NamaTerima', 'Nama', 'KelasLetterC', 'PersilNoLetterC', 'LuasDaerahLetterC', 'LuasTanahLetterC', 'JenisTanahLetterC', 'StatusLetterC', 'StatusTanah', 'File', 'NomorDi',
    'Terbilang', 'NomorBukuHurufC', 'BatasUtara', 'BatasBarat', 'BatasTimur', 'BatasSelatan', 'JenisPersyaratan', 'NamaPewaris', 'TanggalMeninggal', 'DesaKecamatan', 'SuratWasiat', 'TanggalKeteranganWaris',
    'StatusSuratWasiat', 'NamaPPAT', 'PenerimaHibah', 'TanggalSuratHibah', 'NomorSuratHibah', 'PembelianDari', 'Cara', 'TanggalJualBeli', 'TempatLelang', 'WaktuLelang', 'PutusanPemberianHak',
    'Persyaratan', 'NomorSuratPemberianHak', 'Pejabat', 'TanggalPutusan', 'NamaPerwakafan', 'TanggalWakaf', 'AktaPengganti', 'NamaPPAIW', 'NomorSuratWakaf', 'IsActive',
    'DilakukanDengan', 'NomorAktaPPAT', 'NomorPPATPembelian', 'NamaPPATPembelian', 'DijualKepada', 'RisalahLelang'];

    public function StorePersyaratan(Request $Request) {
      $unique_id = uniqid();
      $ID = DB::table('Persyaratan')->max('ID');
      $ID = $ID + 1;
      $IDSW = $ID.'.jpg';

      $StatusSuratWasiat = 2;

      if($Request->hasFile('FilePersyaratan')) {
          $i = 1;
          $SemuaFoto = '';
          $FilePersyaratan = $Request->file('FilePersyaratan');

          foreach($FilePersyaratan as $File) {
            $IDFoto = $ID.'_'.$i.'.jpg';
            $File->move('foto/Persyaratan',$IDFoto);
            $SemuaFoto = $SemuaFoto.$IDFoto.';';
            $i = $i + 1;
          }
      }

      if($Request->hasFile('SuratWasiat')) {
          $IDFotoSW = $ID.'.jpg';
          $Request->SuratWasiat->move(public_path('foto/SuratWasiat'), $IDFotoSW);
          $StatusSuratWasiat = 1;
      }

      $Persyaratan = new Persyaratan(array(
          'Nama' => $Request->get('NamaPemohon'),
          'NomorBukuHurufC' => $Request->get('NomorBukuHurufC'),
          'PersilNoLetterC' => $Request->get('PersilNoLetterC'),
          'KelasLetterC' => $Request->get('KelasLetterC'),
          'JenisTanahLetterC' => $Request->get('JenisTanahLetterC'),
          'LuasDaerahLetterC' => $Request->get('LuasDaerahLetterC'),
          'LuasTanahLetterC' => $Request->get('LuasTanahLetterC'),
          'StatusTanah' => $Request->get('StatusTanah'),
          'File' => $SemuaFoto,
          'BatasUtara' => $Request->get('BatasUtara'),
          'BatasBarat' => $Request->get('BatasBarat'),
          'BatasTimur' => $Request->get('BatasTimur'),
          'BatasSelatan' => $Request->get('BatasSelatan'),
          'JenisPersyaratan' => $Request->get('JenisPersyaratan'),
          'NamaPewaris' => $Request->get('NamaPewaris'),
          'TanggalMeninggal' => $Request->get('TanggalMeninggal'),
          'SuratWasiat' => $IDSW,
          'DesaKecamatan' => $Request->get('DesaKecamatan'),
          'TanggalKeteranganWaris' => $Request->get('TanggalKeteranganWaris'),
          'StatusSuratWasiat' => $StatusSuratWasiat,
          'NamaPPAT' => $Request->get('NamaPPAT'),
          'PenerimaHibah' => $Request->get('PenerimaHibah'),
          'TanggalSuratHibah' => $Request->get('TanggalSuratHibah'),
          'NomorSuratHibah' => $Request->get('NomorSuratHibah'),
          'DilakukanDengan' => $Request->get('DilakukanDengan'),
          'NomorAktaPPAT' => $Request->get('NomorAktaPPAT'),
          'PembelianDari' => $Request->get('PembelianDari'),
          'NomorPPATPembelian' => $Request->get('NomorPPATPembelian'),
          'NamaPPATPembelian' => $Request->get('NamaPPATPembelian'),
          'DijualKepada' => $Request->get('DijualKepada'),
          'Cara' => $Request->get('Cara'),
          'TanggalJualBeli' => $Request->get('TanggalJualBeli'),
          'TempatLelang' => $Request->get('TempatLelang'),
          'WaktuLelang' => $Request->get('WaktuLelang'),
          'RisalahLelang' => $Request->get('RisalahLelang'),
          'PutusanPemberianHak' => $Request->get('PutusanPemberianHak'),
          'Persyaratan' => $Request->get('Persyaratan'),
          'NomorSuratPemberianHak' => $Request->get('NomorSuratPemberianHak'),
          'Pejabat' => $Request->get('Pejabat'),
          'TanggalPutusan' => $Request->get('TanggalPutusan'),
          'NamaPerwakafan' => $Request->get('NamaPerwakafan'),
          'TanggalWakaf' => $Request->get('TanggalWakaf'),
          'AktaPengganti' => $Request->get('AktaPengganti'),
          'NamaPPAIW' => $Request->get('NamaPPAIW'),
          'NomorSuratWakaf' => $Request->get('NomorSuratWakaf'),
          'IsActive' => (1)
      ));
      $Persyaratan->save();

      $ID = DB::table('Persyaratan')->max('ID');
      return $ID;
    }

    public function UpdateValidasiPembayaranPersyaratan(Request $Request) {
        $IDPersyaratan = $Request->get('IDPersyaratan');
        DB::table('Persyaratan')
            ->where('ID', $IDPersyaratan)
            ->update(['NamaTerima' => $Request->get('NamaTerima'),
                      // 'NomorDi' => $Request->get('NomorDi'),
                      'Terbilang' => $Request->get('Terbilang')]);
    }

    public function UpdatePengubahanFPPersyaratan(Request $Request) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');

        if($Request->hasFile('FilePersyaratan')) {
            $i = 1;
            $SemuaFoto = '';
            $FilePersyaratan = $Request->file('FilePersyaratan');

            foreach($FilePersyaratan as $File) {
              $IDFoto = $IDFormulirPermohonan.'_'.$i.'.jpg';
              $File->move('foto/Persyaratan',$IDFoto);
              $SemuaFoto = $SemuaFoto.$IDFoto.';';
              $i = $i + 1;
            }
        }

        DB::table('Persyaratan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Nama' => $Request->get('NamaPemohon'),
                      'NomorBukuHurufC' => $Request->get('NomorBukuHurufC'),
                      'PersilNoLetterC' => $Request->get('PersilNoLetterC'),
                      'KelasLetterC' => $Request->get('KelasLetterC'),
                      'JenisTanahLetterC' => $Request->get('JenisTanahLetterC'),
                      'LuasDaerahLetterC' => $Request->get('LuasDaerahLetterC'),
                      'LuasTanahLetterC' => $Request->get('LuasTanahLetterC'),
                      'StatusTanah' => $Request->get('StatusTanah'),
                      'File' => $SemuaFoto,
                      'BatasUtara' => $Request->get('BatasUtara'),
                      'BatasBarat' => $Request->get('BatasBarat'),
                      'BatasTimur' => $Request->get('BatasTimur'),
                      'BatasSelatan' => $Request->get('BatasSelatan'),
                      // 'JenisPersyaratan' => $Request->get('JenisPersyaratan'),
                      'NamaPewaris' => $Request->get('NamaPewaris'),
                      'TanggalMeninggal' => $Request->get('TanggalMeninggal'),
                      // 'SuratWasiat' => $IDSW,
                      'DesaKecamatan' => $Request->get('DesaKecamatan'),
                      'TanggalKeteranganWaris' => $Request->get('TanggalKeteranganWaris'),
                      // 'StatusSuratWasiat' => $StatusSuratWasiat,
                      'NamaPPAT' => $Request->get('NamaPPAT'),
                      'PenerimaHibah' => $Request->get('PenerimaHibah'),
                      'TanggalSuratHibah' => $Request->get('TanggalSuratHibah'),
                      'NomorSuratHibah' => $Request->get('NomorSuratHibah'),
                      'DilakukanDengan' => $Request->get('DilakukanDengan'),
                      'NomorAktaPPAT' => $Request->get('NomorAktaPPAT'),
                      'PembelianDari' => $Request->get('PembelianDari'),
                      'NomorPPATPembelian' => $Request->get('NomorPPATPembelian'),
                      'NamaPPATPembelian' => $Request->get('NamaPPATPembelian'),
                      'DijualKepada' => $Request->get('DijualKepada'),
                      'Cara' => $Request->get('Cara'),
                      'TanggalJualBeli' => $Request->get('TanggalJualBeli'),
                      'TempatLelang' => $Request->get('TempatLelang'),
                      'WaktuLelang' => $Request->get('WaktuLelang'),
                      'RisalahLelang' => $Request->get('RisalahLelang'),
                      'PutusanPemberianHak' => $Request->get('PutusanPemberianHak'),
                      'Persyaratan' => $Request->get('Persyaratan'),
                      'NomorSuratPemberianHak' => $Request->get('NomorSuratPemberianHak'),
                      'Pejabat' => $Request->get('Pejabat'),
                      'TanggalPutusan' => $Request->get('TanggalPutusan'),
                      'NamaPerwakafan' => $Request->get('NamaPerwakafan'),
                      'TanggalWakaf' => $Request->get('TanggalWakaf'),
                      'AktaPengganti' => $Request->get('AktaPengganti'),
                      'NamaPPAIW' => $Request->get('NamaPPAIW'),
                      'NomorSuratWakaf' => $Request->get('NomorSuratWakaf')]);
    }
}
