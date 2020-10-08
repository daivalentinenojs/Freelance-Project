<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Kategori')

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
<!-- Awal Informasi Dashboard -->

<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
         <div class="panel-heading">
            <h3 class="panel-title">Informasi Kategori</h3>
            <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
         </div>

         <!-- Awal Informasi Pra Estimasi -->

         <div class="panel-body">
             <p>Halaman ini adalah halaman informasi kategori. Halaman Informasi Kategori digunakan untuk <strong>mencari</strong>, <strong>menambah</strong>, dan <strong>mengubah</strong> data kategori yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
             <div class="panel-body col-md-12">
                <div class="form-group">
                   <button id="CreateDataKategori" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i> Tambah Data Kategori</button>
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
                     <h3 class="panel-title">Tabel Informasi Kategori</h3>
                 </div>
                 <div class="panel-body">
                     <table class="table" id="DataTableKategori">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">ID Kategori</th>
                                 <th style="text-align:center;">Nama Kategori</th>
                                 <th style="text-align:center;">Status Terdaftar</th>
                                 <th style="text-align:center;">Detail</th>
                                 <th style="text-align:center;">Ubah</th>
                             </tr>
                         </thead>
                         <tfoot>
                            <tr>
                                 <th style="text-align:center;">ID Kategori</th>
                                 <th style="text-align:center;">Nama Kategori</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail data kategori.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>Untuk mengubah data kategori.</b>
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
               <h4 class="modal-title" id="myModalLabel">Tambah Data Kategori</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahKategori" name="FormTambahKategori" method="POST">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Nama Kategori:</label>
                                     <div class="col-md-5">
                                          <input type="text" name="NamaKategori" required class="form-control" value="" placeholder="Masukkan Nama Kategori" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="button" id="TambahKategori" name="BtnCreateKategori" value="Tambah" class="btn btn-success">
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
               <h4 class="modal-title" id="myModalLabel">Detail Kategori</h4>
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
               <h4 class="modal-title" id="myModalLabel">Ubah Kategori</h4>
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
   var dataTable = $('#DataTableKategori').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/KategoriIndex.php",
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
               return '<div style="text-align:center"><a href="#" class="ViewDataKategori" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataKategori" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataKategori',function(e){
       e.preventDefault();
       $("#myModalCreate").modal('show');
      
   });
});

$(function(){
   $(document).on('click','.ViewDataKategori',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Kategori/KategoriModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataKategori',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Kategori/KategoriModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});

$('#TambahKategori').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Kategori ?",
    function() {
      $("#FormTambahKategori").submit();
      alertify.success('Data Kategori Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Kategori Anda dibatalkan');
    });
});
</script>
@endsection
