<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MahasiswaPunyaNilai;
use App\Http\Requests\NilaiMahasiswaFormRequest;
use App\Karyawan;
use App\JenisNilai;
use App\MataKuliahBuka;
use App\NilaiPerubahan;
use App\MahasiswaAmbilMataKuliah;
use Carbon\Carbon;

use Auth;
use Excel;

class NilaiMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

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

    public function CreateNilaiMahasiswaWeb(Request $request)  // Checked V
    {
        $NPK = $request->session()->get('NPK');
        $Nama = $request->session()->get('Nama');
        $KodeMkBuka = $request->get('namaMataKuliah');
        $KP = $request->get('KPMk');

        $KodeNilai = $request->get('kodeNilai');

        $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
        $InformasiNilaiMahasiswa = $QueryNilaiMahasiswa->TampilInformasiJenisNilaiCreateNilaiMahasiswaWeb($KodeNilai);

        $KodeMkBuka = $InformasiNilaiMahasiswa[0]->KodeMkBuka;
        $KP = $InformasiNilaiMahasiswa[0]->KP;

        // $QuerySemuaNilai = new MahasiswaPunyaNilai();
        // $InformasiSemuaNilais = $QuerySemuaNilai->GetSemuaNilaiKodeMk($KodeMkBuka, $KP);

        $QueryNamaMk = new MahasiswaPunyaNilai();
        $NamaMk = $QueryNamaMk->GetNamaMkBuka($KodeMkBuka);

        $QueryDataMahasiswa= new MahasiswaPunyaNilai();
        $InformasiDataMahasiswas = $QueryDataMahasiswa->TampilInformasiDataMahasiswaCreateNilaiMahasiswaWeb($KodeMkBuka, $KP);

        $CheckSemesterAktif = $this->CheckBatasNAS();

        return view('NilaiMahasiswa.Create', compact('NPK', 'Nama', 'CheckSemesterAktif', 'InformasiNilaiMahasiswa', 'InformasiDataMahasiswas', 'KodeMkBuka', 'NamaMk', 'KP', 'KodeNilai'));
    }

    public function ExportExcel($KodeNilai, $KodeMkBuka, $KP)
    {
        require realpath(base_path('connection/RekapNilai.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryJenisNilai = "SELECT RekapNilai.Nilai.Jenis AS 'JenisNilai'  FROM RekapNilai.Nilai
        WHERE RekapNilai.Nilai.KodeNilai = '$KodeNilai' AND RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.Nilai.KP = '$KP' AND RekapNilai.Nilai.Syarat = 1;";

        $HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
        $JenisNilai = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai))
        {
            $JenisNilai[] = $Hasil;
        }

        mysqli_close($MySQLi);

        require realpath(base_path('connection/Init.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryNamaMk = "SELECT BAAK.MataKuliah.Nama AS 'NamaMkBuka' FROM BAAK.MataKuliah INNER JOIN BAAK.MkBuka ON BAAK.MataKuliah.KodeMk = BAAK.MkBuka.KodeMk
        WHERE BAAK.MkBuka.KodeMkBuka = '$KodeMkBuka'";

        $HasilQueryNamaMk = mysqli_query($MySQLi, $QueryNamaMk);
        $NamaMk = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMk))
        {
            $NamaMk[] = $Hasil;
        }

        $PrintNamaMk = $NamaMk[0]['NamaMkBuka'];

        if ($JenisNilai[0]['JenisNilai'] == 'UTS')
        {
            $QueryGetMhsAmbilMk = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRP', BAAK.Mahasiswa.Nama AS 'Nama',
            ( CASE WHEN (BAAK.MhsAmbilMk.NRP) IN
                (   SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol'  FROM BAAK.MhsAmbilMk
                    WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP' AND BAAK.MhsAmbilMk.HadirUTS = 'N'
                ) THEN 'Tidak Hadir' ELSE '' END
            ) AS 'Nilai' FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
            WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP'";
        }
        else if ($JenisNilai[0]['JenisNilai'] == 'UAS')
        {

            $QueryGetMhsAmbilMk = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRP', BAAK.Mahasiswa.Nama AS 'Nama',
            ( CASE WHEN (BAAK.MhsAmbilMk.NRP) IN
                (   SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol' FROM BAAK.MhsAmbilMk WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka'
    			    AND BAAK.MhsAmbilMk.KP = '$KP' AND (BAAK.MhsAmbilMk.HadirUAS = 'N' || BAAK.MhsAmbilMk.StatusTilangPresensi = 'Y')
                ) THEN 'Tidak Hadir' ELSE '' END
            ) AS 'Nilai' FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
            WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP'";
        }
        else
        {
            $QueryGetMhsAmbilMk = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRP', BAAK.Mahasiswa.Nama AS 'Nama', '' AS 'Nilai'
            FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
            WHERE BAAK.MhsAmbilMk.KodeMkBuka ='$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP'";
        }

        $HasilQueryGetMhsAmbilMk = mysqli_query($MySQLi, $QueryGetMhsAmbilMk);
        $MhsAmbilMk = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetMhsAmbilMk))
        {
            $MhsAmbilMk[] = $Hasil;
        }
        $Export = $MhsAmbilMk;

        $Jenis = $JenisNilai[0]['JenisNilai'];

        Excel:: create('Nilai '.$Jenis.' '.$PrintNamaMk.' KP '.$KP, function($Excel) use($Export)
        {
            $Excel->sheet('Sheet 1', function($Sheet) use($Export){
                $Sheet->fromArray($Export);
            });
        })->export('xlsx');
    }

    public function StoreNilaiMahasiswaWeb(NilaiMahasiswaFormRequest $request)  // Checked V
    {
        $NPK = $request->session()->get('NPK');
        $Nama = $request->session()->get('Nama');

        $KodeNilai = $request->get('KodeNilai');
        $NRPMahasiswa = $request->get('NRP');
        // $NamaMahasiswa = $request->get('NamaMahasiswa');
        $NilaiMahasiswa = $request->get('Nilai');
        $namaMkBuka = $request->get('namaMkBuka');
        $KPMkBuka = $request->get('KPMkBuka');

        // print_r($NRPMahasiswa);
        // print_r($NamaMahasiswa);
        // print_r($NilaiMahasiswa);
        // echo $KodeNilai."<br/>";
        // echo $namaMkBuka."<br/>";
        // echo $KPMkBuka."<br/>";
        // echo $NPK."<br/>";
        // echo $Nama."<br/>";
        // echo"Masuk";
        // exit();

        $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
        $StoreNilaiMahasiswa = $QueryNilaiMahasiswa->SimpanNilaiMahasiswaWeb($KodeNilai, $NRPMahasiswa, $NilaiMahasiswa);

        $QueryJenisNilai = new JenisNilai();
        $UpdateStatusJenisNilai = $QueryJenisNilai->UpdateStatusJenisNilaiWeb($KodeNilai, $KPMkBuka);

        return redirect('/InputNilaiMahasiswa')->with('status', 'Nilai Mahasiswa mata kuliah '.$namaMkBuka.' kelas pararel '.$KPMkBuka.' telah disimpan !');
    }

    public function EditNilaiMahasiswaWeb(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPK');
        $Nama = $request->session()->get('Nama');

        $KodeNilai = $request->get('kodeNilai');
        $KodeMkBuka = $request->get('namaMataKuliah');
        $KP = $request->get('kpMkBuka');

        $query = new JenisNilai();
        $InformasiJenisNilai = $query->GetInformasiJenisNilai($KodeNilai);

        $QueryNamaMk = new MahasiswaPunyaNilai();
        $NamaMk = $QueryNamaMk->GetNamaMkBuka($KodeMkBuka);

        $queryNilaiMahasiswa= new MahasiswaPunyaNilai();
        $InformasiNilaiMahasiswas = $queryNilaiMahasiswa->TampilInformasiNilaiMahasiswaEditNilaiMahasiswaWeb($KodeNilai);

        $CheckSemesterAktif = $this->CheckBatasNAS();

        return view('NilaiMahasiswa.Edit', compact('NPK', 'Nama', 'CheckSemesterAktif', 'InformasiJenisNilai', 'InformasiNilaiMahasiswas', 'NamaMk', 'KP', 'KodeNilai'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  JenisNilaiFormRequest  $request
    * @param  int  $id
    * @return Response
    */
    public function UpdateNilaiMahasiswaWeb(NilaiMahasiswaFormRequest $request) // Checked V
    {
      $KodeNilai = $request->get('kodeNilai');
      $KodeMkBuka = $request->get('kodeMkBuka');
      $NamaMkBuka = $request->get('namaMkBuka');
      $KPMkBuka = $request->get('KPMkBuka');
      $BobotNilai= $request->get('BobotNilai');
      $JenisNilai = $request->get('JenisNilai');
      $WaktuBuat = $request->get('WaktuBuat');
      $DosenPembuat = $request->get('DosenPembuat');
      $NPKDosen = $request->get('NPKDosen');
      $NomorSurat= $request->get('NomorSurat');
      $TanggalSurat = $request->get('TanggalSurat');
      $Keterangan = $request->get('Keterangan');

      $NRPMahasiswa = $request->get('NRP');
      // $NamaMahasiswa = $request->get('NamaMahasiswa');
      $NilaiMahasiswaLama = $request->get('NilaiLama');
      $KodeNisbiLama = $request->get('KodeNisbiLama');
      $NilaiMahasiswaBaru = $request->get('Nilai');

      $KodeNisbiMahasiswaBaru = array();
      $KodeNisbi;

      for ($i=0; $i < count($NilaiMahasiswaBaru); $i++)
      {
          if ($NilaiMahasiswaBaru[$i] >= 81 && $NilaiMahasiswaBaru[$i] <= 100)
          {
              $KodeNisbi = "A";
          }
          else if ($NilaiMahasiswaBaru[$i] >= 73 && $NilaiMahasiswaBaru[$i] <= 80)
          {
              $KodeNisbi = "AB";
          }
          else if ($NilaiMahasiswaBaru[$i] >= 66 && $NilaiMahasiswaBaru[$i] <= 72)
          {
              $KodeNisbi = "B";
          }
          else if ($NilaiMahasiswaBaru[$i] >= 60 && $NilaiMahasiswaBaru[$i] <= 65)
          {
              $KodeNisbi = "BC";
          }
          else if ($NilaiMahasiswaBaru[$i] >= 55 && $NilaiMahasiswaBaru[$i] <= 59)
          {
              $KodeNisbi = "C";
          }
          else if ($NilaiMahasiswaBaru[$i] >= 40 && $NilaiMahasiswaBaru[$i] <= 54)
          {
              $KodeNisbi = "D";
          }
          else if ($NilaiMahasiswaBaru[$i] >= 0 && $NilaiMahasiswaBaru[$i] <= 40)
          {
              $KodeNisbi = "E";
          }
          $KodeNisbiMahasiswaBaru[$i] = $KodeNisbi;
      }

      $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
      $QueryNilaiMahasiswa->UbahNilaiMahasiswaWeb($KodeNilai, $NRPMahasiswa, $NilaiMahasiswaLama, $KodeNisbiLama, $NilaiMahasiswaBaru, $KodeNisbiMahasiswaBaru, $KodeMkBuka, $KPMkBuka, $TanggalSurat, $NomorSurat, $Keterangan, $NPKDosen);

      $QueryNilaiPerubahan = new NilaiPerubahan();
      $QueryNilaiPerubahan->SimpanNilaiPerubahanWeb($KodeNilai, $NRPMahasiswa, $NilaiMahasiswaLama, $KodeNisbiLama, $NilaiMahasiswaBaru, $KodeNisbiMahasiswaBaru, $KodeMkBuka, $KPMkBuka, $TanggalSurat, $NomorSurat, $Keterangan, $NPKDosen);

      return redirect(action('APIController@IndexUbahNilaiMahasiswaWeb'))->with('status', 'Nilai mahasiswa telah berhasil diubah !');
    }

    public function IndexHasilKalkulasiNilaiMahasiswa(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPK');
        $Nama = $request->session()->get('Nama');

        $KodeKalkulasi = $request->get('KodeKalkulasi');

        $KodeMk = $request->get('namaMataKuliah');

        $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
        $NamaMkBuka = $QueryNilaiMahasiswa->GetNamaMkBuka($KodeMk);
        $NamaMk = $NamaMkBuka[0]['NamaMkBuka'];
        $KP = $request->get('KPMk');

        $PersentaseNTS = $request->get('PersentaseNTS');
        $PersentaseNAS = 100 - $PersentaseNTS;

        $CheckSemesterAktif = $this->CheckBatasNAS();

        return view('KalkulasiNilaiMahasiswa.IndexHasilKalkulasi', compact('KodeMk', 'NamaMk', 'CheckSemesterAktif', 'KP', 'NPK', 'Nama', 'PersentaseNTS', 'PersentaseNAS', 'KodeKalkulasi'));
    }

    public function StoreNilaiAkhirMahasiswa(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPKDosen');

        $KodeMkBuka = $request->get('KodeMk');
        $NamaMk = $request->get('NamaMk');
        $KPMkBuka = $request->get('KPMkBuka');

        $NRPMahasiswa = $request->get('NRP');
        $KodeKalkulasi = $request->get('KodeKalkulasi');

        if ($KodeKalkulasi == 1)
        {
            $NTSNASMahasiswa = $request->get('NTS');
            $NTSNASKodeNisbi = $request->get('KodeNisbiNTS');
        }
        else
        {
            $NTSNASMahasiswa = $request->get('NAS');
            $NTSNASKodeNisbi = $request->get('KodeNisbiNAS');
        }

        $QueryMahasiswaAmbilMataKuliah = new MahasiswaAmbilMataKuliah();
        $StoreNilaiAkhirMahasiswa = $QueryMahasiswaAmbilMataKuliah->SimpanNilaiAkhirMahasiswaWeb($KodeMkBuka, $NamaMk, $KPMkBuka, $NRPMahasiswa, $KodeKalkulasi, $NTSNASMahasiswa, $NTSNASKodeNisbi);

        $QueryJenisNilai = new JenisNilai();
        $UpdateStatusKalkulasiJenisNilai = $QueryJenisNilai->UpdateStatusKalkulasiJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $KodeKalkulasi);

        return redirect('/InformasiKalkulasiNilaiMahasiswa')->with('status', 'Nilai Mahasiswa mata kuliah '.$NamaMk.' kelas pararel '.$KPMkBuka.' telah disimpan !');
    }

    public function IndexHasilVerifikasiNilaiMahasiswa(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPK');
        $Nama = $request->session()->get('Nama');

        $KodeVerifikasi = $request->get('KodeVerifikasi');

        $KodeMk = $request->get('namaMataKuliah');

        $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
        $NamaMkBuka = $QueryNilaiMahasiswa->GetNamaMkBuka($KodeMk);

        $NamaMk = $NamaMkBuka[0]['NamaMkBuka'];
        $KP = $request->get('KPMk');

        $CheckSemesterAktif = $this->CheckBatasNAS();

        return view('VerifikasiNilaiMahasiswa.IndexHasilVerifikasi', compact('KodeMk', 'NamaMk', 'CheckSemesterAktif', 'KP', 'NPK', 'Nama', 'KodeVerifikasi'));
    }

    public function StoreVerifikasiNilaiMahasiswa(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPKDosen');

        $KodeMkBuka = $request->get('KodeMk');
        $NamaMk = $request->get('NamaMk');
        $KPMkBuka = $request->get('KPMkBuka');

        $KodeVerifikasi = $request->get('KodeVerifikasi');

        // echo $KodeVerifikasi;
        // exit();

        $QueryJenisNilai = new JenisNilai();
        $UpdateStatusVerifikasiJenisNilaiWeb = $QueryJenisNilai->UpdateStatusVerifikasiJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $KodeVerifikasi);

        return redirect('/InformasiVerifikasiNilaiMahasiswa')->with('status', 'Nilai Mahasiswa mata kuliah '.$NamaMk.' kelas pararel '.$KPMkBuka.' telah diverifikasi !');
    }

    public function IndexHasilUnggahNilaiMahasiswa(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPK');
        $Nama = $request->session()->get('Nama');

        $KodeUnggah = $request->get('KodeUnggah');

        $KodeMk = $request->get('namaMataKuliah');

        $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
        $NamaMkBuka = $QueryNilaiMahasiswa->GetNamaMkBuka($KodeMk);

        $NamaMk = $NamaMkBuka[0]['NamaMkBuka'];
        $KP = $request->get('KPMk');

        $CheckSemesterAktif = $this->CheckBatasNAS();

        return view('UnggahNilaiMahasiswa.IndexHasilUnggah', compact('KodeMk', 'NamaMk', 'CheckSemesterAktif', 'KP', 'NPK', 'Nama', 'KodeUnggah'));
    }

    public function StoreUnggahNilaiMahasiswa(Request $request) // Checked V
    {
        $NPK = $request->session()->get('NPK');

        $KodeMkBuka = $request->get('KodeMk');
        $NamaMk = $request->get('NamaMk');
        $KPMkBuka = $request->get('KPMkBuka');

        $KodeUnggah = $request->get('KodeUnggah');

        $QueryUnggahNilaiMahasiswa = new MahasiswaPunyaNilai();
        $HasilQueryUnggahNilaiMahasiswa = $QueryUnggahNilaiMahasiswa->UnggahMyUbayaJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $NPK, $KodeUnggah);

        $QueryJenisNilai = new JenisNilai();
        $UpdateStatusUnggahJenisNilai = $QueryJenisNilai->UpdateStatusUnggahJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $KodeUnggah);

        return redirect('/InformasiUnggahNilaiMahasiswa')->with('status', 'Nilai Mahasiswa mata kuliah '.$NamaMk.' kelas pararel '.$KPMkBuka.' telah diunggah !');
    }

    public function Upload()
    {
        // echo $_POST['namanya'];
        // $HasilLempar = json_decode($_POST['namanya'],true);
        // print_r($HasilLempar);
         echo "something";
        // exit();
        // $QueryNilaiMahasiswa = new MahasiswaPunyaNilai();
        // $StoreNilaiMahasiswa = $QueryNilaiMahasiswa->SimpanNilaiMahasiswaAndroid($HasilLempar);

        // $QueryJenisNilai = new JenisNilai();
        // $UpdateStatusJenisNilai = $QueryJenisNilai->UpdateStatusJenisNilaiAndroid($HasilLempar);

        // return redirect('/InputNilaiMahasiswa')->with('status', 'Nilai Mahasiswa mata kuliah '.$namaMkBuka.' kelas pararel '.$KPMkBuka.' telah disimpan !');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NilaiMahasiswaFormRequest  $request
     * @return Response
     */
    public function store(NilaiMahasiswaFormRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id,$NRP)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NilaiMahasiswaFormRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(NilaiMahasiswaFormRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
