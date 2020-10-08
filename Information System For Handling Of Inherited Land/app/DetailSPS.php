<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\DetailSPS;
use DB;

class DetailSPS extends Model
{
    protected $table = 'DetailSPS';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'TanggalBayar', 'Biaya', 'Luas', 'Uraian', 'Banyak', 'Jumlah', 'IDPersyaratan', 'IsActive'];

    public function StoreDetailSPS(Request $Request) {
        $unique_id = uniqid();
        $Biaya = $Request->get('ArrayBiaya');
        $Banyak = $Request->get('ArrayBanyak');
        $Uraian = $Request->get('ArrayUraian');
        $TanggalTerimaBayar =  date('Y-m-d'); //$Request->get('TanggalTerimaBayar');
        $Luas = $Request->get('Luas');
        $Jumlah = $Request->get('Jumlah');

        for ($i=0; $i < count($Biaya); $i++) {
            $DetailSPS = new DetailSPS(array(
                'TanggalBayar' => $TanggalTerimaBayar,
                'Biaya' => $Biaya[$i],
                'Luas' => $Luas,
                'Banyak' => $Banyak[$i],
                'Jumlah' => $Jumlah,
                'Uraian' => $Uraian[$i],
                'IDPersyaratan' => $Request->get('IDPersyaratan'),
                'IsActive' => (1),
            ));
            $DetailSPS->save();
        }
    }
}
