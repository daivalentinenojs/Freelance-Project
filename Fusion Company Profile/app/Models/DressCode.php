<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\DressCode;
use DB;

/**
 * Class DressCode
 *
 * @package App\Models
 */
class DressCode extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'dress_code';

	protected $fillable = [
		'dress_man',
		'dress_woman'
	];

	public function Get() {
		$my_dress_code = DB::table('dress_code')->whereNULL('deleted_at')->get();
		return $my_dress_code;
	}

	public function GetDressCodeWedding(Request $request, $event) {
		$my_dress_code_wedding = DB::table('dress_code')->where('id', '=', $event[0]->dress_code_id)->whereNULL('deleted_at')->get();
		return $my_dress_code_wedding;
	}

	public function Store(Request $request) {
		$id = DB::table('dress_code')->max('id');
		$id = $id + 1;	

		$picture_path = 'master-data/dress-code/';

		$dress_code = new DressCode();
		$dress_code->dress_man = $request->dress_man;
		$dress_code->dress_woman = $request->dress_woman;				

		if($request->file('photo')) {	
			$name_file = Storage::disk('public')->put($picture_path.$id, $request->photo);
			$dress_code->picture_path = $name_file;
		}

		$dress_code->save();
	}

	public function UpdateDC(Request $request) {
		$id = $request->id;
		
		$picture_path = 'master-data/dress-code/';
	  
		$dress_code = DressCode::find($id);
		$dress_code->dress_man = $request->dress_man;
		$dress_code->dress_woman = $request->dress_woman;	

		if($request->file('photo')) {	
			$name_file = Storage::disk('public')->put($picture_path.$id, $request->photo);
			$dress_code->picture_path = $name_file;
		}

		$dress_code->save();
	}

	public function DeleteDC(Request $request) {
		$id = $request->d_id;
			  
		$dress_code = DressCode::find($id);
		$dress_code->delete();
	}
}
