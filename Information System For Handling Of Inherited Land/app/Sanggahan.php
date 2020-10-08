<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Sanggahan;
use DB;

class Sanggahan extends Model
{
    protected $table = 'Sanggahan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'AlasanPenyanggah', 'SengketaDengan', 'AdaSanggahan', 'NamaPenyanggah', 'AlamatPenyanggah', 'Penyelesaian', 'File', 'IsActive'];

    public function StoreSanggahan(Request $Request)
    {
        $unique_id = uniqid();
        $Sanggahan = new Sanggahan(array(
            'AlasanPenyanggah' => $Request->get('AlasanPenyanggah'),
            'SengketaDengan' => $Request->get('SengketaDengan'),
            'AdaSanggahan' => $Request->get('AdaSanggahan'),
            'NamaPenyanggah' => $Request->get('NamaPenyanggah'),
            'AlamatPenyanggah' => $Request->get('AlamatPenyanggah'),

            'Penyelesaian' => $Request->get('Penyelesaian'),
            'File' => $Request->get('FileSanggahan'),
            'IsActive' => (1)
        ));
        $Sanggahan->save();
        $ID = DB::table('Sanggahan')->max('ID');

        if($Request->hasFile('FileSanggahan')) {
            $IDFoto = $ID.'.jpg';
            $Request->FileSanggahan->move(public_path('foto/Sanggahan'), $IDFoto);
        }

        return $ID;
    }

    public function UpdateSanggahan(Request $Request)
    {
        $IDSanggahan = $Request->get('IDSanggahan');
        DB::table('Sanggahan')
            ->where('ID', $IDSanggahan)
            ->update(['AlasanPenyanggah' => $Request->get('AlasanPenyanggah'),
                    'SengketaDengan' => $Request->get('SengketaDengan'),
                    'AdaSanggahan' => $Request->get('AdaSanggahan'),
                    'NamaPenyanggah' => $Request->get('NamaPenyanggah'),
                    'AlamatPenyanggah' => $Request->get('AlamatPenyanggah'),

                    'Penyelesaian' => $Request->get('Penyelesaian'),
                    'IsActive' => 1]);

        return $IDSanggahan;
    }
}
