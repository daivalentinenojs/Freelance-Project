<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormulirPermohonan;
use App\Persyaratan;
use App\Pembayaran;
use App\FPXP;
use App\BerkasPermohonan;
use App\DetailSPS;
use App\Tagihan;

class FormulirPermohonanController extends Controller
{

    public function AjaxFP(Request $Request)
    {
        $AjaxFP = new FormulirPermohonan();
        $DataAjaxFP = $AjaxFP->GetAjaxFP($Request->session()->get('ID'));
        return $DataAjaxFP;
    }

    public function AjaxDashboard(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $AjaxDashboard = new FormulirPermohonan();
        $DataAjaxDashboard = $AjaxDashboard->GetAjaxDashboard($Request->session()->get('ID'), $Request->session()->get('Role'));
        return $DataAjaxDashboard;
    }

    public function CreatePengajuanFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

      	return view('FormulirPermohonan.CreatePengajuanFP', compact('ID', 'Nama', 'Email', 'Role'));
    }

    public function StorePengajuanFP(Request $Request)
    {
        $FormulirPermohonan = new FormulirPermohonan();
        $IDFormulirPermohonan = $FormulirPermohonan->StoreFormulirPermohonan($Request);

        $Persyaratan = new Persyaratan();
        $IDPersyaratan = $Persyaratan->StorePersyaratan($Request);

        $FPXP = new FPXP();
        $FPXP->StoreFPXP($IDFormulirPermohonan, $IDPersyaratan);

        return redirect('/PengajuanFP')->with('status', 'Formulir Permohonan Anda telah disimpan !');
    }

    public function EditPengubahanFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetPengubahanFPPemohon($ID);

      	return view('FormulirPermohonan.EditPengubahanFP', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function UpdatePengubahanFP(Request $Request)
    {
        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdatePengubahanFP($Request);

        $Persyaratan = new Persyaratan();
        $Persyaratan->UpdatePengubahanFPPersyaratan($Request);

        return redirect('/PengubahanFP')->with('status', 'Formulir Permohonan telah diubah !');
    }

    public function CreateValidasiPengajuanFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetPengajuanFPKaryawan();

      	return view('FormulirPermohonan.CreateValidasiPengajuanFP', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreValidasiPengajuanFP(Request $Request)
    {
        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateValidasiPengajuanFP($Request, 2);

        $Tagihan = new Tagihan();
        $DataTagihan = $Tagihan->StoreTagihan($Request);

        return redirect('/ValidasiPengajuanFP')->with('status', 'Proses Pengajuan Formulir Permohonan telah divalidasi !');
    }

    public function CreatePembayaranFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetPengajuanFPPemohon($ID);

      	return view('FormulirPermohonan.CreatePembayaranFP', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StorePembayaranFP(Request $Request)
    {
        $Pembayaran = new Pembayaran();
        $Pembayaran->StorePembayaran($Request);

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdatePembayaranFP($Request, 3);
        return redirect('/PembayaranFP')->with('status', 'Pembayaran Formulir Permohonan telah disimpan !');
    }

    public function CreateRevisiFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetRevisiFPPemohon($ID);

      	return view('FormulirPermohonan.CreateRevisiFP', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreRevisiFP(Request $Request)
    {
        $Pembayaran = new Pembayaran();
        $Pembayaran->RevisiPembayaran($Request);

        return redirect('/RevisiFP')->with('status', 'Pembayaran Formulir Permohonan telah direvisi !');
    }

    public function CreateValidasiPembayaranFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetPembayaranFPKaryawan();

      	return view('FormulirPermohonan.CreateValidasiPembayaranFP', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan', 'DataPembayaran'));
    }

    public function StoreValidasiPembayaranFP(Request $Request)
    {
        // if (empty($Request->get('TanggalBerkasValid'))) {
        //   $FormulirPermohonan = new FormulirPermohonan();
        //   $FormulirPermohonan->UpdateValidasiPembayaranFP($Request, 4);
        // } else {
          $FormulirPermohonan = new FormulirPermohonan();
          $FormulirPermohonan->UpdateValidasiPembayaranFP($Request, 5);
        // }

        $Persyaratan = new Persyaratan();
        $Persyaratan->UpdateValidasiPembayaranPersyaratan($Request);

        $BerkasPermohonan = new BerkasPermohonan();
        $BerkasPermohonan->StoreBerkasPermohonan($Request);

        $DetailSPS = new DetailSPS();
        $DetailSPS->StoreDetailSPS($Request);

        return redirect('/ValidasiPembayaranFP')->with('status', 'Validasi Pembayaran Formulir Permohonan telah disimpan !');
    }

    public function CreateValidasiDisposisiFP(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetDisposisiFPKaryawan();

      	return view('FormulirPermohonan.CreateValidasiDisposisiFP', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreValidasiDisposisiFP(Request $Request)
    {
        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateDisposisiFP($Request, 5);

        $BerkasPermohonan = new BerkasPermohonan();
        $BerkasPermohonan->UpdateDisposisiBP($Request);

        return redirect('/ValidasiDisposisiFP')->with('status', 'Validasi Disposisi Formulir Permohonan telah disimpan !');
    }
}
