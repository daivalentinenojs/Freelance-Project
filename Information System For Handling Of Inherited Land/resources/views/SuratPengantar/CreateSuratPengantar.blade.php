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
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Surat Pengantar</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Pengantar</label>
                <div class="col-sm-6" id="DivNomorSuratPengantar">
                </div>
              </div>
              <div class="form-group">
                  <label for="focusedinput" class="col-sm-4 control-label">File Surat Pengantar</label>
                  <div class="col-md-8">
                      <input type="file" name="FileSuratPengantar" id="FileSuratPengantar" class="file" data-preview-file-type="any"/>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Sanggahan</label>
                <div class="col-sm-6">
                  <input type="text" name="Sanggahan" value="" class="form-control" id="Sanggahan">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-success" id="grid_block_5">
          	<div class="panel-heading">
             	<h3 class="panel-title">Informasi Detail Surat Pengantar</h3>
          	</div>

            	<div class="panel-body">
                <div class="col-md-6">
          				<div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Keterangan</label>
          					<div class="col-sm-8">
          						<input type="text" name="Keterangan" class="form-control" id="Keterangan">
          					</div>
          				</div>

                  <div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Naskah</label>
          					<div class="col-sm-4">
          						<input type="text" name="Naskah" class="form-control" id="Naskah">
          					</div>
          				</div>
                </div>

                <div class="col-md-6">

                  <div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Jumlah</label>
          					<div class="col-sm-4">
          						<input type="text" name="Jumlah" class="form-control" required id="Jumlah" onkeypress="return isNumberKey(event)">
          					</div>
          				</div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-4"><br>
                           <button type="button" id="addRow" class="btn btn-info" name="addRow">Tambah Detail Surat Pengantar</button>
                           <button type="button" id="deleteRow" class="btn btn-danger" name="deleteRow">Hapus Detail Surat Pengantar</button><br><br>
                        </div>
                  </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                       <table id="DataTableDetailSuratPengantar" class="datatable table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>Keterangan</th>
                                    <th>Naskah</th>
                                    <th>Jumlah</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>
                                  <tr>
                                    <th>Keterangan</th>
                                    <th>Naskah</th>
                                    <th>Jumlah</th>
                                  </tr>
                              </tfoot>
                           </table>
                     </div><br>
                  </div>
            </div>
       </div>
        <div class="">
        	<div class="col-md-5">
        	</div>
        	<div class="col-md-4">
        		<input type="submit" value="Ajukan Surat Pengantar" class="btn btn-success"><br><br>
        	</div>
        </div>
    </div>

</form>
@endsection

@section('Script')
<script type="text/javascript">
var IDFormulirPermohonan;

var ArrayKeterangan = new Array();
var ArrayNaskah = new Array();
var ArrayJumlah = new Array();

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
    DivInformasiBerkasPengumuman(IDFormulirPermohonan);
    DivInformasiRisalah(IDFormulirPermohonan);
    DivNomorSuratPengantar(IDFormulirPermohonan);

    var t = $('#DataTableDetailSuratPengantar').DataTable();

    $('#addRow').on( 'click', function () {
        Keterangan = $('#Keterangan').val();
        ArrayKeterangan.push(Keterangan);
        $('<input>').attr({
          type:'hidden',
          name:'ArrayKeterangan[]',
          value:Keterangan
        }).appendTo('form');

        Naskah = $('#Naskah').val();
        ArrayNaskah.push(Naskah);
        $('<input>').attr({
          type:'hidden',
          name:'ArrayNaskah[]',
          value:Naskah
        }).appendTo('form');

        Jumlah = $('#Jumlah').val();
        ArrayJumlah.push(Jumlah);
        $('<input>').attr({
          type:'hidden',
          name:'ArrayJumlah[]',
          value:Jumlah
        }).appendTo('form');

        t.row.add([
            Keterangan,
            Naskah,
            Jumlah,
        ] ).draw(true);

    });

    $('#DataTableDetailSuratPengantar tbody').on( 'click', 'tr', function () {
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

        ArrayKeterangan.splice(Index, 1);
        ArrayNaskah.splice(Index, 1);
        ArrayJumlah.splice(Index, 1);

    });
});

$(document).on('change', '#IDFormulirPermohonan', function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivInformasiBerkasPengumuman(IDFormulirPermohonan);
    DivInformasiRisalah(IDFormulirPermohonan);
    DivNomorSuratPengantar(IDFormulirPermohonan);
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
    url: "ajax/VerifikasiSuratPengantar.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiBerkasPengumuman').empty();
        $("#InformasiBerkasPengumuman").html(responseText);
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

function DivNomorSuratPengantar(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/NomorSuratPengantar.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivNomorSuratPengantar').empty();
        $("#DivNomorSuratPengantar").html(responseText);
    }
    });
}
</script>
@endsection
