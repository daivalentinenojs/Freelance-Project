@extends('PDF.kop')

@section('title','Surat Pengantar')

@section('css')
    <style>
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 6px 9px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg th {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            padding: 6px 9px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }
    </style>
@endsection


@section('content')
    <div style="width:100%;text-align:right;">
        Sidoarjo, {{ \Carbon\Carbon::parse($suratPengantar->Tanggal)->format('d-m-Y') }}
    </div>
    <div style="width:100%;text-align:left;">
        Kepada Yth. Kepala Desa
        <br>
        {{ $namaDesa }}
        <br>
        Di
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sidoarjo
    </div>
    <br>
    <br>
    <br>
    <div style="text-decoration: underline;text-align:center;width:100%;">
        SURAT PENGANTAR
    </div>
    <br>
    <br>
    <br>
    <div style="text-align:center;width:100%;margin-bottom:10px;">
        Nomor : {{ $suratPengantar->NomorSuratPengantar }}
    </div>
    <table class="tg" style="width:100%">
        <tr>
            <td class="tg-031e">NO</td>
            <td class="tg-031e">NASKAH DINAS YANG DIKIRIM</td>
            <td class="tg-031e">BANYAKNYA</td>
            <td class="tg-031e">KETERANGAN</td>
        </tr>
        <tr>
            <td class="tg-031e">1.</td>
            <td class="tg-031e">
                Pengumuman Data Fisik dan Yuridis
                <br>
                Nomor : {{ $berkasPengumuman->NomorFisik }}
                <br>
                Tgl &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ \Carbon\Carbon::parse($berkasPengumuman->Tanggal)->format('d/m/Y') }}
            </td>
            <td class="tg-031e">1 (satu) Eks </td>
            <td class="tg-031e">{{ $detilsuratPengantar->Keterangan }}</td>
        </tr>
    </table>
    <br>
    <br>
    <div style="width:50%;float:right;text-align:center">
        a.n. KEPALA KANTOR PERTANAHAN<br>
        KABUPATEN SIDOARJO<br>
        Kepala Sub Bagian Tata Usaha
        <br>
        <br>
        <br>
        <br>
        <br>
        <u>{{ $kepalaSubBagianTU->Nama }}</u><br>
            NIP. {{ $kepalaSubBagianTU->NIK }}
    </div>
    <br>
    <br>
    <div style="width:50%;text-align:left">
        Diterima Tanggal
        <br>
        Penerima,
        <br>
        <br>
        <br>
        <br>
        <u>{{ $namakepaladesa }}</u><br>
        Nip.
    </div>
@endsection
