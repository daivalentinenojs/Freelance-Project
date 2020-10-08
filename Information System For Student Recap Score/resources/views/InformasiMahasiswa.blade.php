<!-- Checked V -->

@extends('Master')

@section('Judul','Sistem Informasi Rekap Nilai')
@section('Judul1','Sistem Informasi Rekap Nilai')
@section('Judul2','Beranda')

@section('Title','Sistem Informasi Rekap Nilai')
@section('Nama','Sistem Informasi Rekap Nilai')

@section('FotoLogin',url('Foto/'.$NRP.'.jpg'))

@section('NRPLogin')
    {{$NRP}}<br>
@endsection

@section('NamaLogin')
    {{$Nama}}<br>
@endsection

@section('Navigasi')
<li class="xn-title">Navigasi</li>
<li class="active" data-toggle="tooltip" data-placement="top" title="Klik untuk Mengakses Halaman Beranda"><a href="{{ url('/InformasiMahasiswa')}}"><span class="fa fa-desktop"></span><span class="xn-text">Beranda</span></a></li>
<li data-toggle="tooltip" data-placement="top" title="Klik untuk Keluar dari Sistem"><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
@endsection

@section('isi')
<div class="panel-heading">
<h3 class="panel-title">Kartu Studi Mahasiswa</h3>
</div>

<div class="panel-body">
    <p>Pada halaman ini Anda dapat melihat mata kuliah yang Anda ambil dan detail nilai yang Anda peroleh.</p>
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
<!-- Awal Informasi Login Hak Akses -->
<form class="form-horizontal" method="POST" id="FormBerandaMahasiswa" action="{{ url('/InformasiMahasiswa') }}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="panel-body" style="padding:0px;">
  <div class="col-md-3">
      <table class="table">
          <tbody>
              <tr>
                  <th style='vertical-align:middle; text-align:right;'>Semester</th>
                  <td>
                    <select id="DivSemesterThn" name="DivSemesterThn" class="form-control" style="width: 60%" data-toggle="tooltip" data-placement="right" title="Silahkan Memilih Semester untuk Melihat Detail Nilai Anda" >
                        @foreach ($MhsPunyaSemesters as $MhsPunyaSemester)
                              <!-- <a href="{{ url('/InformasiMahasiswa/'.$MhsPunyaSemester['Semester'].'/'.$MhsPunyaSemester['ThnAkademik'])}}"> -->
                              <option value="{{$MhsPunyaSemester['Semester']}}|{{$MhsPunyaSemester['ThnAkademik']}}"
                              @if($MhsPunyaSemester['Semester'] == $Semester && $MhsPunyaSemester['ThnAkademik'] == $ThnAkademik)
                                  selected
                              @endif
                              >{{$MhsPunyaSemester['Semester']}} {{$MhsPunyaSemester['ThnAkademik']}}</option>
                              <!-- </a> -->
                        @endforeach
                    </select>
                  </td>
              </tr>
              <tr>
                  <th style='vertical-align:middle; text-align:right;'>NRP</th>
                  <td>
                    @if(isset($MhsAmbilMks[0]['NRP']))
                      {{$MhsAmbilMks[0]['NRP']}}
                    @endif
                  </td>
              </tr>
              <tr>
                  <th style='vertical-align:middle; text-align:right;'>Nama</th>
                  <td>
                    @if(isset($MhsAmbilMks[0]['Nama']))
                      {{$MhsAmbilMks[0]['Nama']}}
                    @endif
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</div>
<!-- Akhir Informasi Login Hak Akses -->

<!-- Awal Mata Kuliah Diambil -->
<div class="panel-body" style="padding:0px;">
	<div class="col-md-12">
    <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="Detail Nilai Anda">
         <div class="panel-heading">
             <h3 class="panel-title">Detail Nilai Mahasiswa</h3>
         </div>
         <div class="panel-body">
             <table id="DivMhsAmbilMk" class="table Datatable " width="100%" >
                <thead>
                  <tr>
                    <th></th>
                    <th style="text-align:center;">Mata Kuliah</th>
                    <th style="text-align:center;">KP</th>
                    <th style="text-align:center;">NTS Akhir</th>
                    <th style="text-align:center;">NAS Akhir</th>
                    <th style="text-align:center;">NA</th>
                    <th style="text-align:center;">Nisbi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th></th>
                    <th style="text-align:center;">Mata Kuliah</th>
                    <th style="text-align:center;">KP</th>
                    <th style="text-align:center;">NTS Akhir</th>
                    <th style="text-align:center;">NAS Akhir</th>
                    <th style="text-align:center;">NA</th>
                    <th style="text-align:center;">Nisbi</th>
                  </tr>
                </tfoot>
            </table>
         </div>
      </div>
  </div>
  <input type="hidden" id="NRPMahasiswa" name="NRPMahasiswa" value="{{$NRP}}">
  <input type="hidden" id="Semester" name="Semester" value="{{$Semester}}">
  <input type="hidden" id="ThnAkademik" name="ThnAkademik" value="{{$ThnAkademik}}">
