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
              <label for="focusedinput" class="col-sm-2 control-label">Nomor Berkas</label>
              <div class="col-sm-9">
                <select class="form-control select" name="IDFormulirPermohonan" required id="IDFormulirPermohonan" data-live-search="true">
                @foreach($DataBerkasPermohonan as $FP)
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
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPembayaran">
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Gambar Ukur</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Tugas Ukur</label>
                <div class="col-sm-3" id="DivNomorSuratTugasUkur">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Peta Pendaftaran</label>
                <div class="col-sm-3">
                  <input type="text" name="NomorPetaPendaftaran" value="" class="form-control" required id="NomorPetaPendaftaran">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">NIB</label>
                <div class="col-sm-2" id="DivNIB">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Petugas Pemetaan</label>
                <div class="col-sm-5" id="DivPetugasPemetaan">

                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Pemetaan</label>
                <div class="col-sm-3">
                  <input type="date" name="TanggalPemetaan" value="" class="form-control" required id="TanggalPemetaan">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Pembuatan</label>
                <div class="col-sm-3">
                  <input type="date" name="Tanggal" value="" class="form-control" required id="Tanggal">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Peta Grafikal</label>
                <div class="col-sm-7">
                  <input type="text" name="PetaGrafikal" value="" class="form-control" required id="PetaGrafikal">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Petugas Ukur</label>
                <div class="col-sm-5" id="DivPetugasUkur">

                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Ukur</label>
                <div class="col-sm-3" id="DivTanggalUkur">

                </div>
              </div>
              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Petugas Ukur 2</label>
                <div class="col-sm-5">
                  <select name="IDKaryawanPengukuranDua" required class="form-control select" data-live-search="true"/>
                     @foreach ($DataKaryawan as $Karyawan)
                           <option value="{{$Karyawan['ID']}}">{{$Karyawan['Nama']}}</option>
                     @endforeach
                  </select>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="">
        	<div class="col-md-5">
        	</div>
        	<div class="col-md-4">
        		<input type="submit" value="Simpan Gambar Ukur Berkas Permohonan" class="btn btn-success"><br><br>
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
    DivPetugasPemetaan(IDFormulirPermohonan);
    DivPetugasUkur(IDFormulirPermohonan);
    DivTanggalUkur(IDFormulirPermohonan);
    DivNomorSuratTugasUkur(IDFormulirPermohonan);
    DivNIB(IDFormulirPermohonan);
});

$(document).on('change', '#IDFormulirPermohonan', function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivPetugasPemetaan(IDFormulirPermohonan);
    DivPetugasUkur(IDFormulirPermohonan);
    DivTanggalUkur(IDFormulirPermohonan);
    DivNomorSuratTugasUkur(IDFormulirPermohonan);
    DivNIB(IDFormulirPermohonan);
});

function DivInformasiFP(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/GambarUkurBP.php?IDFP="+IDFormulirPermohonan,
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
    url: "ajax/GambarUkurBPPersyaratan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiPersyaratan').empty();
        $("#InformasiPersyaratan").html(responseText);
    }
    });
}

function DivNomorSuratTugasUkur(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/NomorSuratTugasUkur.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivNomorSuratTugasUkur').empty();
        $("#DivNomorSuratTugasUkur").html(responseText);
    }
    });
}

function DivNIB(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/NIB.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivNIB').empty();
        $("#DivNIB").html(responseText);
    }
    });
}

function DivPetugasPemetaan(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/PetugasPemetaan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivPetugasPemetaan').empty();
        $("#DivPetugasPemetaan").html(responseText);
    }
    });
}

function DivPetugasUkur(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/PetugasUkur.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivPetugasUkur').empty();
        $("#DivPetugasUkur").html(responseText);
    }
    });
}

function DivTanggalUkur(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/TanggalUkur.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivTanggalUkur').empty();
        $("#DivTanggalUkur").html(responseText);
    }
    });
}
</script>
@endsection
