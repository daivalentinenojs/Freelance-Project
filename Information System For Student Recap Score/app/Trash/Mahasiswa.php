<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\MahasiswaAmbilMataKuliah;
use App\NilaiMahasiswa;
use App\NilaiPerubahan;
use Auth;

class Mahasiswa extends Model
{
    use Authenticatable, CanResetPassword;

    protected $table = 'Mahasiswa';
	protected $guarded = ['NRP'];
	protected $fillable = ['NRP', 'Nama', 'ThnAkademik', 'SemesterTerima', 'IdUser'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function MhsAmbilMk()
	{
		return $this->hasMany('App\MahasiswaAmbilMataKuliah','NRP','NRP');
	}

	public function NilaiMahasiswa()
	{
		return $this->hasMany('App\NilaiMahasiswa','NRP','NRP');
	}

	public function NilaiPerubahan()
	{
		return $this->hasMany('App\NilaiPerubahan','NRP','NRP');
	}

	public function MhsPunyaUser()
    {
        return $this->hasOne('App\User','IdUser','IdUser');
    }
}
