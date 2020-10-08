<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Jabatan extends Model
{
    protected $table = 'Jabatan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'isDelete'];


    public function StoreJabatan(Request $Request)
    {
        $unique_id = uniqid();
        $Jabatan = new Jabatan(array(
            'Nama' => $Request->get('NamaJabatan'),
            'isDelete' => (1)
        ));
        $Jabatan->save();
    }

    public function UpdateJabatan(Request $Request)
    {
        $IDJabatan = $Request->get('IDJabatan');
        DB::table('Jabatan')
            ->where('ID', $IDJabatan)
            ->update(['Nama' => $Request->get('NamaJabatan'),
                      'isDelete' => $Request->get('isDeleteJabatan')]);
    }
}
