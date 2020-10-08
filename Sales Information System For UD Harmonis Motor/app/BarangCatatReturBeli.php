<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class BarangCatatReturBeli extends Model
{
    protected $table = 'BarangCatatReturBelis';
    protected $guarded = ['ReturBeliID'];
    protected $fillable = ['ReturBeliID', 'BarangID', 'KuantitiBarangAsal', 'KuantitiBarangGanti', 
    'SubTotal'];

    public function StoreBarangCatatReturBeli(Request $Request)
    {
        $unique_id = uniqid();
        $BarangCatatReturBeli = new BarangCatatReturBeli(array(
            'ReturBeliID' => $Request->get('ReturBeliID'),
            'BarangID' => $Request->get('BarangID'),
            'KuantitiBarangAsal' => $Request->get('KuantitiBarangAsal'),
            'KuantitiBarangGanti' => $Request->get('KuantitiBarangGanti'),
            'SubTotal' => $Request->get('SubTotal')
        ));
        $BarangCatatReturBeli->save();
    }

    public function UpdateBarangCatatReturBeli(Request $Request)
    {
        DB::table('BarangCatatReturBeli')
            ->where('ReturBeliID', $ReturBeliID)
            ->where('BarangID', $BarangID)
            ->update(['KuantitiBarangAsal' => $Request->get('KuantitiBarangAsal'),
     				'KuantitiBarangGanti' => $Request->get('KuantitiBarangGanti'),
                    'SubTotal' => $Request->get('SubTotal')]);
    }
}
