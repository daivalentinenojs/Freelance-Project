<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\OurStory;
use DB;
use File;

/**
 * Class OurStory
 *
 * @package App\Models
 */
class OurStory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'our_story';

	protected $fillable = [
		'name',
		'is_primary',
		'description',
		'total',
		'picture_path',
		'even_id'
	];

	public function Get(Request $request, $event) {
		$my_our_story = DB::table('our_story')->join('event', 'our_story.id', '=', 'event.our_story_id')->
							where('our_story.id', '=', $event[0]->our_story_id)->
							whereNULL('our_story.deleted_at')->get();
		return $my_our_story;
	}
	
	public function Store(Request $request, $event) {
		$our_story = new OurStory();
		$our_story->title = $request->title;
		$our_story->story = $request->story;
		$our_story->quote = $request->quote;
		$our_story->author = $request->author;
		$our_story->save();

		$id = DB::table('our_story')->max('id');
		return $id;
	}

	public function UpdateOurStory(Request $request, $event) {
		$id = $request->os_our_story_id;

		$our_story = OurStory::find($id);
		$our_story->title = $request->title;
		$our_story->story = $request->story;
		$our_story->quote = $request->quote;
		$our_story->author = $request->author;
		$our_story->save();
	}
}
