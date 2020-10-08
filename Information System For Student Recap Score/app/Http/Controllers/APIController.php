<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Karyawan;
use App\JenisNilai;
use Input;
use Auth;
use Validator;
use Redirect;

class APIController extends Controller
{
  public function Beranda(Request $Request) // Checked V
  {
      $NPK = $Request->session()->get('NPK');
      $Nama = $Request->session()->get('Nama');

      $DosenAjarMks = $this->TampilDistinctMataKuliahDiajarWeb($NPK);
      $DosenPunyaSemesters = $this->TampilDistinctDosenPunyaSemesterWeb($NPK);

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('Beranda', compact('DosenAjarMks', 'DosenPunyaSemesters', 'NPK', 'Nama', 'CheckSemesterAktif'));
  }

  public function BerandaMahasiswa(Request $Request) // Checked V
  {
      $NRP = $Request->session()->get('NRP');
      $Nama = $Request->session()->get('Nama');

      $Semester = $Request->session()->get('Semester');
      $ThnAkademik = $Request->session()->get('ThnAkademik');

      // $Semester, $ThnAkademik
      // echo $Semester;

      $MhsAmbilMks = $this->TampilDistinctMhsAmbilMkWeb($NRP);
      $MhsPunyaSemesters = $this->TampilDistinctMhsPunyaSemesterWeb($NRP);

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('InformasiMahasiswa', compact('MhsAmbilMks', 'MhsPunyaSemesters', 'NRP', 'Nama', 'CheckSemesterAktif', 'Semester', 'ThnAkademik'));
  }

  public function BerandaMahasiswaPost(Request $Request) // Checked V
  {
      $NRP = $Request->session()->get('NRP');
      $Nama = $Request->session()->get('Nama');

      $Semester = $Request->get('Semester');
      $ThnAkademik = $Request->get('ThnAkademik');

      $Request->session()->put('Semester', $Semester);
      $Request->session()->put('ThnAkademik', $ThnAkademik);

      // $Semester, $ThnAkademik
      // echo $Semester;

      $MhsAmbilMks = $this->TampilDistinctMhsAmbilMkWeb($NRP);
      $MhsPunyaSemesters = $this->TampilDistinctMhsPunyaSemesterWeb($NRP);

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('InformasiMahasiswa', compact('MhsAmbilMks', 'MhsPunyaSemesters', 'NRP', 'Nama', 'CheckSemesterAktif', 'Semester', 'ThnAkademik'));
  }

