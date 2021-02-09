<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\EventPlace;
use App\Models\Geocoder\Geocoder;
use DB;
use File;


/**
 * Class EventPlace
 *
 * @package App\Models
 */
class EventPlace extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'event_place';

	protected $fillable = [
		'name',
		'address',
		'city',
		'country',
		'picture_path',
		'google_map_link',
		'date',
        'latitude',
        'longitude',
		'time_start',
		'time_end',
		'even_id',
		'event_place_category_id'
	];

	public function Get(Request $request, $event) {
		$my_event_place = DB::table('event_place')->join('event_place_category', 'event_place.event_place_category_id', '=','event_place_category.id')
							->select('event_place.*', 'event_place_category.name as event_place_category_name')
							->where('event_place.event_id', '=', $event[0]->id)->whereNULL('event_place.deleted_at')->get();
		return $my_event_place;
	}

	public function GetWedding(Request $request, $event) {
		$my_event_place_wedding = DB::table('event_place')->join('event_place_category', 'event_place.event_place_category_id', '=','event_place_category.id')
							->select('event_place.*', 'event_place_category.name as event_place_category_name')
							->where('event_place.event_id', '=', $event[0]->id)
							->where('event_place.event_place_category_id', '=', 1)
							->orWhere('event_place.event_place_category_id', '=', 3)
							->whereNULL('event_place.deleted_at')
							->orderByDesc('event_place.event_place_category_id')
							->get();
		return $my_event_place_wedding;
	}

	public function Store(Request $request, $event) {
		$id = DB::table('event_place')->max('id');
		$id = $id + 1;

		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/event-place/';

		$event_place = new EventPlace();
		$event_place->name = $request->name;
		$event_place->address = $request->address;
		$event_place->city = $request->city;
		$event_place->country = $request->country;

		$path_event_place_photo = $path.'/'.$id.'.jpg';
		$event_place->picture_path = $path_event_place_photo;

		$event_place->google_map_link = $request->google_map_link;
		$event_place->date = $request->date;
		$event_place->time_start = $request->time_start;
		$event_place->time_end = $request->time_end;
		$event_place->event_id = Crypt::decryptString($request->ep_event_id);
		$event_place->event_place_category_id = $request->event_place_category_id;

		// Please Enalbe Your Billing Account First
        // $address = $request->address.', '.$request->city; // Google HQ

        // $client = new \GuzzleHttp\Client();
        // $geocoder = new Geocoder($client);
        // $geocoder->setApiKey(config('geocoder.key'));
        // $geocoder->setCountry(config('geocoder.country', $request->country));
        // $result = $geocoder->getCoordinatesForAddress($address);

        // $event_place->latitude =$result['lat'];
        // $event_place->longitude =$result['lng'];

		if($request->file('event_place_photo')) {
			$name_file = Storage::disk('public')->put($path.$id, $request->event_place_photo);
			$event_place->picture_path = $name_file;
		}

		$event_place->save();
		return $id;
	}

	public function UpdateEventPlace(Request $request, $event) {
		$id = $request->u_ep_id;

		$event_place = EventPlace::find($id);
		$event_place->name = $request->name;
		$event_place->address = $request->address;
		$event_place->city = $request->city;
		$event_place->country = $request->country;

		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/event-place/';
		$path_event_place_photo = $path.'/'.$request->u_ep_id.'.jpg';
		$event_place->picture_path = $path_event_place_photo;

		$event_place->google_map_link = $request->google_map_link;
		$event_place->date = $request->date;
		$event_place->time_start = $request->time_start;
		$event_place->time_end = $request->time_end;
		$event_place->event_id = Crypt::decryptString($request->u_event_id);
		$event_place->event_place_category_id = $request->u_event_place_category_id;

		if($request->file('event_place_photo')) {
			$name_file = Storage::disk('public')->put($path.$id, $request->event_place_photo);
			$event_place->picture_path = $name_file;
		}

		$event_place->save();
	}

	public function DeleteEventPlace(Request $request) {
		$id = $request->event_place_id;

		$event_place = EventPlace::find($id);
		$event_place->delete();
	}
}
