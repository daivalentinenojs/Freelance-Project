<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\MyEvent;
use Auth;
use DB;
use File;

/**
 * Class MyEvent
 *
 * @package App\Models
 */
class MyEvent extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'event';

	protected $fillable = [
		'prince_name',
		'princess_name',
		'date',
		'url_event'
	];

	public function Get(Request $request) {
		$did = Crypt::decryptString($request->event_id);
		$my_event = DB::table('event')->where('id', '=', $did)->get();
		return $my_event;
	}

	public function UpdateGalleryHeader(Request $request) {
		$did = Crypt::decryptString($request->glh_event_id);

		$event = MyEvent::find($did);
		$event->gallery_title = $request->gallery_title;
		$event->gallery_description = $request->gallery_description;
		$event->save();
	}

    public function UpdateRegistry(Request $request) {
	    echo"aa";
        $did = Crypt::decryptString($request->rg_event_id);

        $event = MyEvent::find($did);
        $event->registry_title = $request->registry_title;
        $event->registry_note = $request->registry_note;
        $event->save();
    }

	public function GetURL(Request $request) {
		$my_event = DB::table('event')->where('url_event', '=', $request->event_code)->get();
		return $my_event;
    }

	public function Store(Request $request) {
		$id = DB::table('event')->max('id');
		$id = $id + 1;

		$path = 'assets/images/events/'.substr($request->date,0,4).'/wedding/'.$request->date.'-'.strtolower($request->prince_nickname).'-and-'.strtolower($request->princess_nickname);
		File::makeDirectory($path, $mode = 0777, true, true);

		$event = new MyEvent();
		$event->prince_name = $request->prince_name;
		$event->prince_nickname = $request->prince_nickname;
		$event->princess_name = $request->princess_name;
		$event->princess_nickname = $request->princess_nickname;
		$event->date = $request->date;
		$event->contact_person_name = $request->contact_person_name;
		$event->contact_person_whatsapp = $request->contact_person_whatsapp;

		// $url = strtolower($request->prince_nickname).'-and-'.strtolower($request->princess_nickname).'-'.$request->date;
		$event->url_event = $request->url_event;

		$event->event_category_id = $request->event_category_id;
		$event->user_id = Auth::user()->id;
		$event->save();
	}

	public function UpdateEvent(Request $request) {
		$id = $request->u_id;

		$event = MyEvent::find($id);
		$event->prince_name = $request->prince_name;
		$event->prince_nickname = $request->prince_nickname;
		$event->princess_name = $request->princess_name;
		$event->princess_nickname = $request->princess_nickname;
		$event->date = $request->date;
		$event->contact_person_name = $request->contact_person_name;
		$event->contact_person_whatsapp = $request->contact_person_whatsapp;

		// $url = strtolower($request->prince_nickname).'-and-'.strtolower($request->princess_nickname).'-'.$request->date;
		// $event->url_event = $url;

		$event->event_category_id = $request->event_category_id;
		$event->save();
	}

	public function DeleteEvent(Request $request) {
		$id = $request->d_id;

		$event = MyEvent::find($id);
		$event->delete();
	}

	public function UpdateEventFamilyInformation(Request $request, $family_information_id) {
		$did = Crypt::decryptString($request->fi_event_id);

		$event = MyEvent::find($did);
		$event->family_information_id = $family_information_id;
		$event->save();
	}

	public function UpdateEventAcknowledgment(Request $request, $acknowledgment_id) {
		$did = Crypt::decryptString($request->a_event_id);

		$event = MyEvent::find($did);
		$event->acknowledgment_id = $acknowledgment_id;
		$event->save();
	}

	public function UpdateEventOurStory(Request $request, $our_story_id) {
		$did = Crypt::decryptString($request->os_event_id);

		$event = MyEvent::find($did);
		$event->our_story_id = $our_story_id;
		$event->save();
	}

	public function UpdateEventTimeline(Request $request, $timeline_id) {
		$did = Crypt::decryptString($request->tl_event_id);

		$event = MyEvent::find($did);
		$event->timeline_id = $timeline_id;
		$event->save();
	}

	public function UpdateEventDressCode(Request $request) {
		$did = Crypt::decryptString($request->dc_event_id);

		$event = MyEvent::find($did);
		$event->dress_code_id = $request->dress_code;
		$event->save();
	}


}
