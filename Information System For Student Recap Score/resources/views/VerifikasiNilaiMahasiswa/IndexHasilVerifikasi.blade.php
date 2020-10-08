<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Verifikasi Nilai Mahasiswa')

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
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghitung Nilai Mahasiswa"><a href="{{ url('/InformasiKalkulasiNilaiMahasiswa')}}"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Kalkulasi Nilai Mahasiswa</span></a></li>
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Menverifikasi Nilai Mahasiswa"><a href="{{ url('/InformasiVerifikasiNilaiMahasiswa')}}"><span class="fa fa-check-circle"></span> <span class="xn-text">Verifikasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengunggah Nilai Mahasiswa"><a href="{{ url('/InformasiUnggahNilaiMahasiswa')}}"><span class="fa fa-upload"></span> <span class="xn-text">Unggah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')

<div class="panel-heading">
<h3 class="panel-title">Menverifikasi Nilai Mahasiswa</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat menverifikasi nilai akhir mahasiswa berdasarkan mata kuliah dan kelas pararel yang Anda pilih.</p>
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
<form class="form-horizontal" id="FormVerifikasi" method="POST" action="{{url('VerifikasiNilaiMahasiswa')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">

    <!-- Awal Form Proses Verifikasi Nilai Mahasiswa -->
    <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-md-6 control-label">Mata Kuliah Buka</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <input type="hidden" id="KodeMk" name="KodeMk" value="{{$KodeMk}}">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Mata Kuliah yang Akan Diverifikasi"><strong>{{$NamaMk}}</strong></label>
                              <input id = "NamaMk" data-toggle="tooltip" data-placement="right" title="Mata Kuliah yang Akan Diverifikasi" type="hidden" readonly size="30" value="{{$NamaMk}}" required class="form-control" name="NamaMk" style="width:250px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-6 control-label">Kelas Pararel</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Kelas Pararel Mata Kuliah yang Akan Diverifikasi"><strong>{{$KP}}</strong></label>
                              <input id = "KPMkBuka" type="hidden" data-toggle="tooltip" data-placement="right" title="Kelas Pararel Mata Kuliah yang Akan Diverifikasi"  readonly size="30" value="{{$KP}}" required class="form-control" name="KPMkBuka" style="width:50px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
          </div>
    </div>
    <br><br>
    <!-- Akhir Form Proses Verifikasi Nilai Mahasiswa -->

    <!-- Awal Tampil Nilai Lengkap Mahasiswa -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Daftar Detail Nilai Mahasiswa">
                <div class="panel-heading">
                    <h3 class="panel-title">Informasi Nilai Mahasiswa Mata Kuliah {{$NamaMk}} KP {{$KP}}</h3>
                </div>
                <div class="panel-body">
                  <table id="divNilaiLengkapMahasiswa" class="table datatable" width="100%" >
                      <thead>
                          <tr>
                              <th style="width:5%"></th>
                              <th style="width:17%">NRP</th>
                              <th>Nama</th>

                              @if ($KodeVerifikasi == 1)
                                    <th style="width:26%">NTS</th>
                              @else
                                    <th style="width:26%">NAS</th>
                              @endif

                              <th style="width:26%">Kode Nisbi</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th></th>
                              <th>NRP</th>
                              <th>Nama</th>

                              @if ($KodeVerifikasi == 1)
                                    <th style="width:26%">NTS</th>
                              @else
                                    <th style="width:26%">NAS</th>
                              @endif

                              <th>Kode Nisbi</th>
                          </tr>
                      </tfoot>
                   </table>
                </div>
            </div>
         </div>
          <!-- <div class="col-md-12">
              <div id="divNilaiLengkapMahasiswa" class="form-group">

              </div>
          </div> -->
    </div>
    <!-- Akhir Tampil Nilai Lengkap Mahasiswa -->
        <br><br>
        <center>
            <div id="divTombolVerifikasi" class="form-group">
                <input type='button' id="VerifikasiNilai" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Menverifikasi Nilai" value='Verifikasi' style='margin-right:10px;' class='btn btn-success'>
            </div>
        </center>
        <!-- Awal Hidden Input -->
        <input type="hidden" id="NPKDosen" name="NPKDosen" value="{{$NPK}}">
        <input type="hidden" id="KodeVerifikasi" name="KodeVerifikasi" value="{{$KodeVerifikasi}}">
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
var dataTable;
var KodeVerifikasi;

