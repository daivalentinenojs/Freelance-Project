<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Risalah;
use DB;

class Risalah extends Model
{
    protected $table = 'Risalah';
    protected $guarded = ['Nomor'];
    protected $fillable = ['Nomor', 'Tanggal', 'Sengketa', 'StatusSengketa', 'Proses', 'PenegasanKonversi', 'CatatanKeberatan', 'KeteranganSengketa',
                          'BebanAtasTanah', 'StatusAlatBukti', 'StatusPembebanan', 'BangunanKepentingan', 'StatusTanah', 'StatusBagunanAtasTanah',
                          'KeteranganBangunanAtasTanah', 'IDKepalaDesa', 'IDKenyataan', 'NomorBuktiPemilikan', 'IDKesimpulanStatusTanah', 'NomorBuktiSanggahan',
                          'NomorBuktiPerpajakan', 'IDStatusTanah', 'IDFormulirPermohonan', 'IDSanggahan', 'IsActive'];

    public function GetRisalah() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '10'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function StoreRisalah(Request $Request, $IDKenyataan, $IDBuktiPerpajakan, $IDStatusTanah, $IDSanggahan, $IDKesimpulanStatusTanah)
    {
        if ( $IDSanggahan == '' ) {
          $IDSanggahan = 0;
        }

        $unique_id = uniqid();
        $Risalah = new Risalah(array(
            'Tanggal' => date('Y-m-d'), //$Request->get('TanggalRisalah'),                    // Tanggah hari tersebut
            'Sengketa' => $Request->get('Sengketa'),                                          // Input
            'StatusSengketa' => $Request->get('StatusSengketa'),                              // 1 : Sedang Dalam Sengketa 2 : Tidak Ada Sengketa
            'Proses' => $Request->get('Proses'),                                              // 1 : Diproses 2 : Pemberian hak
            // 'PenegasanKonversi' => $Request->get('PenegasanKonversi'),                     // Dihilangkan

            'CatatanKeberatan' => $Request->get('CatatanKeberatan'),                          // Input
            'KeteranganSengketa' => $Request->get('KeteranganSengketa'),                      // Input
            'BebanAtasTanah' => $Request->get('BebanAtasTanah'),                              // Input
            'StatusAlatBukti' => $Request->get('StatusAlatBukti'),                            // 1 : Lengkap 2 : Tidak Lengkap 3 : Tidak Ada
            'StatusPembebanan' => $Request->get('StatusPembebanan'),                          // 1 : Sedang Digunakan 2 : Tidak Digunakan

            'BangunanKepentingan' => $Request->get('BangunanKepentingan'),                    // Input
            'StatusTanah' => $Request->get('StatusTanah'),                                    // 1 : Tanah Dengan Hak Adat Perorangan 2 : Tanah Bagi Kepentingan Umum 3 : Lain - lain
            'StatusBagunanAtasTanah' => $Request->get('StatusBagunanAtasTanah'),              // 1 : Rumah Hunian 2 : Toko 3 : Gudang 4 : Pagar 5 : Kantor 6 : Rumah Ibadah 7 : Bengkel 8 : Tidak Ada Bangunan
            'KeteranganBangunanAtasTanah' => $Request->get('KeteranganBangunanAtasTanah'),    // Input
            'IDKepalaDesa' => $Request->get('IDKepalaDesa'),                                  // FK

            'IDKenyataan' => $IDKenyataan,                                                    // FK
            'IDKesimpulanStatusTanah' => $IDKesimpulanStatusTanah,                            // FK
            'NomorBuktiPerpajakan' => $IDBuktiPerpajakan,                                     // FK

            'IDStatusTanah' => $IDStatusTanah,                                                // FK
            'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),                  // FK
            'IDSanggahan' => $IDSanggahan,                                                    // FK
            'IsActive' => (1)
        ));
        $Risalah->save();
        $ID = DB::table('Risalah')->max('Nomor');

        if($Request->hasFile('FotoSengketa')) {
            $IDFoto = $ID.'.jpg';
            $Request->FotoSengketa->move(public_path('foto/Sengketa'), $IDFoto);
        }

        if($Request->hasFile('SketsaBidang')) {
            $IDFoto = $ID.'.jpg';
            $Request->SketsaBidang->move(public_path('foto/SketsaBidang'), $IDFoto);
        }
    }

    public function UpdateRisalah(Request $Request, $IDSanggahan)
    {
        $IDRisalah = $Request->get('IDRisalah');

        if ( $IDSanggahan == '' ) {
          $IDSanggahan = 0;
        }

        DB::table('Risalah')
            ->where('Nomor', $IDRisalah)
            ->update(['Tanggal' => date('Y-m-d'),
                    'Sengketa' => $Request->get('Sengketa'),
                    'StatusSengketa' => $Request->get('StatusSengketa'),
                    'Proses' => $Request->get('Proses'),
                    'PenegasanKonversi' =>  $Request->get('PenegasanKonversi'),

                    'CatatanKeberatan' => $Request->get('CatatanKeberatan'),
                    'KeteranganSengketa' => $Request->get('KeteranganSengketa'),
                    'BebanAtasTanah' => $Request->get('BebanAtasTanah'),
                    'StatusAlatBukti' => $Request->get('StatusAlatBukti'),
                    'StatusPembebanan' => $Request->get('StatusPembebanan'),

                    'BangunanKepentingan' => $Request->get('BangunanKepentingan'),
                    'StatusTanah' => $Request->get('StatusTanah'),
                    'StatusBagunanAtasTanah' => $Request->get('StatusBagunanAtasTanah'),
                    'KeteranganBangunanAtasTanah' => $Request->get('KeteranganBangunanAtasTanah'),
                    // 'IDKepalaDesa' => $Request->get('IDKepalaDesa'),

                    // 'IDKenyataan' => $Request->get('IDKenyataan'),
                    // 'IDKesimpulanStatusTanah' => $Request->get('IDKesimpulanStatusTanah'),
                    // 'NomorBuktiPerpajakan' => $Request->get('NomorBuktiPerpajakan'),

                    // 'IDStatusTanah' => $Request->get('IDStatusTanah'),
                    // 'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),
                    'IDSanggahan' => $IDSanggahan,
                    'IsActive' => 1]);

        if($Request->hasFile('FotoSengketa')) {
            $IDFoto = $IDRisalah.'.jpg';
            $Request->FotoSengketa->move(public_path('foto/Sengketa'), $IDFoto);
        }

        if($Request->hasFile('SketsaBidang')) {
            $IDFoto = $IDRisalah.'.jpg';
            $Request->SketsaBidang->move(public_path('foto/SketsaBidang'), $IDFoto);
        }
    }

    public function GetEditRisalah() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '11'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetVerifikasiRisalah($ID) {
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
                  WHERE FormulirPermohonan.Status = '50' AND KepalaDesa.ID = '$ID'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetValidasiRisalah($ID) {
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
                  WHERE FormulirPermohonan.Status = '12' AND Pemohon.ID = '$ID'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetPrintRisalah() {
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
                  WHERE FormulirPermohonan.Status = '13'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
          $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }
}
