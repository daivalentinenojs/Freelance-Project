<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Pengeluaran extends Model
{
    protected $table = 'Pengeluarans';
    protected $guarded = ['IDPengeluaran'];
    protected $fillable = ['IDPengeluaran', 'Tanggal', 'Nama', 'Nominal', 'Keterangan', 
    'StatusTerdaftar', 'KaryawanID'];

    public function StorePengeluaran(Request $Request)
    {
        $unique_id = uniqid();
        $IDKaryawan = $Request->session()->get('ID');
        $Pengeluaran = new Pengeluaran(array(
            'Tanggal' => $Request->get('Tanggal'),
            'Nama' => $Request->get('Nama'),
            'Nominal' => $Request->get('Nominal'),
            'Keterangan' => $Request->get('Keterangan'),
            'StatusTerdaftar' => (1),
            'KaryawanID' => $IDKaryawan
        ));
        $Pengeluaran->save();
    }

    public function UpdatePengeluaran(Request $Request)
    {
        $IDPengeluaran = $Request->get('IDPengeluaran');
        DB::table('Pengeluarans')
            ->where('IDPengeluaran', $IDPengeluaran)
            ->update(['Tanggal' => $Request->get('Tanggal'),
                    'Nama' => $Request->get('Nama'),
                    'Nominal' => $Request->get('Nominal'),
                    'Keterangan' => $Request->get('Keterangan'),
                    'StatusTerdaftar' => $Request->get('StatusTerdaftar')]);
    }
}
