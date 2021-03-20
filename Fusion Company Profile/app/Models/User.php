<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 29 Aug 2018 05:26:16 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
  use Notifiable;
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'jenis_kelamin' => 'int',
		'jabatan' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'tanggal_lahir',
		'verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nama',
		'email',
		'password',
		'alamat',
		'telepon',
		'jenis_kelamin',
		'tanggal_lahir',
		'jabatan',
		'status',
		'remember_token',
		'verified_at'
	];

	protected $appends = [
		'eid'
	];
}
