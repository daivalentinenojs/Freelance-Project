<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Menambah Jenis Penilaian')

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
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Menambah Jenis Nilai"><a href="{{ url('/TambahJenisNilai')}}"><span class="fa fa-file-text-o"></span> <span class="xn-text">Tambah Jenis Nilai</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Bobot Nilai"><a href="{{ url('/InformasiBobotNilai')}}"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Ubah Bobot Nilai</span></a></li>
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
<h3 class="panel-title">Menambah Jenis Penilaian</h3>
</div>

<div class="panel-body" id="statusBenarSalah">
    <p>Pada halaman ini Anda dapat menambah jenis penilaian berdasarkan mata kuliah yang Anda Ampu.</p>
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
<form class="form-horizontal" method="POST" id="TambahJenisNilai" action="{{url('TambahJenisNilai')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">
        <div class="row">
          <div class="col-md-3"></div>

          <!-- Awal Form Proses Input Jenis Nilai -->
          <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3 control-label">Mata Kuliah Buka</label>
                    <select id="mkBuka" name="namaMataKuliah" class="form-control" style="width:70%;" data-toggle="tooltip" data-placement="right" title="Silahkan Memilih Mata Kuliah">
                        @foreach ($MKBukaDiajars as $MKBukaDiajar)
                            <option value="{{$MKBukaDiajar['KodeMkBuka']}}">{{$MKBukaDiajar['NamaMk']}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="divKetentuanNilai" class="form-group">

                </div>
                <div id="divMkBuka" class="form-group">

                </div>
                <div id="divJenisNilai" class="form-group">

                </div>
                <div id="divBobot" class="form-group">

                </div>
                <center>
                    <input type="button" id="InputNilai" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Menambah Jenis Nilai" value="Simpan" style="margin-right:10px;" class="btn btn-success">
                    <input type="reset" id="UlangInput"  data-toggle="tooltip" data-placement="bottom" title="Klik untuk Mengulang Halaman" value="Ulang" style="margin-right:10px;" class="btn btn-primary">
                    <input type="button" id="HapusNotifikasi"  onClick="$.noty.closeAll();" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Menghapus Notifikasi" value="Hapus Notifikasi" style="margin-right:10px; margin-top:5px;" class="btn btn-default">
                </center>
          </div>
        </div>
        <!-- Akhir Form Proses Input Jenis Nilai -->

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

        <!-- Awal Hidden Input -->
        <input type="hidden" name="NPKDosen" id="NPKDosen" value="{{$NPK}}">
        <input type="hidden" name="AwalMatKul" id="AwalMatKul" value="{{$Reset}}">
        <input type="hidden" name="kpMkBukas" id="kpMkBukas">
        <input type="hidden" name="TotalDBDanInput" id="TotalDBDanInput" value="0">
        <input type="hidden" name="CheckPenilaianAda" id="CheckPenilaianAda">
        <input type="hidden" name="CheckSemuaKP" id="CheckSemuaKP">
        <input type="hidden" name="CheckSemuaKPBisaDitambah" id="CheckSemuaKPBisaDitambah" value="1">
        <input type="hidden" name="CheckSemuaKPUTSUAS" id="CheckSemuaKPUTSUAS" value="1">
        <input type="hidden" name="CheckNilaiKoorBukanKoor" id="CheckNilaiKoorBukanKoor">
        <input type="hidden" name="CheckBobotNol" id="CheckBobotNol">
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
var CheckSemuaKPBisaDitambah;
var CheckSemuaKPUTSUAS;
var CheckDB;
var tempkodeMk;

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

// Untuk menampilkan checkbox (Koordinator) atau combobox KP (Bukan Koordinator)
function DivKetentuanNilai(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateCheckKordinator.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divKetentuanNilai').empty();
        // tempkodeMk = $('#kpMkBuka').val();
        // alert(tempkodeMk);
        $('#divMkBuka').empty();
        $("#divKetentuanNilai").html(responseText);
    }
    });
}

