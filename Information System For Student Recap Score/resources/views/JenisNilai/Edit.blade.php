<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Mengubah Bobot Nilai')

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
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Bobot Nilai"><a href="{{ url('/InformasiBobotNilai')}}"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Ubah Bobot Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghapus Jenis Nilai"><a href="{{ url('/InformasiHapusJenisNilai')}}"><span class="fa fa-eraser"></span> <span class="xn-text">Hapus Jenis Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Memasukkan Nilai Mahasiswa"><a href="{{ url('/InputNilaiMahasiswa')}}"><span class="fa fa-keyboard-o"></span> <span class="xn-text">Input Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Nilai Mahasiswa"><a href="{{ url('/InformasiNilaiMahasiswa')}}"><span class="fa fa-list-alt"></span> <span class="xn-text">Ubah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghitung Nilai Mahasiswa"><a href="{{ url('/InformasiKalkulasiNilaiMahasiswa')}}"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Kalkulasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menverifikasi Nilai Mahasiswa"><a href="{{ url('/InformasiVerifikasiNilaiMahasiswa')}}"><span class="fa fa-check-circle"></span> <span class="xn-text">Verifikasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengunggah Nilai Mahasiswa"><a href="{{ url('/InformasiUnggahNilaiMahasiswa')}}"><span class="fa fa-upload"></span> <span class="xn-text">Unggah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')

<div class="panel-heading">
<h3 class="panel-title">Mengubah Bobot Jenis Penilaian</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat mengubah bobot jenis penilaian berdasarkan jenis penilaian yang Anda pilih.</p>
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
<form class="form-horizontal" id="UbahBobotJenisNilai" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">
        <!-- Awal Form Proses Index Jenis Nilai -->
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label class="col-md-6 control-label">Mata Kuliah Buka</label>
                  <div class="col-md-4">
                      <div class="input-group">
                          <input type="hidden" size="30" value="{{$InformasiNilai[0]->KodeNilai}}" required class="form-control" id="kodeNilai" name="kodeNilai" style="width:100%; font-weight:bold; border-radius:2px; color:grey;"/>
                          <input type="hidden" readonly size="30" value="{{$InformasiNilai[0]->KodeMk}}" required class="form-control" id="mkBuka" name="kodeMkBuka" style="width:100%; font-weight:bold; border-radius:2px; color:grey;"/>
                          <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Mata Kuliah dari Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->NamaMk}}</strong></label>
                          <input type="hidden" data-toggle="tooltip" data-placement="right" title="Mata Kuliah dari Jenis Nilai yang akan Diubah" readonly size="30" value="{{$InformasiNilai[0]->NamaMk}}" required class="form-control" id="namaMkBuka" name="namaMkBuka" style="width:100%; font-weight:bold; border-radius:2px; color:grey;"/>
                      </div>
                  </div>
              </div>
              <div id = "divKpMkBuka" class="form-group">
                  <label class="col-md-6 control-label">Kelas Pararel</label>
                  <div class="col-md-4">
                      <div class="input-group">
                          <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Kelas Pararel dari Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->KP}}</strong></label>
                          <input type="hidden" data-toggle="tooltip" data-placement="right" title="Kelas Pararel dari Jenis Nilai yang akan Diubah"  readonly size="30" value="{{$InformasiNilai[0]->KP}}" required class="form-control" id="kpMkBuka" name="kpMkBuka" style="width:30%; font-weight:bold; border-radius:2px; color:grey;"/>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-6 control-label">Jenis Nilai</label>
                  <div class="col-md-4">
                      <div class="input-group">
                          <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->Jenis}}</strong></label>
                          <input id = "jenisNilai" data-toggle="tooltip" data-placement="right" title="Jenis Nilai yang akan Diubah"  type="hidden" readonly size="30" value="{{$InformasiNilai[0]->Jenis}}" required class="form-control" name="JenisNilai" style="width:70%; font-weight:bold; border-radius:2px; color:grey;"/>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-6 control-label">Status</label>
                  <div class="col-md-4">
                      <div class="input-group">
                          <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Status dari Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->Status}}</strong></label>
                          <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Status dari Jenis Nilai yang akan Diubah"  value="{{$InformasiNilai[0]->Status}}" required class="form-control" name="status" style="width:100px; font-weight:bold; border-radius:2px; color:grey;"/>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6">
            <div id="ClassCheckErrorBobotBaru" class="form-group">
                <label class="col-md-6 control-label">Bobot Baru</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input id = "bobotSebelumUbah" type="hidden" value="{{$InformasiNilai[0]->Bobot}}" step=any required min="1" max "100" size="5" style="width:50%; border-radius:3px;" name="bobotNilai" class="form-control"/>
                        <input id = "bobotNilai" value="0" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Bobot Baru"  onkeypress="return isNumberKey(event)" name="bobotNilai" type="number" step=any required min="1" max "100" size="15" style="width:100%; border-radius:3px;" name="bobotNilai" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6 control-label">Bobot Lama</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Bobot Lama dari Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->Bobot}} %</strong></label>
                        <input id = "TampilBobotLama" type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Bobot Lama dari Jenis Nilai yang akan Diubah"  value="{{$InformasiNilai[0]->Bobot}}" required class="form-control" name="TampilBobotLama" style="width:38%; font-weight:bold; border-radius:2px; color:grey;"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6 control-label">Waktu Buat</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Bobot Lama dari Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->WaktuBuat}}</strong></label>
                        <input type="hidden" readonly size="30" value="{{$InformasiNilai[0]->WaktuBuat}}" required data-toggle="tooltip" data-placement="right" title="Waktu Buat dari Jenis Nilai yang akan Diubah"  class="form-control" name="waktuBuat" style="width:135px; font-weight:bold; border-radius:2px; color:grey;"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6 control-label">Dosen Pembuat</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Bobot Lama dari Jenis Nilai yang akan Diubah"><strong>{{$InformasiNilai[0]->NamaDosen}}</strong></label>
                        <input type="hidden" readonly size="30" value="{{$InformasiNilai[0]->DosenPembuat}}" required class="form-control" name="dosenPembuat" style="width:70px; font-weight:bold; border-radius:2px; color:grey;"/>
                        <input type="hidden" readonly size="30" value="{{$InformasiNilai[0]->NamaDosen}}" required data-toggle="tooltip" data-placement="right" title="Dosen Pembuat dari Jenis Nilai yang akan Diubah"  class="form-control" name="namaDosen" style="width:190px; font-weight:bold; border-radius:2px; color:grey;"/>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <br><br>
        <center>
            <input type="button" id="UbahNilai" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Mengubah Bobot Jenis Nilai"  value="Ubah" style="margin-right:10px;" class="btn btn-warning">
            <input type="reset" value="Ulang" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Mengulang Halaman" style="margin-right:10px;" class="btn btn-primary">
            <input type="button" id="HapusNotifikasi"  onClick="$.noty.closeAll();" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Menghapus Notifikasi" value="Hapus Notifikasi" style="margin-right:10px;" class="btn btn-default"/>
        </center>
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
        </div>
        <!-- Akhir Tampil Penilaian Koor Dan Pribadi -->

        <input type="hidden" name="NPKDosen" id="NPKDosen" value="{{$NPK}}">
        <input type="hidden" name="TotalDBDanInput" id="TotalDBDanInput" value="0">
        <input type="hidden" name="CheckSemuaKP" id="CheckSemuaKP">
        <br>
    </div>
