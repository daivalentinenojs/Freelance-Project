<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Menghapus Jenis Nilai')

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
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Menghapus Jenis Nilai"><a href="{{ url('/InformasiHapusJenisNilai')}}"><span class="fa fa-eraser"></span> <span class="xn-text">Hapus Jenis Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Memasukkan Nilai Mahasiswa"><a href="{{ url('/InputNilaiMahasiswa')}}"><span class="fa fa-keyboard-o"></span> <span class="xn-text">Input Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Nilai Mahasiswa"><a href="{{ url('/InformasiNilaiMahasiswa')}}"><span class="fa fa-list-alt"></span> <span class="xn-text">Ubah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghitung Nilai Mahasiswa"><a href="{{ url('/InformasiKalkulasiNilaiMahasiswa')}}"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Kalkulasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menverifikasi Nilai Mahasiswa"><a href="{{ url('/InformasiVerifikasiNilaiMahasiswa')}}"><span class="fa fa-check-circle"></span> <span class="xn-text">Verifikasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengunggah Nilai Mahasiswa"><a href="{{ url('/InformasiUnggahNilaiMahasiswa')}}"><span class="fa fa-upload"></span> <span class="xn-text">Unggah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')

<div class="panel-heading">
<h3 class="panel-title">Menyaring Jenis Penilaian</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat menyaring jenis penilaian untuk dihapus berdasarkan mata kuliah dan kelas pararel yang Anda pilih.</p>
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
<form class="form-horizontal" method="POST" action="{{url('TambahJenisNilai')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">
        <!-- Awal Form Proses Index Jenis Nilai -->
        <div class="row">
          <div class="col-md-3">

          </div>
          <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3 control-label">Mata Kuliah Buka</label>
                    <select id="mkBuka" name="namaMataKuliah" class="form-control" style="width: 70%" data-toggle="tooltip" data-placement="right" title="Silahkan Memilih Mata Kuliah">
                        @foreach ($MKBukaDiajars as $MKBukaDiajar)
                            <option value="{{$MKBukaDiajar['KodeMkBuka']}}">{{$MKBukaDiajar['NamaMk']}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="divMkBuka" class="form-group">

                </div>
                <div id="divKeterangan" class="form-group">

                </div>
                <center>
                    <input type="reset" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Mengulang Halaman" value="Ulang" id="UlangInput" style="margin-right:10px;" class="btn btn-primary">
                </center>
          </div>
      </div>
      <!-- Akhir Form Proses Index Jenis Nilai -->

      <br><br>

      <!-- Awal Tampil Penilaian Koor Dan Pribadi -->
      <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Daftar Jenis Penilaian KP Koordinator">
                <div class="panel-heading">
                    <h3 class="panel-title">Informasi Penilaian Koordinator KP <span id="SpanGetKPKoordinator"></span></h3>
                </div>
                <div class="panel-body">
                  <table id="divIndexJenisNilaiKoor" class="table datatable" width="100%" >
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
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>Jenis</th>
                              <th>Bobot</th>
                              <th>Dosen Pembuat</th>
                              <th>Status</th>
                              <th>Aksi</th>
                          </tr>
                      </tfoot>
                   </table>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div id="divIndexJenisNilaiPribadi" class="form-group">

            </div>
        </div> -->
      </div>
      <!-- Akhir Tampil Penilaian Koor Dan Pribadi -->

      <!-- Awal Hidden Input -->
      <input type="hidden" name="NPKDosen" id="NPKDosen" value="{{$NPK}}">
      <input type="hidden" name="AwalMatKul" id="AwalMatKul" value="{{$Reset}}">
      <!-- Akhir Hidden Input -->
      <br>
  </div>
</form>
<!-- Akhir Isi Konten -->

<script type="text/javascript">

// Untuk deklarasi variabel awal
var NPKDosen;
var kodeMk;
var kpMkBuka;

// Untuk menampilkan kelas pararel (tergantung mata kuliah yang dipilih)
function DivKelasPararel(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiIndexTampilKP.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divMkBuka').empty();
        $("#divMkBuka").html(responseText);
        kpMkBuka=$('#kpMkBuka').val();
        DivIndexJenisNilaiPribadi(kodeMk, NPKDosen);
        DivKeterangan(kodeMk, kpMkBuka, NPKDosen);
    }
    });
}

