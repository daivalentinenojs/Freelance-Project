<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BerkasPermohonan;
use App\FormulirPermohonan;
use App\JadwalUkur;
use App\GambarUkur;
use App\KXGU;
use App\Karyawan;

class BerkasPermohonanController extends Controller
{
    public function CreateJadwalUkur(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $BerkasPermohonan = new BerkasPermohonan();
        $DataBerkasPermohonan = $BerkasPermohonan->GetJadwalUkurFPKaryawan();

        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawanUkur(4);

        return view('BerkasPermohonan.CreateJadwalUkur', compact('ID', 'Nama', 'Email', 'Role', 'DataBerkasPermohonan', 'DataKaryawan'));
    }

    public function StoreJadwalUkur(Request $Request)
    {
        $JadwalUkur = new JadwalUkur();
        $IDJadwalUkur = $JadwalUkur->StoreJadwalUkur($Request);

        $BerkasPermohonan = new BerkasPermohonan();
        $BerkasPermohonan->UpdateJadwalUkur($Request, $IDJadwalUkur);

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateJadwalUkur($Request, 6);

        return redirect('/JadwalUkur')->with('status', 'Jadwal Ukur telah disimpan !');
    }

    public function CreateGambarUkur(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $BerkasPermohonan = new BerkasPermohonan();
        $DataBerkasPermohonan = $BerkasPermohonan->GetGambarUkurFPKaryawan();

        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawanUkur(4);

        return view('BerkasPermohonan.CreateGambarUkur', compact('ID', 'Nama', 'Email', 'Role', 'DataBerkasPermohonan', 'DataKaryawan'));
    }

    public function StoreGambarUkur(Request $Request)
    {
        $GambarUkur = new GambarUkur();
        $IDGambarUkur = $GambarUkur->StoreGambarUkur($Request); // Status 1 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 2 : Sanggahan 3 : Edit Sanggahan 4 : Validasi

        $KXGU = new KXGU();
        $KXGU->StoreKXGU($Request, $IDGambarUkur);

        $BerkasPermohonan = new BerkasPermohonan();
        $BerkasPermohonan->UpdateGambarUkur($Request, $IDGambarUkur);

        $JadwalUkur = new JadwalUkur();
        $JadwalUkur->UpdateJadwalUkur($Request);

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdatePembuatanGambarUkur($Request, 7); // 7 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 8 : Sanggahan 9 : Edit Sanggahan 10 : Validasi

        return redirect('/GambarUkur')->with('status', 'Gambar Ukur telah disimpan !');
    }

    public function CreateSanggahanGambarUkur(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $BerkasPermohonan = new BerkasPermohonan();
        $DataBerkasPermohonan = $BerkasPermohonan->GetSanggahanGambarUkurFPKaryawan();

        return view('BerkasPermohonan.CreateSanggahanGambarUkur', compact('ID', 'Nama', 'Email', 'Role', 'DataBerkasPermohonan'));
    }

    public function StoreSanggahanGambarUkur(Request $Request)
    {
        $GambarUkur = new GambarUkur();
        $IDGambarUkur = $GambarUkur->UpdateSanggahanGambarUkur($Request, 2); // Status 1 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 2 : Sanggahan 3 : Edit Sanggahan 4 : Validasi

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateSanggahanGambarUkur($Request, 8); // 7 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 8 : Sanggahan 9 : Edit Sanggahan 10 : Validasi

        return redirect('/SanggahanGambarUkur')->with('status', 'Sanggahan Gambar Ukur telah disimpan !');
    }

    public function CreateUbahGambarUkur(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $BerkasPermohonan = new BerkasPermohonan();
        $DataBerkasPermohonan = $BerkasPermohonan->GetUbahGambarUkurFPKaryawan();

        $Karyawan = new Karyawan();
        $DataKaryawan = $Karyawan->GetKaryawanUkur(4);

        return view('BerkasPermohonan.CreateUbahGambarUkur', compact('ID', 'Nama', 'Email', 'Role', 'DataBerkasPermohonan', 'DataKaryawan'));
    }

    public function StoreUbahGambarUkur(Request $Request)
    {
        $GambarUkur = new GambarUkur();
        $IDGambarUkur = $GambarUkur->UpdateUbahGambarUkur($Request, 3); // Status 1 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 2 : Sanggahan 3 : Edit Sanggahan 4 : Validasi

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateUbahGambarUkur($Request, 9); // 7 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 8 : Sanggahan 9 : Edit Sanggahan 10 : Validasi

        $KXGU = new KXGU();
        $KXGU->UpdateKXGU($Request);

        return redirect('/UbahGambarUkur')->with('status', 'Proses Pengubahan Gambar Ukur telah disimpan !');
    }

    public function CreateValidasiGambarUkur(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $BerkasPermohonan = new BerkasPermohonan();
        $DataBerkasPermohonan = $BerkasPermohonan->GetValidasiGambarUkurFPKaryawan();

        return view('BerkasPermohonan.CreateValidasiGambarUkur', compact('ID', 'Nama', 'Email', 'Role', 'DataBerkasPermohonan'));
    }

    public function StoreValidasiGambarUkur(Request $Request)
    {
        $GambarUkur = new GambarUkur();
        $IDGambarUkur = $GambarUkur->UpdateValidasiGambarUkur($Request, 4); // Status 1 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 2 : Sanggahan 3 : Edit Sanggahan 4 : Validasi

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateValidasiGambarUkur($Request, 10); // 7 : Pembuatan (Tidak Disanggah, Tidak Divalidasi) 8 : Sanggahan 9 : Edit Sanggahan 10 : Validasi

        return redirect('/ValidasiGambarUkur')->with('status', 'Proses Validasi Gambar Ukur telah disimpan !');
    }
}