// Untuk menampilkan kelas pararel (tergantung ketentuan nilai dicentang atau tidak)
function DivKelasPararel(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateCheckKP.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
      $('#divMkBuka').empty();
      $("#divMkBuka").html(responseText);

      tempkodeMk = $('#kpMkBuka').val();
      CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, tempkodeMk, NPKDosen);
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

// Untuk menampilkan combo box jenis penilaian yang dapat ditambahkan (ada pengecheckan koordinator atau bukan)
function DivJenisNilai(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateTampilJenisNilai.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divJenisNilai').empty();
        $("#divJenisNilai").html(responseText);
    }
    });
}

// Untuk menampilkan input number bobot nilai, tergantung koordinator atau bukan koordinator (sudah dibuat atau belum jenis penilaian oleh koordinator)
function DivBobotNilai(kodeMk, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateTampilBobotNilai.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $('#divBobot').empty();
        $("#divBobot").html(responseText);
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

// Untuk mengembalikan semua KP yang ada, khusus koordinator (contoh A|B|C|D) yang buka di Semester dan Tahun Akademik tertentu
function GetSemuaKPMataKuliahBukaDipilih(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateGetSemuaKP.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        $("#kpMkBukas").val(responseText);
        kpMkBuka = responseText;
    }
    });
}

// Untuk mengembalikan semua KP yang diajar, khusus bukan koordinator (contoh A|B|) yang buka di Semester dan Tahun Akademik tertentu
function GetKPMataKuliahDiajar(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateGetKPDiajar.php?kodeMkBuka="+kodeMk+"&NPK="+{{$MKBukaDiajars[0]['NPK']}},
    context: document.body,
    success: function(responseText) {
        kpMkBuka = responseText;
        $("#kpMkBukas").val(responseText);
        DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen);
    }
    });
}

// Untuk mengembalikan KP yang diajar koordinator (contoh A|B|) yang buka di Semester dan Tahun Akademik tertentu
function GetKPMataKuliahKoordinator(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
      url: "jsscript/JenisNilaiCreateGetKPMkBukaKoordinator.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
      context: document.body,
      success: function(responseText) {
          kpMkBuka = responseText;
          DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen);
          CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
      }
    });
}

// Untuk menentukan default combo box bernilai 1 atau 0 (1 koordinator, 0 bukan koordinator)
function GetNilaiKetentuanDicentangAtauTidak(kodeMk, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateDefaultCheckBox.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        ketentuanNilai = responseText;
        $("#CheckSemuaKP").val(ketentuanNilai);
        if(ketentuanNilai == 1)
        {
            GetSemuaKPMataKuliahBukaDipilih(kodeMk, NPKDosen);
        }
        else
        {
            GetKPMataKuliahDiajar(kodeMk, NPKDosen);
        }
    }
    });
}