// Untuk menampilkan keterangan
function DivKeterangan(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiHapusTampilKeterangan.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divKeterangan').empty();
        $("#divKeterangan").html(responseText);
    }
    });
}

// Untuk menampilkan jenis penilaian yang ada pada KP yang koordinator (Yang telah dibuat koordinator)
function DivIndexJenisNilaiKoordinator(kodeMk) // Checked V
{
    var dataTable = $('#divIndexJenisNilaiKoor').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax":{
        url :"jsscript/JenisNilaiCreateTampilIndexNilaiKoor.php?kodeMkBuka="+kodeMk, // json datasource
        type: "post",  // method  , by default get
    }
    });
}

// Untuk menampilkan jenis penilaian yang ada pada KP yang diajar
function DivIndexJenisNilaiPribadi(kodeMk, NPKDosen) // Checked V
{
    var dataTable = $('#divIndexJenisNilaiPribadi').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollY": 200,
      "scrollX": true,
      "ajax":{
        url : "jsscript/JenisNilaiEditTampilIndexNilaiPribadi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
        type: "post",  // method  , by default get
    },
    "columns":[
        {"data":0},
        {"data":1},
        {"data":2},
        {"data":3},
        {"data": 4,
            "render" : function ( data, type, full, meta ) {
              return '<a data-toggle=\'tooltip\' class=\'btn btn-danger\' data-placement=\'top\' title=\'Klik untuk Menghapus Jenis Nilai\' href=HapusJenisNilai/'+data+'/edit>Hapus</a>';
            }
        }
      ],
      "order":[[0, 'asc']]
    });
    SpanGetKPPribadi(kodeMk, kpMkBuka, NPKDosen);
}

// Untuk menampilkan span KP Pribadi
function SpanGetKPPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiEditTampilSpanKPPribadi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#SpanGetKPPribadi').empty();
        $("#SpanGetKPPribadi").html(responseText);
    }
    });
}

// Untuk menampilkan span KP Koordinator
function SpanGetKPKoordinator(kodeMk) // Checked V
{
    $.ajax({
    url:"jsscript/JenisNilaiCreateTampilSpanKPKoordinator.php?kodeMkBuka="+kodeMk,
    context: document.body,
    success: function(responseText) {
        $('#SpanGetKPKoordinator').empty();
        $("#SpanGetKPKoordinator").html(responseText);
    }
    });
}

// Untuk memanggil set function pengaturan form (koordinator atau bukan koordinator)
function PanggilFunctionSet() // Checked V
{
    DeklarasiVariabel();
    DivKelasPararel(kodeMk, NPKDosen);
    DivIndexJenisNilaiKoordinator(kodeMk);
    SpanGetKPKoordinator(kodeMk);
}

// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    kodeMk = $('#mkBuka').val();
    kpMkBuka = $('#kpMkBuka').val();
    NPKDosen = $('#NPKDosen').val();
}

// Untuk mengembalikan form dalam keadaan semula (reset)
$(document).on('click', '#UlangInput', function() // Checked V
{
    AwalMatKul = $('#AwalMatKul').val();
    kodeMk = AwalMatKul;
    $('#mkBuka').val(kodeMk);
    DivKelasPararel(kodeMk, NPKDosen);
    DivKeterangan(kodeMk, kpMkBuka, NPKDosen)
    DivIndexJenisNilaiKoordinator(kodeMk);
});

// Untuk memberikan hasil penggantian mata kuliah buka
$('#mkBuka').change(function() // Checked V
{
    PanggilFunctionSet();
});

// Untuk memberikan hasil penggantian kelas pararel mata kuliah buka
$(document).on('change', '#kpMkBuka', function() // Checked V
{
    DeklarasiVariabel();
    DivIndexJenisNilaiPribadi(kodeMk, NPKDosen);
    DivKeterangan(kodeMk, kpMkBuka, NPKDosen)
    DivIndexJenisNilaiKoordinator(kodeMk);
});

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    PanggilFunctionSet();
});
</script>
@endif
@endsection
