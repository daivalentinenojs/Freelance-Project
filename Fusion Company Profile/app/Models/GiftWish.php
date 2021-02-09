<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\GiftWish;
use DB;
use File;

/**
 * Class GiftWish
 *
 * @package App\Models
 */
class GiftWish extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'gift_wish';

	protected $fillable = [
		'name',
		'is_primary',
		'description',
		'total',
		'picture_path',
		'even_id'
	];

	public function Get(Request $request, $event) {
		$my_gift_wish = DB::table('gift_wish')->
							where('gift_wish.event_id', '=', $event[0]->id)->whereNULL('gift_wish.deleted_at')->get();
		return $my_gift_wish;
	}

	public function GetRSVP(Request $request, $event) {
		$my_gift_wish = DB::table('gift_wish')
							->where('gift_wish.event_id', '=', $event[0]->id)
							->whereNULL('gift_wish.deleted_at')->get();
		return $my_gift_wish;
	}
	
	public function Store(Request $request, $event) {		
		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/gift-wish/';
		
		$gift_wish = new GiftWish();
		$gift_wish->name = $request->gift_name;
		$gift_wish->is_primary = $request->is_primary;
		$gift_wish->description = $request->description;
		$gift_wish->total = $request->total;
		$gift_wish->event_id = Crypt::decryptString($request->gw_event_id);

		$id = DB::table('gift_wish')->max('id');
		$id += 1;

		$path_gift_wish_photo = $path.'/'.$id.'.jpg';
		$gift_wish->picture_path = $path_gift_wish_photo;		

		if($request->file('gift_photo')) {	
			$name_file = Storage::disk('public')->put($path.$id, $request->gift_photo);
			$gift_wish->picture_path = $name_file;
		}
		
		$gift_wish->save();

		$id = DB::table('gift_wish')->max('id');
		return $id;
	}

	public function UpdateGiftWish(Request $request, $event) {
		$id = $request->u_gw_id;

		$gift_wish = GiftWish::find($id);
		$gift_wish->name = $request->gift_name;
		$gift_wish->is_primary = $request->is_primary;
		$gift_wish->description = $request->description;
		$gift_wish->total = $request->total;
		$gift_wish->event_id = Crypt::decryptString($request->u_event_id);

		$path = 'events/'.substr($event[0]->date,0,4).'/wedding/'.$event[0]->date.'-'.strtolower($event[0]->prince_nickname).'-and-'.strtolower($event[0]->princess_nickname).'/gift-wish/';
		
		if($request->file('gift_photo')) {	
			$name_file = Storage::disk('public')->put($path.$id, $request->gift_photo);
			$gift_wish->picture_path = $name_file;
		}

		$gift_wish->save();
	}

	public function UpdateGiftWishRSVP(Request $request, $guest, $check_input_same) {
		if ($check_input_same != 0) {
        // if ($guest->last_gift_wish_id != $guest->gift_wish_id) {
            if (!empty($request->last_gift_wish_id)) {
                $id_before = $guest->last_gift_wish_id;
				$gift_wish_before = GiftWish::find($id_before);
				
                if ($gift_wish_before->total == 0) {
                    $gift_wish_before->total = 0;
                } elseif ($gift_wish_before->total == -1) {
                    $gift_wish_before->total = 1;
                } else {
                    $gift_wish_before->total = $gift_wish_before->total + 1;
                }
                $gift_wish_before->save();
            }
            
			$id_current = $guest->gift_wish_id;
			$gift_wish_current = GiftWish::find($id_current);

			if ($gift_wish_current->total == 0) {
				$gift_wish_current->total = 0;
			} elseif ($gift_wish_current->total == 1) {
				$gift_wish_current->total = -1;
			} else {
				$gift_wish_current->total = $gift_wish_current->total - 1;
			}
			$gift_wish_current->save();
		}
	}

	public function CheckTotalGiftWish(Request $request) {
        $id_current = $request->gift_wish_id;
		$gift_wish_current = GiftWish::find($id_current);

		if ($gift_wish_current->total == -1) {
			return 0;
		} else {
			return 1;
		}
	}

	public function DeleteGiftWish(Request $request) {
		$id = $request->gift_wish_id;
			  
		$gift_wish = GiftWish::find($id);
		$gift_wish->delete();
	}
}
