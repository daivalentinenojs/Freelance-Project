<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\GuestCategory;
use DB;

/**
 * Class GuestCategory
 *
 * @package App\Models
 */
class GuestCategory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'guest_category';

	protected $fillable = [
		'name'
	];

	public function Get() {
		$guest_categories = DB::table('guest_category')->whereNull('deleted_at')->get();
		return $guest_categories;
	}

	public function Store(Request $request) {
		$id = DB::table('guest_category')->max('id');
		$id = $id + 1;		

		$guest_category = new GuestCategory();
		$guest_category->name = $request->name;
		$guest_category->save();
	}

	public function UpdateGC(Request $request) {
		$id = $request->u_id;
	  
		$guest_category = GuestCategory::find($id);
		$guest_category->name = $request->name;
		$guest_category->save();
	}

	public function DeleteGC(Request $request) {
		$id = $request->d_id;
			  
		$guest_category = GuestCategory::find($id);
		$guest_category->delete();
	}
}
