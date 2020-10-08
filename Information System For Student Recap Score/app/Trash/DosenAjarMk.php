<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\MataKuliahBuka;;
use App\Karyawan;

class DosenAjarMk extends Model
{
	use Authenticatable, CanResetPassword;

    protected $table = 'DosenAjarMk';
	protected $guarded = ['NPK', 'KodeMkBuka'];
	protected $fillable = ['NPK', 'KodeMkBuka', 'KP'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

   

    public function DosenAjarMkDiPunyaiMkBuka()
    {
        return $this->hasOne('App\MataKuliahBuka','KodeMkBuka','KodeMkBuka');
    }

    public function DosenAjarMkDiPunyaiKaryawan()
    {
        return $this->hasOne('App\Karyawan','NPK','NPK');
    }
}
