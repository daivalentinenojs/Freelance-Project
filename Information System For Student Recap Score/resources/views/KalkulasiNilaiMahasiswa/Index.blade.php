<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Kalkulasi Nilai Mahasiswa')

@section('Title','Sistem Informasi Rekap Nilai')
@section('Nama','Sistem Informasi Rekap Nilai')

@section('FotoLogin',url('Foto/'.$NPK.'.jpg'))

@section('NRPLogin')
    {{$NPK}}<br>
@endsection

@section('NamaLogin')
    {{$Nama}}<br>
@endsection

@section('Navigasi')
<li class="xn-title">Navigasi</li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Akses Halaman Beranda" ><a href="{{ url('/Beranda')}}"><span class="fa fa-desktop"></span><span class="xn-text">Beranda</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Melihat Informasi Mata Kuliah Buka"><a href="{{ url('/InformasiMataKuliahBuka')}}"><span class="fa fa-info"></span> <span class="xn-text">Informasi Mata Kuliah</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menambah Jenis Nilai"><a href="{{ url('/TambahJenisNilai')}}"><span class="fa fa-file-text-o"></span> <span class="xn-text">Tambah Jenis Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Bobot Nilai"><a href="{{ url('/InformasiBobotNilai')}}"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Ubah Bobot Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghapus Jenis Nilai"><a href="{{ url('/InformasiHapusJenisNilai')}}"><span class="fa fa-eraser"></span> <span class="xn-text">Hapus Jenis Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Memasukkan Nilai Mahasiswa"><a href="{{ url('/InputNilaiMahasiswa')}}"><span class="fa fa-keyboard-o"></span> <span class="xn-text">Input Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Nilai Mahasiswa"><a href="{{ url('/InformasiNilaiMahasiswa')}}"><span class="fa fa-list-alt"></span> <span class="xn-text">Ubah Nilai Mahasiswa</span></a></li>
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Menghitung Nilai Mahasiswa"><a href="{{ url('/InformasiKalkulasiNilaiMahasiswa')}}"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Kalkulasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menverifikasi Nilai Mahasiswa"><a href="{{ url('/InformasiVerifikasiNilaiMahasiswa')}}"><span class="fa fa-check-circle"></span> <span class="xn-text">Verifikasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengunggah Nilai Mahasiswa"><a href="{{ url('/InformasiUnggahNilaiMahasiswa')}}"><span class="fa fa-upload"></span> <span class="xn-text">Unggah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')

<div class="panel-heading">
<h3 class="panel-title">Menghitung Nilai Mahasiswa</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat menghitung nilai akhir mahasiswa berdasarkan mata kuliah dan kelas pararel yang Anda pilih.</p>
    <br>
    @if($CheckSemesterAktif == 0)
    <div class="panel-body" style="padding:0px; text-align:center; font-size:15px;">
    Belum Ada Semester Aktif, Silahkan Hubungi Administrator
    </div>
    @endif
    <br><br>
    @foreach ($errors->all() as $error)
    <p class="alert alert-danger">{{ $error }}</p>
    @endforeach
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>

