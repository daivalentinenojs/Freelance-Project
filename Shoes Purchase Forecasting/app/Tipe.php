<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Tipe extends Model
{
    protected $table = 'Tipe';
    protected $guarded = ['ID'];
    protected $fillable = ['Nama', 'isDelete', 'MerekSepatuID'];


    public function StoreTipeSepatu(Request $Request)
    {
        $unique_id = uniqid();
        $TipeSepatu = new Tipe(array(
            'Nama' => $Request->get('NamaTipeSepatu'),
            'MerekSepatuID' => $Request->get('MerekSepatu'),
            'isDelete' => (1)
        ));
        $TipeSepatu->save();
    }

    public function UpdateTipeSepatu(Request $Request)
    {
        $IDTipeSepatu = $Request->get('IDTipeSepatu');
        DB::table('Tipe')
            ->where('ID', $IDTipeSepatu)
            ->update(['Nama' => $Request->get('NamaTipeSepatu'),
                      'MerekSepatuID' => $Request->get('MerekSepatu'),
                      'isDelete' => $Request->get('isDeleteTipeSepatu')]);
    }
}
