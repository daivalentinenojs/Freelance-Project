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
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
            <div class="panel-heading">
               <h3 class="panel-title">Beranda</h3>
            </div>

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
                                  <th style="text-align:center;">Detail</th>
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
                                 <th style="text-align:center;">Detail</th>
                             </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
            </div>
         </div>
</div>
@endsection

@section('Script')
<script type="text/javascript">
$(document).ready(function() {
   var dataTable = $('#DataTableFormulirPermohonan').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxDashboard",
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
         },
         {"data": 8,
             "render" : function ( data, type, full, meta ) {
               return '<a data-toggle=\'tooltip\' data-placement=\'top\' class=\'btn btn-info\' href=ViewFormulirPermohonan/'+data+'><span class="fa fa-search"></span></a>';
             }
         }
         ],
      "order":[[0, 'asc']]
   });

});
</script>
@endsection
