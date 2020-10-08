<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Mahasiswa;
use App\Karyawan;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;

	/**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'User';
	protected $guarded = ['IdUser'];
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['IdUser', 'Email', 'Password', 'Status'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function UserDipunyaiKaryawan()
	{
		return $this->hasOne('App\Karyawan','IdUser','id');
	}

    public function UserDipunyaiMahasiswa()
    {
        return $this->hasOne('App\Mahasiswa','IdUser','id');
    }
}
