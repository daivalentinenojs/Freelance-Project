<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Tagihan;
use DB;

class Tagihan extends Model
{
    protected $table = 'Tagihan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Uraian', 'Banyak', 'Jumlah', 'Biaya', 'Luas', 'IDFormulirPermohonan', 'IsActive'];

    public function StoreTagihan(Request $Request)
    {
        $unique_id = uniqid();
        $Biaya = $Request->get('ArrayBiaya');
        $Banyak = $Request->get('ArrayBanyak');
        $Uraian = $Request->get('ArrayUraian');

        for ($i=0; $i < count($Biaya); $i++) {
          $Tagihan = new Tagihan(array(
              'Uraian' => $Uraian[$i],
              'Banyak' => $Banyak[$i],
              'Jumlah' => $Request->get('Jumlah'),
              'Biaya' => $Biaya[$i],
              'Luas' => $Request->get('LuasTanahLetterC'),
              'IDFormulirPermohonan' => $Request->get('IDFormulirPermohonan'),
              'IsActive' => (1)
          ));
          $Tagihan->save();
        }
    }
}
