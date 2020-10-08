<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Ubah Nilai Mahasiswa')

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
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Mengubah Nilai Mahasiswa"><a href="{{ url('/InformasiNilaiMahasiswa')}}"><span class="fa fa-list-alt"></span> <span class="xn-text">Ubah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menghitung Nilai Mahasiswa"><a href="{{ url('/InformasiKalkulasiNilaiMahasiswa')}}"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Kalkulasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Menverifikasi Nilai Mahasiswa"><a href="{{ url('/InformasiVerifikasiNilaiMahasiswa')}}"><span class="fa fa-check-circle"></span> <span class="xn-text">Verifikasi Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Mengunggah Nilai Mahasiswa"><a href="{{ url('/InformasiUnggahNilaiMahasiswa')}}"><span class="fa fa-upload"></span> <span class="xn-text">Unggah Nilai Mahasiswa</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')
<div class="panel-heading">
<h3 class="panel-title">Mengubah Nilai Mahasiswa</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat mengubah nilai mahasiswa berdasarkan mata kuliah, kelas pararel, dan jenis penilaian yang Anda pilih.</p>
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
<form class="form-horizontal" id="FormUbahNilaiMahasiswa" action="{{url('UbahNilaiMahasiswa')}}" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="panel-body">
            <!-- Awal Informasi Jenis Nilai Mahasiswa -->
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Mata Kuliah</label>
                      <div class="col-md-8">
                          <div class="input-group">
                              <input type="hidden" readonly size="30" value="{{$KodeNilai}}" class="form-control" id="kodeNilai" name="kodeNilai"/>
                              <input type="hidden" readonly size="30" value="{{$InformasiJenisNilai[0]->KodeMk}}" class="form-control"  id="kodeMkBuka" name="kodeMkBuka"/>
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Mata Kuliah yang Dipilih"><strong>{{$InformasiJenisNilai[0]->NamaMk}}</strong></label>
                              <input type="hidden" readonly data-toggle="tooltip" data-placement="right" title="Mata Kuliah yang Dipilih" size="30" value="{{$InformasiJenisNilai[0]->NamaMk}}" class="form-control" id="namaMkBuka" name="namaMkBuka" style="width:235px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Kelas Pararel</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Kelas Pararel Mata Kuliah yang Dipilih"><strong>{{$InformasiJenisNilai[0]->KP}}</strong></label>
                              <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Kelas Pararel Mata Kuliah yang Dipilih" value="{{$InformasiJenisNilai[0]->KP}}" class="form-control" id="KPMkBuka" name="KPMkBuka" style="width:45px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Dosen Pembuat</label>
                      <div class="col-md-6">
                          <div class="input-group">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Dosen Pembuat dari Jenis Nilai yang Dipilih"><strong>{{$InformasiJenisNilai[0]->NamaDosen}}</strong></label>
                              <input type="hidden" readonly size="30" value="{{$InformasiJenisNilai[0]->NamaDosen}}" data-toggle="tooltip" data-placement="right" title="Dosen Pembuat dari Jenis Nilai yang Dipilih" class="form-control" id="DosenPembuat" name="DosenPembuat" style="width:210px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Waktu Buat</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Waktu Buat dari Jenis Nilai yang Dipilih"><strong>{{$InformasiJenisNilai[0]->WaktuBuat}}</strong></label>
                              <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Waktu Buat dari Jenis Nilai yang Dipilih" value="{{$InformasiJenisNilai[0]->WaktuBuat}}" class="form-control" id="WaktuBuat" name="WaktuBuat" style="width:235px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Jenis</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Jenis Nilai Mata Kuliah yang Dipilih"><strong>{{$InformasiJenisNilai[0]->Jenis}}</strong></label>
                              <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Jenis Nilai Mata Kuliah yang Dipilih" value="{{$InformasiJenisNilai[0]->Jenis}}" class="form-control" id="JenisNilai" name="JenisNilai" style="width:100px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Bobot</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <input type="hidden" readonly size="30" value="{{$InformasiJenisNilai[0]->Bobot}}" class="form-control" id="BobotNilai" name="BobotNilai" style="width:60px; font-weight:bold; border-radius:2px; color:grey;"/>
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Bobot dari Jenis Nilai yang Dipilih"><strong>{{$InformasiJenisNilai[0]->Bobot}} %</strong></label>
                              <input type="hidden" readonly size="30" value="{{$InformasiJenisNilai[0]->Bobot}} %" data-toggle="tooltip" data-placement="right" title="Bobot dari Jenis Nilai yang Dipilih" class="form-control" id="BobotNilaiShow" name="BobotNilaiShow" style="width:60px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Nomor Surat</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <input type="text" size="45" class="form-control" id="NomorSurat" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Nomor Surat" name="NomorSurat" style="width:110px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Tanggal Surat</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <input type="date" class="form-control" id="TanggalSurat" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Tanggal Surat" name="TanggalSurat" style="width:175px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Keterangan</label>
                      <div class="col-md-4">
                          <textarea id="Keterangan" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Keterangan"  width="50px" name="Keterangan" rows="5" cols="35"></textarea>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Akhir Informasi Jenis Nilai Mahasiswa -->

          <br><br>
          <!-- Awal Tabel Input Nilai Mahasiswa -->
          <div class="row">
               <div class="col-md-12">
                  <br/>
                      <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Daftar Mahasiswa dan Nilai">
                        <div class="panel-heading">
                            <h3 class="panel-title">Daftar Mahasiswa dan Nilai Mata Kuliah {{$NamaMk[0]['NamaMkBuka']}} KP {{$KP}}</h3><br><br>
                        </div>
                        <div class="panel-body">
                          <table id="DivDataMahasiswa" class="table" width="100%" >
                              <thead>
              					<tr>
                                    <th style="width:15%;">NRP</th>
                                    <th style="width:25%;">Nama</th>
                                    <th style="width:20%;">Nilai Lama</th>
                                    <th style="width:10%;">Kode Nisbi Lama</th>
                                    <th style="width:20%;">Nilai Baru</th>
              					</tr>
              				</thead>
                              <tfoot>
              					<tr>
                                    <th style="width:15%;">NRP</th>
                                    <th style="width:25%;">Nama</th>
                                    <th style="width:20%;">Nilai Lama</th>
                                    <th style="width:10%;">Kode Nisbi Lama</th>
                                    <th style="width:20%;">Nilai Baru</th>
              					</tr>
              				</tfoot>
                          </table>
                        </div>
                      </div>
              </div>
          </div>
          <!-- <input type="button" onClick="check();" value="0"> -->
          <input type="hidden" name="CheckInputNilai" id="CheckInputNilai" value="0">
          <input type="hidden" name="NPKDosen" id="NPKDosen" value="{{$NPK}}">
          <!-- Akhir Tabel Input Nilai Mahasiswa -->

          <center>
            <input type="button" id="UbahNilai" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengubah Nilai Mahasiswa' value="Ubah" style="margin-right:10px;" class="btn btn-warning">
            <input type="reset" value="Ulang" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style="margin-right:10px;" class="btn btn-primary">
            <input type="button" id="HapusNotifikasi"  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' onClick="$.noty.closeAll();" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Menghapus Notifikasi" value="Hapus Notifikasi" style="margin-right:10px;" class="btn btn-default">
          </center>
          <br>
   </div>