// Untuk menampilkan semua nilai mahasiswa yang diinputkan
function DivNilaiLengkapMahasiswa(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    // $.ajax({
    // url: "jsscript/NilaiMahasiswaIndexHasilKalkulasiNilaiMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen+"&PersentaseNTS="+PersentaseNTS,
    // context: document.body,
    // success: function(responseText) {
    //     $('#divNilaiLengkapMahasiswa').empty();
    //     $("#divNilaiLengkapMahasiswa").html(responseText);
    // }
    // });
    KodeVerifikasi = $("#KodeVerifikasi").val();
    dataTable = $('#divNilaiLengkapMahasiswa').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax":{
        url : "jsscript/VerifikasiNilaiMahasiswaIndexHasilVerifikasiNilaiMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen+"&KodeVerifikasi="+KodeVerifikasi,
        type: "post",  // method  , by default get
    },
    "columns":[
    {
      "className":'details-control',
      "orderable":false,
      "data":null,
      "defaultContent":''
    },
    {"data":0},
    {"data":1},
    {"data":2},
    {"data":6}
    ],
    "order":[[1, 'asc']]
    });
}

// Event Verifikasi Nilai
$('#VerifikasiNilai').on('click', function() // Checked V
{
    alertify.confirm("Apakah Anda Yakin Ingin Menverifikasi Nilai Mahasiswa Mata Kuliah {{$NamaMk}} KP {{$KP}} ?",
    function(){
        $('#FormVerifikasi').submit();
        alertify.success('Nilai Mahasiswa Mata Kuliah {{$NamaMk}} KP {{$KP}} Telah Diverifikasi');
    },
    function(){
        alertify.error('Proses Verifikasi Dibatalkan');
    });
});

$(document).on('click', '#divNilaiLengkapMahasiswa tbody tr td.details-control', function() // Checked V
{
    var tr = $(this).closest('tr');
    var row = dataTable.row(tr);
    var datarow = (dataTable.row(tr).data());
    KodeVerifikasi = $("#KodeVerifikasi").val();
    kpMkBuka = $('#KPMkBuka').val();
    // alert(datarow);

    if (row.child.isShown())
    {
      row.child.hide();
      tr.removeClass('shown');
    }
    else
    {
      // KodeBantuan = row.data();
      // alert("1"+KodeBantuan);
      // row.child(format(KodeBantuan)).show();
      //console.log(datarow);
      // Open this row
      //format(row.child, datarow);
      // tr.addClass('shown');
      //   alert(datarow);

      $.ajax({
      url: "jsscript/VerifikasiNilaiMahasiswaTampilDetailNilai.php?KodeSubString="+datarow+"&KodeMkBuka="+kodeMk+"&KPMkBuka="+kpMkBuka+"&KodeVerifikasi="+KodeVerifikasi,
      context: document.body,
      success: function(responseText) {
          // alert(responseText);
          row.child(responseText).show();
          tr.addClass('shown');
      }
      });
    }
});

// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    kodeMk = $('#KodeMk').val();
    kpMkBuka = $('#KPMkBuka').val();
    NPKDosen = $('#NPKDosen').val();
    KodeVerifikasi = $('#KodeVerifikasi').val();
}

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    DeklarasiVariabel();
    DivNilaiLengkapMahasiswa(kodeMk, kpMkBuka, NPKDosen);
});
</script>
@endif
@endsection
