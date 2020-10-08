<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Pemasok')

@section('Title','Sistem Informasi Harmonis Motor')
@section('Nama','Sistem Informasi Harmonis Motor')

@section('FotoLogin',url('foto/karyawan/'.$ID.'.jpg'))

@section('ID')
   
@endsection

@section('NamaLogin')
   {{$Nama}}
@endsection

@section('Navigasi')
   @include('../Navigasi/Navigasi')
@endsection

@section('isi')
<!-- Awal Group Box Pra Estimasi -->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Informasi Pemasok</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Informasi Pra Estimasi -->
      <div class="panel-body">
          <p>Halaman ini adalah halaman informasi Pemasok. Halaman Informasi Pemasok digunakan untuk <strong>mencari</strong>, <strong>menambah</strong>, dan <strong>mengubah</strong> data Pemasok yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
          <div class="panel-body col-md-12">
             <div class="form-group">
                <button id="CreateDataPemasok" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i> Tambah Data Pemasok</button>
             </div>
          </div>
          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Tabel Informasi Pemasok</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTablePemasok">
                      <thead>
                          <tr>
                              <th style="text-align:center;">ID Pemasok</th>
                              <th style="text-align:center;">No Rekening</th>
                              <th style="text-align:center;">Nama Rekening</th>
                              <th style="text-align:center;">Bank</th>
                              <th style="text-align:center;">Alamat</th>
                              <th style="text-align:center;">No Telepon</th>
                              <th style="text-align:center;">Status Beli</th>
                              <th style="text-align:center;">Status Terdaftar</th>
                              <th style="text-align:center;">Detail</th>
                              <th style="text-align:center;">Ubah</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                              <th style="text-align:center;">ID Pemasok</th>
                              <th style="text-align:center;">No Rekening</th>
                              <th style="text-align:center;">Nama Rekening</th>
                              <th style="text-align:center;">Bank</th>
                              <th style="text-align:center;">Alamat</th>
                              <th style="text-align:center;">No Telepon</th>
                              <th style="text-align:center;">Status Beli</th>
                              <th style="text-align:center;">Status Terdaftar</th>
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

<!-- Awal Group Box Help dan Hint-->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-info" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Help dan Hint</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-4">
                     <div class="form-group">
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail data pemasok.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>Untuk mengubah data pemasok.</b>
                     </div>
                  </div>

                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Setiap Daftar hanya muncul 10 items dari daftar.</b>
                     </div>
                     <div class="form-group">
                           <b>2. Bila ingin melihat halaman berikutnya, silahkan klik bagian bawah kanan dari tabel Anda.</b>
                     </div>
                     <div class="form-group">
                           <b>3. Fitur [Cari] pada kanan atas dari tabel dapat diisi apapun berkaitan dengan kolom tabel yang muncul.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help dan Hint -->

<!-- Awal MyModal-->
<div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Tambah Data Pemasok</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahPemasok" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                               <div class="form-group">
                                     <label class="col-md-4 control-label">No Rekening:</label>
                                     <div class="col-md-5">
                                          <input type="text" name="NoRekening" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Masukkan No Rekening" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Nama Rekening:</label>
                                     <div class="col-md-5">
                                          <input type="text" name="NamaRekening" required class="form-control" value="" placeholder="Masukkan Nama Rekening" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Bank:</label>
                                     <div class="col-md-3">
                                          <input type="text" name="Bank" required class="form-control" value="" placeholder="Bank" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Alamat:</label>
                                     <div class="col-md-6">
                                          <textarea name="Alamat" required class="form-control" value="" placeholder="Masukkan Alamat" style="background:white; color:black;"></textarea>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">No Telepon:</label>
                                     <div class="col-md-4">
                                          <input type="text" name="NoTelepon" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Masukkan No Telepon" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                <label class="col-md-4 control-label">Foto:</label>
                                <div class="col-md-5">
                                      <input type="file" class="fileinput" required id="FotoPemasok" name="FotoPemasok"/>
                                </div>
                           </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="button" id="TambahPemasok" name="BtnCreatePemasok" value="Tambah" class="btn btn-success">
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
               <h4 class="modal-title" id="myModalLabel">Detail Pemasok</h4>
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
               <h4 class="modal-title" id="myModalLabel">Ubah Pemasok</h4>
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

<!-- Akhir Informasi Dashboard -->
<script type="text/javascript">
$(document).ready(function() {

   function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
  }

   var dataTable = $('#DataTablePemasok').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/PemasokIndex.php",
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
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":5,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":6,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":7,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataPemasok" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":9,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataPemasok" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

 function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
  }

$(function(){
   $(document).on('click','#CreateDataPemasok',function(e){
       e.preventDefault();
       $("#myModalCreate").modal('show');
   });
});

$(function(){
   $(document).on('click','.ViewDataPemasok',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Pemasok/PemasokModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
      );
   });
});

$(function(){
   $(document).on('click','.EditDataPemasok',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Pemasok/PemasokModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
      );
   });
});

$('#TambahPemasok').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Pemasok ?",
    function() {
      $("#FormTambahPemasok").submit();
      alertify.success('Data Pemasok Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Pemasok Anda dibatalkan');
    });
});
</script>
@endsection
