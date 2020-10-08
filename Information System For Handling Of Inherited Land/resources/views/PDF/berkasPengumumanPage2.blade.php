@extends('PDF.header-footer')

@section('title','Berkas Yuridis')

@section('css')
    <style>
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 4px 8px;
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
            padding: 0px 8px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg .tg-yw4l {
            vertical-align: top
        }
    </style>
@endsection

@section('content')
    <div style="position:absolute;top:0px;right:0px;text-align: right;">
        DI.201 C
    </div>
    <div style="position:absolute;top:0px;left:0px;text-align: left;display:block;width:100%">
        KANTOR PERTANAHAN
        <br>
        KABUPATEN SIDOARJO
    </div>
    <div style="width:100%;text-align: center; margin-top:35px;">
        DAFTAR DATA YURIDIS DAN DATA FISIK BIDANG TANAH
        <BR>
        LAMPIRAN P E N G U M U M A N
        <table style="display:table;margin-left:auto;margin-right:auto;width:10%">
            <tr>
                <td style="padding-right:25px">
                    NOMOR
                </td>
                <td style="width:15px;">
                    : &nbsp; &nbsp;
                </td>
                <td>
                    {{ $berkasPengumuman->NomorBerkasPengumuman }}
                </td>
            </tr>
            <tr>
                <td>
                    TANGGAL
                </td>
                <td>
                    : &nbsp; &nbsp;
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($berkasPengumuman->Tanggal)->format('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>
<br>
    <table class="tg">
        <tr>
            <td class="tg-031e" rowspan="2">No. <br>Urut</td>
            <td class="tg-031e" colspan="2">Bidang Tanah</td>
            <td class="tg-yw4l">Letak Tanah</td>
            <td class="tg-yw4l" colspan="2">Akan dibukukan pada Daftar Hak</td>
            <td class="tg-yw4l" rowspan="2">Status</td>
            <td class="tg-yw4l" rowspan="2">Keterangan</td>
        </tr>
        <tr>
            <td class="tg-031e">NIB</td>
            <td class="tg-031e">Luas m<sup>2</sup></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l">Nama</td>
            <td class="tg-yw4l">Alamat</td>
        </tr>
        <tr>
            <td class="tg-031e">1</td>
            <td class="tg-031e">2</td>
            <td class="tg-031e">3</td>
            <td class="tg-yw4l">4</td>
            <td class="tg-yw4l">5</td>
            <td class="tg-yw4l">6</td>
            <td class="tg-yw4l">7</td>
            <td class="tg-yw4l">8</td>
        </tr>
        <tr>
            <td class="tg-031e">1</td>
            <td class="tg-031e">{{ $berkasPermohonan->KodeDi301 }}</td>
            <td class="tg-031e">{{ $persyaratan->LuasTanahLetterC }}</td>
            <td class="tg-031e">a. Desa {{ $namaDesa }}<br>b. Kec.</td>
            <td class="tg-yw4l">{{ $pemohon->Nama }}</td>
            <td class="tg-yw4l">{{ $pemohon->Alamat }}</td>
            <td class="tg-yw4l">Tanah Milik Adat </td>
            <td class="tg-yw4l">{{ $risalah->StatusBangunanAtasTanah  }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>
                Keterangan:
                <br>
                <br>
            </td>
            <td>
                TN = Tanah Negara; TMA = Tanah Milik Adat; M: Milik
                <br>
                TD = Tanah Darat; TS = Tanah Sawah .-
            </td>
        </tr>
    </table>
    <br>
    <br>
    <div style="width:50%;float:right;text-align:center">
        Sidoarjo, {{ \Carbon\Carbon::parse($berkasPengumuman->Tanggal)->format('d M Y') }}
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
        NIK: {{ $nikKepalSeksiHakTanahDanPendaftaranTanah }}
    </div>
@endsection
