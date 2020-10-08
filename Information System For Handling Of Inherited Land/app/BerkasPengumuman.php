<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\BerkasPengumuman;
use DB;

class BerkasPengumuman extends Model
{
  protected $table = 'BerkasPengumuman';
  protected $guarded = ['NomorFisik'];
  protected $fillable = ['NomorFisik', 'NomorBerkasPengumuman', 'NomorBidang', 'Tanggal', 'Sanggahan', 'File', 'Status', 'IDFormulirPermohonan', 'IDKaryawan', 'IDKaryawanSatu', 'IDKaryawanDua', 'IDKaryawanTiga', 'IsActive'];

  public function StoreBerkasPengumuman(Request $Request) {
    $unique_id = uniqid();
    $ID = DB::table('BerkasPengumuman')->max('NomorFisik');
    $ID = $ID + 1;

    if($Request->hasFile('FileBidangTanah')) {
        $IDFoto = $ID.'.jpg';
        $Request->FileBidangTanah->move(public_path('foto/BerkasPengumuman'), $IDFoto);
    }

    $BerkasPengumuman = new BerkasPengumuman(array(
        'NomorBerkasPengumuman' => $Request->get('NomorBerkasPengumuman'),
        'NomorBidang' => $Request->get('NomorBidang'),
        'Tanggal' => date('Y-m-d'),
        'Sanggahan' => $Request->get('Sanggahan'),
        'Status' => (1), // 1 : Pengajuan 2 : Verifikasi 1 3 : Verifikasi 2 4 : Verifikasi 3 5 : Ada Sanggahan
        'IDKaryawan' => $Request->session()->get('ID'),
        'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),
        'File' => $IDFoto,
        'IsActive' => (1)
    ));
    $BerkasPengumuman->save();

    $IDNomorFisik = DB::table('BerkasPengumuman')->max('NomorFisik');
    return $IDNomorFisik;
  }

  public function UpdateBerkasPengumuman(Request $Request) {
      if($Request->hasFile('FileBidangTanah')) {
          $IDFoto = $ID.'.jpg';
          $Request->FileBidangTanah->move(public_path('foto/BerkasPengumuman'), $IDFoto);
      }

      $NomorBerkasPengumuman = $Request->get('NomorBerkasPengumuman');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      DB::table('BerkasPengumuman')
          ->where('NomorBerkasPengumuman', $NomorBerkasPengumuman)
          ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
          ->update(['Sanggahan' => $Request->get('Sanggahan')]);
  }

  public function UpdateVerifikasiSatu(Request $Request) {
      $NomorBerkasPengumuman = $Request->get('NomorBerkasPengumuman');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      DB::table('BerkasPengumuman')
          ->where('NomorBerkasPengumuman', $NomorBerkasPengumuman)
          ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
          ->update(['IDKaryawanSatu' => $Request->session()->get('ID'),
                    'Status' => (2)]);
  }

  public function UpdateVerifikasiDua(Request $Request) {
      $NomorBerkasPengumuman = $Request->get('NomorBerkasPengumuman');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      DB::table('BerkasPengumuman')
          ->where('NomorBerkasPengumuman', $NomorBerkasPengumuman)
          ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
          ->update(['IDKaryawanDua' => $Request->session()->get('ID'),
                    'Status' => (3)]);
  }

  public function UpdateVerifikasiTiga(Request $Request) {
      $NomorBerkasPengumuman = $Request->get('NomorBerkasPengumuman');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      DB::table('BerkasPengumuman')
          ->where('NomorBerkasPengumuman', $NomorBerkasPengumuman)
          ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
          ->update(['IDKaryawanTiga' => $Request->session()->get('ID'),
                    'Status' => (4)]);
  }

  public function UpdateVerifikasiSanggahan(Request $Request) {
      $NomorBerkasPengumuman = $Request->get('NomorBerkasPengumuman');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      DB::table('BerkasPengumuman')
          ->where('NomorBerkasPengumuman', $NomorBerkasPengumuman)
          ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
          ->update(['IDKaryawanSatu' => '',
                    'IDKaryawanDua' => '',
                    'IDKaryawanTiga' => '',
                    'Sanggahan' => $Request->get('Sanggahan'),
                    'Status' => (1)]);
  }

  public function GetPrintBerkasPengumuman() {
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
                WHERE FormulirPermohonan.Status = '18'";
      $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
      $DataFormulirPermohonan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
      }
      return $DataFormulirPermohonan;
  }
}
