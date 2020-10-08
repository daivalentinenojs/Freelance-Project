<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\MataKuliah;
use App\NilaiPerubahan;
use App\JenisNilai;
use App\MahasiswaAmbilMataKuliah;
use App\DosenAjarMk;
use App\Karyawan;

class MataKuliahBuka extends Model
{
    use Authenticatable, CanResetPassword;

    protected $table = 'mkbuka';
	protected $guarded = ['KodeMkBuka'];
	protected $fillable = ['KodeMkBuka', 'KodeMk', 'ThnAkademik', 'Semester', 'NPK'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    

   	public function MkBukaCatatNilaiPerubahan()
	{
		return $this->hasMany('App\NilaiPerubahan','KodeMkBuka','KodeMkBuka');
	}

	public function MkBukaCatatNilai()
	{
		return $this->hasMany('App\JenisNilai','KodeMkBuka','KodeMkBuka');
	}

	public function MkDiambilMhs()
	{
		return $this->hasMany('App\MahasiswaAmbilMataKuliah','KodeMkBuka','KodeMkBuka');
	}

	public function MkDiajarDosen()
	{
		return $this->hasMany('App\DosenAjarMk','KodeMkBuka','KodeMkBuka');
	}

	public function MkBukaDiCatatMk()
    {
        return $this->hasOne('App\MataKuliah','KodeMk','KodeMk');
    }

    public function MkBukaDiAmpuDosen()
    {
        return $this->hasOne('App\Karyawan','NPK','NPK');
    }
}
