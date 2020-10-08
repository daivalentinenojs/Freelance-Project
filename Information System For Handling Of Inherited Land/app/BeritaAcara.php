<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\BeritaAcara;
use DB;

class BeritaAcara extends Model
{
  protected $table = 'BeritaAcara';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Nomor', 'NomorBeritaAcara', 'Tanggal', 'Sanggahan', 'PenjelasanPengesahan', 'File', 'Status', 'IDFormulirPermohonan', 'IDKaryawan', 'IDKaryawanVerifikasi', 'IsActive'];

  public function StoreBeritaAcara(Request $Request) {
    $unique_id = uniqid();
    $ID = DB::table('BeritaAcara')->max('Nomor');
    $ID = $ID + 1;

    if($Request->hasFile('FileBeritaAcara')) {
        $IDFoto = $ID.'.jpg';
        $Request->FileBeritaAcara->move(public_path('foto/BeritaAcara'), $IDFoto);
    }

    $BeritaAcara = new BeritaAcara(array(
        'NomorBeritaAcara' => $Request->get('NomorBeritaAcara'),
        'Tanggal' => date('Y-m-d'),
        // 'Sanggahan' => $Request->get('Sanggahan'),
        'PenjelasanPengesahan' => $Request->get('PenjelasanPengesahan'),
        'Status' => (1), // 1 : Pengajuan 2 : Verifikasi Karyawan
        'IDKaryawan' => $Request->session()->get('ID'),
        'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),
        'IsActive' => (1)
    ));
    $BeritaAcara->save();
  }

  public function UpdateVerifikasiBeritaAcara(Request $Request) {
      $NomorBeritaAcara = $Request->get('NomorBeritaAcara');
      $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
      DB::table('BeritaAcara')
          ->where('IDFormulirPermohonan', $IDFormulirPermohonan)
          ->update(['IDKaryawanVerifikasi' => $Request->session()->get('ID'),
                    'Status' => (2)]);
  }

  public function GetPrintBeritaAcara() {
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
                WHERE FormulirPermohonan.Status = '25'";
      $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
      $DataFormulirPermohonan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
      }
      return $DataFormulirPermohonan;
  }
}
