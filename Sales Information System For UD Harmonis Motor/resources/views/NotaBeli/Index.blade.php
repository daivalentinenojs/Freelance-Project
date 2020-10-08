<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Nota Beli')

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
         <h3 class="panel-title">Informasi Nota Beli</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

         <!-- Awal Informasi Pra Estimasi -->

         <div class="panel-body">
             <p>Halaman ini adalah halaman informasi nota beli. Halaman Informasi Nota Beli digunakan untuk <strong>mencari</strong> dan <strong>menambah</strong> data nota beli yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
             <div class="panel-body col-md-12">
                <div class="form-group pull-right">
                   <a class="btn btn-success" href="DataNotaBeliDetail"><i class="fa fa-plus"></i> Tambah Data Nota Beli</a>
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
                     <h3 class="panel-title">Tabel Informasi Nota Beli</h3>
                 </div>
                 <div class="panel-body">
                     <table class="table" id="DataTableNotaBeli">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">No Nota Beli</th>
                                 <th style="text-align:center;">Tanggal Buat</th>
                                 <th style="text-align:center;">Jatuh Tempo</th>
                                 <th style="text-align:center;">Total Akhir (Rp)</th>
                                 <th style="text-align:center;">Nama Pemasok</th>
                                 <th style="text-align:center;">Nama Karyawan</th>
                                 <th style="text-align:center;">Status Beli</th>
                                 <th style="text-align:center;">Detail</th>
                                 <th style="text-align:center;">Ubah Pembayaran</th>
                             </tr>
                         </thead>
                         <tfoot>
                            <tr>
                                 <th style="text-align:center;">No Nota Beli</th>
                                 <th style="text-align:center;">Tanggal Buat</th>
                                 <th style="text-align:center;">Jatuh Tempo</th>
                                 <th style="text-align:center;">Total Akhir (Rp)</th>
                                 <th style="text-align:center;">Nama Pemasok</th>
                                 <th style="text-align:center;">Nama Karyawan</th>
                                 <th style="text-align:center;">Status Beli</th>
                                 <th style="text-align:center;">Detail</th>
                                 <th style="text-align:center;">Ubah Pembayaran</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail data nota beli.</b>
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
<div class="modal fade" id="myModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Detail Nota Beli</h4>
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
               <h4 class="modal-title" id="myModalLabel">Ubah Pembayaran</h4>
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
   var dataTable = $('#DataTableNotaBeli').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/NotaBeliIndex.php",
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
               return '<div style="text-align:center"><a href="#" class="ViewDataNotaBeli" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataNotaBeli" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','.ViewDataNotaBeli',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/NotaBeli/NotaBeliModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataNotaBeli',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/NotaBeli/NotaBeliModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