</form>

<!-- Akhir Isi Konten -->

<script type="text/javascript">

// Deklarasi Variabel
var kodeMk;
var kpMkBuka;
var arra = [];
var dataTable;
var kodeNilai;

// Untuk mencegah input huruf, hanya angka dan titik yang boleh
// function isNumberKey(evt) // Checked V
// {
//      var charCode = (evt.which) ? evt.which : event.keyCode
//      if (charCode == 46)
//         return true;
//      if ((charCode > 31 && (charCode < 48 || charCode > 57)))
//         return false;
//      return true;
// }

// // Untuk proses Check Input Nilai
// function Varer(value) // Checked V
// {
//     // alert(value.substr(5, 4));
//     // $KotakArray = split('Nilai', value);
//     // alert($KotakArray[1]);
//     $Temp = $('#'+value).val();
//     if ($Temp > 100 || $Temp < 0)
//     {
//         noty({text: "Nilai Mahasiswa tidak boleh lebih dari 100 !", layout: 'topRight', type: 'error'});
//         $('#'+value).unwrap( "<div class='form-group has-error has-feedback' style='width:100%; margin-top:5%; margin-left:2%;'></div>" );
//         $('#'+value).wrap( "<div class='form-group has-error has-feedback' style='width:100%; margin-top:5%; margin-left:2%;'></div>" );
//     }
//     else
//     {
//         $('#'+value).unwrap( "<div class='form-group has-success has-feedback' style='width:100%; margin-top:5%; margin-left:2%;'></div>" );
//         $('#'+value).wrap( "<div class='form-group has-success has-feedback' style='width:100%; margin-top:5%; margin-left:2%;'></div>" );
//     }
//     arra[value.substr(5, 4)]=$Temp;
//     // alert(arra[value.substr(5, 4)]);
//     // alert(arr[value.substr(5, 4)]);
//
// }

// Untuk proses pengecheckan isi Array
function check() // Checked V
{
    arra.forEach(function(entry) {
        alert(entry);
    });

}

