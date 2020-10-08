<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\SuratPengantar;
use App\DetailSuratPengantar;
use App\FormulirPermohonan;

class SuratPengantarController extends Controller
{
    public function CreateSuratPengantar(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetCreateSuratPengantar();

        return view('SuratPengantar.CreateSuratPengantar', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreSuratPengantar(Request $Request)
    {
        $NomorSuratPengantar = new SuratPengantar();
        $NomorSuratPengantar = $NomorSuratPengantar->StoreSuratPengantar($Request);

        $DetailSuratPengantar = new DetailSuratPengantar();
        $DetailSuratPengantar->StoreDetailSuratPengantar($Request, $NomorSuratPengantar);

        if ($Request->get('Sanggahan') == '') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateCreateSuratPengantar($Request, 19);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateCreateSuratPengantar($Request, 21);
        }

        return redirect('/SuratPengantar')->with('status', 'Surat Pengantar telah disimpan !');
    }

    public function EditSuratPengantar(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetEditSuratPengantar();

        return view('SuratPengantar.EditSuratPengantar', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function UpdateSuratPengantar(Request $Request)
    {
        $NomorSuratPengantar = new SuratPengantar();
        $NomorSuratPengantar->UpdateSuratPengantar($Request);

        if ($Request->get('Sanggahan') == '') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateEditSuratPengantar($Request, 19);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateEditSuratPengantar($Request, 21);
        }

        return redirect('/EditSuratPengantar')->with('status', 'Surat Pengantar telah disimpan !');
    }

    public function VerifikasiSPKaryawan(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetVerifikasiSuratPengantarKaryawan();

        return view('SuratPengantar.VerifikasiSuratPengantarKaryawan', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function UpdateSPKaryawan(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $NomorSuratPengantar = new SuratPengantar();
        $NomorSuratPengantar->UpdateVerifikasiKaryawan($Request, $ID);

        if ($Request->get('Sanggahan') == '') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateEditSuratPengantar($Request, 20);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateEditSuratPengantar($Request, 21);
        }

        return redirect('/VerifikasiSPKaryawan')->with('status', 'Surat Pengantar telah diverifikasi !');
    }

    public function VerifikasiSPKepalaDesa(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetVerifikasiSuratPengantarKepalaDesa($ID);

        return view('SuratPengantar.VerifikasiSuratPengantarKepalaDesa', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function UpdateSPKepalaDesa(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $NomorSuratPengantar = new SuratPengantar();
        $NomorSuratPengantar->UpdateVerifikasiKepalaDesa($Request, $ID);

        if ($Request->get('Sanggahan') == '') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateEditSuratPengantar($Request, 23);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateEditSuratPengantar($Request, 22);
        }

        return redirect('/VerifikasiSPKepalaDesa')->with('status', 'Surat Pengantar telah diverifikasi !');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PrintSuratPengantar(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $SuratPengantar = new SuratPengantar();
        $DataSuratPengantar = $SuratPengantar->GetPrintSuratPengantar();

        return view('SuratPengantar.PrintSuratPengantar', compact('ID', 'Email', 'Nama', 'Role', 'DataSuratPengantar'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PostPrintSuratPengantar(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $ID = $Request->get('IDFormulirPermohonan');

        $pemohon = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
                                     ->where('formulirpermohonan.ID', $ID)
                                     ->first();
        $berkasPengumuman = FormulirPermohonan::join('berkaspengumuman', 'berkaspengumuman.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                              ->where('formulirpermohonan.ID', $ID)->first();
        $namaDesa = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
                                      ->join('desa', 'pemohon.IDDesa', 'desa.ID')
                                      ->where('formulirpermohonan.ID', $ID)
                                      ->first()->Nama;
        $persyaratan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                         ->where('formulirpermohonan.ID', $ID)->first();
        $suratPengantar = FormulirPermohonan::join('suratpengantar', 'suratpengantar.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                            ->where('formulirpermohonan.ID', $ID)->first();
        $detilsuratPengantar = FormulirPermohonan::join('suratpengantar', 'suratpengantar.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                                 ->join('detailsuratpengantar', 'suratpengantar.Nomor', 'detailsuratpengantar.NomorSuratPengantar')
                                                 ->where('formulirpermohonan.ID', $ID)->first();
        $namakepaladesa = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
                                            ->join('desa', 'pemohon.IDDesa', 'desa.ID')
                                            ->join('kepaladesa', 'desa.ID', 'kepaladesa.IDDesa')
                                            ->first()->Nama;
        // $nikkepaladesa = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
        //                                    ->join('desa', 'pemohon.IDDesa', 'desa.ID')
        //                                    ->join('kepaladesa', 'desa.ID', 'kepaladesa.IDDesa')
        //                                    ->join('karyawan', 'kepaladesa.IDUser', 'karyawan.IDUser')
        //                                    ->first()->NIK;
        $berkasPermohonan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                              ->join('berkaspermohonan', 'berkaspermohonan.IDPersyaratan', 'persyaratan.ID')
                                              ->where('formulirpermohonan.ID', $ID)->first();
        $risalah = FormulirPermohonan::join('risalah', 'risalah.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                     ->where('formulirpermohonan.ID', $ID)->first();
        $beritaAcara = FormulirPermohonan::join('beritaacara', 'beritaacara.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                         ->where('formulirpermohonan.ID', $ID)->first();
        $kepalaSubBagianTU = App\Karyawan::where('Jabatan', 2)->first();
        if (!isset($detilsuratPengantar)) {
            $detilsuratPengantar = FormulirPermohonan::join('suratpengantar', 'suratpengantar.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                                     ->join('detailsuratpengantar', 'suratpengantar.Nomor', 'detailsuratpengantar.NomorSuratPengantar')
                                                     ->first();
        }
        if (!isset($berkasPengumuman)) {
            $berkasPengumuman = FormulirPermohonan::join('berkaspengumuman', 'berkaspengumuman.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                                  ->first();
        }
        if (!isset($beritaAcara)) {
            $beritaAcara = FormulirPermohonan::join('beritaacara', 'beritaacara.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                             ->first();
        }
        if (!isset($berkasPermohonan)) {
            $berkasPermohonan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                                  ->join('berkaspermohonan', 'berkaspermohonan.IDPersyaratan', 'persyaratan.ID')
                                                  ->first();
        }
        if (!isset($persyaratan)) {
            $persyaratan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')->first();
        }
        $data = [
            'namaDesa'            => $namaDesa,
            'persyaratan'         => $persyaratan,
            'namakepaladesa'      => $namakepaladesa,
            'suratPengantar'      => $suratPengantar,
            'detilsuratPengantar' => $detilsuratPengantar,
            // 'nikkepaladesa'    => $nikkepaladesa,
            'berkasPengumuman'    => $berkasPengumuman,
            'berkasPermohonan'    => $berkasPermohonan,
            'beritaAcara'         => $beritaAcara,
            'pemohon'             => $pemohon,
            'risalah'             => $risalah,
            'kepalaSubBagianTU'   => $kepalaSubBagianTU,
        ];

        $PDF = \PDF::loadView('PDF.suratPengantar', $data);
        $PDF->setPaper('A4');
        return $PDF->stream();
    }
}
