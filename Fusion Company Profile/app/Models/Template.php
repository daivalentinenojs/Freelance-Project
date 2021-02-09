<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Template;
use DB;

/**
 * Class Template
 *
 * @package App\Models
 */
class Template extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'template';

	protected $fillable = [
		'name',
        'url_link'
	];

	public function Get() {
		$template = DB::table('template')->whereNull('deleted_at')->get();
		return $template;
	}

	public function Store(Request $request) {
        $path = 'master-data/template/';

        $template = new Template();
        $template->name = $request->name;
        $template->url_link = $request->url_link;

        $id = DB::table('template')->max('id');
        $id = $id + 1;

        if($request->file('desktop_photo')) {
            $name_file = Storage::disk('public')->put($path.$id, $request->file('desktop_photo'));
            $template->desktop_photo_path = $name_file;
        }

        if($request->file('handphone_photo')) {
            $name_file = Storage::disk('public')->put($path.$id, $request->file('handphone_photo'));
            $template->handphone_photo_path = $name_file;
        }

        $template->save();
	}

	public function UpdateTemplate(Request $request) {
        $path = 'master-data/template/';

		$id = $request->u_id;

		$template = Template::find($id);
        $template->name = $request->name;
        $template->url_link = $request->url_link;

        if($request->file('desktop_photo')) {
            $name_file = Storage::disk('public')->put($path.$id, $request->file('desktop_photo'));
            $template->desktop_photo_path = $name_file;
        }

        if($request->file('handphone_photo')) {
            $name_file = Storage::disk('public')->put($path.$id, $request->file('handphone_photo'));
            $template->handphone_photo_path = $name_file;
        }

        $template->save();
	}

	public function DeleteTemplate(Request $request) {
		$id = $request->d_id;

        $template = Template::find($id);
        $template->delete();
	}
}
