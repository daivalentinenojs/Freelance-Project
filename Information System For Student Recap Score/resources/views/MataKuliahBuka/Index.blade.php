<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Informasi Mata Kuliah Buka')

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
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Melihat Informasi Mata Kuliah Buka"><a href="{{ url('/InformasiMataKuliahBuka')}}"><span class="fa fa-info"></span> <span class="xn-text">Informasi Mata Kuliah</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menambah Jenis Nilai"><a href="{{ url('/TambahJenisNilai')}}"><span class="fa fa-file-text-o"></span> <span class="xn-text">Tambah Jenis Nilai</span></a></li>
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
<h3 class="panel-title">Informasi Mata Kuliah Buka</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat melihat informasi mata kuliah buka beserta dosen yang mengajar pada mata kuliah dan kelas pararel tersebut.</p>
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
<!-- Awal Tabel Mata Kuliah  -->
<div class="panel-body" style="padding:0px;">
	<div class="col-md-12">
    <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Informasi Mata Kuliah Buka">
         <div class="panel-heading">
             <h3 class="panel-title">Informasi Mata Kuliah Buka</h3>
         </div>
         <div class="panel-body">
             <table id="DivMataKuliahBuka" class="table datatable" width="100%" >
                <thead>
                  <tr>
                    <th style="text-align:center;">Mata Kuliah</th>
                    <th style="text-align:center;">KP</th>
                    <th style="text-align:center;">SKS</th>
                    <th style="text-align:center;">Dosen Pengajar</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th style="text-align:center;">Mata Kuliah</th>
                    <th style="text-align:center;">KP</th>
                    <th style="text-align:center;">SKS</th>
                    <th style="text-align:center;">Dosen Pengajar</th>
                  </tr>
                </tfoot>
            </table>
         </div>
      </div>
  </div>
</div>
<!-- Akhir Tabel Mata Kuliah  -->

<script type="text/javascript">

// Untuk menampilkan mahasiswa ambil mata kuliah berdasarkan
function DivMataKuliahBuka() // Checked V
{
    var dataTable = $('#DivMataKuliahBuka').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax":{
        url : "jsscript/InformasiMataKuliahBuka.php",
        type: "post",
      },
      "order":[[1, 'asc']]
    });
}

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    DivMataKuliahBuka();
});
</script>
@endif
@endsection
