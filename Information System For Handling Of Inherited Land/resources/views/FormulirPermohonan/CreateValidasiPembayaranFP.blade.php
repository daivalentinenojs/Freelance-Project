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
    <div class="col-md-12 scCol" style="background:white;" id="InformasiTagihan">

    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPembayaran">
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Surat Perintah Setor</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6" id="DivNamaTerima">
              
              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Di</label>
                <div class="col-sm-3">
                  <input type="text" name="NomorDi" value="" class="form-control" required id="NomorDi" onkeypress="return isNumberKeyCrash(event)">
                </div>
              </div> -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Terbilang</label>
                <div class="col-sm-8">
                  <input type="text" name="Terbilang" value="" class="form-control" required id="Terbilang">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPembayaran">
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Detail Surat Perintah Setor</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian</label>
                <div class="col-sm-8">
                  <input type="text" name="Uraian" value="" class="form-control" id="Uraian">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Biaya</label>
                <div class="col-sm-4">
                  <input type="text" name="Biaya" value="" class="form-control" id="Biaya" onkeypress="return isNumberKey(event)">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Banyak</label>
                <div class="col-sm-2">
                  <input type="text" name="Banyak" value="" class="form-control" id="Banyak" onkeypress="return isNumberKey(event)">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-4"><br>
                       <button type="button" id="addRow" class="btn btn-info" name="addRow">Tambah Detail SPS</button>
                       <button type="button" id="deleteRow" class="btn btn-danger" name="deleteRow">Hapus Detail SPS</button><br><br>
                    </div>
              </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                   <table id="DataTableDetailSPS" class="datatable table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                <th>Uraian</th>
                                <th>Banyak</th>
                                <th>Biaya</th>
                              </tr>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                              <tr>
                                <th>Uraian</th>
                                <th>Banyak</th>
                                <th>Biaya</th>
                              </tr>
                          </tfoot>
                       </table>
                 </div>
                 <div class="col-md-12">
                   <div class="form-group"><br><br>
                          <label class="col-md-10 control-label">Total Biaya</label>
                          <div class="col-md-2">
                               <input type="text" id="TotalBiaya" name="TotalBiaya" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                          </div>
                   </div><br><br><br>
                 </div>
                 <!-- <div class="col-md-6">
                   <div class="form-group">
                     <label for="focusedinput" class="col-sm-4 control-label">Tanggal Validasi Bayar</label>
                     <div class="col-sm-3">
                       <input type="date" name="TanggalTerimaBayar" value="" required class="form-control" id="TanggalTerimaBayar">
                     </div>
                   </div>
                 </div> -->
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="focusedinput" class="col-sm-4 control-label">Luas (m2)</label>
                     <div class="col-sm-2" id="DivLuas">

                     </div>
                     <!-- <div class="col-sm-2">
                       <input type="text" name="Luas" value="" class="form-control" id="Luas" onkeypress="return isNumberKey(event)">
                     </div> -->
                   </div>
                   <!-- <div class="form-group">
                     <label for="focusedinput" class="col-sm-4 control-label">Jumlah</label>
                     <div class="col-sm-2">
                       <input type="text" name="Jumlah" value="" class="form-control" id="JumlahS" onkeypress="return isNumberKey(event)">
                     </div>
                   </div> -->
                 </div>
              </div>
          </div>
        </div>
    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPembayaran">
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Berkas Permohonan</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Berkas</label>
                <div class="col-sm-2" id="DivNomorBerkas">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Kode Di 301</label>
                <div class="col-sm-2" id="DivKodeDi301">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Kode Di 302</label>
                <div class="col-sm-2" id="DivKodeDi302">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Kode Di 305</label>
                <div class="col-sm-2" id="DivKodeDi305">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Kode Di 306</label>
                <div class="col-sm-2" id="DivKodeDi306">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Permohonan</label>
                <div class="col-sm-3">
                  <input type="date" name="TanggalPermohonan" value="" class="form-control" required id="TanggalPermohonan">
                </div>
              </div> -->
              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Berkas Masuk</label>
                <div class="col-sm-3">
                  <input type="date" name="TanggalBerkasMasuk" value="" class="form-control" required id="TanggalBerkasMasuk">
                </div>
              </div> -->
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Berkas Valid</label>
                <div class="col-sm-3">
                  <input type="date" name="TanggalBerkasValid" value="" class="form-control" id="TanggalBerkasValid" >
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Disposisi</label>
                <div class="col-sm-8">
                  <input type="text" name="Disposisi" value="" class="form-control" id="Disposisi" >
                </div>
              </div>
              <div class="form-group">
                <!-- <label for="focusedinput" class="col-sm-4 control-label">Nomor Hak</label> -->
                <div class="col-sm-3" id="DivNomorHak">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="">
    	<div class="col-md-5">
    	</div>
    	<div class="col-md-6">
    		<input type="submit" value="Validasi Pembayaran Formulir Permohonan" class="btn btn-success"><br><br>
        <!-- <input type="reset" value="Ulang Formulir Permohonan" class="btn btn-primary"> -->
    	</div>
    </div>
</form>
@endsection

@section('Script')
<script type="text/javascript">
var IDFormulirPermohonan;
var TotalBiaya = 0;

