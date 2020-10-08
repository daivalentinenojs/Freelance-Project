<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Input Nilai Mahasiswa')

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
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Memasukkan Nilai Mahasiswa"><a href="{{ url('/InputNilaiMahasiswa')}}"><span class="fa fa-keyboard-o"></span> <span class="xn-text">Input Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Nilai Mahasiswa"><a href="{{ url('/InformasiNilaiMahasiswa')}}"><span class="fa fa-list-alt"></span> <span class="xn-text">Ubah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghitung Nilai Mahasiswa"><a href="{{ url('/InformasiKalkulasiNilaiMahasiswa')}}"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Kalkulasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menverifikasi Nilai Mahasiswa"><a href="{{ url('/InformasiVerifikasiNilaiMahasiswa')}}"><span class="fa fa-check-circle"></span> <span class="xn-text">Verifikasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengunggah Nilai Mahasiswa"><a href="{{ url('/InformasiUnggahNilaiMahasiswa')}}"><span class="fa fa-upload"></span> <span class="xn-text">Unggah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')

<div class="panel-heading">
<h3 class="panel-title">Memasukkan Nilai Mahasiswa</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat menyaring jenis penilaian berdasarkan mata kuliah dan kelas pararel yang Anda pilih.</p>
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
<form class="form-horizontal" method="POST" action="{{url('InputNilaiMahasiswa')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">

        <!-- Awal Form Proses Input Nilai Mahasiswa -->
        <div class="row">
          <div class="col-md-3">

          </div>
          <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3 control-label">Mata Kuliah Buka</label>
                    <select id="mkBuka" name="namaMataKuliah" class="form-control" style="width: 75%;" data-toggle="tooltip" data-placement="right" title="Silahkan Memilih Mata Kuliah">
                        @foreach ($MKBukaDiajars as $MKBukaDiajar)
                            <option value="{{$MKBukaDiajar['KodeMkBuka']}}">{{$MKBukaDiajar['NamaMk']}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="KPMk" name="KPMk" value="">
                <div id="divMkBuka" class="form-group">

                </div>
                <div id="divJenisNilai" class="form-group">

                </div>
                <div id="divKeterangan" class="form-group">

                </div>
                <br>

                <center>
                    <!-- <div class="pull-right" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Unduh Tabel Nilai Mahasiswa'>
                    <button class="btn btn-info toggle" id="AndroidTesseract"><i class="fa fa-bars"></i> Tesseract</button>
                    </div> -->
                    <!-- <input type='button' value='Masukkan Nilai dengan Camera' style='margin-right:10px;' class='btn btn-warning' id='AndroidTesseract'> -->

                    <div id="divTombolInput" class="form-group">

                    </div>
                </center>
          </div>
        </div>
        <!-- Akhir Form Proses Input Nilai Mahasiswa -->

        <br><br>

        <!-- Awal Tampil Penilaian Koor Dan Pribadi -->
        <div class="row">
            <div class="col-md-6">
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
           <div class="col-md-6">
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
        <input type="hidden" id="NPKDosen" name="NPKDosen" value="{{$NPK}}">
        <input type="hidden" name="AwalMatKul" id="AwalMatKul" value="{{$Reset}}">
        <input type="hidden" name="kpMkBuka" id="kpMkBuka">
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
var kodeNilai;

// Untuk menampilkan jenis penilaian yang ada pada Mata Kuliah dan KP yang dipilih
function DivJenisNilai(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/NilaiMahasiswaIndexTampilComboBoxJenisNilai.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divJenisNilai').empty();
        $("#divJenisNilai").html(responseText);
        DeklarasiVariabel();
        DivTombolInput(kodeMk, kpMkBuka, NPKDosen, kodeNilai);
        DivKeterangan(kodeMk, kpMkBuka, NPKDosen, kodeNilai);
    }
    });
}

// Untuk menampilkan keterangan yang ada pada Mata Kuliah dan KP yang dipilih
function DivKeterangan(kodeMk, kpMkBuka, NPKDosen, kodeNilai) // Checked V
{
    // alert(kodeNilai);
    $.ajax({
    url: "jsscript/NilaiMahasiswaIndexTampilKeterangan.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen+"&kodeNilai="+kodeNilai,
    context: document.body,
    success: function(responseText) {
        $('#divKeterangan').empty();
        $("#divKeterangan").html(responseText);
    }
    });
}

// Untuk menampilkan tombol input yang ada pada Mata Kuliah dan KP yang dipilih
function DivTombolInput(kodeMk, kpMkBuka, NPKDosen, kodeNilai) // Checked V
{
    // alert(kodeNilai);
    $.ajax({
    url: "jsscript/NilaiMahasiswaIndexTampilTombolInput.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen+"&kodeNilai="+kodeNilai,
    context: document.body,
    success: function(responseText) {
        $('#divTombolInput').empty();
        $("#divTombolInput").html(responseText);

        $('#AndroidTesseract').on('click', function() // Checked V
        {
            Android.moveToNextScreen();
        });
    }
    });
}

// Untuk menampilkan kelas pararel tergantung mata kuliah yang dipilih
function DivKelasPararel(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiIndexTampilKP.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
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

// Untuk memanggil set function pengaturan form
function PanggilFunctionSet() // Checked V
{
    DivJenisNilai(kodeMk, kpMkBuka, NPKDosen);
    // DivTombolInput(kodeMk, kpMkBuka, NPKDosen, kodeNilai);
    DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, NPKDosen);
    DivIndexMahasiswaAmbilMataKuliah(kodeMk, kpMkBuka, NPKDosen);
}

// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    kodeMk=$('#mkBuka').val();
    kpMkBuka=$('#kpMkBuka').val();
    NPKDosen = $('#NPKDosen').val();
    kodeNilai = $('#jenisNilai').val();
}

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

// Untuk memberikan hasil jenis nilai
$(document).on('change', '#jenisNilai', function() // Checked V
{
    kpMkBuka=$('#kpMkBuka').val();
    $('#KPMk').val(kpMkBuka);
    DeklarasiVariabel();
    DivTombolInput(kodeMk, kpMkBuka, NPKDosen, kodeNilai);
    DivKeterangan(kodeMk, kpMkBuka, NPKDosen, kodeNilai);
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
});
</script>
@endif
@endsection
