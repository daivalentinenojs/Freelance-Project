<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\KesimpulanStatusTanah;
use DB;

class KesimpulanStatusTanah extends Model
{
    protected $table = 'KesimpulanStatusTanah';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'Uraian', 'Jenis', 'Usulan', 'NamaPenempat', 'IsActive'];

    public function StoreKesimpulanStatusTanah(Request $Request)
    {
        $unique_id = uniqid();
        $KesimpulanStatusTanah = new KesimpulanStatusTanah(array(
            'Nama' => $Request->get('NamaKesimpulanStatusTanah'),
            'Uraian' => $Request->get('Uraian'),
            'Jenis' => $Request->get('JenisKesimpulanStatusTanah'),
            'Usulan' => $Request->get('Usulan'),
            'NamaPenempat' => $Request->get('NamaPenempat'),

            'IsActive' => (1)
        ));
        $KesimpulanStatusTanah->save();
        $IDKesimpulanStatusTanah = DB::table('KesimpulanStatusTanah')->max('ID');
        return $IDKesimpulanStatusTanah;
    }

    public function UpdateKesimpulanStatusTanah(Request $Request)
    {
        $IDKesimpulanStatusTanah = $Request->get('IDKesimpulanStatusTanah');
        DB::table('KesimpulanStatusTanah')
            ->where('ID', $IDKesimpulanStatusTanah)
            ->update(['Uraian' => $Request->get('Uraian'),
                    'Usulan' => $Request->get('Usulan'),
                    'IsActive' => 1]);
    }
}
