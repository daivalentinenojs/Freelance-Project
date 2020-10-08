<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Auth;

use App\MahasiswaPunyaNilai;
use App\MataKuliahBuka;
use App\Karyawan;
use App\JenisNilai;
use Carbon\Carbon;

class JenisNilai extends Model
{
    use Authenticatable, CanResetPassword;

    protected $table = 'Nilai';
    protected $guarded = ['KodeNilai'];
    protected $fillable = ['KodeNilai', 'KodeMkBuka', 'KP', 'Jenis', 'Bobot', 'WaktuBuat', 'WaktuValidasiDosen', 'WaktuValidasiAdmik', 'DosenPembuat', 'AdmikValidator', 'Status', 'Syarat'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function NilaiDiPunyaiNilaiMahasiswa()
    {
        return $this->hasMany('App\MahasiswaPunyaNilai','KodeNilai','KodeNilai');
    }

    public function NilaiDiPunyaiMkBuka()
    {
        return $this->hasOne('App\MataKuliahBuka','KodeMkBuka','KodeMkBuka');
    }

    public function NilaiDiBuatDosen()
    {
    	return $this->hasOne('App\Karyawan','NPK','DosenPembuat');
    }

    public function CheckUTSMkBuka($Kode, $Jenis) // Checked V
    {
        if ($Jenis == "UTS" || $Jenis == "UAS")
        {
            $QueryUTSUASAda = "SELECT Count(Nilai.KodeNilai) AS 'Jumlah' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.Jenis Like '$Jenis' Group By Nilai.KodeMkBuka";
            $HasilQueryUTSUASAda = $MySQLi->query($QueryUTSUASAda);
            $Hasil=$HasilQueryUTSUASAda->fetch_assoc();
        }
        return $Hasil['Jumlah'];
    }

    public function SimpanJenisNilai($KodeMataKuliah, $KPMkBuka, $JenisNilai, $BobotNilai, $NPK, $Status) // Checked V
    {
        if($JenisNilai == "QuizUTS" || $JenisNilai == "KeaktifanUTS" || $JenisNilai == "ProyekUTS" || $JenisNilai == "UTS" || $JenisNilai == "TugasUTS" | $JenisNilai == "NTS")
        {
            $KodeUTSUAS = "T";
        }
        else
        {
            $KodeUTSUAS = "A";
        }

        $TempKP = "";
        if(strlen($KPMkBuka) == 1)
        {
            $TempKP = "0".$KPMkBuka;
        }
        else
        {
            $TempKP = $KPMkBuka;
        }

        $KodeSementara = $KodeMataKuliah.$TempKP.$KodeUTSUAS;

        if(strlen($KodeSementara) < 18)
        {
          $JumlahNol = "";
          for ($i=0; $i < (18 - strlen($KodeSementara)); $i++) {
            $JumlahNol .= "0";
          }
          $KodeSementara = $JumlahNol.$KodeSementara;
        }

        require realpath(base_path('connection/RekapNilai.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryMaxKodeNilai= "SELECT MAX(Nilai.KodeNilai) AS 'MaxKodeNilai' FROM Nilai WHERE Nilai.KodeNilai LIKE '$KodeSementara%'";

        $HasilQueryMaxKodeNilai = mysqli_query($MySQLi, $QueryMaxKodeNilai);
        $MaxKodeNilai = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryMaxKodeNilai))
        {
          $MaxKodeNilai[] = $Hasil;
        }

        $Max = $MaxKodeNilai[0]['MaxKodeNilai'];

        if(empty($Max))
        {
            $DigitAkhir = "001";
            $KodeAkhir = $KodeSementara.$DigitAkhir;
        }
        else
        {
            $QueryKodeNilaiBaru = "SELECT right(Nilai.KodeNilai,3) AS 'DigitAkhir' FROM Nilai WHERE Nilai.KodeNilai = '$Max'";
            $HasilQueryKodeNilaiBaru = mysqli_query($MySQLi, $QueryKodeNilaiBaru);
            $KodeBaru = array();
            while($KodeBaru = mysqli_fetch_assoc($HasilQueryKodeNilaiBaru))
            {
              $KodeTambahan[] = $KodeBaru;
            }
            $TempDigit = $KodeTambahan[0]['DigitAkhir'];
            $Temp = $TempDigit+1;

            if($Temp < 10)
            {
                $Tambahan = "00".$Temp;
            }
            else if ($Temp < 100)
            {
                $Tambahan = "0".$Temp;
            }
            else
            {
                $Tambahan = $Temp;
            }

            $KodeAkhir = $KodeSementara.$Tambahan;
        }

        if(strlen($KodeAkhir) < 21)
        {
          $JumlahNol = "";
          for ($i=0; $i < (21 - strlen($KodeAkhir)); $i++) {
            $JumlahNol .= "0";
          }
          $KodeAkhir = $JumlahNol.$KodeAkhir;
        }

        $JenisNilai = new JenisNilai(array(
            'KodeNilai' => $KodeAkhir,
            'KodeMkBuka' => $KodeMataKuliah,
            'KP' => $KPMkBuka,
            'Jenis' => $JenisNilai,
            'Syarat' => (1),
            'Bobot' => $BobotNilai,
            'WaktuBuat' => Date("Y-m-d"),
            'DosenPembuat' => $NPK,
            'Status' => $Status,
        ));
        $JenisNilai->save();
    }

    public function SimpanJenisNilaiSemuaKP($KodeMataKuliah, $JenisNilai, $BobotNilai, $NPK, $Status, $KP) // Checked V
    {
          for ($i=0; $i < (count($KP) - 1); $i++)
          {
              if($JenisNilai == "QuizUTS" || $JenisNilai == "KeaktifanUTS" || $JenisNilai == "ProyekUTS" || $JenisNilai == "UTS" || $JenisNilai == "TugasUTS" | $JenisNilai == "NTS")
              {
                  $KodeUTSUAS = "T";
              }
              else
              {
                  $KodeUTSUAS = "A";
              }

              $TempKP = "";
              if(strlen($KP[$i]) == 1)
              {
                  $TempKP = "0".$KP[$i];
              }
              else
              {
                  $TempKP = $KP[$i];
              }

              $KodeSementara = $KodeMataKuliah.$TempKP.$KodeUTSUAS;

              if(strlen($KodeSementara) < 18)
              {
                $JumlahNol = "";
                for ($k=0; $k < (18 - strlen($KodeSementara)); $k++) {
                  $JumlahNol .= "0";
                }
                $KodeSementara = $JumlahNol.$KodeSementara;
              }

              require realpath(base_path('connection/RekapNilai.php'));
              $MySQLi = mysqli_connect($domain, $username, $password, $database);

              $QueryMaxKodeNilai= "SELECT MAX(Nilai.KodeNilai) AS 'MaxKodeNilai' FROM Nilai WHERE Nilai.KodeNilai LIKE '$KodeSementara%'";

              $HasilQueryMaxKodeNilai = mysqli_query($MySQLi, $QueryMaxKodeNilai);
              $MaxKodeNilai = array();
              while($Hasil = mysqli_fetch_assoc($HasilQueryMaxKodeNilai))
              {
                $MaxKodeNilai[] = $Hasil;
              }

              $Max = $MaxKodeNilai[0]['MaxKodeNilai'];

              if(empty($Max))
              {
                  $DigitAkhir = "001";
                  $KodeAkhir = $KodeSementara.$DigitAkhir;
              }
              else
              {
                  $TambahanKodeTigaDigit = substr($Max,-3);
                  $Temp = $TambahanKodeTigaDigit+1;
                  if($Temp < 10)
                  {
                      $Tambahan = "00".$Temp;
                  }
                  else if ($Temp < 100)
                  {
                      $Tambahan = "0".$Temp;
                  }
                  else
                  {
                      $Tambahan = $Temp;
                  }
                  $KodeAkhir = $KodeSementara.$Tambahan;
              }

              if(strlen($KodeAkhir) < 21)
              {
                $JumlahNol = "";
                for ($j=0; $j < (21 - strlen($KodeAkhir)); $j++)
                {
                  $JumlahNol .= "0";
                }
                $KodeAkhir = $JumlahNol.$KodeAkhir;
              }

              $JenisNilais = new JenisNilai(array(
                  'KodeNilai' => $KodeAkhir,
                  'KodeMkBuka' => $KodeMataKuliah,
                  'KP' => $KP[$i],
                  'Jenis' => $JenisNilai,
                  'Bobot' => $BobotNilai,
                  'Syarat' => (1),
                  'WaktuBuat' => Date("Y-m-d"),
                  'DosenPembuat' => $NPK,
                  'Status' => $Status,
                  ));
              $JenisNilais->save();
        }
    }

    public function GetInformasiJenisNilai($KodeNilai) // Checked V
    {
        $InformasiNilai = DB::table('nilai')
          ->select('Nilai.KodeNilai AS KodeNilai', 'Nilai.KodeMkBuka AS KodeMk', 'Nilai.KP AS KP', 'Nilai.KodeMkBuka AS NamaMk', 'Nilai.Jenis AS Jenis', 'Nilai.Bobot AS Bobot', 'Nilai.WaktuBuat AS WaktuBuat', 'Nilai.DosenPembuat AS DosenPembuat', 'Nilai.DosenPembuat AS NamaDosen', 'Nilai.Status AS Status')
          ->where('Nilai.KodeNilai', '=', $KodeNilai)
          ->get();

        $Date = date_create($InformasiNilai[0]->WaktuBuat);
      	$InformasiNilai[0]->WaktuBuat = date_format($Date, "d F Y");
        $Temp = $InformasiNilai[0]->KodeMk;

        require realpath(base_path('connection/Init.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryMataKuliah = "SELECT MataKuliah.Nama AS 'Nama' FROM MataKuliah INNER JOIN MkBuka ON MataKuliah.KodeMk = MkBuka.KodeMk WHERE MkBuka.KodeMkBuka = '$Temp'";
        $HasilQueryMataKuliah = mysqli_query($MySQLi, $QueryMataKuliah);
        $NamaMataKuliah = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryMataKuliah))
        {
          $NamaMataKuliah[] = $Hasil;
        }

        $InformasiNilai[0]->NamaMk = $NamaMataKuliah[0]['Nama'];

        $Temp = $InformasiNilai[0]->DosenPembuat;

        $QueryDosen = "SELECT Karyawan.Nama AS 'NamaKaryawan' FROM Karyawan WHERE Karyawan.NPK = '$Temp'";
        $HasilQueryDosen = mysqli_query($MySQLi, $QueryDosen);
        $NamaDosen = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryDosen))
        {
          $NamaDosen[] = $Hasil;
        }

