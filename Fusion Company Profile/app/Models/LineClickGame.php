<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\LineClickGame;
use DB;

/**
 * Class DressCode
 *
 * @package App\Models
 */
class LineClickGame extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'line_click_game';

	protected $fillable = [
		'user_id',
		'user_name',
        'score',
        'average_click'
	];

	public function GetHighScore() {
		$high_score = DB::table('line_click_game')->orderBy('score', 'DESC')->limit(10)->whereNULL('deleted_at')->get();
		return $high_score;
	}

	public function Store(Request $request) {
		$save_record = new LineClickGame();
        $save_record->user_id = $request->l_userid;
        $save_record->user_name = $request->l_username;
        $save_record->score = $request->l_score;
        $save_record->average_click = $request->l_average_click;
        $save_record->save();
	}
}