</div>
</form>
<!-- Akhir Mata Kuliah Diambil -->

<script type="text/javascript">

// Untuk deklarasi variabel awal V
var NRPMahasiswa;
var KodeTahunSemester;
var KodeBantuan;
var dataTable;
var Check = 0;
var tr;
var row;
var datarow;

// Untuk menampilkan detail nilai
// function format (Kode) // Checked V
// {
//     $.ajax({
//     url: "jsscript/InformasiMahasiswaTampilDetailNilai.php?KodeSubString="+Kode+"&NRP="+NRPMahasiswa,
//     context: document.body,
//     success: function(responseText) {
//         alert(responseText);
//         HasilDetailMahasiswa = responseText;
//     }
//     });
//     return HasilDetailMahasiswa;
//
//     // `d` is the original data object for the row // ini contoh aslinya
//     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
//         '<tr>'+
//             '<td>Full name:</td>'+
//             '<td></td>'+
//         '</tr>'+
//         '<tr>'+
//             '<td>Extension number:</td>'+
//             '<td></td>'+
//         '</tr>'+
//         '<tr>'+
//             '<td>Extra info:</td>'+
//             '<td>And any further details here (images etc)...</td>'+
//         '</tr>'+
//     '</table>';
// }

// Untuk menampilkan detail nilai mahasiswa berdasarkan Mata Kuliah dan KP
function DivMahasiswaAmbilMk(NRPMahasiswa, Semester, ThnAkademik) // Checked V
{
    dataTable = $('#DivMhsAmbilMk').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollY": 200,
      "scrollX": true,
      "ajax":
      {
        url : "jsscript/InformasiMahasiswaTampilMahasiswaAmbilMataKuliah.php?NRPMahasiswa="+NRPMahasiswa+"&Semester="+Semester+"&ThnAkademik="+ThnAkademik,
        type: "post",
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
        {"data":3},
        {"data":4},
        {"data":5}
      ],
      "order":[[1, 'asc']]
    });
}

$(document).on('click', '#DivMhsAmbilMk tbody tr td.details-control', function() // Checked V
{
    tr = $(this).closest('tr');
    row = dataTable.row(tr);
    datarow = (dataTable.row(tr).data());
    // alert(datarow);0
    //alert("1"+datarow);
    // alert(tr);

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

      // row.child("Test").show();
      // tr.addClass('shown');

      $.ajax({
      url: "jsscript/InformasiMahasiswaTampilDetailNilai.php?KodeSubString="+datarow+"&NRP="+NRPMahasiswa,
      context: document.body,
      success: function(responseText)
      {
          row.child(responseText).show();
          tr.addClass('shown');
          // Check = 1;
      }
      });
    }
});


// Untuk memanggil deklarasi variabel awal
function DeklarasiVariabel() // Checked V
{
    NRPMahasiswa = $('#NRPMahasiswa').val();
    // KodeTahunSemester = $('#DivSemesterThn').val();
    Semester = $('#Semester').val();
    ThnAkademik = $('#ThnAkademik').val();
}

// Untuk memberikan hasil penggantian tahun akademik dan semester
$('#DivSemesterThn').change(function() // Checked V
{
    // if (Check == 1)
    // {
    //   KodeTahunSemester = $('#DivSemesterThn').val();
    //   location.reload();
    //   Check = 0;
    // }

    Kode = $('#DivSemesterThn').val();
    Hasil = Kode.split('|');
    $('#Semester').val(Hasil[0]);
    $('#ThnAkademik').val(Hasil[1]);
    DeklarasiVariabel();
    $('#FormBerandaMahasiswa').submit();
    // DivMahasiswaAmbilMk(NRPMahasiswa, Semester, ThnAkademik);
});

// Untuk memberikan tampilan awal
$(document).ready(function() // Checked V
{
    DeklarasiVariabel();
    DivMahasiswaAmbilMk(NRPMahasiswa, Semester, ThnAkademik);

          // $.ajax({
          // url: "jsscript/InformasiMahasiswaTampilMahasiswaAmbilMataKuliah.php?NRPMahasiswa="+NRPMahasiswa+"&KodeTahunSemester="+KodeTahunSemester,
          // context: document.body,
          // success: function(responseText) {
          //     Check = 1;
          //     alert(responseText);
          //     console.log(responseText);
          // }
          // });
});
</script>
@endif
@endsection
