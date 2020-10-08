<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class BarangCatatReturJual extends Model
{
    protected $table = 'BarangCatatReturJuals';
    protected $guarded = ['ReturJualID'];
    protected $fillable = ['ReturJualID', 'BarangID', 'KuantitiBarangAsal', 'KuantitiBarangGanti',
    'SubTotal'];

    public function StoreBarangCatatReturJual(Request $Request)
    {
        $unique_id = uniqid();
        $BarangCatatReturJual = new BarangCatatReturJual(array(
            'ReturJualID' => $Request->get('ReturJualID'),
            'BarangID' => $Request->get('BarangID'),
            'KuantitiBarangAsal' => $Request->get('KuantitiBarangAsal'),
            'KuantitiBarangGanti' => $Request->get('KuantitiBarangGanti'),
            'SubTotal' => $Request->get('SubTotal')
        ));
        $BarangCatatReturJual->save();
        $ID = DB::table('Barangs')->max('IDBarang');
    }

    public function UpdateBarangCatatReturJual(Request $Request)
    {
        DB::table('BarangCatatReturJual')
            ->where('ReturJualID', $ReturJualID)
            ->where('BarangID', $BarangID)
            ->update(['KuantitiBarangAsal' => $Request->get('KuantitiBarangAsal'),
     				'KuantitiBarangGanti' => $Request->get('KuantitiBarangGanti'),
                    'SubTotal' => $Request->get('SubTotal')]);
    }
}
