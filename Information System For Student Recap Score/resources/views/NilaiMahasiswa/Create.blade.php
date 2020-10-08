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
    <p>Pada halaman ini Anda dapat menambah nilai mahasiswa berdasarkan mata kuliah, kelas pararel, dan jenis penilaian yang Anda pilih.</p>
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
<!-- enctype="multipart/form-data"  -->
<form class="form-horizontal" method="POST" id="FormInputNilaiMahasiswa" action="{{url('TambahNilaiMahasiswa')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="panel-body">
            <!-- Awal Informasi Jenis Nilai Mahasiswa -->
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Mata Kuliah</label>
                      <div class="col-md-8">
                          <div class="input-group">
                              <input type="hidden" size="30" value="{{$KodeNilai}}" class="form-control" id="KodeNilai" name="KodeNilai"/>
                              <input type="hidden" size="30" value="{{$KodeMkBuka}}" class="form-control" id="kodeMkBuka" name="kodeMkBuka"/>
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Mata Kuliah yang Dipilih"><strong>{{$NamaMk[0]['NamaMkBuka']}}</strong></label>
                              <input type="hidden" readonly data-toggle="tooltip" data-placement="right" title="Mata Kuliah yang Dipilih" size="30" value="{{$NamaMk[0]['NamaMkBuka']}}" class="form-control" id="namaMkBuka" name="namaMkBuka" style="width:235px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" style="text-align:right;">Kelas Pararel</label>
                      <div class="col-md-4">
                          <div class="input-group">
                              <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Kelas Pararel Mata Kuliah yang Dipilih"><strong>{{$KP}}</strong></label>
                              <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Kelas Pararel Mata Kuliah yang Dipilih"  value="{{$KP}}" class="form-control" id="KPMkBuka" name="KPMkBuka" style="width:45px; font-weight:bold; border-radius:2px; color:grey;"/>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-4 control-label" style="text-align:right;">Jenis</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Jenis Nilai Mata Kuliah yang Dipilih"><strong>{{$InformasiNilaiMahasiswa[0]->Jenis}}</strong></label>
                            <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Jenis Nilai Mata Kuliah yang Dipilih" value="{{$InformasiNilaiMahasiswa[0]->Jenis}}" class="form-control" id="JenisNilai" name="JenisNilai" style="width:100px; font-weight:bold; border-radius:2px; color:grey;"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" style="text-align:right;">Bobot</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Bobot dari Jenis Nilai yang Dipilih"><strong>{{$InformasiNilaiMahasiswa[0]->Bobot}} %</strong></label>
                            <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Bobot dari Jenis Nilai yang Dipilih"  value="{{$InformasiNilaiMahasiswa[0]->Bobot}} %" class="form-control" id="BobotNilai" name="BobotNilai" style="width:60px; font-weight:bold; border-radius:2px; color:grey;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-4 control-label" style="text-align:right;">Waktu Buat</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Waktu Buat dari Jenis Nilai yang Dipilih"><strong>{{$InformasiNilaiMahasiswa[0]->WaktuBuat}}</strong></label>
                            <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Waktu Buat dari Jenis Nilai yang Dipilih"  value="{{$InformasiNilaiMahasiswa[0]->WaktuBuat}}" class="form-control" id="WaktuBuat" name="WaktuBuat" style="width:235px; font-weight:bold; border-radius:2px; color:grey;"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" style="text-align:right;">Dosen Pembuat</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label style="margin-top:7px;" data-toggle="tooltip" data-placement="right" title="Dosen Pembuat dari Jenis Nilai yang Dipilih"><strong>{{$InformasiNilaiMahasiswa[0]->NamaDosen}}</strong></label>
                            <input type="hidden" readonly size="30" data-toggle="tooltip" data-placement="right" title="Dosen Pembuat dari Jenis Nilai yang Dipilih"  value="{{$InformasiNilaiMahasiswa[0]->NamaDosen}}" class="form-control" id="DosenPembuat" name="DosenPembuat" style="width:210px; font-weight:bold; border-radius:2px; color:grey;"/>
                        </div>
                    </div>
                </div>
            </div>
          </div>

    </div>

    <!-- Awal Tabel Input Nilai Mahasiswa -->
    <div class="row">
         <div class="col-md-12">
            <br/>
                <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Daftar Mahasiswa dan Nilai">
                  <div class="panel-heading">
                      <h3 class="panel-title">Daftar Mahasiswa dan Nilai Mata Kuliah {{$NamaMk[0]['NamaMkBuka']}} KP {{$KP}}</h3><br><br>
                      <div class="pull-right" id="unduh"  data-toggle='tooltip'data-placement='bottom' title='Klik untuk Unduh Tabel Nilai Mahasiswa'>
                            <button class="btn btn-info toggle" data-toggle="exportTable" style="margin-right:10px; margin-top:5px;"><i class="fa fa-bars"></i> Unduh Tabel Nilai</button>
                      </div>
                      <div class="pull-right" id="excel" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Unggah Tabel Nilai Mahasiswa' style="padding-right:10px;">
                            <input type="file" name="file"  id="InputExcel" class="inputfile" style="width: 0.1px;	height: 0.1px;	opacity: 0;	margin-top:5px; overflow: hidden;	position: absolute;	z-index: -1;"/>
                            <label class="btn btn-primary" style="margin-top:5px;" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Unggah Tabel Nilai Mahasiswa' for="InputExcel"><i class="fa fa-bars"></i> Unggah Tabel Nilai</label>
                      </div>
                      <div class="pull-right" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Input dengan Camera' id="android" style="display: none;">
                              <!-- data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa dengan Pemotretan' -->
                             <input type='button'  value='Masukkan Nilai dengan Camera' style='margin-right:10px; margin-top:5px;' class='btn btn-info toggle' id='AndroidTesseract'>
                      </div>
                  </div>
                  <div class="panel-body" id="exportTable" style="display: none;">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4">
                            <div class="list-group border-bottom">
                                <a href="{!! action('NilaiMahasiswaController@ExportExcel', [$KodeNilai, $KodeMkBuka, $KP]) !!}" class="list-group-item" id="ExportExcel"><img src='img/icons/xls.png' width="24"/> XLS</a>
                                <!-- <a href="#" class="list-group-item" onClick ="$('#DivDataMahasiswa').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a> -->
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item" onClick ="$('#DivDataMahasiswa').tableExport({type:'csv',escape:'false'});"><img src='img/icons/csv.png' width="24"/> CSV</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item" onClick ="$('#DivDataMahasiswa').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a>
                            </div>
                        </div> -->
                    </div>
                  </div>
                  <div class="panel-body">
                        <div id="buttons"></div>
                        <table id="DivDataMahasiswa" class="table" width="100%" >

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
      <input type="button" id="InputNilai" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menyimpan Nilai Mahasiswa' value="Simpan" style="margin-right:10px;" class="btn btn-success">
      <input type="reset" value="Ulang" data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style="margin-right:10px;" class="btn btn-primary">
      <input type="button" id="HapusNotifikasi"  onClick="$.noty.closeAll();" data-toggle="tooltip" data-placement="bottom" title="Klik untuk Menghapus Notifikasi" value="Hapus Notifikasi" style="margin-right:10px;" class="btn btn-default">
    </center>
    <br>
