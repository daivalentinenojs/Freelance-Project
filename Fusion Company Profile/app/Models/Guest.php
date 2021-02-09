<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Guest;
use DB;

/**
 * Class Guest
 *
 * @package App\Models
 */
class Guest extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'guest';

	protected $fillable = [
		'name',
		'email',
		'address',
		'telephone',
		'note',
		'code_barcode',
		'guest_id',
		'guest_category_id'
	];

	public function GetOneGuest(Request $request) {
		$did = Crypt::decryptString($request->guest_id);
		$my_guest = DB::table('guest')
			->select('guest.id as guest_id', 'guest.name as name', 'guest.email as email', 'guest.address as address', 'guest.telephone as telephone',
					'guest.note as note', 'guest.rsvp_status_id as rsvp_status_id', 'guest.meal_preference_id as meal_preference_id', 'guest.max_guest as max_guest', 'guest.total_guest as total_guest',
					'guest.last_gift_wish_id as last_gift_wish_id', 'guest.gift_wish_id as gift_wish_id', 'guest_category.id as guest_category_id', 'guest_category.name as guest_category_name')
			->join('event', 'event.id', '=', 'guest.event_id')
			->join('guest_category', 'guest_category.id', '=', 'guest.guest_category_id')
			->where('guest.id', '=', $did)
			->where('event.url_event', '=', $request->event_code)
			->get();
		return $my_guest;
	}

	public function Get(Request $request) {
		$my_guest = DB::table('guest')
			->select('guest.id as guest_id', 'guest.name as name', 'guest.email as email', 'guest.address as address', 'guest.telephone as telephone',
					'guest.note as note', 'guest.rsvp_status_id as rsvp_status_id', 'rsvp_status.name as rsvp_name', 'guest.total_guest as total_guest',
					'guest.meal_preference_id as meal_preference_id', 'meal_preference.name as meal_preference_name',
					'guest.last_gift_wish_id as last_gift_wish_id', 'guest.gift_wish_id as gift_wish_id', 'gift_wish.name as gift_wish_name',
					'guest_category.id as guest_category_id', 'guest_category.name as guest_category_name', 'event.url_event as url_event')
			->leftjoin('event', 'event.id', '=', 'guest.event_id')
			->leftjoin('rsvp_status', 'guest.rsvp_status_id', '=', 'rsvp_status.id')
			->leftjoin('meal_preference', 'guest.meal_preference_id', '=', 'meal_preference.id')
			->leftjoin('gift_wish', 'guest.gift_wish_id', '=', 'gift_wish.id')
			->leftjoin('guest_category', 'guest_category.id', '=', 'guest.guest_category_id')
			->where('event.id', '=', Crypt::decryptString($request->event_id))
			->whereNULL('guest.deleted_at')
			->get();		
		return $my_guest;
	}

	public function GetTotalGuest(Request $request) {
		$total_guest = DB::table('guest')
			->select('guest.total_guest')
			->join('event', 'event.id', '=', 'guest.event_id')
			->join('rsvp_status', 'guest.rsvp_status_id', '=', 'rsvp_status.id')
			->where('event.id', '=', Crypt::decryptString($request->event_id))
			->where(function($query) {
                $query->where('guest.rsvp_status_id', '=', 1)->orWhere('guest.rsvp_status_id', '=', 2);
            })->sum('guest.total_guest');		
		return $total_guest;
	}

	public function Generate_String($input, $strength = 250) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
	 
		return $random_string;
	}

	public function Store(Request $request) {
		$id = DB::table('guest')->max('id');
		$id = $id + 1;		

		$guest = new Guest();
		$guest->name = $request->name;
		$guest->email = $request->email;
		$guest->address = $request->address;
		$guest->telephone = $request->telephone;

		if ($request->guest_category_id == 1 )
			$guest->max_guest = $request->max_guest;	
		elseif ($request->guest_category_id == 2 )
			$guest->max_guest = 2;
		elseif ($request->guest_category_id == 3 )
			$guest->max_guest = 1;
		
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code_barcode = $this->Generate_String($permitted_chars, 250);
		$guest->code_barcode = $code_barcode;		
		$guest->event_id = Crypt::decryptString($request->event_id);
		$guest->guest_category_id = $request->guest_category_id;
		$guest->save();
	}

	public function UpdateGuest(Request $request) {
		$id = $request->u_id;
	  
		$guest = Guest::find($id);
		$guest->name = $request->name;
		$guest->email = $request->email;
		$guest->address = $request->address;
		$guest->telephone = $request->telephone;
		$guest->guest_category_id = $request->guest_category_id;
		// $guest->max_guest = $request->max_guest;
		if ($request->guest_category_id == 1 )
			$guest->max_guest = $request->max_guest;	
		elseif ($request->guest_category_id == 2 )
			$guest->max_guest = 2;
		elseif ($request->guest_category_id == 3 )
			$guest->max_guest = 1;
		$guest->save();
	} 

	public function UpdateRSVPYes(Request $request, $check_input_same) {
		$id = $request->guest_id;

		$guest = Guest::find($id);
		$guest->name = $request->name;
		// $guest->email = $request->email;
		// $guest->address = $request->address;
		// $guest->telephone = $request->telephone;
		
		$guest->rsvp_status_id = $request->rsvp_status_id;		
		if ($guest->guest_category_id == 3) {
			$guest->total_guest = 1;
		} else {
			$guest->total_guest = $request->total_guest;
		}

		$guest->meal_preference_id = $request->meal_preference_id;	
		if($check_input_same != 0) {
			if(empty($guest->last_gift_wish_id)) {
				$guest->last_gift_wish_id = $request->gift_wish_id;
			} else {
				$guest->last_gift_wish_id = $guest->gift_wish_id;
			}
			$guest->gift_wish_id = $request->gift_wish_id;
		}		
		$guest->note = $request->note;	
		$guest->save();

		return $guest;
	}

	public function UpdateRSVPYesNoGift(Request $request) {
		$id = $request->guest_id;

		$guest = Guest::find($id);
		$guest->name = $request->name;
		// $guest->email = $request->email;
		// $guest->address = $request->address;
		// $guest->telephone = $request->telephone;
		
		$guest->rsvp_status_id = $request->rsvp_status_id;		
		if ($guest->guest_category_id == 3) {
			$guest->total_guest = 1;
		} else {
			$guest->total_guest = $request->total_guest;
		}

		if ($request->meal_preference_id != '') {
			$guest->meal_preference_id = $request->meal_preference_id;	
		}

		$guest->note = $request->note;	
		$guest->save();

		return $guest;
	}

	public function UpdateRSVPNo(Request $request) {
		$id = $request->guest_id;

		$guest = Guest::find($id);
		$guest->name = $request->name;
		$guest->email = $request->email;
		$guest->address = $request->address;
		$guest->telephone = $request->telephone;
		
		$guest->rsvp_status_id = $request->rsvp_status_id;		
		$guest->total_guest = 0;
		$guest->save();
	}

	public function CheckRSVP(Request $request) {
		$id = $request->guest_id;

		$guest = Guest::find($id);
		if ($guest->gift_wish_id == $request->gift_wish_id)
			return 0;
		else
			return 1;
	}

	public function DeleteGuest(Request $request) {
		$id = $request->d_id;
			  
		$guest = Guest::find($id);
		$guest->delete();
	}
}