        $InformasiNilai[0]->NamaDosen = $NamaDosen[0]['NamaKaryawan'];

        mysqli_close($MySQLi);

        return $InformasiNilai;
    }

    public function UbahBobotJenisNilai($KodeNilai, $BobotBaru, $JenisNilai, $KodeMk, $KPMk) // Checked V
    {
        DB::table('Nilai')
            ->where('KodeNilai', $KodeNilai)
            ->where('Jenis', $JenisNilai)
            ->where('KodeMkBuka', $KodeMk)
            ->where('KP', $KPMk)
            ->update(['Bobot' => $BobotBaru]);
    }

    public function HapusJenisNilai($KodeNilai, $JenisNilai, $KodeMk, $KPMk) // Checked V
    {
        DB::table('Nilai')
            ->where('KodeNilai', $KodeNilai)
            ->where('Jenis', $JenisNilai)
            ->where('KodeMkBuka', $KodeMk)
            ->where('KP', $KPMk)
            ->update(['Syarat' => 0]);
    }

    public function UpdateStatusJenisNilaiWeb($KodeNilai, $KPMkBuka) // Checked V
    {
        DB::table('Nilai')
            ->where('KodeNilai', $KodeNilai)
            ->where('KP', $KPMkBuka)
            ->update(['Status' => 'Daftar']);
    }

    public function UpdateStatusKalkulasiJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $KodeKalkulasi) // Checked V
    {
        require '../connection/RekapNilai.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        if ($KodeKalkulasi == 1)
        {
            $QueryJenisNilaiUTS = "SELECT Nilai.KodeNilai AS 'KodeNilaiUTS'
            FROM Nilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND right(Nilai.Jenis,3) = 'UTS'";

            $HasilQueryJenisNilaiUTS = mysqli_query($MySQLi, $QueryJenisNilaiUTS);
            $JenisNilaiUTS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiUTS))
            {
                $JenisNilaiUTS[] = $Hasil;
            }

            // print_r($JenisNilaiUTS);
            for ($i=0; $i < count($JenisNilaiUTS); $i++)
            {
                DB::table('Nilai')
                    ->where('KodeMkBuka', $KodeMkBuka)
                    ->where('KP', $KPMkBuka)
                    ->where('KodeNilai', $JenisNilaiUTS[$i]['KodeNilaiUTS'])
                    ->update(['Status' => 'TelahDiKalkulasi']);
            }
        }
        else
        {
            $QueryJenisNilaiUAS = "SELECT Nilai.KodeNilai AS 'KodeNilaiUAS'
            FROM Nilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND right(Nilai.Jenis,3) = 'UAS'";

            $HasilQueryJenisNilaiUAS = mysqli_query($MySQLi, $QueryJenisNilaiUAS);
            $JenisNilaiUAS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiUAS))
            {
                $JenisNilaiUAS[] = $Hasil;
            }

            // print_r($JenisNilaiUAS);
            for ($i=0; $i < count($JenisNilaiUAS); $i++)
            {
                DB::table('Nilai')
                    ->where('KodeMkBuka', $KodeMkBuka)
                    ->where('KP', $KPMkBuka)
                    ->where('KodeNilai', $JenisNilaiUAS[$i]['KodeNilaiUAS'])
                    ->update(['Status' => 'TelahDiKalkulasi']);
            }
        }
        mysqli_close($MySQLi);
    }

    public function UpdateStatusVerifikasiJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $KodeVerifikasi) // Checked V
    {
        require '../connection/RekapNilai.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        if ($KodeVerifikasi == 1)
        {
            $QueryJenisNilaiUTS = "SELECT Nilai.KodeNilai AS 'KodeNilaiUTS'
            FROM Nilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND right(Nilai.Jenis,3) = 'UTS'";

            $HasilQueryJenisNilaiUTS = mysqli_query($MySQLi, $QueryJenisNilaiUTS);
            $JenisNilaiUTS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiUTS))
            {
                $JenisNilaiUTS[] = $Hasil;
            }

            // print_r($JenisNilaiUTS);
            for ($i=0; $i < count($JenisNilaiUTS); $i++)
            {
                DB::table('Nilai')
                    ->where('KodeMkBuka', $KodeMkBuka)
                    ->where('KP', $KPMkBuka)
                    ->where('KodeNilai', $JenisNilaiUTS[$i]['KodeNilaiUTS'])
                    ->update(['Status' => 'SiapUpload']);
            }
        }
        else
        {
            $QueryJenisNilaiUAS = "SELECT Nilai.KodeNilai AS 'KodeNilaiUAS'
            FROM Nilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND right(Nilai.Jenis,3) = 'UAS'";

            $HasilQueryJenisNilaiUAS = mysqli_query($MySQLi, $QueryJenisNilaiUAS);
            $JenisNilaiUAS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiUAS))
            {
                $JenisNilaiUAS[] = $Hasil;
            }

            // print_r($JenisNilaiUAS);
            for ($i=0; $i < count($JenisNilaiUAS); $i++)
            {
                DB::table('Nilai')
                    ->where('KodeMkBuka', $KodeMkBuka)
                    ->where('KP', $KPMkBuka)
                    ->where('KodeNilai', $JenisNilaiUAS[$i]['KodeNilaiUAS'])
                    ->update(['Status' => 'SiapUpload']);
            }
        }
        mysqli_close($MySQLi);

        // DB::table('Nilai')
        //     ->where('KodeMkBuka', $KodeMkBuka)
        //     ->where('KP', $KPMkBuka)
        //     ->update(['Status' => 'SiapUpload']);
    }

    public function UpdateStatusUnggahJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $KodeUnggah) // Checked V
    {
        $WaktuSekarang = Date("Y-m-d");

        require '../connection/RekapNilai.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        if ($KodeUnggah == 1)
        {
            $QueryJenisNilaiUTS = "SELECT Nilai.KodeNilai AS 'KodeNilaiUTS'
            FROM Nilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND right(Nilai.Jenis,3) = 'UTS'";

            $HasilQueryJenisNilaiUTS = mysqli_query($MySQLi, $QueryJenisNilaiUTS);
            $JenisNilaiUTS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiUTS))
            {
                $JenisNilaiUTS[] = $Hasil;
            }

            // print_r($JenisNilaiUTS);
            for ($i=0; $i < count($JenisNilaiUTS); $i++)
            {
                DB::table('Nilai')
                    ->where('KodeMkBuka', $KodeMkBuka)
                    ->where('KP', $KPMkBuka)
                    ->where('KodeNilai', $JenisNilaiUTS[$i]['KodeNilaiUTS'])
                    ->update(['Status' => 'TelahDiUpload']);
            }
        }
        else
        {
            $QueryJenisNilaiUAS = "SELECT Nilai.KodeNilai AS 'KodeNilaiUAS'
            FROM Nilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND right(Nilai.Jenis,3) = 'UAS'";

            $HasilQueryJenisNilaiUAS = mysqli_query($MySQLi, $QueryJenisNilaiUAS);
            $JenisNilaiUAS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiUAS))
            {
                $JenisNilaiUAS[] = $Hasil;
            }

            // print_r($JenisNilaiUAS);
            for ($i=0; $i < count($JenisNilaiUAS); $i++)
            {
                DB::table('Nilai')
                    ->where('KodeMkBuka', $KodeMkBuka)
                    ->where('KP', $KPMkBuka)
                    ->where('KodeNilai', $JenisNilaiUAS[$i]['KodeNilaiUAS'])
                    ->update(['Status' => 'TelahDiUpload']);
            }
        }
        mysqli_close($MySQLi);

        // DB::table('Nilai')
        //     ->where('KodeMkBuka', $KodeMkBuka)
        //     ->where('KP', $KPMkBuka)
        //     ->update(['Status' => 'TelahDiUpload', 'WaktuValidasiDosen' => '$WaktuSekarang']);
    }

    public function UpdateStatusJenisNilaiAndroid($Hasil) // Checked V
    {
        DB::table('Nilai')
            ->where('KodeNilai', $KodeNilai)
            ->where('KP', $KPMkBuka)
            ->update(['Status' => 'Daftar']);
    }
}