// Untuk check apakah jumlah bobot yang diinputkan benar (dapat diinputkan dengan maximal total 100%) atau tidak
function CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateCheckJumlahBobot.php?kodeMkBuka="+kodeMk+"&ketentuanNilai="+ketentuanNilaiBobot+"&jenisNilai="+jenisNilai+"&bobotNilai="+bobotNilai+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
      if (responseText == "21")
      {
          $("#CheckBobotNol").val(1);
          $("#CheckPenilaianAda").val(2);
          $("#TotalDBDanInput").val(1000);
          CheckDB=$("#TotalDBDanInput").val();
          CheckBobotNol=$("#CheckBobotNol").val();

          noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat diinputkan satu kali saja !", layout: 'topRight', type: 'error'});
          noty({text: "Jumlah bobot penilaian dari Mata Kuliah yang Anda pilih untuk penilaian "+jenisNilai+" tidak boleh lebih dari 100% !", layout: 'topRight', type: 'error'});

          document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
          document.getElementById("divBobot").className = "form-group has-error has-feedback";
          document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
      }
      else if (responseText == "20")
      {
          $("#CheckBobotNol").val(1);
          $("#CheckPenilaianAda").val(2);
          $("#TotalDBDanInput").val(0);
          CheckDB=$("#TotalDBDanInput").val();
          CheckBobotNol=$("#CheckBobotNol").val();

          noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat diinputkan satu kali saja !", layout: 'topRight', type: 'error'});

          document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
          document.getElementById("divBobot").className = "form-group has-success has-feedback";
      }
      else if (responseText == "10")
      {
          $("#CheckBobotNol").val(1);
          $("#CheckPenilaianAda").val(0);
          $("#TotalDBDanInput").val(1000);
          CheckDB=$("#TotalDBDanInput").val();
          CheckBobotNol=$("#CheckBobotNol").val();

          noty({text: "Jumlah bobot penilaian dari Mata Kuliah yang Anda pilih untuk penilaian "+jenisNilai+" tidak boleh lebih dari 100% !", layout: 'topRight', type: 'error'});

          document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
          document.getElementById("divBobot").className = "form-group has-error has-feedback";
      }
      else if (responseText == "111")
      {

      }
      else if (responseText == "11")
      {
          $("#CheckBobotNol").val(2);
          CheckBobotNol=$("#CheckBobotNol").val();

          noty({text: "Jumlah bobot penilaian dari Mata Kuliah yang Anda pilih tidak boleh kurang dari 1% !", layout: 'topRight', type: 'error'});

          document.getElementById("divBobot").className = "form-group has-error has-feedback";
      }
      else
      {
          // alert(bobotNilai);
        //   if (bobotNilai != "undefined" && bobotNilai != "")
        //   {
              // alert("masuk");
              $("#CheckBobotNol").val(1);
              $("#CheckPenilaianAda").val(0);
              $("#TotalDBDanInput").val(0);
              CheckDB=$("#TotalDBDanInput").val();
              CheckBobotNol=$("#CheckBobotNol").val();

              document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
              document.getElementById("divBobot").className = "form-group has-success has-feedback";
        //   }
      }
    }
    });
}

// Untuk check apakah jumlah bobot yang diinputkan benar (dapat diinputkan dengan maximal total 100%) atau tidak
function CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateCheckJumlahBobotSemuaKP.php?kodeMkBuka="+kodeMk+"&ketentuanNilai="+ketentuanNilaiBobot+"&jenisNilai="+jenisNilai+"&bobotNilai="+bobotNilai+"&kpMkBuka="+kpMkBuka+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        if (responseText == "21")
        {
            $("#CheckSemuaKPBisaDitambah").val(2);
            $("#CheckSemuaKPUTSUAS").val(2);

            noty({text: "Salah satu kelas pararel dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !", layout: 'topRight', type: 'error'});
            noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat terdaftar satu kali dalam Satu Kelas Pararel !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == "20")
        {
            $("#CheckSemuaKPBisaDitambah").val(1);
            $("#CheckSemuaKPUTSUAS").val(2);

            noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat terdaftar satu kali dalam Satu Kelas Pararel !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-success has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == "10")
        {
            $("#CheckSemuaKPBisaDitambah").val(2);
            $("#CheckSemuaKPUTSUAS").val(1);

            noty({text: "Salah satu kelas pararel dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else
        {
            $("#CheckSemuaKPBisaDitambah").val(1);
            $("#CheckSemuaKPUTSUAS").val(1);

            document.getElementById("divBobot").className = "form-group has-success has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-success has-feedback";
        }
    }
    });
}

// Untuk check apakah yang sedang login merupakan koordinator dari mata kuliah yang dipilih atau bukan
function CheckKoordinatorAtauBukanKoordinator(kodeMk, NPKDosen) // Checked V
{
  $.ajax({
  url: "jsscript/JenisNilaiCreateCheckKordinatorAtauBukan.php?kodeMkBuka="+kodeMk+"&NPK="+NPKDosen,
  context: document.body,
  success: function(responseText) {
      if (responseText == 0) {
        CheckBandingNilaiKoordinatorDanBukanKoordinator(kodeMk, kpMkBuka, jenisNilai, NPKDosen);
      }
  }
  });
}

