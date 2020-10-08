<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Warna extends Model
{
    protected $table = 'Warna';
    protected $guarded = ['ID'];
    protected $fillable = ['Nama', 'isDelete'];


    public function StoreWarna(Request $Request)
    {
        $unique_id = uniqid();
        $Warna = new Warna(array(
            'Nama' => $Request->get('NamaWarna'),
            'isDelete' => (1)
        ));
        $Warna->save();
    }

    public function UpdateWarna(Request $Request)
    {
        $IDWarna = $Request->get('IDWarna');
        DB::table('Warna')
            ->where('ID', $IDWarna)
            ->update(['Nama' => $Request->get('NamaWarna'),
                      'isDelete' => $Request->get('isDeleteWarna')]);
    }
}
