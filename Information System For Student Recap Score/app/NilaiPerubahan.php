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
use App\MataKuliahBuka;
use App\Karyawan;
use App\NilaiPerubahan;
use Carbon\Carbon;

class NilaiPerubahan extends Model
{
    use Authenticatable, CanResetPassword;

    protected $table = 'NilaiPerubahan';
    protected $guarded = ['VersiUbah'];
    protected $fillable = ['VersiUbah', 'KodeMkBuka', 'KP', 'TglUbah', 'NoSurat', 'TglSurat', 'NilaiLama', 'NilaiBaru', 'KodeNilai', 'KodeNisbiLama', 'KodeNisbiBaru', 'Keterangan', 'NRP', 'NPK'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



    public function NilaiPerubahanDiPunyaiMkBuka()
    {
        return $this->hasOne('App\MataKuliahBuka','KodeMkBuka','KodeMkBuka');
    }

    public function NilaiPerubahanDiPunyaiMhs()
    {
        return $this->hasOne('App\Mahasiswa','NRP','NRP');
    }

    public function NilaiPerubahanDiPunyaiKaryawan()
    {
        return $this->hasOne('App\Karyawan','NPK','NPK');
    }

    public function SimpanNilaiPerubahanWeb($KodeNilai, $NRPMahasiswa, $NilaiMahasiswaLama, $KodeNisbiMahasiswaLama, $NilaiMahasiswaBaru, $KodeNisbiMahasiswaBaru, $KodeMkBuka, $KPMkBuka, $TanggalSurat, $NomorSurat, $Keterangan, $NPKDosen) // Checked V
    {
        $WaktuSekarang = Carbon::now();
      	for ($i=0; $i < count($NRPMahasiswa); $i++)
        {
            if ($NilaiMahasiswaLama[$i] != $NilaiMahasiswaBaru[$i])
            {
                $CariVersiUbah = DB::table('NilaiPerubahan')->max('NilaiPerubahan.VersiUbah');

                if(empty($CariVersiUbah))
                {
                    $CariVersiUbah = 0;
                }

                $Temp = $CariVersiUbah+1;

              	$NilaiPerubahan = new NilaiPerubahan(array(
					'VersiUbah' => $Temp,
					'KodeMkBuka' => $KodeMkBuka,
					'KP' => $KPMkBuka,
					'TglUbah' => $WaktuSekarang,
                    'NoSurat' => $NomorSurat,
                    'TglSurat' => $TanggalSurat,
                    'NilaiLama' => $NilaiMahasiswaLama[$i],
                    'NilaiBaru' => $NilaiMahasiswaBaru[$i],
                    'KodeNilai' => $KodeNilai,
                    'KodeNisbiLama' => $KodeNisbiMahasiswaLama[$i],
                    'KodeNisbiBaru' => $KodeNisbiMahasiswaBaru[$i],
                    'Keterangan' => $Keterangan,
                    'NRP' => $NRPMahasiswa[$i],
                    'NPK' => $NPKDosen,
    			));
    			$NilaiPerubahan->save();
            }
      	}
    }


}
