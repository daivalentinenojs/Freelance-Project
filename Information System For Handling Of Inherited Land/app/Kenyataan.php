<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Kenyataan;
use DB;

class Kenyataan extends Model
{
    protected $table = 'Kenyataan';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'KeteranganTahun', 'KeteranganCara', 'KeteranganAlih', 'Jenis', 'IsActive'];

    public function StoreKenyataan(Request $Request)
    {
        $unique_id = uniqid();
        $Kenyataan = new Kenyataan(array(
            'KeteranganTahun' => $Request->get('KeteranganTahun'),                      // Input
            'KeteranganCara' => $Request->get('KeteranganCara'),                        // Input
            'KeteranganAlih' => $Request->get('KeteranganAlih'),                        // Input
            'Jenis' => $Request->get('JenisKenyataan'),                                 // 1 : Sawah 2 : Perumahan 3 : Ladang 4 : Industri 5 : Kebun 6 : Perkebunan 7 : Kolam Ikan 8 : Lapangan Umum
            'IsActive' => (1)
        ));
        $Kenyataan->save();
        $IDKenyataan = DB::table('Kenyataan')->max('ID');
        return $IDKenyataan;
    }

    public function UpdateKenyataan(Request $Request)
    {
        $IDKenyataan = $Request->get('IDKenyataan');
        DB::table('Kenyataan')
            ->where('ID', $IDKenyataan)
            ->update(['KeteranganTahun' => $Request->get('KeteranganTahun'),
                    'KeteranganCara' => $Request->get('KeteranganCara'),
                    'KeteranganAlih' => $Request->get('KeteranganAlih'),
                    'Jenis' => $Request->get('JenisKenyataan'),
                    'IsActive' => 1]);
    }
}
