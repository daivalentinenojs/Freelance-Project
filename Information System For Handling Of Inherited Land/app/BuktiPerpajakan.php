<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\BuktiPerpajakan;
use DB;

class BuktiPerpajakan extends Model
{
    protected $table = 'BuktiPerpajakan';
    protected $guarded = ['Nomor'];
    protected $fillable = ['Nomor', 'Tanggal', 'UraianPatokD', 'UraianVerponding', 'UraianIPEDA', 'UraianLain', 'StatusVerponding', 'StatusIPEDA', 'LainLain', 'Tahun', 'IsActive'];

    public function StoreBuktiPerpajakan(Request $Request)
    {
        $unique_id = uniqid();
        $BuktiPerpajakan = new BuktiPerpajakan(array(
            'Tanggal' => $Request->get('TanggalBuktiPerpajakan'),                         // Input
            'UraianPatokD' => $Request->get('UraianPatokD'),                              // Input
            'UraianVerponding' => $Request->get('UraianVerponding'),                      // Input
            'UraianIPEDA' => $Request->get('UraianIPEDA'),                                // Input
            'UraianLain' => $Request->get('UraianLain'),                                  // Input

            'Tahun' => $Request->get('TahunBuktiPerpajakan'),                             // Input
            'StatusVerponding' => $Request->get('StatusVerponding'),
            'StatusIPEDA' => $Request->get('StatusIPEDA'),
            'LainLain' => $Request->get('LainLain'),
            'IsActive' => (1)
        ));
        $BuktiPerpajakan->save();
        $IDBuktiPerpajakan = DB::table('BuktiPerpajakan')->max('Nomor');
        return $IDBuktiPerpajakan;
    }

    public function UpdateBuktiPerpajakan(Request $Request)
    {
        $IDBuktiPerpajakan = $Request->get('IDBuktiPerpajakan');
        DB::table('BuktiPerpajakan')
            ->where('Nomor', $IDBuktiPerpajakan)
            ->update(['Tanggal' => $Request->get('TanggalBuktiPerpajakan'),
                    'UraianPatokD' => $Request->get('UraianPatokD'),
                    'UraianVerponding' => $Request->get('UraianVerponding'),
                    'UraianIPEDA' => $Request->get('UraianIPEDA'),
                    'UraianLain' => $Request->get('UraianLain'),

                    'Tahun' => $Request->get('TahunBuktiPerpajakan'),
                    'StatusVerponding' => $Request->get('StatusVerponding'),
                    'StatusIPEDA' => $Request->get('StatusIPEDA'),
                    'LainLain' => $Request->get('LainLain'),
                    'IsActive' => 1]);
    }
}