</form>
<!-- Akhir Isi Konten -->

<script type="text/javascript">

// Untuk deklarasi variabel awal V
var NPKDosen;
var kodeMk;
var kpMkBuka;
var TotalDBDanInput;
var CheckSemuaKP;
var namaMk;
var jenisNilai;
var bobotNilai;
var bobotSebelumUbah;

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

// Untuk menampilkan checkbox (Koordinator) atau combobox KP (Bukan Koordinator) => Tidak jadi dipakai
function DivKetentuanNilai(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "../../jsscript/JenisNilaiEditCheckKordinator.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divKetentuanNilai').empty();
        $("#divKetentuanNilai").html(responseText);
    }
    });
}

// Untuk menampilkan jenis penilaian yang ada pada KP yang diajar
function DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    var dataTable = $('#divIndexJenisNilaiPribadi').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax":{
        url :"../../jsscript/JenisNilaiEditTampilIndexNilaiPribadiTanpaAksi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
        type: "post",  // method  , by default get
    }
    });
    SpanGetKPPribadi(kodeMk, kpMkBuka, 1, NPKDosen);
}

// Untuk menampilkan jenis penilaian yang ada pada KP yang koordinator (Yang telah dibuat koordinator)
function DivIndexJenisNilaiKoordinator(kodeMk) // Checked V
{
    var dataTable = $('#divIndexJenisNilaiKoor').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "ajax":{
        url :"../../jsscript/JenisNilaiCreateTampilIndexNilaiKoor.php?kodeMkBuka="+kodeMk, // json datasource
        type: "post",  // method  , by default get
    }
    });
}

// Untuk menampilkan span KP Pribadi
function SpanGetKPPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen) // Checked V
{
    $.ajax({
    url: "../../jsscript/JenisNilaiEditTampilSpanKPPribadi.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
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
    url:"../../jsscript/JenisNilaiCreateTampilSpanKPKoordinator.php?kodeMkBuka="+kodeMk,
    context: document.body,
    success: function(responseText) {
        $('#SpanGetKPKoordinator').empty();
        $("#SpanGetKPKoordinator").html(responseText);
    }
    });
}