@if($CheckSemesterAktif == 1)
<!-- Awal Isi Konten -->
<form class="form-horizontal" id="FormKalkulasiNilaiMahasiswa" method="POST" action="{{url('InformasiKalkulasiNilaiMahasiswa')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">

        <!-- Awal Form Proses Input Nilai Mahasiswa -->
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                  <div class="form-group">
                      <label class="col-md-4 control-label">Mata Kuliah Buka</label>
                      <select id="mkBuka" name="namaMataKuliah" class="form-control" style="width: 300px" data-toggle="tooltip" data-placement="right" title="Silahkan Memilih Mata Kuliah">
                          @foreach ($MKBukaDiajars as $MKBukaDiajar)
                              <option value="{{$MKBukaDiajar['KodeMkBuka']}}">{{$MKBukaDiajar['NamaMk']}}</option>
                          @endforeach
                      </select>
                  </div>
                  <input type="hidden" id="KPMk" name="KPMk" value="">
                  <div id="divMkBuka" class="form-group">

                  </div>
                  <div id="divNilaiLengkapMahasiswa" class="form-group">

                  </div>
            </div>
            <div class="col-md-5">
                  <div id="divTotalBobotUTS" class="form-group">

                  </div>
                  <div id="divTotalBobotUAS" class="form-group">

                  </div>
                  <div id="divBobotNTS" class="form-group">
                      <!-- <label class="col-md-4 control-label">Persentase NTS</label> -->
                      <input onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Bobot NTS" step=any required type="hidden" min="1" max="100" value="40" size="30" class="form-control" id="PersentaseNTS" name="PersentaseNTS" style="width:70px; font-weight:bold; border-radius:2px; color:grey;"/>
                  </div>
            </div>
        </div>
        <br>
        <center>
            <div id="divTombolKalkulasi" class="form-group">

            </div>
            <!-- <div id="divTombolKalkulasi" class="form-group">

            </div> -->
        </center>
        <!-- Akhir Form Proses Input Nilai Mahasiswa -->

        <br><br>

        <!-- Awal Tampil Penilaian Koor Dan Pribadi -->
        <div class="row">
            <div class="col-md-7">
              <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Daftar Jenis Penilaian KP Anda">
                  <div class="panel-heading">
                      <h3 class="panel-title">Informasi Penilaian Pribadi KP <span id="SpanGetKPPribadi"></span></h3>
                  </div>
                  <div class="panel-body">
                    <table id="divIndexJenisNilaiPribadi" class="table datatable" width="100%" >
                        <thead>
                            <tr>
                                <th>Jenis</th>
                                <th>Bobot</th>
                                <th>Dosen Pembuat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Jenis</th>
                                <th>Bobot</th>
                                <th>Dosen Pembuat</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                     </table>
                  </div>
              </div>
           </div>
           <div class="col-md-5">
             <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Daftar Mahasiswa KP Anda">
                <div class="panel-heading">
                    <h3 class="panel-title">Informasi Mahasiswa KP <span id="SpanGetKPMhsPribadi"></span></h3>
                </div>
                <div class="panel-body">
                  <table id="divIndexMahasiswaAmbilMK" class="table datatable" width="100%" >
                      <thead>
                          <tr>
                              <th style="width:30%;">NRP</th>
                              <th style="width:50%;">Nama</th>
                              <th>Tahun Terima</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>NRP</th>
                              <th>Nama</th>
                              <th>Tahun Terima</th>
                          </tr>
                      </tfoot>
                   </table>
                </div>
            </div>
          </div>
          <!-- <div class="col-md-5">
              <div id="divIndexMahasiswaAmbilMK" class="form-group">

              </div>
          </div> -->
        </div>
        <!-- Akhir Tampil Penilaian Koor Dan Pribadi -->

        <!-- Awal Hidden Input -->
        <input type="hidden" name="NPKDosen" id="NPKDosen" value="{{$NPK}}">
        <input type="hidden" name="AwalMatKul" id="AwalMatKul" value="{{$Reset}}">
        <!-- <input type="hidden" name="CheckUTS" id="CheckUTS">
        <input type="hidden" name="CheckUAS" id="CheckUAS"> -->
        <input type="hidden" name="kpMkBuka" id="kpMkBuka">
        <input type="hidden" name="KodeKalkulasi" id="KodeKalkulasi">
        <!-- Akhir Hidden Input -->
        <br><br>
    </div>
</form>
<!-- Akhir Isi Konten -->

<script type="text/javascript">

// Untuk deklarasi variabel awal
var NPKDosen;
var kodeMk;
var kpMkBuka;

// Untuk mencegah input huruf, hanya angka dan titik yang boleh
function isNumberKey(evt) // Checked V
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

