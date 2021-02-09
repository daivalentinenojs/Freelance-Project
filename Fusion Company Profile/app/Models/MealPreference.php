<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\MealPreference;
use DB;

/**
 * Class MealPreference
 *
 * @package App\Models
 */
class MealPreference extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'meal_preference';

	protected $fillable = [
		'name'
	];

	public function Get() {
		$meal_preference = DB::table('meal_preference')->whereNull('deleted_at')->get();
		return $meal_preference;
	}

	public function Store(Request $request) {
		$id = DB::table('meal_preference')->max('id');
		$id = $id + 1;		

		$MealPreference = new MealPreference();
		$MealPreference->name = $request->name;
		$MealPreference->save();
	}

	public function UpdateMP(Request $request) {
		$id = $request->u_id;
	  
		$MealPreference = MealPreference::find($id);
		$MealPreference->name = $request->name;
		$MealPreference->save();
	}

	public function DeleteMP(Request $request) {
		$id = $request->d_id;
			  
		$MealPreference = MealPreference::find($id);
		$MealPreference->delete();
	}
}
