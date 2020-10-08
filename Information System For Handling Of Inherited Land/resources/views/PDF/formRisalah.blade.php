@extends('PDF.header-footer')

@section('title','Form Risalah')

@section('css')
    <style>
        .just {
            text-align: justify;
            text-justify: inter-word;
            text-align-last: center;
            /* for IE9 */
            -ms-text-align-last: center;
        }

        .borderan {
            border: 0.5px solid black;
        }

        .berpading10 {
            padding: 10px;
        }

        .bold {
            font-weight: bold;
        }

        td {
            padding: 4px;
        }

        .table-contente {
            padding-left: 20px;
        !important
        }

        .breaker {
            page-break-after: always;
        }
    </style>
@endsection

@section('content')
<?php ini_set('max_execution_time', 300); ?>
    <div style="margin-bottom:50px">
        <div style="position:absolute;top:0px;left:0px;padding-right:5px;display:inline-block">
            <p class="text-justify">
                <span style="font-size:16px;font-weight:bold">BADAN PERTANAHAN NASIONAL</span>
                <br>
                <span style="font-size:12px;font-weight:bold">KANTOR PERTANAHAN KABUPATEN SIDOARJO</span>
            </p>
        </div>
        <div style="position:absolute;top:0px;right:0px;display:inline-block">
            <span style="font-size:12px;font-weight:bold">Lampiran 43</span>
            <br>
            <span style="font-size:12px;font-weight:bold">DI 201</span>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div style="font-weight:bold;font-size:16px" class="center-block text-center">
        RISALAH PENELITIAN DATA YURIDIS
        <br>
        DAN PENETAPAN BATAS
    </div>
    <br>
    <br>
    <div style="display:block;clear:both;line-height: 1.55em;margin-top:10px">
        <table style="display:table;margin-left:125%;">
            <tr>
                <td style="width:150px">
                    Desa/Kelurahan
                </td>
                <td style="width:15px;">
                    : &nbsp; &nbsp;
                </td>
                <td>
                    {{ $namaDesa }}
                </td>
            </tr>
            <tr>
                <td>
                    N I B
                </td>
                <td>
                    : &nbsp; &nbsp;
                </td>
                <td>
                    {{ $nib }}
                </td>
            </tr>
        </table>
    </div>
    <br>
    <table class="borderan" style="width:100%">
        <tr>
            <td class="borderan bold">I. IDENTIFIKASI BIDANG TANAH DAN YANG BERKEPENTINGAN</td>
        </tr>
        <tr>
            <td class="borderan bold">&nbsp; 1. BIDANG TANAH</td>
        </tr>
        <tr>
            <td class="table-contente">
                LETAK TANAH
                <br>
                Jalan / Blok : {{ $jalan }}
            </td>
        </tr>
        <tr>
            <td class="borderan bold">2. YANG BERKEPENTINGAN</td>
        </tr>
        <tr>
            <td class="table-contente">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td style="width:10px">:</td>
                        <td>{{ $nama }}</td>
                    </tr>
                    <tr>
                        <td>Nomor KTP</td>
                        <td>:</td>
                        <td>{{ $nik }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $pekerjaan }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="borderan bold">3. SKETSA BIDANG TANAH</td>
        </tr>
        <tr>
            <td class="table-contente">
                <img style="margin-top:22px" src="{{ url('/foto/SketsaBidang/'.$img) }}">
            </td>
        </tr>
        <tr>
            <td class="borderan bold">4. PERSETUJUAN BATAS BIDANG TANAH</td>
        </tr>
        <tr>
            <td style="width:100%;border:none;padding:0px">
                <table style="width:100%;border:none">
                    <tr>
                        <td class="borderan berpadding10 text-center">Nama Tetangga yang berkepentingan<br>&nbsp;</td>
                        <td class="borderan berpadding10 text-center">Tanda tanda persetujuan Tetangga<br>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="borderan berpadding10">1. {{ $batasutara }}</td>
                        <td class="borderan berpadding10">Utara</td>
                    </tr>
                    <tr>
                        <td class="borderan berpadding10">2. {{ $batastimur }}</td>
                        <td class="borderan berpadding10">Timur</td>
                    </tr>
                    <tr>
                        <td class="borderan berpadding10">3. {{ $batasselatan }}</td>
                        <td class="borderan berpadding10">Selatan</td>
                    </tr>
                    <tr>
                        <td class="borderan berpadding10">4. {{ $batasbarat }}</td>
                        <td class="borderan berpadding10">Barat</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div style="position:absolute;bottom:10px;right:5px;">
        halaman 1 - 6
    </div>
    <div class="breaker"></div>
    {{--PAGE 2--}}
    <table class="borderan" style="width:100%">
        <tr>
            <td colspan="3" class="borderan bold">II. DATA TENTANG PEMILIKAN DAN PENGUASAAN HAK ATAS TANAH</td>
        </tr>
        <tr>
            <td colspan="3" class="borderan bold">A. PEMILIKAN / PENGUASAAN TANAH:</td>
        </tr>
        <tr>
            <td style="width:30px">1</td>
            <td colspan="2" class="borderan bold">Bukti-Bukti Pemilikan / Penguasaan:</td>
        </tr>
        <?php
        $counterBukti = 'a';
        ?>
        @if(\App\Helper::isNotNullExist([$persyaratan->NamaPewaris,$persyaratan->TanggalMeninggal]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">
                    <table>
                        <tr>
                            <td colspan="3">{{ $counterBukti }}. Sertifikat</td>
                        </tr>
                        <tr>
                            <td>Sertifikat</td>
                            <td style="width:15px;">:&nbsp;</td>
                            <td>{{ $persyaratan->NamaPewaris }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td style="width:15px;">:&nbsp;</td>
                            <td>{{ $persyaratan->TanggalMeninggal }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php $counterBukti++; ?>
        @endif

        @if(\App\Helper::isNotNullExist([$persyaratan->NamaPewaris,$persyaratan->TanggalMeninggal,$persyaratan->NamaPewaris]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">
                    <table>
                        <tr>
                            <td colspan="8">{{ $counterBukti }}. Tanah Hak adat</td>
                        </tr>
                        <tr>
                            <td>Nama Pewaris</td>
                            <td style="width:15px;">:&nbsp;</td>
                            <td>{{ $persyaratan->NamaPewaris }}</td>
                        </tr>
                        <tr>
                            <td>Meninggal Tanggal</td>
                            <td style="width:15px;">:&nbsp;</td>
                            <td>{{ $persyaratan->TanggalMeninggal }}</td>
                        </tr>
                        <tr>
                            <td>Ada Warisan</td>
                            <td style="width:15px;">:&nbsp;</td>
                            <td>{{ $persyaratan->NamaPewaris }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php $counterBukti++; ?>
        @endif
        @if(\App\Helper::isNotNullExist([$persyaratan->NomorSuratHibah]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">{{ $counterBukti }}. Pemberi hibah
                    : {{ $persyaratan->NomorSuratHibah }}</td>
            </tr>
            <?php $counterBukti++; ?>
        @endif
        @if(\App\Helper::isNotNullExist([$persyaratan->PembelianDari]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">{{ $counterBukti }}. Pembelian Dari
                    : {{ $persyaratan->PembelianDari }}</td>
            </tr>
            <?php $counterBukti++; ?>
        @endif
        @if(\App\Helper::isNotNullExist([$persyaratan->pelelangan]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">{{ $counterBukti }}. Pelelangan : {{ $persyaratan->pelelangan }}</td>
            </tr>
            <?php $counterBukti++; ?>
        @endif
        @if(\App\Helper::isNotNullExist([$persyaratan->PutusanPemberianHak]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">{{ $counterBukti }}. Putusan Pemberian
                    Hak {{ $persyaratan->PutusanPemberianHak }}</td>
            </tr>
            <?php $counterBukti++; ?>
        @endif
        @if(\App\Helper::isNotNullExist([$persyaratan->NamaPerwakafan]))
            <tr>
                <td style="border-bottom:none">&nbsp;</td>
                <td colspan="2" class="borderan">{{ $counterBukti }}.
                    Perwakafan: {{ $persyaratan->NamaPerwakafan }}</td>
            </tr>
            <?php $counterBukti++; ?>
        @endif
        {{--@if(\App\Helper::isNotNullExist([$persyaratan->PutusanPemberianHak]))--}}
        {{--<tr>--}}
        {{--<td colspan="2" class="borderan">{{ $counterBukti }}. Lain-lain</td>--}}
        {{--</tr>--}}
        {{--<?php $counterBukti++; ?>--}}
        {{--@endif--}}
        <tr>
            <td class="borderan bold">2</td>
            <td class="borderan bold">Bukti Pajak</td>
            <td class="borderan bold text-center">Uraian</td>
        </tr>
        <tr>
            <td rowspan="4"></td>
            <td class="borderan">
                Letter C
            </td>
            <td class="borderan">{{ $buktiPerpajakan->UraianPatokD }}</td>
        </tr>
        <tr>
            <td class="borderan">
                Verponding / Verponding Indonesia<br>
                {{ $buktiPerpajakan->StatusVerponding }}
            </td>
            <td class="borderan">{{ $buktiPerpajakan->UraianVerponding }}</td>
        </tr>
        <tr>
            <td class="borderan">
                IPEDA / PBB / SPPT<br>
                {{ $buktiPerpajakan->StatusIPEDA }}</td>
            <td class="borderan">{{ $buktiPerpajakan->UraianIPEDA }}</td>
        </tr>
        <tr>
            <td class="borderan">Lain-lain(sebutkan)<br>
                {{ $buktiPerpajakan->LainLain }}</td>
            <td class="borderan">{{ $buktiPerpajakan->UraianLain }}</td>
        </tr>
        <tr>
            <td class="borderan bold">3</td>
            <td colspan="2" class="borderan bold">Kenyataan Penguasaan dan Penggunaan Tanah:</td>
        </tr>
        <tr>
            <td rowspan="2" class="borderan"></td>
            <td colspan="2" class="borderan">
                <ol type="a">
                    <li>Pada Tahun {{ $kenyataan->KeteranganTahun }}
                        Dikuasai / dimiliki oleh: {{ $pemohon->Nama }}
                        Berdasarkan {{ $kenyataan->KeteranganCara }}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="borderan">
                <table>
                    <tr>
                        <td>Penggunaan Tanah:</td>
                        <td>Sawah</td>
                        <td>[{{ $kenyataan->Jenis==1?"X":"" }}]</td>
                        <td>Ladang</td>
                        <td>[{{ $kenyataan->Jenis==2?"X":"" }}]</td>
                        <td>Kebun</td>
                        <td>[{{ $kenyataan->Jenis==3?"X":"" }}]</td>
                        <td>Kolam Ikan</td>
                        <td>[{{ $kenyataan->Jenis==4?"X":"" }}]</td>
                    </tr>
                    <tr>
                        <td rowspan="2"></td>
                        <td>Perumahan</td>
                        <td>[{{ $kenyataan->Jenis==5?"X":"" }}]</td>
                        <td>Industri</td>
                        <td>[{{ $kenyataan->Jenis==6?"X":"" }}]</td>
                        <td>Perkebunan</td>
                        <td>[{{ $kenyataan->Jenis==7?"X":"" }}]</td>
                        <td>Dikelola pengembang</td>
                        <td>[{{ $kenyataan->Jenis==8?"X":"" }}]</td>
                    </tr>
                    <tr>
                        <td>Pekarangan</td>
                        <td>[{{ $kenyataan->Jenis==9?"X":"" }}]</td>
                        <td></td>
                        <td colspan="2">Penggembalaan<br>ternak</td>
                        <td>[{{ $kenyataan->Jenis==10?"X":"" }}]</td>
                        <td>Dibiarkan<br>Lapangan Umum</td>
                        <td>[{{ $kenyataan->Jenis==11?"X":"" }}]<br>[{{ $kenyataan->Jenis==12?"X":"" }}]</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div style="position:absolute;bottom:10px;right:5px;">
        halaman 2 - 6
    </div>
    <div class="breaker"></div>
    {{--PAGE 3--}}
    <table class="borderan" style="width:100%">
        <tr>
            <td class="borderan bold">4.</td>
            <td class="borderan bold" colspan="2">Bangunan diatas tanah:</td>
        </tr>
        <tr>
            <td class="borderan"></td>
            <td colspan="2">
                <table>
                    <tr>
                        <td>a. Jenisnya</td>
                        <td>Rumah hunian</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==1?"X":"" }}]</td>
                        <td>Gudang</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==2?"X":"" }}]</td>
                        <td>kantor</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==3?"X":"" }}]</td>
                        <td>Bengkel</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==4?"X":"" }}]</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Toko</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==5?"X":"" }}]</td>
                        <td>Pagar</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==6?"X":"" }}]</td>
                        <td>Rumah ibadah</td>
                        <td>[{{ $risalah->StatusBagunanAtasTanah==7?"X":"" }}]</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="9">b. Tidak ada bangunan</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="borderan bold">5.</td>
            <td class="borderan">Status tanahnya</td>
            <td class="borderan">Uraian</td>
        </tr>
        <tr>
            <td class="borderan" rowspan="3"></td>
            <td class="borderan">a. Tanah dengan hak adat perorangan:</td>
            <td class="borderan">
                <table>
                    <tr>
                        <td>Hak milik adat</td>
                        <td>:</td>
                        <td>[X]</td>
                        <td>Hak Gogol</td>
                        <td>:</td>
                        <td>[ ]</td>
                    </tr>
                    <tr>
                        <td>Hak Sanggan</td>
                        <td>:</td>
                        <td>[ ]</td>
                        <td>Hak Yasan</td>
                        <td>:</td>
                        <td>[ ]</td>
                    </tr>
                    <tr>
                        <td>Hak Anggaduh</td>
                        <td>:</td>
                        <td>[ ]</td>
                        <td>Hak Pekulen</td>
                        <td>:</td>
                        <td>[ ]</td>
                    </tr>
                    <tr>
                        <td>Hak Norowito</td>
                        <td>:</td>
                        <td>[ ]</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="borderan">b. Tanah bagi kepentingan umum</td>
            <td class="borderan">
                <table>
                    <tr>
                        <td>Tanah Kuburan</td>
                        <td>:</td>
                        <td>[ ]</td>
                        <td>Tanah Panggonan</td>
                        <td>:</td>
                        <td>[ ]</td>
                    </tr>
                    <tr>
                        <td>Tanah Pasar</td>
                        <td>:</td>
                        <td>[ ]</td>
                        <td>Tanah Lapang</td>
                        <td>:</td>
                        <td>[ ]</td>
                    </tr>
                    <tr>
                        <td>Tanah Kas Desa</td>
                        <td>:</td>
                        <td>[ ]</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="borderan">c. Lain-lain, sebutkan</td>
            <td class="borderan"></td>
        </tr>
        <tr>
            <td class="borderan bold">6.</td>
            <td class="borderan bold" colspan="2">Beban-beban atas tanah</td>
        </tr>
        <tr>
            <td class="borderan"></td>
            <td colspan="2">
                {{ $risalah->BebanAtasTanah }}
            </td>
        </tr>
        <tr>
            <td class="borderan bold">7.</td>
            <td class="borderan bold" colspan="2">Bangunan Kepentingan Umum dan Sosial (kalau ada uraikan</td>
        </tr>
        <tr>
            <td class="borderan"></td>
            <td colspan="2">
                {{ $risalah->BangunanKepentingan }}</td>
        </tr>
        <tr>
            <td class="borderan bold">8.</td>
            <td class="borderan bold" colspan="2">Sengketa atas tanah</td>
        </tr>
        <tr>
            <td class="borderan"></td>
            <td class="borderan" colspan="2">
                @if($risalah->StatusSengketa==1)
                    a. Sedang dalam sengketa
                @else
                    b. Tidak ada sengketa
                @endif
            </td>
        </tr>
        <tr>
            <td class="borderan">B.</td>
            <td>YANG MENGUMPULKAN DATA:<br><br><br><br><br><br><br><br></td>
            <td class="text-center borderan">
                Sidoarjo, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br>Mengetahui,
                <br>Yang berkepentingan / Wakilnya
                <br><br><br><br><br>( {{ $pemohon->Nama }} )
            </td>
        </tr>
    </table>
    <div style="position:absolute;bottom:10px;right:5px;">
        halaman 3 - 6
    </div>
    <div class="breaker"></div>
    {{--PAGE 4--}}
    <table style="width:100%">
        <tr>
            <td class="bold borderan">III. KESIMPULAN PANITIA PEMERIKSAAN TANAH "A"</td>
        </tr>
        <tr>
            <td class="borderan">Berdasarkan pada penilaian atas fakta dan data yang telah dikumpulkan, maka dengan ini
                disimpulkan bahwa:
            </td>
        </tr>
        <tr>
            <td class="borderan">1. Pemilik / yang menguasai tanah adalah: {{ $pemohon->Nama }}</td>
        </tr>
        <tr>
            <td class="borderan">2. Status tanahnya adalah:<br>
                <ol type="a">
                    <li>Tanah Hak: Milik [X] &nbsp;&nbsp;&nbsp;&nbsp; HGB [ ] &nbsp;&nbsp;&nbsp;&nbsp; Hak Pakai [ ]
                    </li>
                    <li>Bekas Tanah Adat Perorangan:
                        HMA [X]&nbsp;&nbsp;&nbsp;&nbsp; Gogol tetap [ ]
                        &nbsp;&nbsp;&nbsp;&nbsp;Pekulen [ ] &nbsp;&nbsp;&nbsp;&nbsp; Andarbeni [ ]
                    </li>
                    <li>
                        <table>
                            <tr>
                                <td>
                                    Tanah Negara:
                                    <br>
                                </td>
                                <td>
                                    Dikuasai langsung oleh negara [ ]&nbsp;&nbsp;&nbsp;&nbsp;
                                    BUMN [ ]&nbsp;&nbsp;&nbsp;&nbsp; Instansi Pemerintah
                                    <br>
                                    Pemkab/Pemkot/Pemprov [ ]&nbsp;&nbsp;&nbsp;&nbsp;
                                    Badan Otorita [ ]&nbsp;&nbsp;&nbsp;&nbsp; Desa/Kelurahan [ ]
                                </td>
                            </tr>
                        </table>
                    </li>
                    <li>
                        Lain lain sebutkan:
                    </li>
                </ol>
                Kepada yang menempati yaitu {{ $pemohon->Nama }} dapat /<strike>tidak dapat</strike>
                diusulkan untuk diberikan Hak Milik <strike>/ Hak Guna Bangunan / Hak Pakai</strike>
            </td>
        </tr>
        <tr>
            <td class="borderan">3. Pembebanan atas tanah: Sedang diagunakan [{{ $risalah->StatusPembebanan==1?"X":"" }}
                ]
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tidak diagunakan
                [{{ $risalah->StatusPembebanan==2?"X":"" }}]
            </td>
        </tr>
        <tr>
            <td class="borderan">4. Alat bukti yang diajukan:
                Lengkap [{{ $risalah->StatusAlatBukti==1?"X":"" }}]
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tidak Lengkap [{{ $risalah->StatusAlatBukti==2?"X":"" }}]
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tidak ada [{{ $risalah->StatusAlatBukti==3?"X":"" }}]
            </td>
        </tr>
        <tr>
            <td class="borderan">
                <br>
                Demikian Kesimpulan Risalah Penelitian Data Yuridis, dan Penetapan batas atas bidang tanah dengan:
                <br>
                <br>
                <br>
                <div style="margin-left:2cm">
                    <table>
                        <tr>
                            <td>NIB</td>
                            <td>:</td>
                            <td>{{ $nib }}</td>
                        </tr>
                        <tr>
                            <td>Dibuat di</td>
                            <td>:</td>
                            <td>Sidoarjo</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Oleh</td>
                            <td>:</td>
                            <td>Panitia "A"</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <td>Ketua</td>
                            <td>:</td>
                            <td>___________________________ (_______________)</td>
                        </tr>
                        <tr>
                            <td>Anggota-anggota</td>
                            <td>:</td>
                            <td>___________________________ (_______________)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>:</td
                            <td>___________________________ (_______________)</td>
                        </tr>
                        <tr>
                            <td>Sekretaris bukan anggota</td>
                            <td>:</td>
                            <td>___________________________ (_______________)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>:</td>
                            <td>___________________________ (_______________)</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                M E N G E T A H U I
                                <br>
                                Kepala Desa {{ $namaDesa }}
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </div>

            </td>
        </tr>
    </table>
    <div style="position:absolute;bottom:10px;right:5px;">
        halaman 4 - 6
    </div>
    <div class="breaker"></div>
    {{--PAGE 5--}}
    <table style="width:100%">
        <tr>
            <td class="borderan bold">IV. SANGGAHAN / KEBERATAN</td>
        </tr>
        <tr>
            <td class="borderan" style="height:0.5cm;"></td>
        </tr>
        <tr>
            <td class="borderan">
                <ol type="1">
                    <li>
                        Uraian singkat Sengketa / Sanggahan<br>
                        <ol type="a">
                            <li>
                                @if(!isset($sanggahan))<strike>@endif
                                    Terdapat Sengketa / Sanggahan mengenai batas / pemilikan tanah antara berkepentingan
                                    dengan
                                    (nama) __________________ Gugatan Pengadilan telah diajukan / tidak diajukan.
                                    @if(!isset($sanggahan))</strike>@endif
                            </li>
                            <li>
                                Selama Pengumuman @if(!isset($sanggahan))<strike>ada</strike>@else ada @endif
                                / @if(isset($sanggahan))<strike>tidak ada</strike>@else tidak ada @endif yang menyanggah
                            </li>
                            <li>
                                Nama Penyanggah:
                                @if(isset($sanggahan))
                                    {{ $sanggahan->NamaPenyanggah }}
                                @endif
                                <br>
                                Alamat Penyanggah:
                                @if(isset($sanggahan))
                                    {{ $sanggahan->AlamatPenyanggah }}
                                @endif
                            </li>
                            <li>
                                Alasan penyanggah beserta surat buktinya:
                                <br>
                                @if(isset($sanggahan))
                                    {{ $sanggahan->AlasanPenyanggah }}
                                @endif
                            </li>
                        </ol>
                    </li>
                    <li>
                        Penyelesaian sengketa / sanggahan<br>

                        @if(isset($sanggahan))
                            {{ $sanggahan->Penyelesaian }}
                        @endif
                    </li>
                </ol>
            </td>
        </tr>
        <tr>
            <td class="borderan bold">V. KESIMPULAN AKHIR KEPALA KANTOR PERTANAHAN</td>
        </tr>
        <tr>
            <td class="borderan">
                <div style="margin-left:0.5cm">
                    <table style="width:100%">
                        <tr>
                            <td style="vertical-align:top">1. Nama pemilik / yang berkepentingan:</td>
                            <td> {{ $pemohon->Nama }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tanah milik <strike>/ tanah negara</strike></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">2. Pertimbangan dalam hal status:</td>
                            <td>a. Berdasarkan data fisik dan data yuridis yang disahkan dengan Berita Acara Pengesahan
                                data fisik dan data yuridis Tanggal <br>
                                <?php \Carbon\Carbon::setLocale('id'); ?>
                                {{ \Carbon\Carbon::parse($beritaAcara->Tanggal)->format('d M Y') }}
                                No {{ $beritaAcara->NomorBeritaAcara }}
                                hak atas tanah ini <strike>ditegaskan</strike> / diakui
                                konversinya menjadi hak milik dengan pemegang haknya: {{ $pemohon->Nama }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>b. Diproses melalui pengakuan / <strike>pemberian hak</strike></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>

                                <div class="text-center">Sidoarjo, {{ \Carbon\Carbon::parse($berkasPengumuman->Tanggal)->format('d M Y') }}
                                    <br>
                                    a.n. KEPALA KANTOR PERTANAHAN<br>
                                    KABUPATEN SIDOARJO<br>
                                    KEPALA SEKSI HUBUNGAN HUKUM PERTANAHAN
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <u>{{ $kepalSeksiHubHukumPertanahan->Nama }}</u><br>
                                    Nik: {{ $kepalSeksiHubHukumPertanahan->NIK }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <div style="position:absolute;bottom:10px;right:5px;">
        halaman 5 - 6
    </div>
    <div class="breaker"></div>
    {{--PAGE 6--}}
    <table style="width:100%;">
        <tr>
            <td class="borderan bold">VI. KEPUTUSAN KEPALA KANTOR PERTANAHAN</td>
        </tr>
        <tr>
            <td class="borderan">
                Mengingat Peraturan Negara Agraria / Kepala badan Pertanahan Nasional Nomor 3 tahun 1997
                <br>
                Memperhatikan kesimpulan Panitia A yang tercantum dalam Daftar Isian 201, maka:
                <br>
                <ol type="1">
                    <li>
                        Berdasarkan data fisik dan data yuridis yang disahkan denga berita acara
                        pengesahan data fisik dan data Yuridis Tanggal
                        {{ \Carbon\Carbon::parse($beritaAcara->Tanggal)->format('d M Y')  }} No
                        {{ $beritaAcara->NomorBeritaAcara }} Hak atas tanah ini <strike>ditegaskan konversinya menjadi hak milik / </strike>
                        diakui sebagai hak milik dengan pemegang hak: {{ $formulirPermohonan->NamaKuasa }} tanpa / <strike> dengan catatan</strike>
                        ada keberatan ( <strike>tidak ke Pengadilan / sedang diproses di Pengadilan dengan / tanpa sita jaminan</strike> )
                    </li>
                    <li>
                        Berdasarkan data fisik dan data yuridis yang di syahkan dengan berita Acara pengesahan
                        data fisik dan data yuridis tanggal _____________, bidang tnah ini statusnya adalah TANAH NEGARA.
                        <br>
                        Kepada yang menempati / menguasai nama _________________ Dapat / tdak dapat diusulkan untuk diberikan
                        hak milik / hak guna bangunan / hak pakai
                    </li>
                    <li>
                        Berdasarkan Berita Acara Panitia Ajudikasi <i>jo.</i> pasal _____ Peraturan Menteri Negara Agraria / Kepala Badan Pertanahan Nasional
                        Nomor 3 tahun 1997 tanggal __________ dan Keputusan Menteri Negara Agraria / Kepala Badan Pertanahan Nasional No _______ Tahun ______
                        bidang tanah yang diuraikan pada DI. 201 ini ada Dalam SENGKETA, sehubungan dengan itu Proses
                        pensertipikatannya ditunda sampai diterbitkan Keputusan Lembaga Peradilan yang telah mempuyai kekuatan hukum tetap.
                    </li>
                </ol>
                <br>
                Apabila dikemudian hari ternyata ada bukti yang lebih kuat dan sah, sehingga isi keputusan ini harus diubah
                dan disesuaikan dengan bukti-bukti tersebut, maka hal itu akan dilakukan sesuai dengan peraturan perundang-undangan yang berlaku
                <br>
                <br>
                <div class="text-center" style="margin-left:5.5cm">
                    Ditetapkan di: Sidoarjo, {{ \Carbon\Carbon::parse($beritaAcara->Tanggal)->format('d M Y')  }}
                    <br>
                    a.n. KEPALA KANTOR PERTANAHAN<br>
                    KABUPATEN SIDOARJO<br>
                    KEPALA SEKSI HUBUNGAN HUKUM PERTANAHAN
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <u>{{ $kepalSeksiHubHukumPertanahan->Nama }}</u><br>
                    Nik: {{ $kepalSeksiHubHukumPertanahan->NIK }}</div>
                </div>
            </td>
        </tr>
    </table>
    <div style="position:absolute;bottom:10px;right:5px;">
        halaman 6 - 6
    </div>
@endsection
