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
    <div class="col-md-12 scCol" style="background:white;">
        <div class="panel panel-success" id="grid_block_5">
          	<div class="panel-heading">
             	<h3 class="panel-title">Tagihan</h3>
          	</div>

            	<div class="panel-body">
                <div class="col-md-6">
          				<div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Uraian</label>
          					<div class="col-sm-8">
          						<input type="text" name="Uraian" class="form-control" id="Uraian">
          					</div>
          				</div>

                  <div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Banyak</label>
          					<div class="col-sm-4">
          						<input type="text" name="Banyak" class="form-control" id="Banyak" onkeypress="return isNumberKey(event)">
          					</div>
          				</div>
                </div>

                <div class="col-md-6">

                  <div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Biaya</label>
          					<div class="col-sm-4">
          						<input type="text" name="Biaya" class="form-control" required id="Biaya" onkeypress="return isNumberKey(event)">
          					</div>
          				</div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-4"><br>
                           <button type="button" id="addRow" class="btn btn-info" name="addRow">Tambah Tagihan</button>
                           <button type="button" id="deleteRow" class="btn btn-danger" name="deleteRow">Hapus Tagihan</button><br><br>
                        </div>
                  </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                       <table id="DataTableTagihan" class="datatable table-bordered" cellspacing="0" width="100%">
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
                     <div class="form-group"><br><br>
                            <label class="col-md-10 control-label">Total Biaya</label>
                            <div class="col-md-2">
                                 <input type="text" id="Jumlah" name="Jumlah" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                            </div>
                     </div><br>
                  </div>
            </div>
       </div>
    </div>
    <div class="col-md-12 scCol" style="background:white;">
      <div class="">
      	<div class="col-md-5">
      	</div>
      	<div class="col-md-4">
      		<input type="submit" value="Validasi Pengajuan Formulir Permohonan" class="btn btn-success"><br><br>
      	</div>
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

    var t = $('#DataTableTagihan').DataTable();

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
        $('#Jumlah').val(TotalBiaya);
    });

    $('#DataTableTagihan tbody').on( 'click', 'tr', function () {
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
        $('#Jumlah').val(TotalBiaya);

        ArrayBiaya.splice(Index, 1);
        ArrayBanyak.splice(Index, 1);
        ArrayUraian.splice(Index, 1);

    });
});

$(document).on('change', '#IDFormulirPermohonan', function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
});

function DivInformasiFP(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/ValidasiPengajuanFP.php?IDFP="+IDFormulirPermohonan,
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
    url: "ajax/ValidasiPengajuanFPPersyaratan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiPersyaratan').empty();
        $("#InformasiPersyaratan").html(responseText);
    }
    });
}
</script>
@endsection
