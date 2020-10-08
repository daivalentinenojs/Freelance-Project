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
             	<h3 class="panel-title">Formulir Permohonan</h3>
          	</div>

            	<div class="panel-body">
                <div class="col-md-6">
          				<div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Nama Kuasa</label>
          					<div class="col-sm-6">
          						<input type="text" name="NamaKuasa" class="form-control" id="NamaKuasa">
          					</div>
          				</div>

                  <div class="form-group">
                      <label for="focusedinput" class="col-sm-4 control-label">File Formulir Permohonan</label>
                      <div class="col-md-8">
                          <input type="file" name="FileFormulirPermohonan" required id="FileFormulirPermohonan" class="file" data-preview-file-type="any"/>
                      </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Alamat Kuasa</label>
          					<div class="col-sm-8">
          						<input type="text" name="AlamatKuasa" class="form-control" id="AlamatKuasa">
          					</div>
          				</div>

                  <div class="form-group">
          					<label for="focusedinput" class="col-sm-4 control-label">Alamat Tanah</label>
          					<div class="col-sm-8">
          						<input type="text" name="AlamatTanah" class="form-control" required id="AlamatTanah">
          					</div>
          				</div>
                </div>
            </div>
       </div>
    </div>
    <br>
    <div class="col-md-12 scCol" style="background:white;">
        <div class="panel panel-success" id="grid_block_5">
            <div class="panel-heading">
              <h3 class="panel-title">Persyaratan</h3>
            </div>

              <div class="panel-body">
                <div class="col-md-6">
              			<div class="form-group">
              				<label for="focusedinput" class="col-sm-4 control-label">Nama Pemohon</label>
              				<div class="col-sm-6">
              					<input type="text" name="NamaPemohon" class="form-control" required id="NamaPemohon">
              				</div>
              			</div>

                    <div class="form-group">
              				<label for="focusedinput" class="col-sm-4 control-label">Nomor Buku Huruf C</label>
              				<div class="col-sm-3">
              					<input type="text" name="NomorBukuHurufC" class="form-control" required id="NomorBukuHurufC" onkeypress="return isNumberKey(event)">
              				</div>
              			</div>

              			<div class="form-group">
              				<label for="focusedinput" class="col-sm-4 control-label">Persil No Letter C</label>
              				<div class="col-sm-3">
              					<input type="text" name="PersilNoLetterC" class="form-control" required id="PersilNoLetterC" onkeypress="return isNumberKey(event)">
              				</div>
              			</div>

                    <div class="form-group">
                      <label for="focusedinput" class="col-sm-4 control-label">Kelas Letter C</label>
                      <div class="col-sm-3">
                        <input type="text" name="KelasLetterC" class="form-control" required id="KelasLetterC" onkeypress="return isNumberKey(event)">
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="focusedinput" class="col-sm-4 control-label">Jenis Tanah Letter C</label>
                    <div class="col-sm-6">
                      <input type="text" name="JenisTanahLetterC" class="form-control" required id="JenisTanahLetterC">
                    </div>
                  </div>

              			<div class="form-group">
              				<label for="focusedinput" class="col-sm-4 control-label">Luas Daerah Letter C (m2)</label>
              				<div class="col-sm-3">
              					<input type="text" name="LuasDaerahLetterC" class="form-control" required id="LuasDaerahLetterC" onkeypress="return isNumberKey(event)">
              				</div>
              			</div>

                    <div class="form-group">
              				<label for="focusedinput" class="col-sm-4 control-label">Luas Tanah Letter C (m2)</label>
              				<div class="col-sm-3">
              					<input type="text" name="LuasTanahLetterC" class="form-control" required id="LuasTanahLetterC" onkeypress="return isNumberKey(event)">
              				</div>
              			</div>

              			<div class="form-group">
              				<label for="focusedinput" class="col-sm-4 control-label">Status Tanah</label>
              				<div class="col-sm-4">
              					<select class="form-control select" name="StatusTanah" required id="StatusTanah" data-live-search="true">
              						<option value="1">Hak Milik</option>
              						<!-- <option value="2">Hak Guna Bangunan</option>
                          <option value="3">Hak Pakai</option> -->
              					</select>
              				</div>
              			</div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-4 control-label">File Persyaratan</label>
                        <div class="col-md-8">
                            <input type="file" name="FilePersyaratan[]" required id="FilePersyaratan" multiple class="file" data-preview-file-type="any"/>
                        </div>
                    </div>
                  </div>
    		      </div>
    	</div>
      <br><br>
        <div class="panel panel-success" id="grid_block_5">
            <div class="panel-heading">
              <h3 class="panel-title">Jenis Persyaratan</h3>
            </div>

              <div class="panel-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="focusedinput" class="col-sm-4 control-label">Jenis Persyaratan</label>
                    <div class="col-sm-4">
                      <select class="form-control select" name="JenisPersyaratan" required id="JenisPersyaratan" data-live-search="true">
                        <option value="1">Warisan</option>
                        <option value="2">Hibah</option>
                        <option value="3">Pembelian</option>
                        <option value="4">Pelelangan</option>
                        <option value="5">Pemberian Hak</option>
                        <option value="6">Wakaf</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="focusedinput" class="col-sm-4 control-label">Batas Utara</label>
                    <div class="col-sm-3">
                      <input type="text" name="BatasUtara" class="form-control" required id="BatasUtara">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="focusedinput" class="col-sm-4 control-label">Batas Barat</label>
                    <div class="col-sm-3">
                      <input type="text" name="BatasBarat" class="form-control" required id="BatasBarat">
                    </div>
                  </div>
                </div>
                <div class="col-md-6"><br><br><br>
                  <div class="form-group">
                    <label for="focusedinput" class="col-sm-4 control-label">Batas Selatan</label>
                    <div class="col-sm-3">
                      <input type="text" name="BatasSelatan" class="form-control" required id="BatasSelatan">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="focusedinput" class="col-sm-4 control-label">Batas Timur</label>
                    <div class="col-sm-3">
                      <input type="text" name="BatasTimur" class="form-control" required id="BatasTimur">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" id="DivJenisPersyaratan">
                </div>
            </div>
      </div>
      <div class="">
        <div class="col-md-5">
        </div>
        <div class="col-md-4">
          <input type="submit" value="Simpan Formulir Permohonan" class="btn btn-success">
        </div>
      </div>
    </div>
