<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App;
use App\Kenyataan;
use App\Risalah;
use App\Sanggahan;
use App\BuktiPerpajakan;
use App\StatusTanah;
use App\KesimpulanStatusTanah;
use App\FormulirPermohonan;

class RisalahController extends Controller
{

    public function CreateRisalah(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $Risalah = new Risalah();
        $DataRisalah = $Risalah->GetRisalah();

        return view('Risalah.CreateRisalah', compact('ID', 'Email', 'Nama', 'Role', 'DataRisalah'));
    }

    public function StoreRisalah(Request $Request)
    {
        $Kenyataan = new Kenyataan();
        $IDKenyataan = $Kenyataan->StoreKenyataan($Request);

        $BuktiPerpajakan = new BuktiPerpajakan();
        $IDBuktiPerpajakan = $BuktiPerpajakan->StoreBuktiPerpajakan($Request);

        $StatusTanah = new StatusTanah();
        $IDStatusTanah = $StatusTanah->StoreStatusTanah($Request);

        $KesimpulanStatusTanah = new KesimpulanStatusTanah();
        $IDKesimpulanStatusTanah = $KesimpulanStatusTanah->StoreKesimpulanStatusTanah($Request);

        $IDSanggahan = '';
        if ($Request->get('AdaSanggahan') == '1') {
            $Sanggahan = new Sanggahan();
            $IDSanggahan = $Sanggahan->StoreSanggahan($Request);

            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 11);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 12);
        }

        $Risalah = new Risalah();
        $Risalah->StoreRisalah($Request, $IDKenyataan, $IDBuktiPerpajakan, $IDStatusTanah, $IDSanggahan, $IDKesimpulanStatusTanah);

        return redirect('/Risalah')->with('status', 'Informasi Risalah telah disimpan !');
    }

    public function CreateUbahRisalah(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $Risalah = new Risalah();
        $DataRisalah = $Risalah->GetEditRisalah();

        return view('Risalah.EditRisalah', compact('ID', 'Email', 'Nama', 'Role', 'DataRisalah'));
    }

    public function StoreUbahRisalah(Request $Request)
    {
        $Kenyataan = new Kenyataan();
        $Kenyataan->UpdateKenyataan($Request);

        $BuktiPerpajakan = new BuktiPerpajakan();
        $BuktiPerpajakan->UpdateBuktiPerpajakan($Request);

        $StatusTanah = new StatusTanah();
        $StatusTanah->UpdateStatusTanah($Request);

        $KesimpulanStatusTanah = new KesimpulanStatusTanah();
        $KesimpulanStatusTanah->UpdateKesimpulanStatusTanah($Request);

        $IDSanggahan = '';

        if ($Request->get('AdaSanggahan') == '1') {
            $Sanggahan = new Sanggahan();
            $IDSanggahan = $Sanggahan->UpdateSanggahan($Request);

            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 11);
        } else {
            $IDSanggahan = '';

            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 12);
        }

        $Risalah = new Risalah();
        $Risalah->UpdateRisalah($Request, $IDSanggahan);

        return redirect('/UbahRisalah')->with('status', 'Informasi Risalah telah diubah !');
    }

    public function CreateVerifikasiRisalah(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $Risalah = new Risalah();
        $DataRisalah = $Risalah->GetVerifikasiRisalah($ID);

        return view('Risalah.VerifikasiRisalah', compact('ID', 'Email', 'Nama', 'Role', 'DataRisalah'));
    }

    public function CreateValidasiRisalah(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $Risalah = new Risalah();
        $DataRisalah = $Risalah->GetValidasiRisalah($ID);

        return view('Risalah.ValidasiRisalah', compact('ID', 'Email', 'Nama', 'Role', 'DataRisalah'));
    }

    public function StoreVerifikasiRisalah(Request $Request)
    {
        if ($Request->get('IDStatusVerifikasi') == '1') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 13);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 12);
        }

        return redirect('/VerifikasiRisalah')->with('status', 'Informasi Risalah telah diubah !');
    }

    public function StoreValidasiRisalah(Request $Request)
    {
        if ($Request->get('IDStatusVerifikasi') == '1') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 50);
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateRisalah($Request, 12);
        }

        return redirect('/ValidasiRisalah')->with('status', 'Informasi Risalah telah diubah !');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PrintRisalah(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $Risalah = new Risalah();
        $DataRisalah = $Risalah->GetPrintRisalah();

        return view('Risalah.PrintRisalah', compact('ID', 'Email', 'Nama', 'Role', 'DataRisalah'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PostPrintRisalah(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $ID = $Request->get('IDFormulirPermohonan');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');
        $pemohon = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
                                     ->where('formulirpermohonan.ID', $ID)
                                     ->first();
        $namakepaladesa = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
                                            ->join('desa', 'pemohon.IDDesa', 'desa.ID')
                                            ->join('kepaladesa', 'desa.ID', 'kepaladesa.IDDesa')
                                            ->first()->Nama;
        // $nikkepaladesa = FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
        //                                    ->join('desa', 'pemohon.IDDesa', 'desa.ID')
        //                                    ->join('kepaladesa', 'desa.ID', 'kepaladesa.IDDesa')
        //                                    ->join('karyawan', 'kepaladesa.IDUser', 'karyawan.IDUser')
        //                                    ->first()->NIK;
        $persyaratan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                         ->where('formulirpermohonan.ID', $ID)->first();
        $kenyataan = FormulirPermohonan::join('risalah', 'risalah.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                       ->join('kenyataan', 'kenyataan.ID', 'risalah.IDKenyataan')
                                       ->where('formulirpermohonan.ID', $ID)->first();
        $risalah = FormulirPermohonan::join('risalah', 'risalah.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                     ->where('formulirpermohonan.ID', $ID)->first();
        $buktiPerpajakan = FormulirPermohonan::join('risalah', 'risalah.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                             ->join('buktiperpajakan', 'buktiperpajakan.Nomor', 'risalah.NomorBuktiPerpajakan')
                                             ->where('formulirpermohonan.ID', $ID)->first();
        $berkasPermohonan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')
                                              ->join('berkaspermohonan', 'berkaspermohonan.IDPersyaratan', 'persyaratan.ID')
                                              ->where('formulirpermohonan.ID', $ID)->first();
        $karyawan = ""; //TODO: field digunakan untuk karyawan / anggota Panitia A
        $formulirPermohonan = FormulirPermohonan::where('formulirpermohonan.ID', $ID)->first();

        $beritaAcara = FormulirPermohonan::join('beritaacara', 'beritaacara.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                         ->where('formulirpermohonan.ID', $ID)->first();
        $sanggahan = FormulirPermohonan::join('risalah', 'risalah.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                       ->join('sanggahan', 'risalah.IDSanggahan', 'sanggahan.ID')
                                       ->where('formulirpermohonan.ID', $ID)->get();
        $berkasPengumuman = FormulirPermohonan::join('berkaspengumuman', 'berkaspengumuman.IDFormulirPermohonan', 'formulirpermohonan.ID')
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
        if (!isset($berkasPengumuman) ) {
            $berkasPengumuman = FormulirPermohonan::join('berkaspengumuman', 'berkaspengumuman.IDFormulirPermohonan', 'formulirpermohonan.ID')
                                                  ->first();
        }
        if (!isset($persyaratan) ) {
            $persyaratan = FormulirPermohonan::join('persyaratan', 'persyaratan.ID', 'formulirpermohonan.ID')->first();
        }
        $kepalSeksiHubHukumPertanahan = App\Karyawan::where('Jabatan', 6)->first();
        $data = array(
            'namaDesa'     => FormulirPermohonan::join('pemohon', 'pemohon.ID', 'formulirpermohonan.IDPemohon')
                                                ->join('desa', 'pemohon.IDDesa', 'desa.ID')
                                                ->where('formulirpermohonan.ID', $ID)
                                                ->first()->Nama,
            'nib'          => $berkasPermohonan->NIB,
            'jalan'        => $pemohon->AlamatTanah,
            'nama'         => $pemohon->Nama,
            'nik'          => $pemohon->NIK,
            'pekerjaan'    => $pemohon->Pekerjaan,
            'img'          => "" . $ID . ".jpg",
            'batasutara'   => $persyaratan->BatasUtara,
            'batasselatan' => $persyaratan->BatasSelatan,
            'batastimur'   => $persyaratan->BatasTimur,
            'batasbarat'   => $persyaratan->BatasBarat,

            'persyaratan'                  => $persyaratan,
            'buktiPerpajakan'              => $buktiPerpajakan,
            'pemohon'                      => $pemohon,
            'kenyataan'                    => $kenyataan,
            'risalah'                      => $risalah,
            'namakepaladesa'               => $namakepaladesa,
            // 'nikkepaladesa'      => $nikkepaladesa,
            'beritaAcara'                  => $beritaAcara,
            'berkasPengumuman'             => $berkasPengumuman,
            'formulirPermohonan'           => $formulirPermohonan,
            'kepalSeksiHubHukumPertanahan' => $kepalSeksiHubHukumPertanahan,
        );
        if (count($sanggahan) > 0) {
            $data['sanggahan'] = $sanggahan[0];
        }
//        return view()->make('PDF.formRisalah',$data);
        $PDF = PDF::loadView('PDF.formRisalah', $data);
        $PDF->setPaper('A4');
        return $PDF->stream();
    }
}
