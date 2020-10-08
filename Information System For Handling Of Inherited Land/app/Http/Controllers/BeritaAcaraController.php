<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\BeritaAcara;
use App\FormulirPermohonan;

class BeritaAcaraController extends Controller
{
    public function CreateBeritaAcara(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetCreateBeritaAcara();

        return view('BeritaAcara.CreateBeritaAcara', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreBeritaAcara(Request $Request)
    {
        $NomorBeritaAcara = new BeritaAcara();
        $NomorBeritaAcara->StoreBeritaAcara($Request);

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateCreateBeritaAcara($Request, 24);

        return redirect('/BeritaAcara')->with('status', 'Berita Acara telah disimpan !');
    }

    public function VerifikasiBeritaAcara(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetVerifikasiBeritaAcara();

        return view('BeritaAcara.VerifikasiBeritaAcara', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function UpdateBeritaAcara(Request $Request)
    {
        $NomorBeritaAcara = new BeritaAcara();
        $NomorBeritaAcara->UpdateVerifikasiBeritaAcara($Request);

        $FormulirPermohonan = new FormulirPermohonan();
        $FormulirPermohonan->UpdateVerifikasiBeritaAcara($Request, 25);

        return redirect('/VerifikasiBeritaAcara')->with('status', 'Berita Acara telah diverifikasi !');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PrintBeritaAcara(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');
        $ID = $Request->get('IDFormulirPermohonan');

        $BeritaAcara = new BeritaAcara();
        $DataBeritaAcara = $BeritaAcara->GetPrintBeritaAcara();

        return view('BeritaAcara.PrintBeritaAcara', compact('ID', 'Email', 'Nama', 'Role', 'DataBeritaAcara'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PostPrintBeritaAcara(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

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
        $berkasPermohonan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                              ->join('berkaspermohonan', 'berkaspermohonan.IDPersyaratan', 'persyaratan.ID')
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
        if (!isset($beritaAcara) ) {
            $beritaAcara = FormulirPermohonan::join('beritaacara', 'beritaacara.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                             ->first();
        }
        if (!isset($berkasPermohonan) ) {
            $berkasPermohonan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                                  ->join('berkaspermohonan', 'berkaspermohonan.IDPersyaratan', 'persyaratan.ID')
                                                  ->first();
        }
        if(!isset($persyaratan))
        {
            $persyaratan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')->first();
        }
        $kepalSeksiHakTanahDanPendaftaranTanah = App\Karyawan::where('Jabatan', 6)->first();
        $data = [
            'namaDesa'                                  => $namaDesa,
            'persyaratan'                               => $persyaratan,
            'namakepaladesa'                            => $namakepaladesa,
            // 'nikkepaladesa'    => $nikkepaladesa,
            'berkasPengumuman'                          => $berkasPengumuman,
            'berkasPermohonan'                          => $berkasPermohonan,
            'beritaAcara'                               => $beritaAcara,
            'pemohon'                                   => $pemohon,
            'risalah'                                   => $risalah,
            'namaKepalSeksiHakTanahDanPendaftaranTanah' => $kepalSeksiHakTanahDanPendaftaranTanah->Nama,
        ];

        $PDF = \PDF::loadView('PDF.beritaAcara', $data);
        $PDF->setPaper('A4');
        return $PDF->stream();
    }
}
