<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\Mahasiswa;
use App\JenisNilai;
use App\MahasiswaPunyaNilai;

class MahasiswaPunyaNilai extends Model
{
	use Authenticatable, CanResetPassword;

  protected $table = 'NilaiMahasiswa';
	protected $guarded = ['KodeNilai', 'NRP'];
	protected $fillable = ['KodeNilai', 'NRP', 'Nilai', 'KodeNisbi'];

		/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



    public function NilaiMhsDiPunyaiMhs()
    {
        return $this->hasOne('App\Mahasiswa','NRP','NRP');
    }

    public function NilaiMhsDiPunyaiNilai()
    {
        return $this->hasOne('App\JenisNilai','KodeNilai','KodeNilai');
    }

		public function TampilInformasiJenisNilaiCreateNilaiMahasiswaWeb($KodeNilai) // Checked V
    {
				$InformasiNilai = DB::table('Nilai')
          ->select('Nilai.KodeMkBuka AS KodeMkBuka', 'Nilai.KodeMkBuka AS NamaMkBuka', 'Nilai.KP AS KP', 'Nilai.Jenis AS Jenis', 'Nilai.Bobot AS Bobot', 'Nilai.WaktuBuat AS WaktuBuat',
	        'Nilai.DosenPembuat AS NPK', 'Nilai.DosenPembuat AS NamaDosen')
          ->where('Nilai.KodeNilai', '=', $KodeNilai)
          ->get();

				$Temp = $InformasiNilai[0]->KodeMkBuka;

        require realpath(base_path('connection/Init.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetNamaMk = "SELECT MataKuliah.Nama AS NamaMk FROM MkBuka INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk WHERE MkBuka.KodeMkBuka = '$Temp'";
        $HasilQueryGetNamaMk = mysqli_query($MySQLi, $QueryGetNamaMk);
        $NamaMk = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetNamaMk))
        {
          $NamaMk[] = $Hasil;
        }

        $InformasiNilai[0]->NamaMkBuka = $NamaMk[0]['NamaMk'];

				$QueryGetNamaKaryawan = "SELECT Karyawan.Nama AS NamaKaryawan FROM DosenAjarMk INNER JOIN Karyawan ON DosenAjarMk.NPK = Karyawan.NPK WHERE DosenAjarMk.KodeMkBuka = '$Temp'";
				$HasilQueryGetNamaKaryawan = mysqli_query($MySQLi, $QueryGetNamaKaryawan);
				$NamaKaryawan = array();
				while($Hasil = mysqli_fetch_assoc($HasilQueryGetNamaKaryawan))
				{
					$NamaKaryawan[] = $Hasil;
				}

				$InformasiNilai[0]->NamaDosen = $NamaKaryawan[0]['NamaKaryawan'];

				$Date = date_create($InformasiNilai[0]->WaktuBuat);
				$InformasiNilai[0]->WaktuBuat = date_format($Date, "d F Y");

        return $InformasiNilai;
    }

    public function GetSemuaNilaiKodeMk($KodeMkBuka, $KP) // Checked V
    {
        require realpath(base_path('connection/RekapNilai.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetSemuaNilai = "SELECT Nilai.KodeNilai AS KodeNilai, Nilai.Jenis AS NamaNilai, Nilai.Bobot AS Bobot, Nilai.WaktuBuat AS WaktuBuat FROM Nilai WHERE Nilai.KodeMkBuka ='$KodeMkBuka' AND Nilai.KP = '$KP'";
        $HasilQueryGetSemuaNilai = mysqli_query($MySQLi, $QueryGetSemuaNilai);
        $DataMahasiswa = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetSemuaNilai))
        {
          $DataMahasiswa[] = $Hasil;
        }

        return $DataMahasiswa;
    }

    public function GetNamaMkBuka($KodeMkBuka) // Checked V
    {
        require realpath(base_path('connection/Init.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetNamaMk = "SELECT MataKuliah.Nama AS NamaMkBuka FROM MkBuka INNER JOIN MataKuliah ON MataKuliah.KodeMk = MkBuka.KodeMk WHERE MkBuka.KodeMkBuka ='$KodeMkBuka'";
        $HasilQueryGetNamaMk = mysqli_query($MySQLi, $QueryGetNamaMk);
        $NamaMk = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetNamaMk))
        {
          $NamaMk[] = $Hasil;
        }

        return $NamaMk;
    }