// Untuk check apakah jumlah bobot yang diinputkan benar (dapat diinputkan dengan maximal total 100%) atau tidak
function CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, bobotSebelumUbah, NPKDosen) // Checked V
{
    $.ajax({
    url: "../../jsscript/JenisNilaiEditCheckUbahBobot.php?kodeMkBuka="+kodeMk+"&ketentuanNilai="+ketentuanNilaiBobot+"&jenisNilai="+jenisNilai+"&bobotNilai="+bobotNilai+"&kpMkBuka="+kpMkBuka+"&bobotSebelumUbah="+bobotSebelumUbah+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        if (responseText == "1")
        {
            noty({text: "Jumlah bobot penilaian dari Mata Kuliah "+namaMk+" untuk penilaian "+jenisNilai+" tidak boleh lebih dari 100% !", layout: 'topRight', type: 'error'});
            document.getElementById("ClassCheckErrorBobotBaru").className = "form-group has-error has-feedback";
            $("#TotalDBDanInput").val(1000);
        }
        else
        {
            document.getElementById("ClassCheckErrorBobotBaru").className = "form-group has-success has-feedback";
            $("#TotalDBDanInput").val(0);
        }
    }
    });
}

// Untuk check apakah jumlah bobot yang diinputkan benar (dapat diinputkan dengan maximal total 100%) atau tidak => Tidak jadi dipakai
// function CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen) // Checked V
// {
//     $.ajax({
//     url: "../../jsscript/JenisNilaiEditCheckJumlahBobotSemuaKP.php?kodeMkBuka="+kodeMk+"&ketentuanNilai="+ketentuanNilaiBobot+"&jenisNilai="+jenisNilai+"&bobotNilai="+bobotNilai+"&kpMkBuka="+kpMkBuka+"&bobotSebelumUbah="+bobotSebelumUbah+"&NPK="+{{$NPK}},
//     context: document.body,
//     success: function(responseText) {
//         if (responseText == "1") {
//             alert("Salah satu kelas pararel dari dari Mata Kuliah "+namaMk+" mempunyai jumlah bobot penilaian lebih dari 100% !");
//             $("#CheckSemuaKP").val(5);
//         } else {
//             $("#CheckSemuaKP").val(0);
//         }
//     }
//     });
// }

// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    kodeMk=$('#mkBuka').val();
    kpMkBuka=$('#kpMkBuka').val();
    $("#TotalDBDanInput").val(0);
    ketentuan = 0;
}

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    DeklarasiVariabel();
    DivIndexJenisNilaiKoordinator(kodeMk);
    DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, NPKDosen);
    SpanGetKPKoordinator(kodeMk);
    SpanGetKPPribadi(kodeMk, kpMkBuka, 1, NPKDosen);
    docunment.getElementById("ClassCheckErrorBobotBaru").className = "form-group";
    // DivKetentuanNilai(kodeMk, NPKDosen);
});

// Event Ubah Bobot Nilai
$('#UbahNilai').on('click', function() // Checked V
{
    bobotNilai=$('#bobotNilai').val();
    namaMk=$('#namaMkBuka').val();
    jenisNilai=$('#jenisNilai').val();
    if (bobotNilai != 0)
    {
      alertify.confirm("Apakah Anda Yakin Ingin Mengubah Bobot Nilai {{$InformasiNilai[0]->Jenis}} Mata Kuliah {{$InformasiNilai[0]->NamaMk}} KP "+kpMkBuka+" ?",
      function(){
          $('#UbahBobotJenisNilai').submit();
          alertify.success('Bobot Jenis Nilai {{$InformasiNilai[0]->Jenis}} Mata Kuliah {{$InformasiNilai[0]->NamaMk}} KP '+kpMkBuka+' Telah Diubah');
      },
      function(){
          alertify.error('Proses Ubah Bobot Jenis Nilai Dibatalkan');
      });
    }
    else
    {
        noty({text: "Jumlah bobot penilaian baru dari Mata Kuliah "+namaMk+" untuk penilaian "+jenisNilai+" tidak boleh kurang dari 1% !", layout: 'topRight', type: 'error'});
    }
});


// Untuk memberikan hasil penggantian combo box ketentuan nilai untuk semua KP
// Tambahlan event check jumlah bobot dicentang atau tidak !! => Tidak jadi dipakai
/*$(document).on('change', '#ketentuanNilai', function() // Checked V
{
    if(!(this.checked)) {
      ketentuan = 0;
      $('#divKpMkBuka').show();
    } else {
      ketentuan = 1;
      $('#divKpMkBuka').hide();
    }
});*/

// Untuk memberikan hasil pengechekan dari input nilai pada kolom bobot
// Tambahkan pengecheckan semua KP, ambil yang paling banyak !! => Tidak jadi dipakai
$(document).on('input', '#bobotNilai', function() // Checked V
{
    DeklarasiVariabel();
    namaMk=$('#namaMkBuka').val();
    jenisNilai=$('#jenisNilai').val();
    bobotNilai=$('#bobotNilai').val();
    bobotSebelumUbah=$('#bobotSebelumUbah').val();
    TotalDBDanInput=$('#TotalDBDanInput').val();
    ketentuanNilaiBobot = ketentuan;

    /*if(ketentuanNilaiBobot == 0) {*/ // Jika Tidak Dicentang, Bukan Koordinator
    CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, bobotSebelumUbah, NPKDosen);
    /*} else { // Jika Dicentang, Get KP Semua
     CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
    }*/
});

</script>
@endif
@endsection
