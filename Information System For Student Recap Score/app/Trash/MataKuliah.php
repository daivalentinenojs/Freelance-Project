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

class MataKuliah extends Model
{
    use Authenticatable, CanResetPassword;

    protected $table = 'MataKuliah';
	protected $guarded = ['KodeMk'];
	protected $fillable = ['KodeMk', 'Nama', 'NamaEng', 'Sks'];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function MkCatatMkBuka()
	{
		return $this->hasMany('App\MataKuliahBuka','KodeMk','KodeMk');
	}
}