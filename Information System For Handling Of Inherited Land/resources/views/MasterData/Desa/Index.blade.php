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
<div class="col-md-12 scCol" style="background:white;">
    <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Informasi Desa</h3>
      </div>

      <!-- Awal Informasi Pra Estimasi -->
      <div class="panel-body">
         @foreach ($errors->all() as $error)
         <p class="alert alert-danger">{{ $error }}</p>
         @endforeach
         @if (session('status'))
             <div class="alert alert-success">
                 {{ session('status') }}
             </div>
         @endif
          <p>Halaman ini merupakan halaman informasi master data 'Desa'. Halaman informasi master data 'Desa' digunakan untuk mencari, menambah, dan mengubah informasi 'Desa' yang terdaftar.</p><br>
          <div class="panel-body col-md-12">
             <div class="form-group">
                <button id="CreateDataDesa" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Data Desa</button>
             </div>
          </div>

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Tabel Informasi Master Data Desa</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTableDesa">
                      <thead>
                          <tr>
                              <th style="text-align:center;">ID</th>
                              <th style="text-align:center;">Nama</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">Detail</th>
                              <th style="text-align:center;">Ubah</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                              <th style="text-align:center;">ID</th>
                              <th style="text-align:center;">Nama</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">Detail</th>
                              <th style="text-align:center;">Ubah</th>
                         </tr>
                      </tfoot>
                  </table>
              </div>
          </div>
          <!-- END DEFAULT DATATABLE -->
          <!-- Akhir Isi Konten -->
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengetahui informasi detail dari master data 'Desa'.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengubah informasi detail dari master data 'Desa'.</b>
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
                           <b>3. Fitur [Search] terletak di kanan atas dari tabel untuk mencari informasi master data 'Desa' dengan cepat.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help and Hint -->

<!-- Awal MyModal-->
<div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Tambah Desa</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahDesa" name="FormTambahDesa" method="POST">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Nama Desa</label>
                                     <div class="col-md-4">
                                          <input type="text" name="NamaDesa" required class="form-control" value="" placeholder="Nama Desa" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="submit" id="BtnCreateDesa" name="BtnCreateDesa" value="Tambah" class="btn btn-success">
                               </div>
                           </div>
                      </div>
                </div>
              </form>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
           </div>
       </div>
   </div>
</div>

<div class="modal fade" id="myModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Detail Desa</h4>
           </div>
           <div class="modal-body-view" id="modal-body-view">

           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
           </div>
       </div>
   </div>
</div>

<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Ubah Desa</h4>
           </div>
           <div class="modal-body-edit" id="modal-body-edit">

           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
           </div>
       </div>
   </div>
</div>
<!-- Akhir MyModel-->
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
   var dataTable = $('#DataTableDesa').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxDesa",
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
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":2,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":3,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataDesa" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataDesa" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataDesa',function(e){
       e.preventDefault();
       $("#myModalCreate").modal('show');
   });
});

$(function(){
   $(document).on('click','.ViewDataDesa',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Desa/DesaModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataDesa',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Desa/DesaModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
