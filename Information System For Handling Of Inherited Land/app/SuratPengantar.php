<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\SuratPengantar;
use DB;

class SuratPengantar extends Model
{
  protected $table = 'SuratPengantar';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Nomor', 'NomorSuratPengantar', 'Tanggal', 'Sanggahan', 'File', 'Status', 'IDFormulirPermohonan', 'IDKaryawan', 'IDKepalaDesa', 'IDKaryawanVerifikasi', 'IsActive'];

  public function StoreSuratPengantar(Request $Request) {
    $unique_id = uniqid();
    $ID = DB::table('SuratPengantar')->max('Nomor');
    $ID = $ID + 1;

    if($Request->hasFile('FileSuratPengantar')) {
        $IDFoto = $ID.'.jpg';
        $Request->FileSuratPengantar->move(public_path('foto/SuratPengantar'), $IDFoto);
    }

    $StatusSP = 0;
    if ($Request->get('Sanggahan') == '') {
      $StatusSP = 1;
    } else {
      $StatusSP = 3;
    }

    $SuratPengantar = new SuratPengantar(array(
        'NomorSuratPengantar' => $Request->get('NomorSuratPengantar'),
        'Tanggal' => date('Y-m-d'),
        'Sanggahan' => $Request->get('Sanggahan'),
        'Status' => $StatusSP, // 1 : Verifikasi Karyawan 2 : Verifikasi Kepala Desa 3 : Sanggahan Karyawan 4 : Sanggahan Kepala Desa 5 : Berita Acara 19 20 21 22 23
        'IDKaryawan' => $Request->session()->get('ID'),
        'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),
        'File' => $IDFoto,
        'IsActive' => (1)
    ));
    $SuratPengantar->save();

    $IDMax = DB::table('SuratPengantar')->max('Nomor');
    return $IDMax;
  }

  public function UpdateSuratPengantar(Request $Request) {
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');

      if($Request->hasFile('FileSuratPengantar')) {
          $IDFoto = $IDFormulirPermohonan.'.jpg';
          $Request->FileSuratPengantar->move(public_path('foto/SuratPengantar'), $IDFoto);
      }

      if ($Request->get('Sanggahan') == '') {
        DB::table('SuratPengantar')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => (1)]);
      } else {
        DB::table('SuratPengantar')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => (3)]);
      }
  }

  public function UpdateVerifikasiKaryawan(Request $Request, $ID) {
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      if ($Request->get('Sanggahan') == '') {
        DB::table('SuratPengantar')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['IDKaryawanVerifikasi' => $ID,
                      'Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => (2)]);
      } else {
        DB::table('SuratPengantar')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => (3)]);
      }
  }

  public function UpdateVerifikasiKepalaDesa(Request $Request, $ID) {
      $NomorSuratPengantar = $Request->get('NomorSuratPengantar');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');

      if ($Request->get('Sanggahan') == '') {
        DB::table('SuratPengantar')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['IDKepalaDesa' => $ID,
                      'Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => (5)]);
      } else {
        DB::table('SuratPengantar')
            ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
            ->update(['Sanggahan' => $Request->get('Sanggahan'),
                      'Status' => (4)]);
      }
  }

  public function GetPrintSuratPengantar() {
      require '../connection/Init.php';
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan)
                INNER JOIN Persyaratan ON (Persyaratan.ID = FPXP.IDPersyaratan)
                INNER JOIN Pemohon ON (Pemohon.ID = FormulirPermohonan.IDPemohon)
                INNER JOIN Desa ON (Pemohon.IDDesa = Desa.ID)
                INNER JOIN KepalaDesa ON (Desa.ID = KepalaDesa.IDDesa)
                WHERE FormulirPermohonan.Status = '23'";
      $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
      $DataFormulirPermohonan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
      }
      return $DataFormulirPermohonan;
  }
}
