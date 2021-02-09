<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Line;
use DB;

/**
 * Class Template
 *
 * @package App\Models
 */
class Line extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
}
