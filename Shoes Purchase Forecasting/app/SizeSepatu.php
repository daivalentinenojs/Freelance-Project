<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class SizeSepatu extends Model
{
    protected $table = 'SizeOrBox';
    protected $guarded = ['ID'];
    protected $fillable = ['Nama', 'isDelete'];


    public function StoreSizeSepatu(Request $Request)
    {
        $unique_id = uniqid();
        $SizeSepatu = new SizeSepatu(array(
            'Nama' => $Request->get('NamaSizeSepatu'),
            'isDelete' => (1)
        ));
        $SizeSepatu->save();
    }

    public function UpdateSizeSepatu(Request $Request)
    {
        $IDSizeSepatu = $Request->get('IDSizeSepatu');
        DB::table('SizeSepatu')
            ->where('ID', $IDSizeSepatu)
            ->update(['Nama' => $Request->get('NamaSizeSepatu'),
                      'isDelete' => $Request->get('isDeleteSizeSepatu')]);
    }
}
