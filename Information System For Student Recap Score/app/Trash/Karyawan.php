<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\DosenAjarMk;
use App\MkBuka;
use App\Nilai;
use App\NilaiPerubahan;
use App\Karyawan;

class Karyawan extends Model
{
    use Authenticatable, CanResetPassword;

    protected $table = 'Karyawan';
	protected $guarded = ['NPK'];
	protected $fillable = ['NPK', 'Nama', 'IdUser'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function DosenAjarMk()
	{
		return $this->hasMany('App\DosenAjarMk','NPK','NPK');
	}

	public function DosenAmpuMk()
	{
		return $this->hasMany('App\MkBuka','NPK','NPK');
	}

	public function DosenBuatNilai()
	{
		return $this->hasMany('App\JenisNilai','DosenPembuat','NPK');
	}

	public function DosenUbahNilaiPerubahan()
	{
		return $this->hasMany('App\NilaiPerubahan','NPK','NPK');
	}

	public function KaryawanPunyaUser()
    {
        return $this->hasOne('App\User','IdUser','IdUser');
    }
}