var ArrayBiaya = new Array();
var ArrayBanyak = new Array();
var ArrayUraian = new Array();

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function isNumberKeyCrash(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 47)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$(document).ready(function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiTagihan(IDFormulirPermohonan);
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivNamaTerima(IDFormulirPermohonan);
    DivLuas(IDFormulirPermohonan);
    DivKodeDi301(IDFormulirPermohonan);
    DivKodeDi302(IDFormulirPermohonan);
    DivKodeDi305(IDFormulirPermohonan);
    DivKodeDi306(IDFormulirPermohonan);
    DivNomorHak(IDFormulirPermohonan);
    DivNomorBerkas();

    var t = $('#DataTableDetailSPS').DataTable();

    $('#addRow').on( 'click', function () {
        Biaya = $('#Biaya').val();
        ArrayBiaya.push(Biaya);
        $('<input>').attr({
          type:'hidden',
          name:'ArrayBiaya[]',
          value:Biaya
        }).appendTo('form');

        Banyak = $('#Banyak').val();
        ArrayBanyak.push(Banyak);
        $('<input>').attr({
          type:'hidden',
          name:'ArrayBanyak[]',
          value:Banyak
        }).appendTo('form');

        Uraian = $('#Uraian').val();
        ArrayUraian.push(Uraian);
        $('<input>').attr({
          type:'hidden',
          name:'ArrayUraian[]',
          value:Uraian
        }).appendTo('form');

        t.row.add([
            Uraian,
            Banyak,
            Biaya,
        ] ).draw(true);

        TotalBiaya += parseInt(Biaya);
        $('#TotalBiaya').val(TotalBiaya);
    });

    $('#DataTableDetailSPS tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
           t.$('tr.selected').removeClass('selected');
           $(this).addClass('selected');
           Index = t.row( this ).index();
        }
    } );

    $('#deleteRow').click( function () {
        t.row('.selected').remove().draw( false );

        TotalBiaya -= parseInt(ArrayBiaya[Index]);
        $('#TotalBiaya').val(TotalBiaya);

        ArrayBiaya.splice(Index, 1);
        ArrayBanyak.splice(Index, 1);
        ArrayUraian.splice(Index, 1);

    });
});

$(document).on('change', '#IDFormulirPermohonan', function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivNamaTerima(IDFormulirPermohonan);
    DivInformasiTagihan(IDFormulirPermohonan);;
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivLuas(IDFormulirPermohonan);
    DivNomorBerkas();
    DivKodeDi301(IDFormulirPermohonan);
    DivKodeDi302(IDFormulirPermohonan);
    DivKodeDi305(IDFormulirPermohonan);
    DivKodeDi306(IDFormulirPermohonan);
    DivNomorHak(IDFormulirPermohonan);
    ClearForm();
});

function DivInformasiTagihan(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/PembayaranTagihan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiTagihan').empty();
        $("#InformasiTagihan").html(responseText);
    }
    });
}

function DivInformasiFP(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/ValidasiPembayaranFP.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiFP').empty();
        $("#InformasiFP").html(responseText);
    }
    });
}

function DivNamaTerima(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/NamaTerima.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivNamaTerima').empty();
        $("#DivNamaTerima").html(responseText);
    }
    });
}

function DivLuas(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/Luas.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivLuas').empty();
        $("#DivLuas").html(responseText);
    }
    });
}

function DivNomorBerkas()
{
    $.ajax({
    url: "ajax/NomorBerkas.php",
    context: document.body,
    success: function(responseText) {
        $('#DivNomorBerkas').empty();
        $("#DivNomorBerkas").html(responseText);
    }
    });
}

function DivNomorHak()
{
    $.ajax({
    url: "ajax/NomorHak.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivNomorHak').empty();
        $("#DivNomorHak").html(responseText);
    }
    });
}

function DivKodeDi301(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/KodeDi301.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivKodeDi301').empty();
        $("#DivKodeDi301").html(responseText);
    }
    });
}

function DivKodeDi302(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/KodeDi302.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivKodeDi302').empty();
        $("#DivKodeDi302").html(responseText);
    }
    });
}

function DivKodeDi305(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/KodeDi305.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivKodeDi305').empty();
        $("#DivKodeDi305").html(responseText);
    }
    });
}

function DivKodeDi306(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/KodeDi306.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivKodeDi306').empty();
        $("#DivKodeDi306").html(responseText);
    }
    });
}
function DivInformasiFPPersyaratan(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/ValidasiPembayaranFPPersyaratan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiPersyaratan').empty();
        $("#InformasiPersyaratan").html(responseText);
    }
    });
}

function ClearForm() {
    ArrayBiaya = new Array();
    ArrayBanyak = new Array();
    ArrayUraian = new Array();

    document.getElementById("NomorDaftarIsian").value="";
    document.getElementById("Biaya").value="";
    document.getElementById("Banyak").value="";
    document.getElementById("TanggalTerimaBayar").value="";
    document.getElementById("JumlahS").value="";
    document.getElementById("Luas").value="";
    document.getElementById("TotalBiaya").value="";

    var table = $('#DataTableDetailSPS').DataTable();
    table.clear().draw();
}
</script>
@endsection
