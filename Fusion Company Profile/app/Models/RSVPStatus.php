<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\RSVPStatus;
use DB;

/**
 * Class RSVPStatus
 *
 * @package App\Models
 */
class RSVPStatus extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'rsvp_status';

	protected $fillable = [
		'name'
	];

	public function Get() {
		$rsvp_status = DB::table('rsvp_status')->whereNull('deleted_at')->get();
		return $rsvp_status;
	}

	public function Store(Request $request) {
		$id = DB::table('rsvp_status')->max('id');
		$id = $id + 1;		

		$rsvp_status = new RSVPStatus();
		$rsvp_status->name = $request->name;
		$rsvp_status->save();
	}

	public function UpdateRSVP(Request $request) {
		$id = $request->u_id;
	  
		$rsvp_status = RSVPStatus::find($id);
		$rsvp_status->name = $request->name;
		$rsvp_status->save();
	}

	public function DeleteRSVP(Request $request) {
		$id = $request->d_id;
			  
		$rsvp_status = RSVPStatus::find($id);
		$rsvp_status->delete();
	}
}
