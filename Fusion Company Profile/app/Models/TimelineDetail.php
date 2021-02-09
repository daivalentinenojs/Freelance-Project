<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\TimelineDetail;
use DB;
use File;

/**
 * Class timeline_detail
 *
 * @package App\Models
 */
class TimelineDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'timeline_detail';

	protected $fillable = [
		'title',
		'date',
		'city',
		'country',
		'path_timeline_detail',
		'timeline_id'
	];

	public function Get(Request $request, $timeline) {
		$my_timeline_detail = DB::table('timeline_detail')->
							select('timeline_detail.id as td_id', 'timeline_detail.title as title', 'timeline_detail.date as date', 'timeline_detail.path_timeline_detail as path_timeline_detail',
							'timeline_detail.city as city', 'timeline_detail.country as country')->
							join('timeline', 'timeline.id', '=', 'timeline_detail.timeline_id')->
							join('event', 'timeline.id', '=', 'event.timeline_id')->
							where('event.timeline_id', '=', $timeline[0]->timeline_id)->
							whereNULL('timeline_detail.deleted_at')->
							orderBy('timeline_detail.date')->get();
		return $my_timeline_detail;
	}
	
	public function Store(Request $request, $event) {
		$id = DB::table('timeline_detail')->max('id');
		$id = $id + 1;		
		
		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/timeline-detail/';
		
		$timeline_detail = new TimelineDetail();
	
		$timeline_detail->title = $request->title;
		$timeline_detail->date = $request->date;
		$timeline_detail->city = $request->city;
		$timeline_detail->country = $request->country;
		$timeline_detail->timeline_id = $request->tl_timeline_id;		
		
		if($request->file('timeline_detail_photo')) {	
			$name_file = Storage::disk('public')->put($path.$id, $request->timeline_detail_photo);
			$timeline_detail->path_timeline_detail = $name_file;
		}

		$timeline_detail->save();
	}

	public function UpdateTimelineDetail(Request $request, $event) {
		$id = $request->u_tl_id;
		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/timeline-detail/';
		
		$timeline_detail = TimelineDetail::find($id);
		$path_timeline_detail = $path.$id.'.jpg';
		$timeline_detail->path_timeline_detail = $path_timeline_detail;

		$timeline_detail->title = $request->title;
		$timeline_detail->date = $request->date;
		$timeline_detail->city = $request->city;
		$timeline_detail->country = $request->country;
		$timeline_detail->timeline_id = $event[0]->timeline_id;	

		if($request->file('timeline_detail_photo')) {	
			$name_file = Storage::disk('public')->put($path.$id, $request->timeline_detail_photo);
			$timeline_detail->path_timeline_detail = $name_file;
		}

		$timeline_detail->save();
	}

	public function DeleteTimelineDetail(Request $request) {
		$id = $request->d_tl_id;
			  
		$timeline_detail = TimelineDetail::find($id);
		$timeline_detail->delete();
	}
}
