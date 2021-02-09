<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\EventDetail;
use DB;

/**
 * Class EventDetail
 *
 * @package App\Models
 */
class EventDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = '';

	protected $fillable = [];
}
