<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Role;
use DB;

/**
 * Class Role
 *
 * @package App\Models
 */
class Role extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'role';

	protected $fillable = [
		'name'
	];

	public function Store(Request $request) {
		$id = DB::table('role')->max('id');
		$id = $id + 1;		

		$role = new Role();
		$role->name = $request->name;
		$role->save();
	}

	public function UpdateR(Request $request) {
		$id = $request->u_id;
	  
		$role = Role::find($id);
		$role->name = $request->name;
		$role->save();
	}

	public function DeleteR(Request $request) {
		$id = $request->d_id;
			  
		$role = Role::find($id);
		$role->delete();
	}
}