// Untuk menampilkan kelas pararel tergantung mata kuliah yang dipilih
function DivKelasPararel(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/KalkulasiNilaiIndexTampilKP.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divMkBuka').empty();
        $("#divMkBuka").html(responseText);
        kpMkBuka=$('#kpMkBuka').val();
        $('#KPMk').val(kpMkBuka);
        PanggilFunctionSet();
    }
    });
}

// Untuk menampilkan Total Bobot UTS
function DivTotalBobotUTS(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/KalkulasiNilaiIndexTampilBobotUTS.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divTotalBobotUTS').empty();
        $("#divTotalBobotUTS").html(responseText);
    }
    });
}

// Untuk menampilkan Total Bobot UAS
function DivTotalBobotUAS(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/KalkulasiNilaiIndexTampilBobotUAS.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divTotalBobotUAS').empty();
        $("#divTotalBobotUAS").html(responseText);
    }
    });
}

// Untuk menampilkan semua nilai mahasiswa yang diinputkan
function DivNilaiLengkapMahasiswa(kodeMk, kpMkBuka, NPKDosen) // Checked => Tidak Dipakai V
{
    $.ajax({
    url: "jsscript/KalkulasiNilaiMahasiswaIndexTampilNilaiLengkapMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divNilaiLengkapMahasiswa').empty();
        $("#divNilaiLengkapMahasiswa").html(responseText);
    }
    });
}

// Untuk menampilkan jenis penilaian yang ada pada KP yang diajar
function DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen) // Checked V
{
    var dataTable = $('#divIndexJenisNilaiPribadi').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax":{
        url :"jsscript/JenisNilaiCreateTampilIndexNilaiPribadi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&ketentuanNilai="+ketentuanNilai+"&NPK="+NPKDosen,
        type: "post",  // method  , by default get
    }
    });
    SpanGetKPPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen);
    SpanGetKPMhsPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen);
}

// Untuk menampilkan data mahasiswa yang ada pada MatKul dan KP yang diajar
function DivIndexMahasiswaAmbilMataKuliah(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    var dataTable = $('#divIndexMahasiswaAmbilMK').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax":{
        url : "jsscript/NilaiMahasiswaIndexTampilDaftarMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
        type: "post",  // method  , by default get
    }
    });
}

// Untuk check nilai siap upload atau tidak (Keterangan)
function DivCheckSiapUpload(kodeMk, kpMkBuka) // Checked V
{
    $.ajax({
    url: "jsscript/NilaiMahasiswaIndexHasilKalkulasiCheckSiapUpload.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka,
    context: document.body,
    success: function(responseText) {
        $('#divNilaiLengkapMahasiswa').empty();
        $("#divNilaiLengkapMahasiswa").html(responseText);
    }
    });
}

// Untuk menampilkan tombol Kalkulasi
function DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, Check) // Checked V
{
    $.ajax({
    url: "jsscript/KalkulasiNilaiIndexTampilTombolKalkulasi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen+"&Check="+Check,
    context: document.body,
    success: function(responseText) {
        $('#divTombolKalkulasi').empty();
        $("#divTombolKalkulasi").html(responseText);
    }
    });
}

// Untuk menampilkan span KP Pribadi
function SpanGetKPPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateTampilSpanKPPribadi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&ketentuanNilai="+ketentuanNilai+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#SpanGetKPPribadi').empty();
        $("#SpanGetKPPribadi").html(responseText);
    }
    });
}

// Untuk menampilkan span KP Pribadi
function SpanGetKPMhsPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateTampilSpanKPPribadi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&ketentuanNilai="+ketentuanNilai+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#SpanGetKPMhsPribadi').empty();
        $("#SpanGetKPMhsPribadi").html(responseText);
    }
    });
}

