<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\FamilyInformation;
use DB;
use File;

/**
 * Class family_information
 *
 * @package App\Models
 */
class FamilyInformation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'family_information';

	protected $fillable = [
		'path_prince_photo',
		'th_prince',
		'total_prince_siblings',
		'prince_father',
		'prince_mother',
		'prince_information',
		'path_princess_photo',
		'th_princess',
		'total_princess_siblings',
		'princess_father',
		'princess_mother',
		'princess_information',
		'header_photo',
		'footer_photo',
		'couple_photo_1',
		'couple_photo_2',
		'couple_photo_3'
	];

	public function Get(Request $request, $event) {
		$my_family_information = DB::table('family_information')->join('event', 'family_information.id', '=', 'event.family_information_id')->
							where('family_information.id', '=', $event[0]->family_information_id)->
							whereNULL('family_information.deleted_at')->get();
		return $my_family_information;
	}
	
	public function Store(Request $request, $event) {
		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/family-information/';
		$path_banner = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/banner/';

		$family_information = new FamilyInformation();	
		$family_information->th_prince = $request->th_prince;
		$family_information->total_prince_siblings = $request->total_prince_siblings;
		$family_information->prince_father = $request->prince_father;
		$family_information->prince_mother = $request->prince_mother;
		$family_information->prince_information = $request->prince_information;
			
		$family_information->th_princess = $request->th_princess;
		$family_information->total_princess_siblings = $request->total_princess_siblings;
		$family_information->princess_father = $request->princess_father;
		$family_information->princess_mother = $request->princess_mother;
		$family_information->princess_information = $request->princess_information;	

		if($request->file('prince_photo')) {	
			$name_file = Storage::disk('public')->put($path.'prince-photo', $request->prince_photo);
			$family_information->path_prince_photo = $name_file;
		}

		if($request->file('princess_photo')) {	
			$name_file = Storage::disk('public')->put($path.'princess-photo', $request->princess_photo);		
			$family_information->path_princess_photo = $name_file;
		}

		if($request->hasFile('header_banner')) {	
			$name_file = Storage::disk('public')->put($path_banner.'header-banner', $request->header_banner);
			$family_information->header_photo = $name_file;
		}

		if($request->hasFile('footer_banner')) {			
			$name_file = Storage::disk('public')->put($path_banner.'footer-banner', $request->footer_banner);
			$family_information->footer_photo = $name_file;
		}

		if($request->hasFile('couple_photo_1')) {	
			$name_file = Storage::disk('public')->put($path_banner.'couple-photo-1', $request->couple_photo_1);
			$family_information->couple_photo_1 = $name_file;			
		}

		if($request->hasFile('couple_photo_2')) {	
			$name_file = Storage::disk('public')->put($path_banner.'couple-photo-2', $request->couple_photo_2);
			$family_information->couple_photo_2 = $name_file;
		}

		if($request->hasFile('couple_photo_3')) {		
			$name_file = Storage::disk('public')->put($path_banner.'couple-photo-3', $request->couple_photo_3);			
			$family_information->couple_photo_3 = $name_file;
		}

		$family_information->save();
		
		$id = DB::table('family_information')->max('id');
		return $id;
	}

	public function UpdateFamilyInformation(Request $request, $event) {
		$id = $request->fi_family_information_id;

		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/family-information/';
		$path_banner = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/banner/';

		$family_information = FamilyInformation::find($id);
		$family_information->th_prince = $request->th_prince;
		$family_information->total_prince_siblings = $request->total_prince_siblings;
		$family_information->prince_father = $request->prince_father;
		$family_information->prince_mother = $request->prince_mother;
		$family_information->prince_information = $request->prince_information;
		
		$family_information->th_princess = $request->th_princess;
		$family_information->total_princess_siblings = $request->total_princess_siblings;
		$family_information->princess_father = $request->princess_father;
		$family_information->princess_mother = $request->princess_mother;
		$family_information->princess_information = $request->princess_information;

		if($request->file('prince_photo')) {	
			$name_file = Storage::disk('public')->put($path.'prince-photo', $request->prince_photo);
			$family_information->path_prince_photo = $name_file;
		}

		if($request->file('princess_photo')) {	
			$name_file = Storage::disk('public')->put($path.'princess-photo', $request->princess_photo);		
			$family_information->path_princess_photo = $name_file;
		}

		if($request->hasFile('header_banner')) {	
			$name_file = Storage::disk('public')->put($path_banner.'header-banner', $request->header_banner);
			$family_information->header_photo = $name_file;
		}

		if($request->hasFile('footer_banner')) {			
			$name_file = Storage::disk('public')->put($path_banner.'footer-banner', $request->footer_banner);
			$family_information->footer_photo = $name_file;
		}

		if($request->hasFile('couple_photo_1')) {	
			$name_file = Storage::disk('public')->put($path_banner.'couple-photo-1', $request->couple_photo_1);
			$family_information->couple_photo_1 = $name_file;			
		}

		if($request->hasFile('couple_photo_2')) {	
			$name_file = Storage::disk('public')->put($path_banner.'couple-photo-2', $request->couple_photo_2);
			$family_information->couple_photo_2 = $name_file;
		}

		if($request->hasFile('couple_photo_3')) {		
			$name_file = Storage::disk('public')->put($path_banner.'couple-photo-3', $request->couple_photo_3);			
			$family_information->couple_photo_3 = $name_file;
		}

		$family_information->save();
	}
}