// Untuk membandingkan jumlah nilai yang sudah diinputkan oleh koordinator dengan yang mau ditambahkan oleh bukan koordinator
function CheckBandingNilaiKoordinatorDanBukanKoordinator(kodeMk, kpMkBuka, jenisNilai, NPKDosen) // Checked V
{
    $.ajax({
    url: "jsscript/JenisNilaiCreateCheckNilaiKoorBukanKoor.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&jenisNilai="+jenisNilai+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        if (responseText == "3")
        {
            noty({text: "Jenis penilaian "+jenisNilai+" telah diinputkan oleh Koordinator !", layout: 'topRight', type: 'error'});
            document.getElementById("divJexnisNilai").className = "form-group has-error has-feedback";
            $("#CheckNilaiKoorBukanKoor").val(2);
        }
        else
        {
            $("#CheckNilaiKoorBukanKoor").val(0);
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
        }
    }
    });
}

// Untuk memanggil set function pengaturan form (koordinator atau bukan koordinator)
function PanggilFunctionSet() // Checked V
{
    DivKetentuanNilai(kodeMk, NPKDosen);
    DivJenisNilai(kodeMk, kpMkBuka, NPKDosen);
    DivBobotNilai(kodeMk, kpMkBuka, NPKDosen);
    DivIndexJenisNilaiKoordinator(kodeMk);
    GetNilaiKetentuanDicentangAtauTidak(kodeMk, NPKDosen);
    GetKPMataKuliahDiajar(kodeMk, NPKDosen);
    SpanGetKPKoordinator(kodeMk);
}

// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    kodeMk = $('#mkBuka').val();
    kpMkBuka = $('#kpMkBuka').val();
    NPKDosen = $('#NPKDosen').val();
    jenisNilai = $('#jenisNilai').val();
    bobotNilai = $('#bobotNilai').val();

    $('#CheckSemuaKPBisaDitambah').val(1);
    $('#CheckSemuaKPUTSUAS').val(1);
}

// Untuk memberikan hasil penggantian mata kuliah buka
$('#mkBuka').change(function() // Checked V
{
    DeklarasiVariabel();
    PanggilFunctionSet();

    kodeMk=$('#mkBuka').val();
    jenisNilai=$('#jenisNilai').val();
    bobotNilai=$('#bobotNilai').val();
    kpMkBuka;
    ketentuanNilaiBobot = ketentuanNilai;

    if(ketentuanNilaiBobot == 0) // Jika Tidak Dicentang
    {
        kpMkBuka=$('#kpMkBuka').val();
        CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, 0, kpMkBuka, NPKDosen);
        CheckKoordinatorAtauBukanKoordinator(kodeMk, NPKDosen)
    }
    else // Jika Dicentang, Get KP Semua
    {
        CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilaiBobot, jenisNilai, 0, kpMkBuka, NPKDosen)
    }
});