// Untuk check Total Bobot UTS UAS
function CheckTotalBobotUTSUAS(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/KalkulasiNilaiIndexTampilBobotUTSUAS.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        // alert(responseText);
        // if (responseText == 7 || responseText == 13 || responseText == 16 || responseText == 53 || responseText == 56 || responseText == 8 || responseText == 10)
        // {
        // }

        if (responseText == 14 || responseText == 54 || responseText == 9)
        {
            noty({text: "Total Bobot UAS kurang dari 100%", layout: 'topRight', type: 'error'});
        }
        else if (responseText == 23 || responseText == 26)
        {
            noty({text: "Total Bobot UTS kurang dari 100%", layout: 'topRight', type: 'error'});
        }
        else if (responseText == 24)
        {
            noty({text: "Total Bobot UTS dan UAS kurang dari 100%", layout: 'topRight', type: 'error'});
        }

        DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, responseText);

        // Catatan
        // if (responseText == 7)
        // {
        //     // Tidak Ada Notifikasi, Kalkulasi NTS, Kalkulasi NAS, Ulang, Hapus
        // }
        // else if (responseText == 13)
        // {
        //     // Tidak Ada Notifikasi, Ulang, Hapus
        // }
        // else if (responseText == 14)
        // {
        //     // Notifikasi Bobot UAS Kurang 100%, Ulang, Hapus
        // }
        // else if (responseText == 16)
        // {
        //     // Tidak Ada Notifikasi, Kalkulasi NAS, Ulang, Hapus
        // }
        //
        // else if (responseText == 23)
        // {
        //     // Notifikasi Bobot UTS Kurang 100%, Ulang, Hapus
        // }
        // else if (responseText == 24)
        // {
        //     // Notifikasi Bobot UTS Kurang 100%, Notifikasi Bobot UAS Kurang 100%, Ulang, Hapus
        // }
        // else if (responseText == 26)
        // {
        //     // Notifikasi Bobot UTS Kurang 100%, Kalkulasi NAS, Ulang, Hapus
        // }
        //
        // else if (responseText == 53)
        // {
        //     // Tidak Ada Notifikasi, Kalkulasi NTS, Ulang, Hapus
        // }
        // else if (responseText == 54)
        // {
        //     // Notifikasi Bobot UAS Kurang 100%, Kalkulasi NTS, Ulang, Hapus
        // }
        // else if (responseText == 56)
        // {
        //     // Tidak Ada Notifikasi, Kalkulasi NTS, Kalkulasi NAS, Ulang, Hapus
        // }
        //
        // else if (responseText == 8)
        // {
        //     // Tidak Ada Notifikasi, Ulang, Hapus
        // }
        // else if (responseText == 9)
        // {
        //     // Notifikasi Bobot UAS Kurang 100%, Ulang, Hapus
        // }
        // else if (responseText == 10)
        // {
        //     // Tidak Ada Notifikasi, Kalkulasi NAS, Ulang, Hapus
        // }

        // if (responseText == 1 || responseText == 11)
        // {
        //     // $('#CheckUTS').val(2);
        //     // $('#CheckUAS').val(2);
        //     if (responseText == 1)
        //     {
        //         noty({text: "Total Bobot UTS dan UAS kurang dari 100%", layout: 'topRight', type: 'error'});
        //     }
        //     DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 1);
        // }
        // else if (responseText == 2 || responseText == 22)
        // {
        //     // $('#CheckUAS').val(2);
        //     if (responseText == 2)
        //     {
        //         noty({text: "Total Bobot UAS kurang dari 100%", layout: 'topRight', type: 'error'});
        //     }
        //     DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 2);
        // }
        // else if (responseText == 3 || responseText == 33)
        // {
        //     // $('#CheckUTS').val(2);
        //     if (responseText == 3)
        //     {
        //         noty({text: "Total Bobot UTS kurang dari 100%", layout: 'topRight', type: 'error'});
        //     }
        //     DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 3);
        // }
        // else if (responseText == 4 || responseText == 44)
        // {
        //     // $('#CheckUTS').val(1);
        //     // $('#CheckUAS').val(1);
        //     DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 4);
        // }
        // else if (responseText == 5 || responseText == 55)
        // {
        //     if (responseText == 5)
        //     {
        //         noty({text: "Total Bobot UAS kurang dari 100%", layout: 'topRight', type: 'error'});
        //     }
        //     DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 5);
        // }
        // else if (responseText == 6 || responseText == 66)
        // {
        //     // $('#CheckUTS').val(1);
        //     // $('#CheckUAS').val(1);
        //     DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 6);
        // }
    }
    });
}

