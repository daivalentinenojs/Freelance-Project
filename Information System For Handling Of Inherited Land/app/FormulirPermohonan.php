<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\FormulirPermohonan;
use DB;

class FormulirPermohonan extends Model
{
    protected $table = 'FormulirPermohonan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'NamaKuasa', 'AlamatKuasa', 'AlamatTanah', 'Status', 'File', 'IDPemohon', 'IsActive'];

    public function GetAjaxFP($ID) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'NamaKuasa',
          2 => 'AlamatKuasa',
          3 => 'AlamatTanah',
          4 => 'NamaPemohon',
          5 => 'NomorBukuHurufC',
          6 => 'JenisTanahLetterC',
          7 => 'LuasDaerahLetterC',
          8 => 'StatusTanah',
          9 => 'StatusFP',
          10 => 'View',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.IDPemohon = '$ID' AND FormulirPermohonan.Status = '1'";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.IDPemohon = '$ID' AND FormulirPermohonan.Status = '1'";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" AND ( FormulirPermohonan.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR FormulirPermohonan.NamaKuasa LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR FormulirPermohonan.AlamatTanah LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.JenisTanahLetterC LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.LuasDaerahLetterC LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.StatusTanah LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR FormulirPermohonan.Status LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          if ($row["StatusFP"] == 1) {
              $StatusFP = 'Menunggu Validasi';
          }

          if ($row["StatusTanah"] == 1) {
              $StatusTanah = 'Hak Milik';
          } else if ($row["StatusTanah"] == 2) {
              $StatusTanah = 'Hak Guna Bangunan';
          } else {
              $StatusTanah = 'Hak Pakai';
          }

          $nestedData[] = $row["ID"];
          $nestedData[] = $row["NamaKuasa"];
          $nestedData[] = $row["AlamatTanah"];
          $nestedData[] = $row["NamaPemohon"];
          $nestedData[] = $row["JenisTanahLetterC"];
          $nestedData[] = $row["LuasDaerahLetterC"].' m2';
          $nestedData[] = $StatusTanah;
          $nestedData[] = $StatusFP;
          $data[] = $nestedData;
        }

        $json_data = array(
                  "draw"            => intval( $requestData['draw'] ),
                  "recordsTotal"    => intval( $totalData ),
                  "recordsFiltered" => intval( $totalFiltered ),
                  "data"            => $data
                  );

        echo json_encode($json_data);
    }

    public function GetAjaxDashboard($ID, $Role) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'NamaKuasa',
          2 => 'AlamatKuasa',
          3 => 'AlamatTanah',
          4 => 'NamaPemohon',
          5 => 'NomorBukuHurufC',
          6 => 'JenisTanahLetterC',
          7 => 'LuasDaerahLetterC',
          8 => 'StatusTanah',
          9 => 'StatusFP',
          10 => 'View',
        );

        // Ambil Semua Baris Data
        if ($Role == 'Pemohon') {
         $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.IDPemohon = '$ID'";
        } elseif ($Role == 'Penerima Setoran PNBP' || $Role == 'Kepala Sub Bagian TU' || $Role == 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah' || $Role == 'Kepala Seksi Pengukuran dan Pemetaan' ||
              $Role == 'Petugas Pengumpul Data Yuridis' || $Role == 'Kepala Seksi Hub Hukum Pertanahan' || $Role == 'Sekretaris Bukan Anggota' || $Role == 'Anggota' || $Role == 'Ketua' ||
              $Role == 'Koordinator' || $Role == 'Kepala Seksi Infrastruktur Pertanahan' || $Role == 'Kepala Sub Bagian Seksi Peralihan Hak' || $Role == 'Staff Hubungan Hukum Pertanahan') {
         $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                    FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                    Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                    Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                    Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                    FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                    ON (Persyaratan.ID = FPXP.IDPersyaratan)";
        } else {
          $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                    FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                    Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                    Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                    Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                    FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                    ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = 19";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        if ($Role == 'Pemohon') {
        $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.IDPemohon = '$ID'";
        } elseif ($Role == 'Penerima Setoran PNBP' || $Role == 'Kepala Sub Bagian TU' || $Role == 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah' || $Role == 'Kepala Seksi Pengukuran dan Pemetaan' ||
              $Role == 'Petugas Pengumpul Data Yuridis' || $Role == 'Kepala Seksi Hub Hukum Pertanahan' || $Role == 'Sekretaris Bukan Anggota' || $Role == 'Anggota' || $Role == 'Ketua' ||
              $Role == 'Koordinator' || $Role == 'Kepala Seksi Infrastruktur Pertanahan' || $Role == 'Kepala Sub Bagian Seksi Peralihan Hak' || $Role == 'Staff Hubungan Hukum Pertanahan') {
          $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                    FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                    Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                    Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                    Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                    FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                    ON (Persyaratan.ID = FPXP.IDPersyaratan)";
        } else {
          $sql = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                    FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                    Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                    Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
                    Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                    FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                    ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = 19";
        }

        if( !empty($requestData['search']['value']) ) {
          $sql.=" AND ( FormulirPermohonan.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR FormulirPermohonan.NamaKuasa LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR FormulirPermohonan.AlamatTanah LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.JenisTanahLetterC LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.LuasDaerahLetterC LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Persyaratan.StatusTanah LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR FormulirPermohonan.Status LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          $StatusFP = '';
          $StatusTanah = '';

          if ($row["StatusFP"] == 1) {
              $StatusFP = 'Menunggu Validasi Pengajuan';
          } elseif ($row["StatusFP"] == 2) {
              $StatusFP = 'Pengajuan Valid, Menunggu Pembayaran';
          } elseif ($row["StatusFP"] == 3) {
              $StatusFP = 'Telah Dibayar, Menunggu Validasi Pembayaran';
          } elseif ($row["StatusFP"] == 4) {
              $StatusFP = 'Pembayaran Valid, Menunggu Validasi Disposisi';
          } elseif ($row["StatusFP"] == 5) {
              $StatusFP = 'Formulir Permohonan Valid, Menunggu Jadwal Ukur';
          } elseif ($row["StatusFP"] == 6) {
              $StatusFP = 'Proses Pengukuran, Menunggu Hasil Gambar Ukur';
          } elseif ($row["StatusFP"] == 7) {
              $StatusFP = 'Sanggahan Gambar Ukur';
          } elseif ($row["StatusFP"] == 8) {
              $StatusFP = 'Gambar Ukur Baru Telah Dibuat';
          } elseif ($row["StatusFP"] == 9) {
              $StatusFP = 'Menunggu Pemohon Validasi Gambar Ukur';
          } elseif ($row["StatusFP"] == 10) {
              $StatusFP = 'Gambar Ukur Valid, Menunggu Risalah';
          } elseif ($row["StatusFP"] == 11) {
              $StatusFP = 'Risalah 1';
          } elseif ($row["StatusFP"] == 12) {
              $StatusFP = 'Risalah 2';
          } elseif ($row["StatusFP"] == 13) {
              $StatusFP = 'Risalah Valid, Menunggu Pengajuan Berkas Pengumuman';
          } elseif ($row["StatusFP"] == 14) {
              $StatusFP = 'Validasi 1 Berkas Pengumuman';
          } elseif ($row["StatusFP"] == 15) {
              $StatusFP = 'Validasi 2 Berkas Pengumuman';
          } elseif ($row["StatusFP"] == 16) {
              $StatusFP = 'Validasi 3 Berkas Pengumuman';
          } elseif ($row["StatusFP"] == 17) {
              $StatusFP = 'Berkas Pengumuman Valid, Menunggu Pengajuan Surat Pengantar';
          } elseif ($row["StatusFP"] == 18) {
              $StatusFP = 'Menunggu Karyawan Validasi Surat Pengantar';
          } elseif ($row["StatusFP"] == 19) {
              $StatusFP = 'Menunggu Kepala Desa Validasi Surat Pengantar';
          } elseif ($row["StatusFP"] == 20) {
              $StatusFP = 'Surat Pengantar Valid, Menunggu Pengajuan Berita Acara';
          } elseif ($row["StatusFP"] == 21) {
              $StatusFP = 'Menunggu Validasi Berita Acara';
          } elseif ($row["StatusFP"] == 22) {
              $StatusFP = 'Proses Selesai';
          } elseif ($row["StatusFP"] == 31) {
                $StatusFP = 'Ada Sanggahan Surat Pengantar Oleh Kepala Desa';
          }

          if ($row["StatusTanah"] == 1) {
              $StatusTanah = 'Hak Milik';
          } else if ($row["StatusTanah"] == 2) {
              $StatusTanah = 'Hak Guna Bangunan';
          } else {
              $StatusTanah = 'Hak Pakai';
          }

          $nestedData[] = $row["ID"];
          $nestedData[] = $row["NamaKuasa"];
          $nestedData[] = $row["AlamatTanah"];
          $nestedData[] = $row["NamaPemohon"];
          $nestedData[] = $row["JenisTanahLetterC"];
          $nestedData[] = $row["LuasDaerahLetterC"].' m2';
          $nestedData[] = $StatusTanah;
          $nestedData[] = $StatusFP;
          $nestedData[] = $row["ID"];
          $data[] = $nestedData;
        }

        $json_data = array(
                  "draw"            => intval( $requestData['draw'] ),
                  "recordsTotal"    => intval( $totalData ),
                  "recordsFiltered" => intval( $totalFiltered ),
                  "data"            => $data
                  );

        echo json_encode($json_data);
    }

    public function StoreFormulirPermohonan(Request $Request) {
        $unique_id = uniqid();
        $ID = DB::table('FormulirPermohonan')->max('ID');
        $ID = $ID + 1;

        if($Request->hasFile('FileFormulirPermohonan')) {
            $IDFoto = $ID.'.jpg';
            $Request->FileFormulirPermohonan->move(public_path('foto/FormulirPermohonan'), $IDFoto);
        }

        // if($Request->hasFile('SuratWasiat')) {
        //     $IDFotoSW = $ID.'.jpg';
        //     $Request->SuratWasiat->move(public_path('foto/SuratWasiat'), $IDFotoSW);
        // }

        $FormulirPermohonan = new FormulirPermohonan(array(
            'NamaKuasa' => $Request->get('NamaKuasa'),
            'AlamatKuasa' => $Request->get('AlamatKuasa'),
            'AlamatTanah' => $Request->get('AlamatTanah'),
            'Status' => (1),
            'File' => $IDFoto,
            'IDPemohon' => $Request->session()->get('ID'),
            'IsActive' => (1)
        ));
        $FormulirPermohonan->save();

        $ID = DB::table('FormulirPermohonan')->max('ID');
        return $ID;
    }

    public function GetPengubahanFPPemohon($ID) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '1' AND FormulirPermohonan.IDPemohon = '$ID'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetPengajuanFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '1'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateValidasiPengajuanFP(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdatePengubahanFP(Request $Request) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['NamaKuasa' => $Request->get('NamaKuasa'),
                      'AlamatKuasa' => $Request->get('AlamatKuasa'),
                      'AlamatTanah' => $Request->get('AlamatTanah')]);

        if($Request->hasFile('FileFormulirPermohonan')) {
            $IDFoto = $IDFormulirPermohonan.'.jpg';
            $Request->FileFormulirPermohonan->move(public_path('foto/FormulirPermohonan'), $IDFoto);
        }
    }

    public function GetPengajuanFPPemohon($ID) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '2' AND FormulirPermohonan.IDPemohon = '$ID'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetRevisiFPPemohon($ID) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '3' AND FormulirPermohonan.IDPemohon = '$ID'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdatePembayaranFP(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetPembayaranFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '3'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateValidasiPembayaranFP(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetDisposisiFPKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '4'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateDisposisiFP(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdateJadwalUkur(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdatePembuatanGambarUkur(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdateSanggahanGambarUkur(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdateUbahGambarUkur(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdateValidasiGambarUkur(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetCreateBerkasPengumuman() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '13'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateCreateBerkasPengumuman(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetVerifikasiBerkasPengumuman() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '14' OR FormulirPermohonan.Status = '16' OR FormulirPermohonan.Status = '17' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateVerifikasiBerkasPengumuman(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetCreateSuratPengantar() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '18' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function GetEditSuratPengantar() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '21' OR FormulirPermohonan.Status = '22')";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateCreateSuratPengantar(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdateEditSuratPengantar(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetVerifikasiSuratPengantarKaryawan() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '19' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateSuratPengantarKaryawan(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetVerifikasiSuratPengantarKepalaDesa($ID) {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan ON (Persyaratan.ID = FPXP.IDPersyaratan)
                  INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
                  INNER JOIN Desa On (Pemohon.IDDesa = Desa.ID)
                  INNER JOIN KepalaDesa ON (KepalaDesa.IDDesa = Desa.ID)
                  WHERE ( FormulirPermohonan.Status = '20' ) AND KepalaDesa.ID = '$ID'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateSuratPengantarKepalaDesa(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetCreateBeritaAcara() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '23' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateCreateBeritaAcara(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetVerifikasiBeritaAcara() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE ( FormulirPermohonan.Status = '24' )";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }

    public function UpdateVerifikasiBeritaAcara(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function UpdateRisalah(Request $Request, $Status) {
        $IDFormulirPermohonan = $Request->get('IDFormulirPermohonan');
        DB::table('FormulirPermohonan')
            ->where('ID', $IDFormulirPermohonan)
            ->update(['Status' => $Status]);
    }

    public function GetUbahBerkasPengumuman() {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataFormulirPermohonan = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
                  FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
                  Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
                  Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
                  Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
                  FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
                  ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.Status = '15'";
        $HasilQueryGetDataFormulirPermohonan = mysqli_query($MySQLi, $QueryGetDataFormulirPermohonan);
        $DataFormulirPermohonan = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataFormulirPermohonan)) {
        $DataFormulirPermohonan[] = $Hasil;
        }
        return $DataFormulirPermohonan;
    }
}
