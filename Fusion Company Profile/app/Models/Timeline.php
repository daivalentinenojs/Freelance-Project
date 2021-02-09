<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Timeline;
use DB;
use File;

/**
 * Class timeline
 *
 * @package App\Models
 */
class Timeline extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'timeline';

	protected $fillable = [
		'quote',
		'author'
	];

	public function Get(Request $request, $event) {
		$my_timeline = DB::table('timeline')->join('event', 'timeline.id', '=', 'event.timeline_id')->
							where('timeline.id', '=', $event[0]->timeline_id)->
							whereNULL('timeline.deleted_at')->get();
		return $my_timeline;
	}
	
	public function Store(Request $request, $event) {
		$id = DB::table('timeline')->max('id');
		$id = $id + 1;		
		
		$timeline = new Timeline();
		$timeline->quote = $request->quote;
		$timeline->author = $request->author;	
		$timeline->save();

		return $id;
	}

	public function UpdateTimeline(Request $request, $event) {
		$id = $request->tl_timeline_id;
		
		$timeline = Timeline::find($id);		
		$timeline->quote = $request->quote;
		$timeline->author = $request->author;	
		$timeline->save();		
	}
}