// Untuk memanggil set function pengaturan form
function PanggilFunctionSet() // Checked V
{
    DivTotalBobotUTS(kodeMk, kpMkBuka, NPKDosen);
    DivTotalBobotUAS(kodeMk, kpMkBuka, NPKDosen);
    DivCheckSiapUpload(kodeMk, kpMkBuka);
    CheckTotalBobotUTSUAS(kodeMk, kpMkBuka, NPKDosen);
    DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, NPKDosen);
    DivIndexMahasiswaAmbilMataKuliah(kodeMk, kpMkBuka, NPKDosen);
}

// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    kodeMk=$('#mkBuka').val();
    kpMkBuka=$('#kpMkBuka').val();
    NPKDosen = $('#NPKDosen').val();
}

// Event Kalkulasi NTS
$(document).on('click', '#KalkulasiUTS', function() // Checked V
{
    alertify.confirm("Apakah Anda Yakin Ingin Menghitung NTS Mahasiswa ?",
    function(){
        $('#KodeKalkulasi').val(1);
        $('#FormKalkulasiNilaiMahasiswa').submit();
        // alertify.success('Proses Menghitung NTS Mahasiswa Telah Berhasil');
    },
    function(){
        // alertify.error('Proses Menghitung NTS Mahasiswa Dibatalkan');
    });
});

// Event Kalkulasi NAS
$(document).on('click', '#KalkulasiUAS', function() // Checked V
{
    alertify.confirm("Apakah Anda Yakin Ingin Menghitung NAS Mahasiswa ?",
    function(){
        $('#KodeKalkulasi').val(2);
        $('#FormKalkulasiNilaiMahasiswa').submit();
        // alertify.success('Proses Menghitung NAS Mahasiswa Telah Berhasil');
    },
    function(){
        // alertify.error('Proses Menghitung NAS Mahasiswa Dibatalkan');
    });
});

// Untuk memberikan hasil penggantian mata kuliah buka
$('#mkBuka').change(function() // Checked V
{
    kpMkBuka=$('#kpMkBuka').val();
    $('#KPMk').val(kpMkBuka);
    DeklarasiVariabel();
    DivKelasPararel(kodeMk, NPKDosen);
});

// Untuk memberikan hasil penggantian kelas pararel mata kuliah buka
$(document).on('change', '#kpMkBuka', function() // Checked V
{
    kpMkBuka=$('#kpMkBuka').val();
    $('#KPMk').val(kpMkBuka);
    DeklarasiVariabel();
    PanggilFunctionSet();
});

// Untuk mengembalikan form dalam keadaan semula (reset)
$(document).on('click', '#UlangInput', function() // Checked V
{
    AwalMatKul = $('#AwalMatKul').val();
    kodeMk = AwalMatKul;
    $('#mkBuka').val(kodeMk);
    DivKelasPararel(kodeMk, NPKDosen);
    PanggilFunctionSet();
});

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    DeklarasiVariabel();
    DivKelasPararel(kodeMk, NPKDosen);
    // CheckTotalBobotUTSUAS(kodeMk, kpMkBuka, NPKDosen);
    // DivTombolKalkulasi(kodeMk, kpMkBuka, NPKDosen, 0);
});
</script>
@endif
@endsection
