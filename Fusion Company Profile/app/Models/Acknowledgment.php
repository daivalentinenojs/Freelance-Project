<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Acknowledgment;
use DB;
use File;

/**
 * Class Acknowledgment
 *
 * @package App\Models
 */
class Acknowledgment extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'acknowledgment';

	protected $fillable = [
		'pre_wedding_photographer',
		'pre_wedding_make_up',
		'engagement_organizer',
		'engagement_photographer',
		'engagement_make_up',
		'engagement_venue',
		'engagement_tray',
		'engagement_hampers',
		'wedding_organizer',
		'wedding_make_up',
		'wedding_photographer',
		'wedding_videographer',
		'wedding_suit',
		'wedding_dress',
		'wedding_decorator',
		'wedding_cake',
		'wedding_accessories',
		'wedding_stationary',
		'wedding_artist',
		'wedding_music',
		'wedding_bridesmaid_make_up',
		'wedding_bridesmaid_hampers',
		'wedding_bridesmaid_suit',
		'wedding_bridesmaid_dress',
		'wedding_holy_matrimony',
		'wedding_reception_venue'
	];

	public function Get(Request $request, $event) {
		$my_acknowledgment = DB::table('acknowledgment')->where('id', '=', $event[0]->acknowledgment_id)->get();
		return $my_acknowledgment;
	}
	
	public function Store(Request $request) {	
		$acknowledgment = new Acknowledgment();
		$acknowledgment->pre_wedding_photographer = $request->pre_wedding_photographer;
		$acknowledgment->pre_wedding_make_up = $request->pre_wedding_make_up;

		$acknowledgment->engagement_organizer = $request->engagement_organizer;
		$acknowledgment->engagement_photographer = $request->engagement_photographer;
		$acknowledgment->engagement_make_up = $request->engagement_make_up;		
		$acknowledgment->engagement_venue = $request->engagement_venue;
		$acknowledgment->engagement_tray = $request->engagement_tray;
		$acknowledgment->engagement_hampers = $request->engagement_hampers;

		$acknowledgment->wedding_organizer = $request->wedding_organizer;
		$acknowledgment->wedding_make_up = $request->wedding_make_up;
		$acknowledgment->wedding_photographer = $request->wedding_photographer;	
		$acknowledgment->wedding_videographer = $request->wedding_videographer;	
		$acknowledgment->wedding_suit = $request->wedding_suit;		

		$acknowledgment->wedding_dress = $request->wedding_dress;	
		$acknowledgment->wedding_decorator = $request->wedding_decorator;	
		$acknowledgment->wedding_cake = $request->wedding_cake;	
		$acknowledgment->wedding_accessories = $request->wedding_accessories;	
		$acknowledgment->wedding_stationary = $request->wedding_stationary;	
		
		$acknowledgment->wedding_artist = $request->wedding_artist;	
		$acknowledgment->wedding_music = $request->wedding_music;	
		$acknowledgment->wedding_bridesmaid_make_up = $request->wedding_bridesmaid_make_up;	
		$acknowledgment->wedding_bridesmaid_hampers = $request->wedding_bridesmaid_hampers;	
		$acknowledgment->wedding_bridesmaid_suit = $request->wedding_bridesmaid_suit;	

		$acknowledgment->wedding_bridesmaid_dress = $request->wedding_bridesmaid_dress;	
		$acknowledgment->wedding_holy_matrimony = $request->wedding_holy_matrimony;	
		$acknowledgment->wedding_reception_venue = $request->wedding_reception_venue;	
		$acknowledgment->save();

		$id = DB::table('acknowledgment')->max('id');
		return $id;
	}

	public function UpdateAcknowledgment(Request $request) {
		$id = $request->a_acknowledgment_id;
		
		$acknowledgment = Acknowledgment::find($id);
		$acknowledgment->pre_wedding_photographer = $request->pre_wedding_photographer;
		$acknowledgment->pre_wedding_make_up = $request->pre_wedding_make_up;

		$acknowledgment->engagement_organizer = $request->engagement_organizer;
		$acknowledgment->engagement_photographer = $request->engagement_photographer;
		$acknowledgment->engagement_make_up = $request->engagement_make_up;		
		$acknowledgment->engagement_venue = $request->engagement_venue;
		$acknowledgment->engagement_tray = $request->engagement_tray;
		$acknowledgment->engagement_hampers = $request->engagement_hampers;

		$acknowledgment->wedding_organizer = $request->wedding_organizer;
		$acknowledgment->wedding_make_up = $request->wedding_make_up;
		$acknowledgment->wedding_photographer = $request->wedding_photographer;	
		$acknowledgment->wedding_videographer = $request->wedding_videographer;	
		$acknowledgment->wedding_suit = $request->wedding_suit;		

		$acknowledgment->wedding_dress = $request->wedding_dress;	
		$acknowledgment->wedding_decorator = $request->wedding_decorator;	
		$acknowledgment->wedding_cake = $request->wedding_cake;	
		$acknowledgment->wedding_accessories = $request->wedding_accessories;	
		$acknowledgment->wedding_stationary = $request->wedding_stationary;	
		
		$acknowledgment->wedding_artist = $request->wedding_artist;	
		$acknowledgment->wedding_music = $request->wedding_music;	
		$acknowledgment->wedding_bridesmaid_make_up = $request->wedding_bridesmaid_make_up;	
		$acknowledgment->wedding_bridesmaid_hampers = $request->wedding_bridesmaid_hampers;	
		$acknowledgment->wedding_bridesmaid_suit = $request->wedding_bridesmaid_suit;	

		$acknowledgment->wedding_bridesmaid_dress = $request->wedding_bridesmaid_dress;	
		$acknowledgment->wedding_holy_matrimony = $request->wedding_holy_matrimony;	
		$acknowledgment->wedding_reception_venue = $request->wedding_reception_venue;
		$acknowledgment->save();
	}
}
