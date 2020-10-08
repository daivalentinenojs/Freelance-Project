<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuktiPembelian extends Model
{
    protected $table = 'BuktiPembelian';
    protected $guarded = ['Nomor'];
    protected $fillable = ['Nomor', 'Tanggal', 'NamaPenjual', 'NoAktaPPAT', 'File', 'Jenis', 'IsActive'];

    public function StoreBuktiPembelian(Request $Request)
    {
        $unique_id = uniqid();
        $BuktiPembelian = new BuktiPembelian(array(
            'Tanggal' => $Request->get('TanggalBuktiPembelian'),
            'NamaPenjual' => $Request->get('NamaPenjual'),
            'NoAktaPPAT' => $Request->get('NoAktaPPAT'),
            'File' => $Request->get('FileBuktiPembelian'),
            'Jenis' => $Request->get('JenisBuktiPembelian'),

            'IsActive' => (1)
        ));
        $BuktiPembelian->save();
    }

    public function UpdateBuktiPembelian(Request $Request, $IDUser)
    {
        $IDBuktiPembelian = $Request->get('IDBuktiPembelian');
        DB::table('BuktiPembelian')
            ->where('ID', $IDBuktiPembelian)
            ->update(['Tanggal' => $Request->get('Tanggal'),
                    'NamaPenjual' => $Request->get('NamaPenjual'),
                    'NoAktaPPAT' => $Request->get('NoAktaPPAT'),
                    'File' => $Request->get('FileBuktiPembelian'),
                    'Jenis' => $Request->get('JenisBuktiPembelian'),
                    'IsActive' => 1]);
    }
}
