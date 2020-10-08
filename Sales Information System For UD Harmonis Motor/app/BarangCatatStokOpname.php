<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class BarangCatatStokOpname extends Model
{
    protected $table = 'BarangCatatStokOpnames';
    protected $guarded = ['StokOpnameID'];
    protected $fillable = ['StokOpnameID', 'BarangID', 'JumlahSelisih', 'Alasan'];

    public function StoreBarangCatatStokOpname(Request $Request)
    {
        $unique_id = uniqid();
        $BarangCatatStokOpname = new BarangCatatStokOpname(array(
            'StokOpnameID' => $Request->get('StokOpnameID'),
            'BarangID' => $Request->get('BarangID'),
            'JumlahSelisih' => $Request->get('JumlahSelisih'),
            'Alasan' => $Request->get('Alasan')
        ));
        $BarangCatatStokOpname->save();
    }

    public function UpdateBarangCatatStokOpname(Request $Request)
    {
        DB::table('BarangCatatStokOpname')
            ->where('StokOpnameID', $StokOpnameID)
            ->where('BarangID', $BarangID)
            ->update(['JumlahSelisih' => $Request->get('JumlahSelisih'),
     				'Alasan' => $Request->get('Alasan')]);
    }
}