// Event Input Jenis Nilai
$('#InputNilai').on('click', function() // Checked V
{
    DeklarasiVariabel();
    if (ketentuanNilai == 0)
        kpMkBuka = $('#kpMkBuka').val();
    else
        kpMkBuka = $('#kpMkBukas').val();

    // alert(kodeMk + kpMkBuka + ketentuanNilai + bobotNilai + jenisNilai);

    $.ajax({
    url:"jsscript/JenisNilaiCreateCheckPreSimpan.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&ketentuanNilai="+ketentuanNilai+"&bobotNilai="+bobotNilai+"&jenisNilai="+jenisNilai+"&NPK="+NPKDosen,
    context: document.body,
    success: function(responseText) {
        // alert(responseText);
        if (responseText == 521)
        {
            $("#CheckSemuaKPBisaDitambah").val(2);
            $("#CheckSemuaKPUTSUAS").val(2);

            noty({text: "Salah satu kelas pararel dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !", layout: 'topRight', type: 'error'});
            noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat terdaftar satu kali dalam Satu Kelas Pararel !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == 520)
        {
            $("#CheckSemuaKPBisaDitambah").val(1);
            $("#CheckSemuaKPUTSUAS").val(2);

            noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat terdaftar satu kali dalam Satu Kelas Pararel !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-success has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == 510)
        {
            $("#CheckSemuaKPBisaDitambah").val(2);
            $("#CheckSemuaKPUTSUAS").val(1);

            noty({text: "Salah satu kelas pararel dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == 51)
        {
            $("#CheckSemuaKPBisaDitambah").val(1);
            $("#CheckSemuaKPUTSUAS").val(1);
            $("#CheckNilaiKoorBukanKoor").val(0);
            $("#CheckBobotNol").val(0);

            document.getElementById("divBobot").className = "form-group has-success has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-success has-feedback";

            alertify.confirm("Apakah Anda Yakin Ingin Menambah Jenis Nilai Mata Kuliah "+$("#mkBuka option:selected").text()+" KP "+kpMkBuka+" ?",
            function(){
                $('#TambahJenisNilai').submit();
                alertify.success('Jenis Nilai Mata Kuliah '+$("#mkBuka option:selected").text()+' KP '+kpMkBuka+' Telah Disimpan');
            },
            function(){
                alertify.error('Proses Tambah Jenis Nilai Dibatalkan');
            });
        }
        else if (responseText == 21)
        {
            $("#CheckSemuaKPBisaDitambah").val(2);
            $("#CheckSemuaKPUTSUAS").val(2);

            noty({text: "Salah satu kelas pararel dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !", layout: 'topRight', type: 'error'});
            noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat terdaftar satu kali dalam Satu Kelas Pararel !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == 20)
        {
            $("#CheckSemuaKPBisaDitambah").val(1);
            $("#CheckSemuaKPUTSUAS").val(2);

            noty({text: "Jenis penilaian "+jenisNilai+" hanya dapat terdaftar satu kali dalam Satu Kelas Pararel !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-success has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == 10)
        {
            $("#CheckSemuaKPBisaDitambah").val(2);
            $("#CheckSemuaKPUTSUAS").val(1);

            noty({text: "Salah satu kelas pararel dari Mata Kuliah yang Anda pilih mempunyai jumlah bobot penilaian lebih dari 100% !", layout: 'topRight', type: 'error'});

            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-error has-feedback";
        }
        else if (responseText == 33)
        {
            noty({text: "Jenis penilaian "+jenisNilai+" telah diinputkan oleh Koordinator !", layout: 'topRight', type: 'error'});
            document.getElementById("divJenisNilai").className = "form-group has-error has-feedback";
            $("#CheckNilaiKoorBukanKoor").val(2);
        }
        else if (responseText == 0)
        {
            noty({text: "Bobot jenis penilaian "+jenisNilai+" tidak boleh kurang dari 1% !", layout: 'topRight', type: 'error'});
            document.getElementById("divBobot").className = "form-group has-error has-feedback";
            $("#CheckBobotNol").val(2);
        }
        else if (responseText == 1)
        {
            $("#CheckSemuaKPBisaDitambah").val(1);
            $("#CheckSemuaKPUTSUAS").val(1);
            $("#CheckNilaiKoorBukanKoor").val(0);
            $("#CheckBobotNol").val(0);

            document.getElementById("divBobot").className = "form-group has-success has-feedback";
            document.getElementById("divJenisNilai").className = "form-group has-success has-feedback";
            document.getElementById("divKetentuanNilai").className = "form-group has-success has-feedback";

            alertify.confirm("Apakah Anda Yakin Ingin Menambah Jenis Nilai Mata Kuliah "+$("#mkBuka option:selected").text()+" KP "+kpMkBuka+" ?",
            function(){
                $('#TambahJenisNilai').submit();
                alertify.success('Jenis Nilai Mata Kuliah '+$("#mkBuka option:selected").text()+' KP '+kpMkBuka+' Telah Disimpan');
            },
            function(){
                alertify.error('Proses Tambah Jenis Nilai Dibatalkan');
            });
        }
    }
    });
});

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    DeklarasiVariabel();
    PanggilFunctionSet();
    // alert($('#kpMkBuka').val());
});

// Untuk memberikan hasil penggantian combo box ketentuan nilai untuk semua KP
$(document).on('change', '#ketentuanNilai', function() // Checked V
{
    DeklarasiVariabel();
    if (this.checked)
    {
    // kpMkBuka=$('#kpMkBuka').val();
        // alert(kodeMk +" KTEN " + ketentuanNilai  + " JENI "+ jenisNilai +" BOBO "+ bobotNilai  + " KP "+ kpMkBuka  +" NPK "+ NPKDosen);
        ketentuanNilai = 1;
        $("#CheckSemuaKP").val(1);
        GetSemuaKPMataKuliahBukaDipilih(kodeMk, NPKDosen);
        GetKPMataKuliahKoordinator(kodeMk, NPKDosen);
        CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilai, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
        tempkodeMk=kpMkBuka;
        $('#divMkBuka').empty();
    }
    else
    {
        // alert(kodeMk +" KTEN " + ketentuanNilai  + " JENI "+ jenisNilai +" BOBO "+ bobotNilai  + " KP "+ kpMkBuka  +" NPK "+ NPKDosen);
        DivKelasPararel(kodeMk, NPKDosen);
        ketentuanNilai = 0;
        // kpMkBuka=$('#kpMkBuka').val();
        kpMkBuka=tempkodeMk;
        // alert("a" + kpMkBuka);
        $("#CheckSemuaKP").val(0);
        CheckJumlahBobotSatuKP(kodeMk, ketentuanNilai, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
        GetKPMataKuliahDiajar(kodeMk, NPKDosen);
        CheckKoordinatorAtauBukanKoordinator(kodeMk, NPKDosen);

    }
});

// Untuk mengembalikan form dalam keadaan semula (reset)
$(document).on('click', '#UlangInput', function() // Checked V
{
    AwalMatKul = $('#AwalMatKul').val();
    kodeMk = AwalMatKul;
    $('#mkBuka').val(kodeMk);
    $('#statusBenarSalah').empty();
    PanggilFunctionSet();
});

// Untuk memberikan hasil penggantian kelas pararel mata kuliah buka
$(document).on('change', '#kpMkBuka', function() // Checked V
{
    var kodeMk=$('#mkBuka').val();
    var kpMkBuka=$('#kpMkBuka').val();
    CheckJumlahBobotSatuKP(kodeMk, ketentuanNilai, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
    DivIndexJenisNilaiPribadi(kodeMk, kpMkBuka, ketentuanNilai, NPKDosen);
});

$(document).on('change', '#jenisNilai', function() // Checked V
{
  kodeMk=$('#mkBuka').val();
  jenisNilai=$('#jenisNilai').val();
  bobotNilai=$('#bobotNilai').val();
  kpMkBuka;
  ketentuanNilaiBobot = ketentuanNilai;

  if(ketentuanNilaiBobot == 0) // Jika Tidak Dicentang
  {
      kpMkBuka=$('#kpMkBuka').val();
      CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
      CheckKoordinatorAtauBukanKoordinator(kodeMk, NPKDosen);
  }
  else // Jika Dicentang, Get KP Semua
  {
      CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen)
  }
});

// Untuk memberikan hasil pengechekan dari input nilai pada kolom bobot
$(document).on('input', '#bobotNilai', function() // Checked V
{
    kodeMk=$('#mkBuka').val();
    jenisNilai=$('#jenisNilai').val();
    bobotNilai=$('#bobotNilai').val();
    kpMkBuka;
    ketentuanNilaiBobot = ketentuanNilai;

    if(ketentuanNilaiBobot == 0) // Jika Tidak Dicentang
    {
        kpMkBuka=$('#kpMkBuka').val();
        CheckJumlahBobotSatuKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen);
        CheckKoordinatorAtauBukanKoordinator(kodeMk, NPKDosen)
    }
    else // Jika Dicentang, Get KP Semua
    {
        CheckJumlahBobotSemuaKP(kodeMk, ketentuanNilaiBobot, jenisNilai, bobotNilai, kpMkBuka, NPKDosen)
    }
});

</script>
@endif
@endsection
