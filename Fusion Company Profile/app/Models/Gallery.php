<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Gallery;
use DB;
use File;

/**
 * Class gallery
 *
 * @package App\Models
 */
class Gallery extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'gallery';

	protected $fillable = [
		'photo_path',
		'photo_name',
		'gallery_category_id',
		'event_id'
	];

	public function Get(Request $request, $event) {
		$my_gallery = DB::table('gallery')->
							select('gallery.id as id', 'gallery.photo_path as photo_path', 'gallery.photo_name as photo_name', 'gallery.gallery_category_id as gallery_category_id', 
							'gallery_category.name as category_name')->
							join('gallery_category', 'gallery_category.id', '=', 'gallery.gallery_category_id')->
							join('event', 'event.id', '=', 'gallery.event_id')->
							where('event.id', '=', $event[0]->id)->
							whereNULL('gallery.deleted_at')->
							orderBy('gallery.gallery_category_id')->get();
		return $my_gallery;
	}
	
	public function Store(Request $request, $event) {	
		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/gallery/';

		if($request->file('gallery_photos')) {
			foreach($request->file('gallery_photos') as $image) {
				$gallery = new Gallery();
				$id = DB::table('gallery')->max('id');
				$id = $id + 1;		
				
				$name_file = Storage::disk('public')->put($path.$id, $image);
				$gallery->photo_path = $name_file;
				
				$gallery->photo_name = $id.'.jpg';
				$gallery->gallery_category_id = $request->gallery_category_id;		
				$gallery->event_id = Crypt::decryptString($request->gl_event_id);	
				$gallery->save();						
			}	
		}
	}

	public function DeleteGallery(Request $request) {
		$id = $request->d_gal_id;

		$gallery = Gallery::find($id);
		$gallery->delete();
	}
}