		public function TampilInformasiDataMahasiswaCreateNilaiMahasiswaWeb($KodeMkBuka, $KP) // Checked V
    {
				require realpath(base_path('connection/Init.php'));
				$MySQLi = mysqli_connect($domain, $username, $password, $database);

		    $QueryDataMahasiswa = "SELECT mahasiswa.NRP AS NRP, mahasiswa.Nama AS NamaMahasiswa FROM mahasiswa INNER JOIN mhsambilmk ON mahasiswa.NRP = mhsambilmk.NRP WHERE mhsambilmk.KodeMkBuka ='$KodeMkBuka' AND mhsambilmk.KP = '$KP'";
        $HasilQueryDataMahasiswa = mysqli_query($MySQLi, $QueryDataMahasiswa);
        $DataMahasiswa = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryDataMahasiswa))
        {
          $DataMahasiswa[] = $Hasil;
        }

        return $DataMahasiswa;
    }

		public function SimpanNilaiMahasiswaWeb($KodeNilai, $NRPMahasiswa, $NilaiMahasiswa) // Checked V
    {
      	for ($i=0; $i < count($NRPMahasiswa); $i++)
        {
						if ($NilaiMahasiswa[$i] >= 81 && $NilaiMahasiswa[$i] <= 100)
            {
								$KodeNisbi = "A";
						}
            else if ($NilaiMahasiswa[$i] >= 73 && $NilaiMahasiswa[$i] < 81)
            {
								$KodeNisbi = "AB";
						}
            else if ($NilaiMahasiswa[$i] >= 66 && $NilaiMahasiswa[$i] < 73)
            {
								$KodeNisbi = "B";
						}
            else if ($NilaiMahasiswa[$i] >= 60 && $NilaiMahasiswa[$i] < 66)
            {
								$KodeNisbi = "BC";
						}
            else if ($NilaiMahasiswa[$i] >= 55 && $NilaiMahasiswa[$i] < 60)
            {
								$KodeNisbi = "C";
						}
            else if ($NilaiMahasiswa[$i] >= 40 && $NilaiMahasiswa[$i] < 55)
            {
								$KodeNisbi = "D";
						}
            else if ($NilaiMahasiswa[$i] >= 0 && $NilaiMahasiswa[$i] < 40)
            {
								$KodeNisbi = "E";
						}

						$MahasiswaPunyaNilai = new MahasiswaPunyaNilai(array(
								'KodeNilai' => $KodeNilai,
								'NRP' => $NRPMahasiswa[$i],
								'Nilai' => $NilaiMahasiswa[$i],
								'KodeNisbi' => $KodeNisbi,
								));
						$MahasiswaPunyaNilai->save();
      	}
    }

		public function TampilInformasiNilaiMahasiswaEditNilaiMahasiswaWeb($KodeNilai) // Checked V
    {
				$InformasiNilai = DB::table('nilaimahasiswa')
					->select('nilaimahasiswa.KodeNilai AS KodeNilai', 'nilaimahasiswa.NRP AS NRP', 'nilaimahasiswa.NRP AS NamaMahasiswa', 'nilaimahasiswa.Nilai AS NilaiMahasiswaLama', 'nilaimahasiswa.KodeNisbi AS KodeNisbiMahasiswaLama')
					->where('nilaimahasiswa.KodeNilai', '=', $KodeNilai)
					->get();

				require realpath(base_path('connection/Init.php'));
				$MySQLi = mysqli_connect($domain, $username, $password, $database);

				for ($i=0; $i < count($InformasiNilai); $i++) {
						$Temp = $InformasiNilai[$i]->NRP;

						$QueryNRPMahasiswa = "SELECT mahasiswa.NRP AS NRP, mahasiswa.Nama AS NamaMahasiswa FROM mahasiswa WHERE mahasiswa.NRP = '$Temp'";

						$HasilQueryNRPMahasiswa = mysqli_query($MySQLi, $QueryNRPMahasiswa);
		        $DataMahasiswa = array();
		        while($Hasil = mysqli_fetch_assoc($HasilQueryNRPMahasiswa)) {
		          	$DataMahasiswa[] = $Hasil;
								$Temp = $DataMahasiswa[0]['NamaMahasiswa'];
						}
						$InformasiNilai[$i]->NamaMahasiswa = $Temp;

				}

        return $InformasiNilai;
    }

		public function UbahNilaiMahasiswaWeb($KodeNilai, $NRPMahasiswa, $NilaiMahasiswaLama, $KodeNisbiMahasiswaLama, $NilaiMahasiswaBaru, $KodeNisbiMahasiswaBaru, $KodeMkBuka, $KPMkBuka, $TanggalSurat, $NomorSurat, $Keterangan, $NPKDosen) // Checked V
    {
				for ($i=0; $i < count($NilaiMahasiswaLama); $i++)
        {
						if($NilaiMahasiswaLama[$i] != $NilaiMahasiswaBaru[$i])
            {
								DB::table('NilaiMahasiswa')
									->where('KodeNilai', $KodeNilai)
									->where('NRP', $NRPMahasiswa[$i])
									->where('Nilai', $NilaiMahasiswaLama[$i])
									->where('KodeNisbi', $KodeNisbiMahasiswaLama[$i])
									->update(['Nilai' => $NilaiMahasiswaBaru[$i], 'KodeNisbi' => $KodeNisbiMahasiswaBaru[$i]]);
						}
				}
    }

		public function UnggahMyUbayaJenisNilaiWeb($KodeMkBuka, $KPMkBuka, $NPK, $KodeUnggah) // Checked
    {
        require realpath(base_path('connection/MyUbaya.php'));
        $MySQLi = mysqli_connect($domain, $username, $password, $database);
        $WaktuSekarang = Date("Y-m-d");
        $KodeNTSFinal = "";
        $KodeNASFinal = "";

        if ($KodeUnggah == 1)
        {
            $QueryMaxNTSKodeNilai = "SELECT MAX(myUbaya.baak_Nilai.KodeNilai) AS 'MaxKodeNilai' FROM myUbaya.baak_Nilai
            WHERE right(myUbaya.baak_Nilai.KodeNilai,4) LIKE 'T%' AND myUbaya.baak_Nilai.KodeMkBuka = '$KodeMkBuka' AND myUbaya.baak_Nilai.KP = '$KPMkBuka'";
            // GROUP BY myUbaya.baak_Nilai.KodeNilai;
            $HasilQueryMaxNTSKodeNilai = mysqli_query($MySQLi, $QueryMaxNTSKodeNilai);
            $MaxKodeNilaiNTS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryMaxNTSKodeNilai))
            {
                $MaxKodeNilaiNTS[] = $Hasil;
            }

            if($MaxKodeNilaiNTS[0]['MaxKodeNilai'] == NULL) //if(empty($MaxKodeNilaiNTS))
            {
              echo "kosong";
                $TempKP = $KPMkBuka;
                if (strlen($KPMkBuka) == 1)
                {
                  $TempKP = "0".$KPMkBuka;
                }

                $KodeNTSSementara = $KodeMkBuka.$TempKP."T"."001";

                if(strlen($KodeNTSSementara) < 21)
                {
                   $JumlahNol = "";
                   for ($k=0; $k < (21 - strlen($KodeNTSSementara)); $k++) {
                     $JumlahNol .= "0";
                   }
                   $KodeSementara = $JumlahNol.$KodeNTSSementara;
                }

                $KodeNTSFinal = $KodeSementara;

                $QueryInsertNTS = "INSERT INTO myUbaya.baak_Nilai (`KodeNilai`, `KodeMkBuka`, `KP`, `Jenis`, `WaktuBuat`, `WaktuValidasiDosen`, `WaktuValidasiAdmik`,
                `DosenPembuat`, `AdmikValidator`, `Status`)
                VALUES ('$KodeNTSFinal', '$KodeMkBuka', '$KPMkBuka', 'NTS', '$WaktuSekarang', '$WaktuSekarang', NULL, '$NPK', NULL, 'ValidDosen')";

                $InsertFinalNTS = mysqli_query($MySQLi, $QueryInsertNTS);

            }
            else // Jika Sudah Pernah Ada
            {
                $KodeNTSMaxSementara = $MaxKodeNilaiNTS[0]['MaxKodeNilai'];

                $QueryCheckStatusNTS = "SELECT myUbaya.baak_Nilai.Status AS 'StatusNTS' FROM myUbaya.baak_Nilai
                WHERE right(myUbaya.baak_Nilai.KodeNilai,4) LIKE 'T%' AND myUbaya.baak_Nilai.KodeMkBuka = '$KodeMkBuka' AND myUbaya.baak_Nilai.KP = '$KPMkBuka' AND myUbaya.baak_Nilai.KodeNilai = '$KodeNTSMaxSementara'
                ORDER BY myUbaya.baak_Nilai.KodeNilai DESC";

                $HasilQueryCheckStatusNTS = mysqli_query($MySQLi, $QueryCheckStatusNTS);
                $StatusNTS = array();
                while($Hasil = mysqli_fetch_assoc($HasilQueryCheckStatusNTS))
                {
                    $StatusNTS[] = $Hasil;
                }

                if ($StatusNTS[0]['StatusNTS'] == 'Daftar')
                {
                    $KodeNTSFinal = $KodeNTSMaxSementara;

                    $QueryUpdateNTS = "UPDATE baak_Nilai SET WaktuBuat='$WaktuSekarang', WaktuValidasiDosen='$WaktuSekarang', DosenPembuat='$NPK', Status='ValidDosen'
                    WHERE KodeNilai='$KodeNTSMaxSementara' AND KodeMkBuka = '$KodeMkBuka' AND KP = '$KPMkBuka' AND Jenis = 'NTS';";

                    $UpdateFinalNTS = mysqli_query($MySQLi, $QueryUpdateNTS);
                }
                else if ($StatusNTS[0]['StatusNTS'] == 'ValidDosen' || $StatusNTS[0]['StatusNTS'] == 'Invalid')
                {
                    $KodeNilaiNTS = $KodeNTSMaxSementara;
                    $KodeKiriNTS = substr($KodeNilaiNTS,0,-3);
                    $KodeKananNTS = substr($KodeNilaiNTS,-3);
                    $TempKanan = $KodeKananNTS + 1;

                    if($TempKanan < 10)
                    {
                        $JumlahNol = "00";
                    }
                    else if($TempKanan < 100)
                    {
                        $JumlahNol = "0";
                    }
                    else
                    {
                        $JumlahNol = "";
                    }

                    $KodeNTSFinal = $KodeKiriNTS.$JumlahNol.$TempKanan;

                    $QueryInsertNTS = "INSERT INTO myUbaya.baak_Nilai (`KodeNilai`, `KodeMkBuka`, `KP`, `Jenis`, `WaktuBuat`, `WaktuValidasiDosen`, `WaktuValidasiAdmik`,
                    `DosenPembuat`, `AdmikValidator`, `Status`)
                    VALUES ('$KodeNTSFinal', '$KodeMkBuka', '$KPMkBuka', 'NTS', '$WaktuSekarang', '$WaktuSekarang', NULL, '$NPK', NULL, 'ValidDosen')";

                    $InsertFinalNTS = mysqli_query($MySQLi, $QueryInsertNTS);
                }
                // else if ($StatusNTS[0]['StatusNTS'] == 'ValidAdmik')
                // {
                //
                // }
            }

            require realpath(base_path('connection/RekapNilai.php'));
            $MySQLi = mysqli_connect($domain, $username, $password, $database);

            $QueryMhsAmbilMk = "SELECT RekapNilai.MhsAmbilMk.NRP AS 'NRP', RekapNilai.MhsAmbilMk.NTS AS 'NTS'
            FROM RekapNilai.MhsAmbilMk
            WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.MhsAmbilMk.KP = '$KPMkBuka'";

            $HasilQueryMhsAmbilMk = mysqli_query($MySQLi, $QueryMhsAmbilMk);
            $MhsAmbilMk = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryMhsAmbilMk))
            {
                $MhsAmbilMk[] = $Hasil;
            }

            mysqli_close($MySQLi);

            require realpath(base_path('connection/MyUbaya.php'));
            $MySQLi = mysqli_connect($domain, $username, $password, $database);

            for ($i=0; $i < count($MhsAmbilMk); $i++)
            {
              $TempNRPMhs = $MhsAmbilMk[$i]['NRP'];
              $TempNTSMhs = $MhsAmbilMk[$i]['NTS'];

              if ($MhsAmbilMk[$i]['NTS'] >= 81 && $MhsAmbilMk[$i]['NTS'] <= 100)
              {
                  $KodeNisbi = "A";
              }
              else if ($MhsAmbilMk[$i]['NTS'] >= 73 && $MhsAmbilMk[$i]['NTS'] < 81)
              {
                  $KodeNisbi = "AB";
              }
              else if ($MhsAmbilMk[$i]['NTS'] >= 66 && $MhsAmbilMk[$i]['NTS'] < 73)
              {
                  $KodeNisbi = "B";
              }
              else if ($MhsAmbilMk[$i]['NTS'] >= 60 && $MhsAmbilMk[$i]['NTS'] < 66)
              {
                  $KodeNisbi = "BC";
              }
              else if ($MhsAmbilMk[$i]['NTS'] >= 55 && $MhsAmbilMk[$i]['NTS'] < 60)
              {
                  $KodeNisbi = "C";
              }
              else if ($MhsAmbilMk[$i]['NTS'] >= 40 && $MhsAmbilMk[$i]['NTS'] < 55)
              {
                  $KodeNisbi = "D";
              }
              else if ($MhsAmbilMk[$i]['NTS'] >= 0 && $MhsAmbilMk[$i]['NTS'] < 40)
              {
                  $KodeNisbi = "E";
              }

              $QueryInsertNTSMahasiswa = "INSERT INTO myUbaya.baak_NilaiMahasiswa (`KodeNilai`, `NRP`, `Nilai`, `KodeNisbi`)
              VALUES ('$KodeNTSFinal', '$TempNRPMhs', '$TempNTSMhs', '$KodeNisbi')";

              $InsertFinalNilaiMhsNTS = mysqli_query($MySQLi, $QueryInsertNTSMahasiswa);
            }
        }
        else
        {
            $QueryMaxNASKodeNilai = "SELECT MAX(myUbaya.baak_Nilai.KodeNilai) AS 'MaxKodeNilai' FROM myUbaya.baak_Nilai
            WHERE right(myUbaya.baak_Nilai.KodeNilai,4) LIKE 'A%' AND myUbaya.baak_Nilai.KodeMkBuka = '$KodeMkBuka' AND myUbaya.baak_Nilai.KP = '$KPMkBuka'";

            $HasilQueryMaxNASKodeNilai = mysqli_query($MySQLi, $QueryMaxNASKodeNilai);
            $MaxKodeNilaiNAS = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryMaxNASKodeNilai))
            {
                $MaxKodeNilaiNAS[] = $Hasil;
            }

            if($MaxKodeNilaiNAS[0]['MaxKodeNilai'] == NULL) //if(empty($MaxKodeNilaiNTS))
            {
                $TempKP = $KPMkBuka;
                if (strlen($KPMkBuka) == 1)
                {
                  $TempKP = "0".$KPMkBuka;
                }

                $KodeNASSementara = $KodeMkBuka.$TempKP."A"."001";

                if(strlen($KodeNASSementara) < 21)
                {
                   $JumlahNol = "";
                   for ($k=0; $k < (21 - strlen($KodeNASSementara)); $k++) {
                     $JumlahNol .= "0";
                   }
                   $KodeSementara = $JumlahNol.$KodeNASSementara;
                }

                $KodeNASFinal = $KodeSementara;

                $QueryInsertNAS = "INSERT INTO myUbaya.baak_Nilai (`KodeNilai`, `KodeMkBuka`, `KP`, `Jenis`, `WaktuBuat`, `WaktuValidasiDosen`, `WaktuValidasiAdmik`,
                `DosenPembuat`, `AdmikValidator`, `Status`)
                VALUES ('$KodeNASFinal', '$KodeMkBuka', '$KPMkBuka', 'NAS', '$WaktuSekarang', '$WaktuSekarang', NULL, '$NPK', NULL, 'ValidDosen')";

                $InsertFinalNAS = mysqli_query($MySQLi, $QueryInsertNAS);
            }
            else // Jika Sudah Pernah Ada
            {
                $KodeNASMaxSementara = $MaxKodeNilaiNAS[0]['MaxKodeNilai'];

                $QueryCheckStatusNAS = "SELECT myUbaya.baak_Nilai.Status AS 'StatusNAS' FROM myUbaya.baak_Nilai
                WHERE right(myUbaya.baak_Nilai.KodeNilai,4) LIKE 'A%' AND myUbaya.baak_Nilai.KodeMkBuka = '$KodeMkBuka' AND myUbaya.baak_Nilai.KP = '$KPMkBuka' AND myUbaya.baak_Nilai.KodeNilai = '$KodeNASMaxSementara'";

                $HasilQueryCheckStatusNAS = mysqli_query($MySQLi, $QueryCheckStatusNAS);
                $StatusNAS = array();
                while($Hasil = mysqli_fetch_assoc($HasilQueryCheckStatusNAS))
                {
                    $StatusNAS[] = $Hasil;
                }

                if ($StatusNAS[0]['StatusNAS'] == 'Daftar')
                {
                    $KodeNASFinal = $KodeNASMaxSementara;

                    $QueryUpdateNAS = "UPDATE baak_Nilai SET WaktuBuat='$WaktuSekarang', WaktuValidasiDosen='$WaktuSekarang', DosenPembuat='$NPK', Status='ValidDosen'
                    WHERE KodeNilai='$KodeNASMaxSementara' AND KodeMkBuka = '$KodeMkBuka' AND KP = '$KPMkBuka' AND Jenis = 'NAS';";

                    $UpdateFinalNAS = mysqli_query($MySQLi, $QueryUpdateNAS);
                }
                else if ($StatusNAS[0]['StatusNAS'] == 'ValidDosen' || $StatusNAS[0]['StatusNAS'] == 'Invalid')
                {
                    $KodeNilaiNAS = $KodeNASMaxSementara;
                    $KodeKiriNAS = substr($KodeNilaiNAS,0,-3);
                    $KodeKananNAS = substr($KodeNilaiNAS,-3);
                    $TempKanan = $KodeKananNAS + 1;

                    if($TempKanan < 10)
                    {
                        $JumlahNol = "00";
                    }
                    else if($TempKanan < 100)
                    {
                        $JumlahNol = "0";
                    }
                    else
                    {
                        $JumlahNol = "";
                    }

                    $KodeNASFinal = $KodeKiriNAS.$JumlahNol.$TempKanan;

                    $QueryInsertNAS = "INSERT INTO myUbaya.baak_Nilai (`KodeNilai`, `KodeMkBuka`, `KP`, `Jenis`, `WaktuBuat`, `WaktuValidasiDosen`, `WaktuValidasiAdmik`,
                    `DosenPembuat`, `AdmikValidator`, `Status`)
                    VALUES ('$KodeNASFinal', '$KodeMkBuka', '$KPMkBuka', 'NAS', '$WaktuSekarang', '$WaktuSekarang', NULL, '$NPK', NULL, 'ValidDosen')";

                    $InsertFinalNAS = mysqli_query($MySQLi, $QueryInsertNAS);
                }
                // else if ($StatusNTS[0]['StatusNTS'] == 'ValidAdmik')
                // {
                //
                // }
            }

            require realpath(base_path('connection/RekapNilai.php'));
            $MySQLi = mysqli_connect($domain, $username, $password, $database);

            $QueryMhsAmbilMk = "SELECT RekapNilai.MhsAmbilMk.NRP AS 'NRP', RekapNilai.MhsAmbilMk.NAS AS 'NAS'
            FROM RekapNilai.MhsAmbilMk
            WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.MhsAmbilMk.KP = '$KPMkBuka'";

            $HasilQueryMhsAmbilMk = mysqli_query($MySQLi, $QueryMhsAmbilMk);
            $MhsAmbilMk = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryMhsAmbilMk))
            {
                $MhsAmbilMk[] = $Hasil;
            }

            mysqli_close($MySQLi);

            require realpath(base_path('connection/MyUbaya.php'));
            $MySQLi = mysqli_connect($domain, $username, $password, $database);

            for ($i=0; $i < count($MhsAmbilMk); $i++)
            {
              $TempNRPMhs = $MhsAmbilMk[$i]['NRP'];
              $TempNASMhs = $MhsAmbilMk[$i]['NAS'];

              if ($MhsAmbilMk[$i]['NAS'] >= 81 && $MhsAmbilMk[$i]['NAS'] <= 100)
              {
                  $KodeNisbi = "A";
              }
              else if ($MhsAmbilMk[$i]['NAS'] >= 73 && $MhsAmbilMk[$i]['NAS'] < 81)
              {
                  $KodeNisbi = "AB";
              }
              else if ($MhsAmbilMk[$i]['NAS'] >= 66 && $MhsAmbilMk[$i]['NAS'] < 73)
              {
                  $KodeNisbi = "B";
              }
              else if ($MhsAmbilMk[$i]['NAS'] >= 60 && $MhsAmbilMk[$i]['NAS'] < 66)
              {
                  $KodeNisbi = "BC";
              }
              else if ($MhsAmbilMk[$i]['NAS'] >= 55 && $MhsAmbilMk[$i]['NAS'] < 60)
              {
                  $KodeNisbi = "C";
              }
              else if ($MhsAmbilMk[$i]['NAS'] >= 40 && $MhsAmbilMk[$i]['NAS'] < 55)
              {
                  $KodeNisbi = "D";
              }
              else if ($MhsAmbilMk[$i]['NAS'] >= 0 && $MhsAmbilMk[$i]['NAS'] < 40)
              {
                  $KodeNisbi = "E";
              }

              $QueryInsertNASMahasiswa = "INSERT INTO myUbaya.baak_NilaiMahasiswa (`KodeNilai`, `NRP`, `Nilai`, `KodeNisbi`)
              VALUES ('$KodeNASFinal', '$TempNRPMhs', '$TempNASMhs', '$KodeNisbi')";

              $InsertFinalNilaiMhsNAS = mysqli_query($MySQLi, $QueryInsertNASMahasiswa);
            }
        }
    }

		public function SimpanNilaiMahasiswaAndroid($Hasil) // Checked V
    {
      	for ($i=0; $i < count($NRPMahasiswa); $i++)
        {
						if ($NilaiMahasiswa[$i] >= 81 && $NilaiMahasiswa[$i] <= 100)
            {
								$KodeNisbi = "A";
						}
            else if ($NilaiMahasiswa[$i] >= 73 && $NilaiMahasiswa[$i] < 81)
            {
								$KodeNisbi = "AB";
						}
            else if ($NilaiMahasiswa[$i] >= 66 && $NilaiMahasiswa[$i] < 73)
            {
								$KodeNisbi = "B";
						}
            else if ($NilaiMahasiswa[$i] >= 60 && $NilaiMahasiswa[$i] < 66)
            {
								$KodeNisbi = "BC";
						}
            else if ($NilaiMahasiswa[$i] >= 55 && $NilaiMahasiswa[$i] < 60)
            {
								$KodeNisbi = "C";
						}
            else if ($NilaiMahasiswa[$i] >= 40 && $NilaiMahasiswa[$i] < 55)
            {
								$KodeNisbi = "D";
						}
            else if ($NilaiMahasiswa[$i] >= 0 && $NilaiMahasiswa[$i] < 40)
            {
								$KodeNisbi = "E";
						}

						$MahasiswaPunyaNilai = new MahasiswaPunyaNilai(array(
								'KodeNilai' => $KodeNilai,
								'NRP' => $NRPMahasiswa[$i],
								'Nilai' => $NilaiMahasiswa[$i],
								'KodeNisbi' => $KodeNisbi,
								));
						$MahasiswaPunyaNilai->save();
      	}
    }
        // $QueryMaxNASKodeNilai = "SELECT MAX(RekapNilai.Nilai.KodeNilai) AS 'MaxKodeNilai' FROM RekapNilai.Nilai
        // WHERE right(RekapNilai.Nilai.KodeNilai,4) LIKE 'A%' AND RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.Nilai.KP = '$KPMkBuka'";
        //
        // $HasilQueryMaxNASKodeNilai = mysqli_query($MySQLi, $QueryMaxNASKodeNilai);
        // $MaxKodeNilaiNAS = array();
        // while($Hasil = mysqli_fetch_assoc($HasilQueryMaxNASKodeNilai))
        // {
        //     $MaxKodeNilaiNAS[] = $Hasil;
        // }
        //
        // $KodeNilaiNAS = $MaxKodeNilaiNAS[0]['MaxKodeNilai'];
        // $KodeKiriNAS = substr($KodeNilaiNAS,0,-3);
        // $KodeKananNAS = substr($KodeNilaiNAS,-3);
        // $TempKanan = $KodeKananNAS + 1;
        //
        // if($TempKanan < 10)
        // {
        //     $JumlahNol = "00";
        // }
        // else if($TempKanan < 100)
        // {
        //     $JumlahNol = "0";
        // }
        // else
        // {
        //     $JumlahNol = "";
        // }
        //
        // $KodeNilaiNASFinal = $KodeKiriNAS.$JumlahNol.$TempKanan;
        // $WaktuSekarang = Date("Y-m-d");
        //
        // mysqli_close($MySQLi);
        //
        // require realpath(base_path('connection/MyUbaya.php'));
        // $MySQLi = mysqli_connect($domain, $username, $password, $database);
        //
        // $QueryInsertNTS = "INSERT INTO myUbaya.baak_Nilai (`KodeNilai`, `KodeMkBuka`, `KP`, `Jenis`, `WaktuBuat`, `WaktuValidasiDosen`, `WaktuValidasiAdmik`, `DosenPembuat`, `AdmikValidator`, `Status`)
        // VALUES ('$KodeNilaiNTSFinal', '$KodeMkBuka', '$KPMkBuka', 'NTS', '$WaktuSekarang', '$WaktuSekarang', NULL, '$NPK', NULL, 'ValidDosen')";
        // $InsertFinalNTS = mysqli_query($MySQLi, $QueryInsertNTS);
        //
        // $QueryInsertNAS = "INSERT INTO myUbaya.baak_Nilai (`KodeNilai`, `KodeMkBuka`, `KP`, `Jenis`, `WaktuBuat`, `WaktuValidasiDosen`, `WaktuValidasiAdmik`, `DosenPembuat`, `AdmikValidator`, `Status`)
        // VALUES ('$KodeNilaiNASFinal', '$KodeMkBuka', '$KPMkBuka', 'NAS', '$WaktuSekarang', '$WaktuSekarang', NULL, '$NPK', NULL, 'ValidDosen')";
        // $InsertFinalNAS = mysqli_query($MySQLi, $QueryInsertNAS);
        //
        // mysqli_close($MySQLi);
        //
        // require realpath(base_path('connection/RekapNilai.php'));
        // $MySQLi = mysqli_connect($domain, $username, $password, $database);
        //
        // $QueryMhsAmbilMk = "SELECT RekapNilai.MhsAmbilMk.NRP AS 'NRP', RekapNilai.MhsAmbilMk.NTS AS 'NTS', RekapNilai.MhsAmbilMk.NAS AS 'NAS' FROM RekapNilai.MhsAmbilMk
        // WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.MhsAmbilMk.KP = '$KPMkBuka'";
        //
        // $HasilQueryMhsAmbilMk = mysqli_query($MySQLi, $QueryMhsAmbilMk);
        // $MhsAmbilMk = array();
        // while($Hasil = mysqli_fetch_assoc($HasilQueryMhsAmbilMk))
        // {
        //     $MhsAmbilMk[] = $Hasil;
        // }
        //
        // mysqli_close($MySQLi);
        //
        // require realpath(base_path('connection/MyUbaya.php'));
        // $MySQLi = mysqli_connect($domain, $username, $password, $database);
        //
        // for ($i=0; $i < count($MhsAmbilMk); $i++)
        // {
        //   $TempNRPMhs = $MhsAmbilMk[$i]['NRP'];
        //   $TempNTSMhs = $MhsAmbilMk[$i]['NTS'];
        //   $TempNASMhs = $MhsAmbilMk[$i]['NAS'];
        //
        //   if ($MhsAmbilMk[$i]['NTS'] >= 81 && $MhsAmbilMk[$i]['NTS'] <= 100)
        //   {
        //       $KodeNisbi = "A";
        //   }
        //   else if ($MhsAmbilMk[$i]['NTS'] >= 73 && $MhsAmbilMk[$i]['NTS'] < 81)
        //   {
        //       $KodeNisbi = "AB";
        //   }
        //   else if ($MhsAmbilMk[$i]['NTS'] >= 66 && $MhsAmbilMk[$i]['NTS'] < 73)
        //   {
        //       $KodeNisbi = "B";
        //   }
        //   else if ($MhsAmbilMk[$i]['NTS'] >= 60 && $MhsAmbilMk[$i]['NTS'] < 66)
        //   {
        //       $KodeNisbi = "BC";
        //   }
        //   else if ($MhsAmbilMk[$i]['NTS'] >= 55 && $MhsAmbilMk[$i]['NTS'] < 60)
        //   {
        //       $KodeNisbi = "C";
        //   }
        //   else if ($MhsAmbilMk[$i]['NTS'] >= 40 && $MhsAmbilMk[$i]['NTS'] < 55)
        //   {
        //       $KodeNisbi = "D";
        //   }
        //   else if ($NilaiMahasiswa[$i]['NTS'] >= 0 && $NilaiMahasiswa[$i]['NTS'] <= 40)
        //   {
        //       $KodeNisbi = "E";
        //   }
        //
        //   $QueryInsertNTSMahasiswa = "INSERT INTO myUbaya.baak_NilaiMahasiswa (`KodeNilai`, `NRP`, `Nilai`, `KodeNisbi`)
        //   VALUES ('$KodeNilaiNTSFinal', '$TempNRPMhs', '$TempNTSMhs', '$KodeNisbi')";
        //   $InsertFinalNilaiMhsNTS = mysqli_query($MySQLi, $QueryInsertNTSMahasiswa);
        //
        //   if ($MhsAmbilMk[$i]['NAS'] >= 81 && $MhsAmbilMk[$i]['NAS'] <= 100)
        //   {
        //       $KodeNisbi = "A";
        //   }
        //   else if ($MhsAmbilMk[$i]['NAS'] >= 73 && $MhsAmbilMk[$i]['NAS'] < 81)
        //   {
        //       $KodeNisbi = "AB";
        //   }
        //   else if ($MhsAmbilMk[$i]['NAS'] >= 66 && $MhsAmbilMk[$i]['NAS'] < 73)
        //   {
        //       $KodeNisbi = "B";
        //   }
        //   else if ($MhsAmbilMk[$i]['NAS'] >= 60 && $MhsAmbilMk[$i]['NAS'] < 66)
        //   {
        //       $KodeNisbi = "BC";
        //   }
        //   else if ($MhsAmbilMk[$i]['NAS'] >= 55 && $MhsAmbilMk[$i]['NAS'] < 60)
        //   {
        //       $KodeNisbi = "C";
        //   }
        //   else if ($MhsAmbilMk[$i]['NAS'] >= 40 && $MhsAmbilMk[$i]['NAS'] < 55)
        //   {
        //       $KodeNisbi = "D";
        //   }
        //   else if ($NilaiMahasiswa[$i]['NAS'] >= 0 && $NilaiMahasiswa[$i]['NAS'] < 40)
        //   {
        //       $KodeNisbi = "E";
        //   }
        //
        //   $QueryInsertNASMahasiswa = "INSERT INTO myUbaya.baak_NilaiMahasiswa (`KodeNilai`, `NRP`, `Nilai`, `KodeNisbi`)
        //   VALUES ('$KodeNilaiNASFinal', '$TempNRPMhs', '$TempNASMhs', '$KodeNisbi')";
        //   $InsertFinalNilaiMhsNAS = mysqli_query($MySQLi, $QueryInsertNASMahasiswa);


		// public function GetNamaMkBuka($Kode)
    // {
		// 	require realpath(base_path('connection/Init.php'));
		// 	$MySQLi = mysqli_connect($domain, $username, $password, $database);
    //
		// 	$QueryNamaMataKuliah = "SELECT MataKuliah.Nama AS Nama FROM mkbuka INNER JOIN matakuliah ON mkbuka.KodeMk = MataKuliah.KodeMk WHERE mkbuka.KodeMkBuka = '$Kode'";
		// 	$HasilQueryNamaMataKuliah = mysqli_query($MySQLi, $QueryNamaMataKuliah);
		// 	$NamaMkBuka = array();
		// 	while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMataKuliah)) {
		// 			$NamaMkBuka[] = $Hasil;
		// 	}
		// 	$Nama = $NamaMkBuka[0]['Nama'];
		// 	return $Nama;
    // }
}