  public function CheckBatasNAS()
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      if($ThnAkademik == "0" && $Semester == "0")
      {
          return 0;
      }
      else
      {
          return 1;
      }
  }

  public function TampilDistinctMataKuliahDiajarWeb($NPK) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);
      $QueryDosenAjarMks = "SELECT DISTINCT DosenAjarMk.KodeMkBuka AS KodeMkBuka, DosenAjarMk.KP AS KP, MataKuliah.Nama AS NamaMk, MataKuliah.SKS AS SKS, Karyawan.NPK AS NPK,
      Karyawan.Nama AS Nama FROM Karyawan LEFT JOIN DosenAjarMk ON Karyawan.NPK = DosenAjarMk.NPK LEFT JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka
      LEFT JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk WHERE Karyawan.NPK = '$NPK'";

      $HasilQueryDosenAjarMks = mysqli_query($MySQLi, $QueryDosenAjarMks);
      $DosenAjarMks = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryDosenAjarMks))
      {
        $DosenAjarMks[] = $Hasil;
      }
      return $DosenAjarMks;
  }

  public function TampilDistinctMhsAmbilMkWeb($NRP) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryMhsAmbilMks = "SELECT Mahasiswa.Nama AS Nama, MhsAmbilMk.NRP AS NRP, MhsAmbilMk.KodeMkBuka AS KodeMkBuka, MhsAmbilMk.KP AS KP, MataKuliah.Nama AS NamaMk, MataKuliah.Sks AS SKS
      FROM Mahasiswa LEFT JOIN MhsAmbilMk ON Mahasiswa.NRP = MhsAmbilMk.NRP LEFT JOIN MkBuka ON MkBuka.KodeMkBuka = MhsAmbilMk.KodeMkBuka LEFT JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk
      WHERE Mahasiswa.NRP = '$NRP' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";

      $HasilQueryMhsAmbilMks = mysqli_query($MySQLi, $QueryMhsAmbilMks);
      $MhsAmbilMks = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryMhsAmbilMks))
      {
        $MhsAmbilMks[] = $Hasil;
      }
      return $MhsAmbilMks;
  }

  public function TampilDistinctDosenPunyaSemesterWeb($NPK) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryDosenPunyaSemesters = "SELECT DISTINCT MkBuka.Semester AS 'Semester', MkBuka.ThnAkademik AS 'ThnAkademik' FROM MkBuka LEFT JOIN DosenAjarMk ON MkBuka.KodeMkBuka = DosenAjarMk.KodeMkBuka
      LEFT JOIN Karyawan ON DosenAjarMk.NPK = Karyawan.NPK WHERE Karyawan.NPK = '$NPK' ORDER BY MkBuka.ThnAkademik DESC, MkBuka.Semester DESC";

      $HasilQueryDosenPunyaSemesters = mysqli_query($MySQLi, $QueryDosenPunyaSemesters);
      $DosenPunyaSemesters = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryDosenPunyaSemesters))
      {
        $DosenPunyaSemesters[] = $Hasil;
      }
      return $DosenPunyaSemesters;
  }

  public function TampilDistinctMhsPunyaSemesterWeb($NRP) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryMhsPunyaSemesters = "SELECT DISTINCT MkBuka.Semester AS 'Semester', MkBuka.ThnAkademik AS 'ThnAkademik' FROM MkBuka LEFT JOIN MhsAmbilMk ON MkBuka.KodeMkBuka = MhsAmbilMk.KodeMkBuka
      LEFT JOIN Mahasiswa ON MhsAmbilMk.NRP = Mahasiswa.NRP WHERE Mahasiswa.NRP = '$NRP' ORDER BY MkBuka.ThnAkademik DESC, MkBuka.Semester DESC";

      $HasilQueryMhsPunyaSemesters = mysqli_query($MySQLi, $QueryMhsPunyaSemesters);
      $MhsPunyaSemesters = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryMhsPunyaSemesters))
      {
        $MhsPunyaSemesters[] = $Hasil;
      }
      return $MhsPunyaSemesters;
  }

  public function InformasiMataKuliahBuka(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $InformasiMkBukas = $this->TampilMataKuliahBukaWeb();

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('MataKuliahBuka.Index', compact('InformasiMkBukas', 'NPK', 'Nama', 'CheckSemesterAktif'));
  }

  public function TampilMataKuliahBukaWeb() // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);
      $QueryTampilMataKuliahBukas = "SELECT DosenAjarMk.NPK AS NPK, Karyawan.Nama AS Nama, DosenAjarMk.KodeMkBuka AS KodeMkBuka, DosenAjarMk.KP AS KP, MataKuliah.Nama AS NamaMk, MataKuliah.SKS AS SKS
      FROM Karyawan INNER JOIN DosenAjarMk ON Karyawan.NPK = DosenAjarMk.NPK INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk
      WHERE MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";

      $HasilQueryTampilMataKuliahBukas = mysqli_query($MySQLi, $QueryTampilMataKuliahBukas);
      $MataKuliahBukas = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryTampilMataKuliahBukas))
      {
        $MataKuliahBukas[] = $Hasil;
      }
      return $MataKuliahBukas;
  }

  public function CreateJenisNilaiWeb(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $CheckSemesterAktif = $this->CheckBatasNAS();

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $JenisNilaiDBs = $this->TampilJenisNilaiWeb();

      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      return view('JenisNilai.Create', compact('MKBukaDiajars', 'JenisNilaiDBs', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      if($ThnAkademik != "0" && $Semester != "0")
      {
          $QueryMataKuliahDiajar = "SELECT DISTINCT DosenAjarMk.KodeMkBuka AS KodeMkBuka, MataKuliah.Nama AS NamaMk, MataKuliah.SKS AS SKS, Karyawan.NPK AS NPK,
          Karyawan.Nama AS Nama FROM Karyawan INNER JOIN DosenAjarMk ON Karyawan.NPK = DosenAjarMk.NPK INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka
          INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk WHERE Karyawan.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";

          $HasilQueryMataKuliahDiajar = mysqli_query($MySQLi, $QueryMataKuliahDiajar);
          $DosenAjarMks = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryMataKuliahDiajar))
          {
            $DosenAjarMks[] = $Hasil;
          }
          return $DosenAjarMks;
      }
  }

  public function TampilJenisNilaiWeb() // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);
      $QueryJenisNilai = "SHOW COLUMNS FROM Nilai LIKE 'Jenis'";
      $HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
      $JenisNilais = array();

      while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai))
      {
        $JenisNilais[] = $Hasil;
      }
      $IsiEnum = $JenisNilais[0]['Type'];
      $SplitIsi = substr($IsiEnum, 6, -2);
      $ArrayHasil = explode("','", $SplitIsi);
      return $ArrayHasil;
  }

  public function GetNPKKaryawanWeb($ID) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);
      $QueryGetNPK = "SELECT Karyawan.NPK AS NPK FROM Karyawan WHERE Karyawan.IdUser = '$ID'";

      $HasilQueryGetNPK = mysqli_query($MySQLi, $QueryGetNPK);
      $NPKDosen = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetNPK))
      {
        $NPKDosen[] = $Hasil;
      }
      return $NPKDosen;
  }

  public function TampilDistinctMataKuliahDiAmpuWeb($NPK) // Checked V
  {
      require realpath(base_path('connection/Init.php'));
      $MySQLi = mysqli_connect($domain, $username, $password, $database);

      $QueryMataKuliahDiAmpu = "SELECT DISTINCT DosenAjarMk.KodeMkBuka AS KodeMkBuka, DosenAjarMk.KP AS KP, MataKuliah.Nama AS NamaMk, MataKuliah.SKS AS SKS, Karyawan.NPK AS NPK,
      Karyawan.Nama AS Nama FROM Karyawan INNER JOIN DosenAjarMk ON Karyawan.NPK = DosenAjarMk.NPK INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka
      INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk WHERE Karyawan.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester' AND MkBuka.NPK = '$NPK'";

      $HasilQueryMataKuliahDiAmpu = mysqli_query($MySQLi, $QueryMataKuliahDiAmpu);
      $DosenAmpuMks = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryMataKuliahDiAmpu))
      {
        $DosenAmpuMks[] = $Hasil;
      }
      return $DosenAmpuMks;
  }

  public function IndexJenisNilaiWeb(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('JenisNilai.Index', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function IndexHapusJenisNilaiWeb(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('JenisNilai.IndexHapus', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function IndexNilaiMahasiswaWeb(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('NilaiMahasiswa.Index', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function IndexUbahNilaiMahasiswaWeb(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('NilaiMahasiswa.IndexUbah', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function IndexKalkulasiNilaiMahasiswa(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('KalkulasiNilaiMahasiswa.Index', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function IndexVerifikasiNilaiMahasiswa(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('VerifikasiNilaiMahasiswa.Index', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  public function IndexUnggahNilaiMahasiswa(Request $request) // Checked V
  {
      $NPK = $request->session()->get('NPK');
      $Nama = $request->session()->get('Nama');

      $MKBukaDiajars = $this->TampilDistinctMataKuliahDiajarTanpaLihatKPWeb($NPK);
      $Reset = $MKBukaDiajars[0]['KodeMkBuka'];

      $CheckSemesterAktif = $this->CheckBatasNAS();

      return view('UnggahNilaiMahasiswa.Index', compact('MKBukaDiajars', 'NPK', 'Nama', 'Reset', 'CheckSemesterAktif'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      //
  }
}
