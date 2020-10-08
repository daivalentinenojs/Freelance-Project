<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\BerkasPermohonan;
use DB;

class BerkasPermohonan extends Model
{
    protected $table = 'BerkasPermohonan';
    protected $guarded = ['Nomor'];
    protected $fillable = ['Nomor', 'NomorWarkah', 'TanggalBerkasMasuk', 'NomorHak', 'TanggalBerkasValid', 'NIB',
                          'KodeDi301', 'KodeDi302', 'KodeDi303', 'KodeDi305', 'KodeDi306', 'KodeDi307', 'KodeDi208', 'TanggalPermohonan', 'NomorPengumuman', 'TanggalPengumuman',
                          'NomorSuratUkur', 'TanggalSuratUkur', 'TanggalBukuTanah',
                          'Disposisi', 'NomorSuratPengantar', 'NomorBerkasPengumuman', 'IDKaryawan', 'IDJadwalUkur', 'NomorGambarUkur', 'IDPembayaran', 'IDPersyaratan', 'IsActive'];

    public function StoreBerkasPermohonan(Request $Request) {
      $unique_id = uniqid();
      // $ID = DB::table('BerkasPermohonan')->max('Nomor');
      // $ID = $ID + 1;
      //
      // if($Request->hasFile('FileBerkasPermohonan')) {
      //     $IDFoto = $ID.'.jpg';
      //     $Request->FileBerkasPermohonan->move(public_path('foto/BerkasPermohonan'), $IDFoto);
      // }

      $BerkasPermohonan = new BerkasPermohonan(array(
          'NomorWarkah' => $Request->get('NomorWarkah'),
          'TanggalBerkasMasuk' => date('Y-m-d'), //$Request->get('TanggalBerkasMasuk'),
          'TanggalBerkasValid' => $Request->get('TanggalBerkasValid'),
          'NIB' => $Request->get('NIB'),
          'KodeDi301' => $Request->get('KodeDi301'),
          'KodeDi302' => $Request->get('KodeDi302'),
          // 'KodeDi303' => $Request->get('KodeDi303'),
          'KodeDi305' => $Request->get('KodeDi305'),
          'KodeDi306' => $Request->get('KodeDi306'),
          'NomorHak' => $Request->get('NomorHak'),
          // 'KodeDi307' => $Request->get('KodeDi307'),
          // 'KodeDi208' => $Request->get('KodeDi208'),
          'TanggalPermohonan' => date('Y-m-d'), //$Request->get('TanggalPermohonan'),
          // 'NomorPengumuman' => $Request->get('NomorPengumuman'),
          // 'TanggalPengumuman' => $Request->get('TanggalPengumuman'),
          'NomorSuratUkur' => $Request->get('NomorSuratUkur'),
          'TanggalSuratUkur' => $Request->get('TanggalSuratUkur'),
          'TanggalBukuTanah' => $Request->get('TanggalBukuTanah'),
          'Disposisi' => $Request->get('Disposisi'),
          'IDKaryawan' => $Request->session()->get('ID'),
          'IDPembayaran' => $Request->get('IDPembayaran'),
          'IDPersyaratan' => $Request->get('IDPersyaratan'),
          // 'File' => $IDFoto,
          'IsActive' => (1)
      ));
      $BerkasPermohonan->save();
    }

    public function UpdateDisposisiBP(Request $Request) {
        $IDPersyaratan = $Request->get('IDPersyaratan');
        $IDPembayaran = $Request->get('IDPembayaran');
        DB::table('BerkasPermohonan')
            ->where('IDPersyaratan', $IDPersyaratan)
            ->where('IDPembayaran', $IDPembayaran)
            ->update(['TanggalBerkasValid' => $Request->get('TanggalBerkasValid')]);
    }

    public function GetJadwalUkurFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '5'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateJadwalUkur(Request $Request, $IDJadwalUkur) {
        $IDPersyaratan = $Request->get('IDFormulirPermohonan');
        DB::table('BerkasPermohonan')
            ->where('IDPersyaratan', $IDPersyaratan)
            ->update(['IDJadwalUkur' => $IDJadwalUkur]);
    }

    public function GetGambarUkurFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '6'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateGambarUkur(Request $Request, $IDGambarUkur) {
        $IDPersyaratan = $Request->get('IDFormulirPermohonan');
        DB::table('BerkasPermohonan')
            ->where('IDPersyaratan', $IDPersyaratan)
            ->update(['NomorGambarUkur' => $IDGambarUkur,
                      'NIB' => $Request->get('NIB')]);
    }

    public function GetSanggahanGambarUkurFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '7' OR FormulirPermohonan.Status = '9' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetUbahGambarUkurFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '7' OR FormulirPermohonan.Status = '8' OR FormulirPermohonan.Status = '9' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetValidasiGambarUkurFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '7' OR FormulirPermohonan.Status = '8' OR FormulirPermohonan.Status = '9' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateNomorPengumuman(Request $Request, $IDBerkasPengumuman) {
        $IDPersyaratan = $Request->get('IDFormulirPermohonan');
        DB::table('BerkasPermohonan')
            ->where('IDPersyaratan', $IDPersyaratan)
            ->update(['NomorBerkasPengumuman' => $IDBerkasPengumuman,
                      'NomorPengumuman' => $IDBerkasPengumuman,
                      'TanggalPengumuman' => date('Y-m-d')]);
    }
}