</form>

<div class="col-md-12 scCol" style="background:white;"><br><br>
  <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">Tabel Informasi Formulir Permohonan</h3>
      </div>
      <div class="panel-body">
          <table class="table" id="DataTableFormulirPermohonan">
              <thead>
                  <tr>
                      <th style="text-align:center;">ID</th>
                      <th style="text-align:center;">Nama Kuasa</th>
                      <th style="text-align:center;">Alamat Tanah</th>
                      <th style="text-align:center;">Pemohon</th>
                      <th style="text-align:center;">Jenis Tanah Letter C</th>
                      <th style="text-align:center;">Luas Daerah Letter C</th>
                      <th style="text-align:center;">Status Tanah</th>
                      <th style="text-align:center;">Status Form Permohonan</th>
                  </tr>
              </thead>
              <tfoot>
                 <tr>
                     <th style="text-align:center;">ID</th>
                     <th style="text-align:center;">Nama Kuasa</th>
                     <th style="text-align:center;">Alamat Tanah</th>
                     <th style="text-align:center;">Pemohon</th>
                     <th style="text-align:center;">Jenis Tanah Letter C</th>
                     <th style="text-align:center;">Luas Daerah Letter C</th>
                     <th style="text-align:center;">Status Tanah</th>
                     <th style="text-align:center;">Status Form Permohonan</th>
                 </tr>
              </tfoot>
          </table>
      </div>
  </div>
</div>

<!-- Awal Group Box Help and Hint-->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-info" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Bantuan Informasi</h3>
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-4">
                     <div class="form-group">
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengetahui informasi detail dari Formulir Permohonan.</b>
                     </div>
                  </div>

                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Setiap list akan menampilkan 10 item dalam 1 halaman.</b>
                     </div>
                     <div class="form-group">
                           <b>2. Jika Anda ingin mengetahui halaman selanjutnya, Anda dapat menekan tombol selanjutnya yang terletak di kanan bawah tabel.</b>
                     </div>
                     <div class="form-group">
                           <b>3. Fitur [Search] terletak di kanan atas dari tabel untuk mencari informasi Formulir Permohonan dengan cepat.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help and Hint -->
@endsection

@section('Script')
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$(document).ready(function() {
   var dataTable = $('#DataTableFormulirPermohonan').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxPengajuanFP",
         type: "get",
      },
      "columns":[
         {"data":0,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":1,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         },
         {"data":2,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         },
         {"data":3,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         },
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         },
         {"data":5,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:right">'+data+'</div>';
            }
         },
         {"data":6,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         },
         {"data":7,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });

   IDJenisPersyaratan = $('#JenisPersyaratan').val();
   DivJenisPersyaratan(IDJenisPersyaratan);
});

$(document).on('change', '#JenisPersyaratan', function()
{
    IDJenisPersyaratan = $('#JenisPersyaratan').val();
    DivJenisPersyaratan(IDJenisPersyaratan);
});

function DivJenisPersyaratan(IDJenisPersyaratan)
{
    $.ajax({
    url: "ajax/JenisPersyaratan.php?IDJP="+IDJenisPersyaratan,
    context: document.body,
    success: function(responseText) {
        $('#DivJenisPersyaratan').empty();
        $("#DivJenisPersyaratan").html(responseText);
    }
    });
}
</script>
@endsection