// Untuk menampilkan jenis penilaian yang ada pada KP yang diajar
function DivDataMahasiswa(kodeMk, kpMkBuka) // Checked V
{
    // var tes=-1;
    // var dataTable = $('#DivDataMahasiswa').DataTable( {
    //   "processing": true,
    //   "serverSide": true,
    //   "bDestroy": true,
    //   "ajax":{
    //     url : "jsscript/NilaiMahasiswaCreateTampilDataMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka,
    //     type: "post",  // method  , by default get
    // },
    // "columns":[
    //     {"data":0},
    //     {"data":1},
    //     {"data":2,
    //         "render" : function ( data, type, full, meta ) {
    //             tes++;
    //             return '<input id=\'Nilai'+tes+'\' onchange=\'return Varer(this.id)\' onkeypress=\'return isNumberKey(event)\' data-toggle=\'tooltip\' data-placement=\'right\' title=\'Silahkan Memasukkan Nilai Mahasiswa '+data+'\' type=\'number\' step=any required min=\'1\' max \'100\' size=\'5\' style=\'width:100%; border-radius:3px;\' name=\'Nilai[]\' class=\'form-control\'/>';
    //         }
    //     }
    //   ],
    //   "order":[[0, 'asc']]
    // });

    $.ajax( {
        "url": "jsscript/NilaiMahasiswaEditTampilDataMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&kodeNilai="+kodeNilai,
        "success": function ( json ) {

            $('#DivDataMahasiswa').dataTable( json );

            $('.UbahBaru').bind('change keydown keyup',function(e){
               //  alert('');
               // console.log(this.value);

               var charCode = (e.which) ? e.which : event.keyCode
               console.log(charCode);
               //  if (charCode == 46){return true;}
               // && charCode!= 190
               if ((charCode > 31 && (charCode < 48 || charCode > 57) && charCode!= 46))
               {return false;}

               if (e.target.value > 100 || e.target.value < 0){
                   // e.target.value =e.target.value.slice(1, -1);
                   e.target.value = 100;
               }
               else {
                   console.log(e.target.value);
               }

            });
        },
        "dataType": "json"
    });

    // ,
    // "columns":[
    //     {"data":0},
    //     {"data":1},
    //     {"data":2,"searchable":false,"orderable":false,"targets":0,
    //         "render" : function ( data, type, full, meta ) {
    //             tes++;
    //             return '<input id=\'Nilai'+tes+'\' onchange=\'return Varer(this.id)\' onkeypress=\'return isNumberKey(event)\' data-toggle=\'tooltip\' data-placement=\'right\' title=\'Silahkan Memasukkan Nilai Mahasiswa '+data+'\' type=\'number\' step=any required min=\'1\' max \'100\' size=\'5\' style=\'width:100%; border-radius:3px;\' name=\'Nilai[]\' class=\'form-control\'/>';
    //
    //         }
    //     }
    //   ],
    //   "order":[[0, 'asc']]
    // alert(JSON.stringify(dataTable));
}

// Event Ubah Nilai
$('#UbahNilai').on('click', function() // Checked V
{
    // $.ajax({
    // url:"jsscript/NilaiMahasiswaEditCheckPreUbah.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&ketentuanNilai="+ketentuanNilai+"&bobotNilai="+bobotNilai+"&jenisNilai="+jenisNilai+"&NPK="+NPKDosen,
    // context: document.body,
    // success: function(responseText) {
    //
    //
    // }
    // });
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Nilai {{$InformasiJenisNilai[0]->Jenis}} Mahasiswa ?",
    function(){
        $('#FormUbahNilaiMahasiswa').submit();
        alertify.success('Nilai {{$InformasiJenisNilai[0]->Jenis}} Mahasiswa Telah Diubah');
    },
    function(){
        alertify.error('Proses Ubah Nilai Mahasiswa Dibatalkan');
    });
});

//Untuk memberikan tampilan awal
$(document).ready( function() // Checked V
{
    kodeMk = $("#kodeMkBuka").val();
    kpMkBuka = $("#KPMkBuka").val();
    kodeNilai = $("#kodeNilai").val();

    // alert(kodeNilai);
    // $.ajax( {
    //     "url": "jsscript/NilaiMahasiswaCreateTampilDataMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka,
    //     "success": function ( json ) {
    //     $('#DivNilaiMahasiswa').dataTable( json );
    // },
    // "dataType": "json"
    // } );
    DivDataMahasiswa(kodeMk, kpMkBuka);

    $('#form').submit( function() {
        var sData =$('#DivDataMahasiswa').$('input').serialize();
        alert( "The following data would have been submitted to the server: \n\n"+sData );
        return false;
    } );
});
</script>
<style>
table tbody td {
min-width: 100px;
}
@media (min-width: 1026px) {
    #android { display: none; }
}
@media (max-width: 1026px) {
    #unduh  { display: none; }
    #excel  { display: none; }
}
</style>
@endif
@endsection
