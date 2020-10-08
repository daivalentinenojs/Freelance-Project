<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App;
use App\BerkasPengumuman;
use App\BerkasPermohonan;
use App\FormulirPermohonan;
use iio\libmergepdf\Merger;

class BerkasPengumumanController extends Controller
{
    public function CreateBerkasPengumuman(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetCreateBerkasPengumuman();

        return view('BerkasPengumuman.CreateBerkasPengumuman', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreBerkasPengumuman(Request $Request)
    {
        $NomorBerkasPengumuman = new BerkasPengumuman();
        $IDBerkasPengumuman = $NomorBerkasPengumuman->StoreBerkasPengumuman($Request);

        $NomorBerkasPermohonan = new BerkasPermohonan();
        $NomorBerkasPermohonan->UpdateNomorPengumuman($Request, $IDBerkasPengumuman);

        if ($Request->get('Sanggahan') == '') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateCreateBerkasPengumuman($Request, 14); // 14 : Siap Verifikasi 15 : Sanggahan 16 : Verifikasi 1 17 : Verifikasi 2 18 : Verifikasi 3
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateCreateBerkasPengumuman($Request, 15);
        }

        return redirect('/PengajuanBPFY')->with('status', 'Berkas Pengumuman telah disimpan !');
    }

    public function ValidasiBerkasPengumuman(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetVerifikasiBerkasPengumuman();

        return view('BerkasPengumuman.ValidasiBerkasPengumuman', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function UpdateBerkasPengumuman(Request $Request)
    {
        if ($Request->get('Sanggahan') == '') {
            if ($Request->get('IDKaryawanSatu') == '-') {
                $NomorBerkasPengumuman = new BerkasPengumuman();
                $NomorBerkasPengumuman->UpdateVerifikasiSatu($Request);

                $FormulirPermohonan = new FormulirPermohonan();
                $FormulirPermohonan->UpdateVerifikasiBerkasPengumuman($Request, 16);

                return redirect('/ValidasiBPFY')->with('status', 'Verifikasi Satu Berkas Pengumuman telah disimpan !');
            } elseif ($Request->get('IDKaryawanDua') == '-') {
                $NomorBerkasPengumuman = new BerkasPengumuman();
                $NomorBerkasPengumuman->UpdateVerifikasiDua($Request);

                $FormulirPermohonan = new FormulirPermohonan();
                $FormulirPermohonan->UpdateVerifikasiBerkasPengumuman($Request, 17);

                return redirect('/ValidasiBPFY')->with('status', 'Verifikasi Dua Berkas Pengumuman telah disimpan !');
            } elseif ($Request->get('IDKaryawanTiga') == '-') {
                $NomorBerkasPengumuman = new BerkasPengumuman();
                $NomorBerkasPengumuman->UpdateVerifikasiTiga($Request);

                $FormulirPermohonan = new FormulirPermohonan();
                $FormulirPermohonan->UpdateVerifikasiBerkasPengumuman($Request, 18);

                return redirect('/ValidasiBPFY')->with('status', 'Verifikasi Tiga Berkas Pengumuman telah disimpan !');
            }
        } else {
            $NomorBerkasPengumuman = new BerkasPengumuman();
            $NomorBerkasPengumuman->UpdateVerifikasiSanggahan($Request);

            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateVerifikasiBerkasPengumuman($Request, 15);

            return redirect('/ValidasiBPFY')->with('status', 'Berkas Pengumuman telah disanggah !');
        }

    }

    public function CreateUbahBerkasPengumuman(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $FormulirPermohonan = new FormulirPermohonan();
        $DataFormulirPermohonan = $FormulirPermohonan->GetUbahBerkasPengumuman();

        return view('BerkasPengumuman.UbahBerkasPengumuman', compact('ID', 'Nama', 'Email', 'Role', 'DataFormulirPermohonan'));
    }

    public function StoreUbahBerkasPengumuman(Request $Request)
    {
        if ($Request->get('Sanggahan') == '') {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateCreateBerkasPengumuman($Request, 14); // 14 : Siap Verifikasi 15 : Sanggahan 16 : Verifikasi 1 17 : Verifikasi 2 18 : Verifikasi 3
        } else {
            $FormulirPermohonan = new FormulirPermohonan();
            $FormulirPermohonan->UpdateCreateBerkasPengumuman($Request, 15);
        }

        $NomorBerkasPengumuman = new BerkasPengumuman();
        $NomorBerkasPengumuman->UpdateBerkasPengumuman($Request);

        return redirect('/UbahBPFY')->with('status', 'Berkas Pengumuman telah diubah !');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PrintBPFY(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $BerkasPengumuman = new BerkasPengumuman();
        $DataBerkasPengumuman = $BerkasPengumuman->GetPrintBerkasPengumuman();

        return view('BerkasPengumuman.PrintBerkasPengumuman', compact('ID', 'Email', 'Nama', 'Role', 'DataBerkasPengumuman'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PostPrintBPFY(Request $Request)
    {
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
        $kepalSeksiHakTanahDanPendaftaranTanah= App\Karyawan::where('Jabatan',3)->first();
        if (!isset($beritaAcara)) {
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
        $data = [
            'namaDesa'         => $namaDesa,
            'persyaratan'      => $persyaratan,
            'namakepaladesa'   => $namakepaladesa,
            // 'nikkepaladesa'    => $nikkepaladesa,
            'berkasPengumuman' => $berkasPengumuman,
            'berkasPermohonan' => $berkasPermohonan,
            'pemohon'          => $pemohon,
            'risalah'          => $risalah,
            'namaKepalSeksiHakTanahDanPendaftaranTanah' => $kepalSeksiHakTanahDanPendaftaranTanah->Nama,
            'nikKepalSeksiHakTanahDanPendaftaranTanah' => $kepalSeksiHakTanahDanPendaftaranTanah->NIK,
        ];
//        return view()->make('PDF.berkasPengumuman', $data);
        $merger = new Merger();
        $PDF = PDF::loadView('PDF.berkasPengumuman', $data);
        $PDF->setPaper('A4');
        $merger->addRaw($PDF->output());

        $PDF2 = PDF::loadView('PDF.berkasPengumumanPage2', $data);
        $PDF2->setPaper('A4','landscape');
        $merger->addRaw($PDF2->output());

        $response = response()->make($merger->merge(), 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
}