</form>
<!-- Akhir Isi Konten -->

<script type="text/javascript">

// Deklarasi Variabel
var kodeMk;
var kpMkBuka;
var arra = [];
var table;

var nrp=[];
var nilai=[];
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
//
// // Untuk proses Check Input Nilai
// function Varer(value) // Checked V
// {
//     // alert(value.substr(5, 4));
//
//     $Temp = $('#'+value).val();
//     if ($Temp > 100 || $Temp < 0)
//     {
//         noty({text: "Nilai Mahasiswa tidak boleh lebih dari 100 !", layout: 'topRight', type: 'error'});
//         $('#'+value).unwrap( "<div class='form-group has-error has-feedback' style='width:100%; margin-top:3%'></div>" );
//         $('#'+value).wrap( "<div class='form-group has-error has-feedback' style='width:100%; margin-top:3%'></div>" );
//     }
//     else
//     {
//         $('#'+value).unwrap( "<div class='form-group has-success has-feedback' style='width:100%; margin-top:3%'></div>" );
//         $('#'+value).wrap( "<div class='form-group has-success has-feedback' style='width:100%; margin-top:3%'></div>" );
//     }
// }
function DivDataMahasiswa(kodeMk, kpMkBuka, kodeNilai) // Checked V
{
    kodeNilai = $("#KodeNilai").val();
    $.ajax( {
        "url": "jsscript/NilaiMahasiswaCreateTampilDataMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka+"&kodeNilai="+kodeNilai,
        "success": function ( json ) {
             table = $('#DivDataMahasiswa').dataTable( json );
            //  console.log(json['data']);
             $.each(json['data'], function (key, data) {
                //  console.log(data);
                // console.log($(data['Nilai']).attr('value'));
                nrp.push($(data['NRP']).text());
                nilai.push($(data['Nilai']).attr('value'));
             });
             $('.dataTables_scrollBody thead tr').addClass('hidden');
             $("#android").css('display', '');
             $('.InputBaru').bind('change keydown keyup',function(e){
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
            //  $('.inputbaru').on('keyup',function(e){
            //     //  alert('');
            //     // console.log(this.value);
            //     console.log(this.value);
            //     return false;
             //
            //  });
        },
        "dataType": "json",

    });


    //
    //   new $.fn.dataTable.Buttons(table, {
    //   buttons: [
    //     'copyHtml5',
    //     'excelHtml5',
    //     'csvHtml5',
    //     'pdfHtml5'
    //  ]
    //   }).container().appendTo($('#buttons'));
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

// Event Input Nilai
$('#InputNilai').on('click', function() // Checked V
{
    alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Nilai {{$InformasiNilaiMahasiswa[0]->Jenis}} Mahasiswa Mata Kuliah {{$NamaMk[0]['NamaMkBuka']}} KP {{$KP}}?",
    function(){
        $('#FormInputNilaiMahasiswa').submit();
        alertify.success('Nilai  {{$InformasiNilaiMahasiswa[0]->Jenis}} Mahasiswa Mata Kuliah {{$NamaMk[0]["NamaMkBuka"]}} KP {{$KP}} Telah Disimpan');
    },
    function(){
        alertify.error('Proses Simpan Nilai Mahasiswa Dibatalkan');
    });
});

$('#AndroidTesseract').on('click', function(e) // Checked V
{
    var values = {};
    // var nrp=[];
    // var nilai=[];
    var datanya=[];
    var fields = $( '#FormInputNilaiMahasiswa' ).serializeArray();
    $.each( fields, function( i, field ) {
        if (field.name === 'NRP[]'){
        //    nrp.push(field.value);
       }else if (field.name === 'Nilai[]')
       {
        //    nilai.push(field.value);
       }
       else {
           values[field.name] = field.value;
       }
    });

    $.each(nrp,function(i,field){
        datanya.push({
            nrp : nrp[i],
            nilai : nilai[i]
        });
    });

    values['Data'] = datanya;
    // values['NRP'] = nrp;
    // values['Nilai'] = nilai;
    var passdata = JSON.stringify(values);

    // var passdata = '{"_token":"RmV5GdmjgpsNaa7ulP517PFq54zv5BlcbEhSDTnX","KodeNilai":"001604A011201610AA001","kodeMkBuka":"1604A01120161","namaMkBuka":"ALGORITMA DAN PEMROGRAMAN","KPMkBuka":"A","JenisNilai":"QuizUAS","BobotNilai":"20 %","WaktuBuat":"06 December 2016","DosenPembuat":"Susana Limanto, S.T., M.Si.","DivDataMahasiswa_length":"10","CheckInputNilai":"0","NPKDosen":"197030","Data":[{"nrp":"6134004","nilai":"0"},{"nrp":"6134020","nilai":"0"},{"nrp":"6134059","nilai":"0"},{"nrp":"6134111","nilai":"0"},{"nrp":"6134115","nilai":"0"}]}';




	console.log(passdata);
    Android.moveToNextScreen("value",passdata);
});

//Untuk memberikan tampilan awal
$(document).ready( function() // Checked V
{
    kodeMk = $("#kodeMkBuka").val();
    kpMkBuka = $("#KPMkBuka").val();
    kodeNilai = $("#KodeNilai").val();

    // $.ajax( {
    //     "url": "jsscript/NilaiMahasiswaCreateTampilDataMahasiswa.php?kodeMkBuka="+kodeMk+"&kpMkBuka="+kpMkBuka,
    //     "success": function ( json ) {
    //     $('#DivNilaiMahasiswa').dataTable( json );
    // },
    // "dataType": "json"
    // } );

    DivDataMahasiswa(kodeMk, kpMkBuka, kodeNilai);

    $('#InputExcel').on('change', function() {
        //   $("#DivDataMahasiswa").dataTable(settings);
	    var file_data = $('#InputExcel').prop('files')[0];
	    var form_data = new FormData();
	    form_data.append('file', file_data);
	    $.ajax({
          url: "jsscript/ImportExcel.php?KodeMkBuka="+kodeMk+"&KP="+kpMkBuka+"&KodeNilai="+kodeNilai,
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(php_script_response){
              $('#DivDataMahasiswa').dataTable().fnClearTable();
              $('#DivDataMahasiswa').dataTable().fnDraw();
              $('#DivDataMahasiswa').dataTable().fnDestroy();
              $('#DivDataMahasiswa').dataTable(php_script_response);
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              noty({text: "File Excel yang diinputkan tidak sesuai !", layout: 'topRight', type: 'error'});
          }
          ,
          dataType: "json"
	     });
         $('#InputExcel').val(null);
	});
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
