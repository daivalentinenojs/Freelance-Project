@extends('PDF.kop')

@section('title','Berita Acara')

@section('css')
    <style>
    </style>
@endsection

@section('lampiran')
    <div style="position:absolute;top:-30px;right:0px;text-align: right;">
        DI 202
    </div>
@endsection

@section('content')

    <div style="font-weight:bold;font-size:18" class="text-center">
        BERITA ACARA
    </div>

    <div style="font-weight:bold;font-size:14;margin-top:16px" class="text-center">
        PENGESAHAN PENGUMUMAN DATA FISIK DAN DATA YURIDIS
    </div>

    <div style="display:block;clear:both;line-height: 1.25em;margin-top:0px;margin-bottom:18px">
        <table style="display:table;margin-left:210%;">
            <tr>
                <td style="padding-right:25px">
                    Nomor
                </td>
                <td style="width:15px;">
                    : &nbsp; &nbsp;
                </td>
                <td>
                    {{ $beritaAcara->NomorBeritaAcara }}
                </td>
            </tr>
            <tr>
                <td>
                    Tanggal
                </td>
                <td>
                    : &nbsp; &nbsp;
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($beritaAcara->Tanggal)->format('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top:15px;text-align:justify">
        Memenuhi ketentuan dalam Pasal 26 (1) Peraturan Pemerintah Nomor 24 Tahun 1997
        tentang Pendaftaran Tanah, setelah diumumkan selama 60 (enam puluh) hari, dengan ini
        Kepala Kantor Pertanahan Kabupaten Sidoarjo.
    </div>
    <div style="text-align:center;font-weight:bold;font-size:12;margin-top:15px;margin-bottom:15px;">MENGESAHKAN</div>
    <div style="text-align:justify">
        Hasil penelitian Data Fisik dan Data Yuridis yang telah diumumkan di Desa/Kelurahan {{ $namaDesa }}.
        Dengan nomor: {{ $berkasPengumuman->NomorBerkasPengumuman }}, Tanggal {{ \Carbon\Carbon::parse($berkasPengumuman->Tanggal)->format('d/m/Y') }}.
        Dengan penjelasan sebagai berikut:
        <br><br>
        {{ $beritaAcara->PenjelasanPengesahan }}
        {{--Tidak ada keberatan 1 ( satu ) Bidang--}}
        {{--<br>--}}
        {{--Ada keberatan dan sudah dapat diselesaikan melalui ---}}
        {{--<br>--}}
        {{--Ada keberatan yang belum ada penyelesaiannya - Bidang.--}}

    </div>
    <br>
    <br>
    <div style="width:50%;float:right;text-align:center">
        Sidoarjo, {{ \Carbon\Carbon::parse($beritaAcara->Tanggal)->format('d M Y') }}
        <br>
        a.n. KEPALA KANTOR PERTANAHAN<br>
        KABUPATEN SIDOARJO<br>
        Kepala Seksi Hak Tanah dan Pendaftaran tanah
        <br>
        <br>
        <br>
        <br>
        <br>
        <u>{{ $namaKepalSeksiHakTanahDanPendaftaranTanah }}</u><br>
    </div>
@endsection
