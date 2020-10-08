<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Karyawan extends Model
{
    protected $table = 'User';
    protected $guarded = ['IDUser'];
    protected $fillable = ['Email', 'Password', 'Nama', 'JabatanID', 'isDelete', 'Alamat', 'Telepon', 'TanggalMulaiKerja'];

    public function StoreKaryawan(Request $Request)
    {
        $unique_id = uniqid();
        $Email = $Request->get('EmailKaryawan');
        $Domain = $Request->get('DomainKaryawan');
        $EmailLengkap = $Email.$Domain;
        $Karyawan = new Karyawan(array(
            'Nama' => $Request->get('NamaKaryawan'),
            'Email' => $EmailLengkap,
            'Password' => $Request->get('PasswordKaryawan'),
            'JabatanID' => $Request->get('JabatanKaryawan'),
            'Alamat' => $Request->get('AlamatKaryawan'),
            'Telepon' => $Request->get('TeleponKaryawan'),
            'TanggalMulaiKerja' => $Request->get('TanggalKerjaKaryawan'),
            'isDelete' => (1)
        ));
        $Karyawan->save();
    }

    public function UpdateKaryawan(Request $Request)
    {
        $IDKaryawan = $Request->get('IDKaryawan');
        $Email = $Request->get('EmailKaryawan');
        $Domain = $Request->get('DomainKaryawan');
        $EmailLengkap = $Email.$Domain;
        DB::table('User')
            ->where('IDUser', $IDKaryawan)
            ->update(['Nama' => $Request->get('NamaKaryawan'),
                        'Email' => $EmailLengkap,
                        'Password' => $Request->get('PasswordKaryawan'),
                        'JabatanID' => $Request->get('JabatanKaryawan'),
                        'Alamat' => $Request->get('AlamatKaryawan'),
                        'Telepon' => $Request->get('TeleponKaryawan'),
                        'TanggalMulaiKerja' => $Request->get('TanggalKerjaKaryawan'),
                        'isDelete' => $Request->get('isDeleteKaryawan')]);
    }
}
