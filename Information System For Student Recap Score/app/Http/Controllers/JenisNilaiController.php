<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\JenisNilaiFormRequest;
use App\Http\Requests\JenisNilaiEditFormRequest;
use App\Http\Requests\JenisNilaiHapusFormRequest;
use App\Http\Controllers\Controller;
use App\Karyawan;
use App\JenisNilai;
use App\MataKuliahBuka;
use Carbon\Carbon;

use Auth;

class JenisNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

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
     * @param  JenisNilaiFormRequest  $request
     * @return Response
     */
    public function StoreJenisNilaiWeb(JenisNilaiFormRequest $request) // Checked V
    {
        $Check =  $request->get('CheckSemuaKP');
        $KodeMataKuliah = $request->get('namaMataKuliah');
        $Check =  $request->get('CheckSemuaKP');

        if ($Check == 1)
        {
          $KPMkBuka = $request->get('kpMkBukas');
        }
        else
        {
          $KPMkBuka = $request->get('kpMkBuka');
        }

        $JenisNilai = $request->get('jenisNilai');
        $BobotNilai = $request->get('bobotNilai');
        $NPK = $request->get('NPKDosen');
        $Status = "BelumInput";
        $Hasil = explode("|", $KPMkBuka);

        $QueryJenisNilai = new JenisNilai();
        if ($Check == 0)
        {
          $QueryJenisNilai->SimpanJenisNilai($KodeMataKuliah, $KPMkBuka, $JenisNilai, $BobotNilai, $NPK, $Status);
        }
        else
        {
          $QueryJenisNilai->SimpanJenisNilaiSemuaKP($KodeMataKuliah, $JenisNilai, $BobotNilai, $NPK, $Status, $Hasil);
        }
        return redirect('/TambahJenisNilai')->with('status', 'Jenis Penilaian telah disimpan !');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
     public function EditJenisNilaiWeb(Request $request, $KodeNilai) // Checked V
     {
         $NPK = $request->session()->get('NPK');
         $Nama = $request->session()->get('Nama');

         $QueryInformasiJenisNilai = new JenisNilai();
         $InformasiNilai = $QueryInformasiJenisNilai->GetInformasiJenisNilai($KodeNilai);

         $CheckSemesterAktif = $this->CheckBatasNAS();

         return view('JenisNilai.Edit', compact('NPK', 'Nama', 'InformasiNilai', 'CheckSemesterAktif'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return Response
      */
      public function HapusJenisNilaiWeb(Request $request, $KodeNilai)
      {
          $NPK = $request->session()->get('NPK');
          $Nama = $request->session()->get('Nama');

          $query = new JenisNilai();
          $InformasiNilai = $query->GetInformasiJenisNilai($KodeNilai);

          $CheckSemesterAktif = $this->CheckBatasNAS();

          return view('JenisNilai.Delete', compact('NPK', 'Nama', 'InformasiNilai', 'CheckSemesterAktif'));
      }


     /**
     * Update the specified resource in storage.
     *
     * @param  JenisNilaiFormRequest  $request
     * @param  int  $id
     * @return Response
     */
     public function UpdateJenisNilaiWeb(JenisNilaiEditFormRequest $request, $id) // Checked V
     {
          $KodeNilai = $request->get('kodeNilai');
          $BobotBaru = $request->get('bobotNilai');
          $JenisNilai = $request->get('JenisNilai');
          $KodeMk = $request->get('kodeMkBuka');
          $KPMk = $request->get('kpMkBuka');
          $NamaMk = $request->get('namaMkBuka');

          $queryJenisNilai = new JenisNilai();
          $queryJenisNilai->UbahBobotJenisNilai($KodeNilai, $BobotBaru, $JenisNilai, $KodeMk, $KPMk);

          return redirect(action('APIController@IndexJenisNilaiWeb'))->with('status', 'Bobot jenis nilai '. $JenisNilai .' dari mata kuliah '. $NamaMk .' KP '. $KPMk .' telah berhasil diubah!');
     }

     /**
     * Update the specified resource in storage.
     *
     * @param  JenisNilaiFormRequest  $request
     * @param  int  $id
     * @return Response
     */
     public function UpdateHapusJenisNilaiWeb(JenisNilaiHapusFormRequest $request, $id) // Checked V
     {
          $KodeNilai = $request->get('kodeNilai');
          $BobotBaru = $request->get('bobotNilai');
          $JenisNilai = $request->get('JenisNilai');
          $KodeMk = $request->get('kodeMkBuka');
          $KPMk = $request->get('kpMkBuka');
          $NamaMk = $request->get('namaMkBuka');

          $queryJenisNilai = new JenisNilai();
          $queryJenisNilai->HapusJenisNilai($KodeNilai, $JenisNilai, $KodeMk, $KPMk);

          return redirect(action('APIController@IndexHapusJenisNilaiWeb'))->with('status', 'Jenis penilaian '. $JenisNilai .' dari mata kuliah '. $NamaMk .' KP '. $KPMk .' telah berhasil dihapus!');
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
