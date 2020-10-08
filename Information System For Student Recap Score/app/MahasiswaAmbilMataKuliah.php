<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\MataKuliahBuka;
use App\Mahasiswa;
use App\MahasiswaAmbilMataKuliah;

class MahasiswaAmbilMataKuliah extends Model
{
	use Authenticatable, CanResetPassword;

  protected $table = 'MhsAmbilMk';
	protected $guarded = ['NRP', 'KodeMkBuka'];
	protected $fillable = ['NRP', 'KodeMkBuka', 'KP', 'NTS', 'NAS', 'NA', 'KodeNisbi'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



	public function MhsAmbilMkDiPunyaiMkBuka()
  {
      return $this->hasOne('App\MataKuliahBuka','KodeMkBuka','KodeMkBuka');
  }

  public function MhsAmbilMkDiPunyaiMhs()
  {
      return $this->hasOne('App\Mahasiswa','NRP','NRP');
  }

	public function SimpanNilaiAkhirMahasiswaWeb($KodeMkBuka, $NamaMk, $KPMkBuka, $NRPMahasiswa, $KodeKalkulasi, $NTSNASMahasiswa, $NTSNASKodeNisbi) // Checked V
	{
			require '../connection/RekapNilai.php';
			$MySQLi = mysqli_connect($domain, $username, $password, $database);

			if ($KodeKalkulasi == 1)
			{
					for ($i=0; $i < count($NRPMahasiswa); $i++)
					{
							$TempNRP = $NRPMahasiswa[$i];
							$QueryCheckNTSNASMahasiswa = "SELECT MhsAmbilMk.NRP AS 'NRPInput', MhsAmbilMk.KodeMkBuka AS 'KodeMkBukaInput', MhsAmbilMk.KP AS 'KPInput'
							FROM MhsAmbilMk WHERE MhsAmbilMk.NRP = '$TempNRP' AND MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND  MhsAmbilMk.KP = '$KPMkBuka'";

							$HasilQueryCheckNTSNASMahasiswa = mysqli_query($MySQLi, $QueryCheckNTSNASMahasiswa);
							$CheckNTSNASMahasiswa = array();
							while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNTSNASMahasiswa))
							{
								$CheckNTSNASMahasiswa[] = $Hasil;
							}

							if (empty($CheckNTSNASMahasiswa))
							{
									$MahasiswaAmbilMk = new MahasiswaAmbilMataKuliah(array(
											'NRP' => $NRPMahasiswa[$i],
											'KodeMkBuka' => $KodeMkBuka,
											'KP' => $KPMkBuka,
											'NTS' => $NTSNASMahasiswa[$i],
											'NAS' => 0,
											'NA' => 0,
											'KodeNisbi' => "-",
											));
									$MahasiswaAmbilMk->save();
							}
							else
							{
									$QueryNASMahasiswa = "SELECT MhsAmbilMk.NAS AS 'NASInput'
									FROM MhsAmbilMk WHERE MhsAmbilMk.NRP = '$TempNRP' AND MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND  MhsAmbilMk.KP = '$KPMkBuka'";

									$HasilQueryNASMahasiswa = mysqli_query($MySQLi, $QueryNASMahasiswa);
									$NASMahasiswa = array();
									while($Hasil = mysqli_fetch_assoc($HasilQueryNASMahasiswa))
									{
										$NASMahasiswa[] = $Hasil;
									}

									$NAMahasiswa = ((40/100) * $NTSNASMahasiswa[$i]) + ((60/100) * $NASMahasiswa[0]['NASInput']);

									if ($NAMahasiswa >= 81 && $NAMahasiswa <= 100)
			            {
											$KodeNisbi = "A";
									}
			            else if ($NAMahasiswa >= 73 && $NAMahasiswa < 81)
			            {
											$KodeNisbi = "AB";
									}
			            else if ($NAMahasiswa >= 66 && $NAMahasiswa < 73)
			            {
											$KodeNisbi = "B";
									}
			            else if ($NAMahasiswa >= 60 && $NAMahasiswa < 66)
			            {
											$KodeNisbi = "BC";
									}
			            else if ($NAMahasiswa >= 55 && $NAMahasiswa < 60)
			            {
											$KodeNisbi = "C";
									}
			            else if ($NAMahasiswa >= 40 && $NAMahasiswa < 55)
			            {
											$KodeNisbi = "D";
									}
			            else if ($NAMahasiswa >= 0 && $NAMahasiswa < 40)
			            {
											$KodeNisbi = "E";
									}

									DB::table('MhsAmbilMk')
										->where('NRP', $NRPMahasiswa[$i])
										->where('KodeMkBuka', $KodeMkBuka)
										->where('KP', $KPMkBuka)
										->update(['NTS' => $NTSNASMahasiswa[$i], 'NA' => $NAMahasiswa, 'KodeNisbi' => $KodeNisbi]);
							}
					}
			}
			else
			{
					for ($i=0; $i < count($NRPMahasiswa); $i++)
					{
							$TempNRP = $NRPMahasiswa[$i];
							$QueryCheckNTSNASMahasiswa = "SELECT MhsAmbilMk.NRP AS 'NRPInput', MhsAmbilMk.KodeMkBuka AS 'KodeMkBukaInput', MhsAmbilMk.KP AS 'KPInput'
							FROM MhsAmbilMk WHERE MhsAmbilMk.NRP = '$TempNRP' AND MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND  MhsAmbilMk.KP = '$KPMkBuka'";

							$HasilQueryCheckNTSNASMahasiswa = mysqli_query($MySQLi, $QueryCheckNTSNASMahasiswa);
							$CheckNTSNASMahasiswa = array();
							while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNTSNASMahasiswa))
							{
								$CheckNTSNASMahasiswa[] = $Hasil;
							}

