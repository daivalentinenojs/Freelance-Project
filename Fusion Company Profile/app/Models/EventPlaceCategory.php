<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\EventPlaceCategory;
use DB;

/**
 * Class EventPlaceCategory
 *
 * @package App\Models
 */
class EventPlaceCategory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'event_place_category';

	protected $fillable = [
		'name'
	];

	public function Get() {
		$event_place_categories = DB::table('event_place_category')->whereNull('deleted_at')->get();
		return $event_place_categories;
	}

	public function Store(Request $request) {
		$id = DB::table('event_place_category')->max('id');
		$id = $id + 1;		

		$event_place_category = new EventPlaceCategory();
		$event_place_category->name = $request->name;
		$event_place_category->save();
	}

	public function UpdateEPC(Request $request) {
		$id = $request->u_id;
	  
		$event_place_category = EventPlaceCategory::find($id);
		$event_place_category->name = $request->name;
		$event_place_category->save();
	}

	public function DeleteEPC(Request $request) {
		$id = $request->d_id;
			  
		$event_place_category = EventPlaceCategory::find($id);
		$event_place_category->delete();
	}
}
