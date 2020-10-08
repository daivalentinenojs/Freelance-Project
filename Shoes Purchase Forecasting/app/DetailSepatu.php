<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DetailSepatu extends Model
{
    protected $table = 'DetailSepatu';
    protected $guarded = ['ID'];
    protected $fillable = ['Stok', 'SizeOrBoxID', 'HargaBeliTerakhir', 'HargaJual', 'WarnaID', 'TipeID', 'isDelete', 'Keterangan', 'StatusBox'];


    public function StoreDetailSepatu(Request $Request)
    {
        $unique_id = uniqid();
        $DetailSepatu = new DetailSepatu(array(
            'HargaBeliTerakhir' => $Request->get('HargaBeliSepatu'),
            'HargaJual' => $Request->get('HargaJualSepatu'),
            'WarnaID' => $Request->get('WarnaSepatu'),
            'Stok' => $Request->get('StokSepatu'),
            'TipeID' => $Request->get('TipeSepatu'),
            'Keterangan' => $Request->get('KeteranganSepatu'),
            'isDelete' => (1),
            'StatusBox'=>(0),
            'SizeOrBoxID' => $Request->get('JenisUkuran')
            ));
            $DetailSepatu->save();
     }

    public function UpdateDetailSepatu(Request $Request)
    {
        $IDDetailSepatu = $Request->get('IDDetailSepatu');
        DB::table('DetailSepatu')
            ->where('ID', $IDDetailSepatu)
            ->update(['HargaJual' => $Request->get('HargaJualSepatu'),
                      'WarnaID' => $Request->get('WarnaSepatu'),
                      'TipeID' => $Request->get('TipeSepatu'),
                      'Keterangan' => $Request->get('KeteranganSepatu'),
                      'SizeOrBoxID' => $Request->get('JenisUkuran'),
                      'isDelete' => $Request->get('isDelete')]);
    }
}