							if (empty($CheckNTSNASMahasiswa))
							{
									$MahasiswaAmbilMk = new MahasiswaAmbilMataKuliah(array(
											'NRP' => $NRPMahasiswa[$i],
											'KodeMkBuka' => $KodeMkBuka,
											'KP' => $KPMkBuka,
											'NTS' => 0,
											'NAS' => $NTSNASMahasiswa[$i],
											'NA' => 0,
											'KodeNisbi' => "-",
											));
									$MahasiswaAmbilMk->save();
							}
							else
							{
									$QueryNTSMahasiswa = "SELECT MhsAmbilMk.NTS AS 'NTSInput'
									FROM MhsAmbilMk WHERE MhsAmbilMk.NRP = '$TempNRP' AND MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND  MhsAmbilMk.KP = '$KPMkBuka'";

									$HasilQueryNTSMahasiswa = mysqli_query($MySQLi, $QueryNTSMahasiswa);
									$NTSMahasiswa = array();
									while($Hasil = mysqli_fetch_assoc($HasilQueryNTSMahasiswa))
									{
										$NTSMahasiswa[] = $Hasil;
									}

									$NAMahasiswa = ((40/100) * $NTSMahasiswa[0]['NTSInput']) + ((60/100) * $NTSNASMahasiswa[$i]);

									if ($NAMahasiswa >= 81 && $NAMahasiswa <= 100)
									{
											$KodeNisbi = "A";
									}
									else if ($NAMahasiswa >= 73 && $NAMahasiswa < 81)
									{
											$KodeNisbi = "AB";
									}
									else if ($NAMahasiswa >= 66 && $NAMahasiswa < 73)
									{
											$KodeNisbi = "B";
									}
									else if ($NAMahasiswa >= 60 && $NAMahasiswa < 66)
									{
											$KodeNisbi = "BC";
									}
									else if ($NAMahasiswa >= 55 && $NAMahasiswa < 60)
									{
											$KodeNisbi = "C";
									}
									else if ($NAMahasiswa >= 40 && $NAMahasiswa < 55)
									{
											$KodeNisbi = "D";
									}
									else if ($NAMahasiswa >= 0 && $NAMahasiswa < 40)
									{
											$KodeNisbi = "E";
									}

									DB::table('MhsAmbilMk')
										->where('NRP', $NRPMahasiswa[$i])
										->where('KodeMkBuka', $KodeMkBuka)
										->where('KP', $KPMkBuka)
										->update(['NAS' => $NTSNASMahasiswa[$i], 'NA' => $NAMahasiswa, 'KodeNisbi' => $KodeNisbi]);
							}
					}
			}
			mysqli_close($MySQLi);
	}
}
