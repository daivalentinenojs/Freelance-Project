<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use DB;

/**
 * Class EventCategory
 *
 * @package App\Models
 */
class EventCategory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'event_category';

	protected $fillable = [
		'name'
	];

	public function Get() {
		$event_categories = DB::table('event_category')->whereNull('deleted_at')->get();
		return $event_categories;
	}

	public function Store(Request $request) {
		$id = DB::table('event_category')->max('id');
		$id = $id + 1;		

		$event_category = new EventCategory();
		$event_category->name = $request->name;
		$event_category->save();
	}

	public function UpdateEC(Request $request) {
		$id = $request->u_id;
	  
		$event_category = EventCategory::find($id);
		$event_category->name = $request->name;
		$event_category->save();
	}

	public function DeleteEC(Request $request) {
		$id = $request->d_id;
			  
		$event_category = EventCategory::find($id);
		$event_category->delete();
	}
}
