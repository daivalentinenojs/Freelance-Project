@extends('PDF.kop')

@section('title','Berkas Yuridis')

@section('css')
    <style>
        td {
            padding-left: 4px;
        }
    </style>
@endsection

@section('lampiran')
    <div style="position:absolute;top:-30px;right:0px;text-align: right;">
        Lampiran 45
        <br>
        DI 201 B
    </div>
@endsection

@section('content')
    <div style="font-weight:bold;font-size:18" class="text-center">
        PENGUMUMAN DATA FISIK DAN DATA YURIDIS
    </div>

    <div style="display:block;clear:both;line-height: 1.25em;margin-top:0px;margin-bottom:18px">
        <table style="display:table;margin-left:160%;">
            <tr>
                <td style="padding-right:25px">
                    Nomor
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
                    Tanggal
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
    <ol type="I">
        <li>
            Untuk memenuhi ketentuan dalam Pasal 26 ayat (1) Peraturan Pemerintah Nomor 24 Tahun 1997
            tentang Pendaftaran Tanah, dengan ini diumumkan hasi lepngumpulan data fisik dan data
            yuridis atas Pendaftaran Tanah Untuk Pertama Kali Pengakuan Dan Penegasan Hak - Sporadis.

            <table style="margin-top:15px;margin-bottom:15px;">
        <tr>
            <td style="width: 190px">Nomor bidang</td>
            <td>:</td>
            <td>{{ $berkasPermohonan->KodeDi301 }}</td>
        </tr>
        <tr>
            <td colspan="3">Terletak  :</td>
        </tr>
        <tr>
            <td>Jalan</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>RT / RW</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Kel / Desa</td>
            <td>:</td>
            <td>{{ $namaDesa }}</td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Kabupaten</td>
            <td>:</td>
            <td>Sidoarjo</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Yang berasal dari :</td>
        </tr>
        <tr>
            <td  style="width: 190px">Status Tanah</td>
            <td>:</td>
            <td>Hak Milik Adat</td>
        </tr>
        <tr>
            <td>Persil</td>
            <td>:</td>
            <td>{{ $persyaratan->PersilNoLetterC }}</td>
        </tr>
        <tr>
            <td>Klas</td>
            <td>:</td>
            <td>{{ $persyaratan->KelasLetterC }}</td>
        </tr>
        <tr>
            <td>Luas</td>
            <td>:</td>
            <td>{{ $persyaratan->LuasTanahLetterC }} m<sup>2</sup></td>
        </tr>
        <tr>
            <td colspan="3">Akan dibukukan pada daftar hak :</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $pemohon->Nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $pemohon->Alamat }}</td>
        </tr>
        </table>
        </li>
        <li>
            Dalam waktu 60 (enam puluh) hari sejak pengumuman ini, kepada pihak-pihak yang
            berkepentingan terhadap bidang / bidang - bidang tanah yang dimaksud dalam pengumuman ini di beri kesempatan
            untuk mengajukan keberatan-keberatan mengenai pengumuman ini kepada :
            <br>
            Kepala Kantor Pertanahan Kabupaten Sidoarjo Alamat Jl.Jl. Jaksa Agung Raya Suprapto No. 7 Kota Sidoarjo
        </li>
        <li>
            Apabila keberatan-keberatan dimaksud disampaikan lewat jangka waktu tersebut diatas tidak dapat
            dilayani
            <br>
            No. Berkas permohonan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $berkasPermohonan->NIB }}

        </li>
    </ol>
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
