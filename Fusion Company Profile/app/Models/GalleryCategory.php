<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use DB;

/**
 * Class GalleryCategory
 *
 * @package App\Models
 */
class GalleryCategory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'gallery_category';

	protected $fillable = [
		'name'
	];

	public function Get() {
		$gallery_categories = DB::table('gallery_category')->whereNull('deleted_at')->get();
		return $gallery_categories;
	}

	public function GetWedding($request, $event) {
		$gallery_categories = DB::table('gallery_category')
								->select('gallery_category.id', 'gallery_category.name')
								->distinct('gallery_category.name')
								->join('gallery', 'gallery_category.id', '=', 'gallery.gallery_category_id')
								->join('event', 'event.id', '=', 'gallery.event_id')
                                ->where('event.id', '=', $event[0]->id)
                                ->whereNull('gallery.deleted_at')
                                ->whereNull('gallery_category.deleted_at')->get();
		return $gallery_categories;
	}

	public function Store(Request $request) {
		$id = DB::table('gallery_category')->max('id');
		$id = $id + 1;

		$gallery_category = new GalleryCategory();
		$gallery_category->name = $request->name;
		$gallery_category->save();
	}

	public function UpdateGC(Request $request) {
		$id = $request->u_id;

		$gallery_category = GalleryCategory::find($id);
		$gallery_category->name = $request->name;
		$gallery_category->save();
	}

	public function DeleteGC(Request $request) {
		$id = $request->d_id;

		$gallery_category = GalleryCategory::find($id);
		$gallery_category->delete();
	}
}
