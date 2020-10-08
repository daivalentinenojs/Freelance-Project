<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class BarangCatatNotaJual extends Model
{
    protected $table = 'BarangCatatNotaJuals';
    protected $guarded = ['NotaJualID'];
    protected $fillable = ['NotaJualID', 'BarangID', 'Kuantiti', 'HargaJual', 'SubTotal'];

    public function StoreBarangCatatNotaJual(Request $Request)
    {
        $unique_id = uniqid();
        $BarangCatatNotaJual = new BarangCatatNotaJual(array(
            'NotaJualID' => $Request->get('NotaJualID'),
            'BarangID' => $Request->get('BarangID'),
            'Kuantiti' => $Request->get('Kuantiti'),
            'HargaJual' => $Request->get('HargaJual'),
            'SubTotal' => $Request->get('SubTotal'),
        ));
        $BarangCatatNotaJual->save();
    }

    public function UpdateBarangCatatNotaJual(Request $Request)
    {
        DB::table('BarangCatatNotaJuals')
            ->where('NotaJualID', $NotaJualID)
            ->where('BarangID', $BarangID)
            ->update(['Kuantiti' => $Request->get('Kuantiti'),
            		'HargaJual' => $Request->get('HargaJual'),
            		'SubTotal' => $Request->get('SubTotal')]);
    }
}
