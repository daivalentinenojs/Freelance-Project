@extends('Master')

@section('Judul','Beranda')

@if($Role == 'Kepala Desa')
  @section('Foto',url('foto/KepalaDesa/'.$ID.'.jpg'))
@elseif($Role == 'Karyawan')
  @section('Foto',url('foto/Karyawan/'.$ID.'.jpg'))
@else
  @section('Foto',url('foto/Pemohon/'.$ID.'.jpg'))
@endif

@section('ID')
  {{$Nama}}
@endsection

@section('Nama')
  {{$Role}}
@endsection

@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
{{csrf_field()}}
    <input type="hidden" name="IDFormulirPermohonan" id="IDFormulirPermohonan" value="{{$IDFP}}" class="form-control">
    <div class="col-md-12 scCol" style="background:white;" id="InformasiFP">

    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPersyaratan">

    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiGU">

    </div>
</form>
@endsection

@section('Script')
<script type="text/javascript">
$(document).ready(function() {
   IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
   DivInformasiFP(IDFormulirPermohonan);
   DivInformasiFPPersyaratan(IDFormulirPermohonan);
   DivInformasiGU(IDFormulirPermohonan);
});

function DivInformasiGU(IDFormulirPermohonan)
{
    $.ajax({
    url: "../ajax/ViewGambarUkur.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiGU').empty();
        $("#InformasiGU").html(responseText);
    }
    });
}

function DivInformasiFP(IDFormulirPermohonan)
{
    $.ajax({
    url: "../ajax/ViewFP.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiFP').empty();
        $("#InformasiFP").html(responseText);
    }
    });
}

function DivInformasiFPPersyaratan(IDFormulirPermohonan)
{
    $.ajax({
    url: "../ajax/ViewFPP.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiPersyaratan').empty();
        $("#InformasiPersyaratan").html(responseText);
    }
    });
}
</script>
@endsection
