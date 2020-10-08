@extends('Master')

@section('Judul','Master Data | Informasi Desa')

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
    <div class="col-md-12 scCol" style="background:white;">
      @foreach ($errors->all() as $error)
      <p class="alert alert-danger">{{ $error }}</p>
      @endforeach
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
    </div>
    <div class="col-md-12 scCol" style="background:white;">
      <div class="panel panel-success" id="grid_block_5">
        <div class="panel-heading">
          <h3 class="panel-title">Pilih Formulir Permohonan</h3>
        </div>
        <div class="panel-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Nomor Formulir</label>
              <div class="col-sm-9">
                <select class="form-control select" name="IDFormulirPermohonan" required id="IDFormulirPermohonan" data-live-search="true">
                @foreach($DataFormulirPermohonan as $FP)
                  <option value="{{$FP['ID']}}">{{$FP['NamaPemohon']}} | Nomor : {{$FP['NomorBukuHurufC']}} | Jenis : {{$FP['JenisTanahLetterC']}} | Luas : {{$FP['LuasDaerahLetterC']}} m2</option>
                @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiFP">

    </div>
    <br>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPersyaratan">

    </div>
    <br>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiRisalah">

    </div>
    <br>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiBerkasPengumuman">

    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiSuratPengantar">

    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiBeritaAcara">
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Berita Acara</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Berita Acara</label>
                <div class="col-sm-2" id="DivNomorBeritaAcara">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Penjelasan Pengesahan</label>
                <div class="col-sm-6">
                  <input type="text" name="PenjelasanPengesahan" value="" class="form-control" required id="PenjelasanPengesahan">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label for="focusedinput" class="col-sm-4 control-label">File Berita Acara</label>
                  <div class="col-md-8">
                      <input type="file" name="FileBeritaAcara" required id="FileBeritaAcara" class="file" data-preview-file-type="any"/>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="">
          <div class="col-md-5">
          </div>
          <div class="col-md-4">
            <input type="submit" value="Ajukan Berita Acara" class="btn btn-success"><br><br>
          </div>
        </div>
    </div>
</form>
@endsection

@section('Script')
<script type="text/javascript">
var IDFormulirPermohonan;

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$(document).ready(function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivInformasiRisalah(IDFormulirPermohonan);
    DivInformasiBerkasPengumuman(IDFormulirPermohonan);
    DivInformasiSuratPengantar(IDFormulirPermohonan);
    DivNomorBeritaAcara(IDFormulirPermohonan);
});

$(document).on('change', '#IDFormulirPermohonan', function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivInformasiRisalah(IDFormulirPermohonan);
    DivInformasiBerkasPengumuman(IDFormulirPermohonan);
    DivInformasiSuratPengantar(IDFormulirPermohonan);
    DivNomorBeritaAcara(IDFormulirPermohonan);
});

function DivInformasiFP(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/VerifikasiBerkasPermohonanFP.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiFP').empty();
        $("#InformasiFP").html(responseText);
    }
    });
}

function DivInformasiRisalah(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/VerifikasiRisalahInformasiRisalah.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiRisalah').empty();
        $("#InformasiRisalah").html(responseText);
    }
    });
}

function DivInformasiFPPersyaratan(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/VerifikasiBerkasPermohonanPersyaratanFP.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiPersyaratan').empty();
        $("#InformasiPersyaratan").html(responseText);
    }
    });
}

function DivInformasiBerkasPengumuman(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/VerifikasiSuratPengantarKaryawan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiBerkasPengumuman').empty();
        $("#InformasiBerkasPengumuman").html(responseText);
    }
    });
}

function DivInformasiSuratPengantar(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/VerifikasiBeritaAcara.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiSuratPengantar').empty();
        $("#InformasiSuratPengantar").html(responseText);
    }
    });
}

function DivNomorBeritaAcara(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/NomorBeritaAcara.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivNomorBeritaAcara').empty();
        $("#DivNomorBeritaAcara").html(responseText);
    }
    });
}
</script>
@endsection
