<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\StatusTanah;
use DB;

class StatusTanah extends Model
{
    protected $table = 'StatusTanah';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'KeteranganNama', 'Uraian', 'IsActive'];

    public function StoreStatusTanah(Request $Request)
    {
        $unique_id = uniqid();
        $StatusTanah = new StatusTanah(array(
            'Nama' => $Request->get('NamaStatusTanah'),
            'Uraian' => $Request->get('UraianStatusTanah'),
            'IsActive' => (1)
        ));
        $StatusTanah->save();
        $IDStatusTanah = DB::table('StatusTanah')->max('ID');
        return $IDStatusTanah;
    }

    public function UpdateStatusTanah(Request $Request)
    {
        $IDStatusTanah = $Request->get('IDStatusTanah');
        DB::table('StatusTanah')
            ->where('ID', $IDStatusTanah)
            ->update(['Nama' => $Request->get('NamaStatusTanah'),
                    'Uraian' => $Request->get('UraianStatusTanah'),
                    'IsActive' => 1]);
    }
}
