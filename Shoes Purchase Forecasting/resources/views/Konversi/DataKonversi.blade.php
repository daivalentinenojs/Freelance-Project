<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Konversi Barang')

@section('Title','Sistem Informasi Forecasting')
@section('Nama','Sistem Informasi Forecasting')

@section('FotoLogin',url('foto/perusahaan.png'))
@section('ID')
   {{$Name}}
@endsection

@section('NamaLogin')
   {{$Jabatan}}
@endsection

@section('Navigasi')
   @include('../Navigasi/Navigasi')
@endsection

@section('isi')
<!-- Awal Group Box Daftar Estimasi -->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Konversi Barang</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Konversi barang berisi semua data pembukaan box sepatu baru agar dapat dijual per sepasang sepatu. Bila Anda ingin melihat detail, atau menambah data Konversi dapat menekan icon tombol <i>View</i>, Tambah</p><br>
          <div class="col-md-2 pull-right">
             <a class="btn btn-success" href="DataKonversiDetail"><i class="fa fa-plus"></i> Tambah Data Konversi</a>
          <br><br></div>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Tabel Data Konversi Barang</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTableKonversi">
                      <thead>
                          <tr>
                            <th style="text-align:center;">Nomor</th>
                            <th style="text-align:center;">Nama Box</th>
                            <th style="text-align:center;">Tanggal Buka</th>
                            <th style="text-align:center;">Jumlah Buka</th>
                            <th style="text-align:center;">Detail</th>
                          </tr>
                      </thead>

                      <tfoot>
                          <tr>
                            <th style="text-align:center;">Nomor</th>
                            <th style="text-align:center;">Nama Box</th>
                            <th style="text-align:center;">Tanggal Buka</th>
                            <th style="text-align:center;">Jumlah Buka</th>
                            <th style="text-align:center;">Detail</th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
          </div>
          <!-- END DEFAULT DATATABLE -->
      </div>
   </div>
</div>
<!-- Akhir Group Box Daftar Estimasi -->

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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail data Konversi.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>Untuk mengubah data Konversi.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-trash-o"></span>&nbsp;&nbsp;&nbsp;<b>Untuk menghapus data Konversi.</b>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Detail Konversi Barang</h4>
           </div>
           <div class="modal-body">
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
           </div>
       </div>
   </div>
</div>
<!-- Akhir MyModal-->

<script type="text/javascript">
$(document).ready(function() {
   var dataTable = $('#DataTableKonversi').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/KonversiIndex.php",
         type: "get",
      },
      "columns":[
         {"data":0},
         {"data":1},
         {"data":2},
         {"data":3},
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataKonversi" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         }/*,
         {"data":7,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataNotaBeli" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }*/
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','.ViewDataKonversi',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/NotaKonversiModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

/*
$(function(){
   $(document).on('click','#CreateDataKonversi',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/KonversiModalCreate.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.ViewDataNotaBeli',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/NotaBeliModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataNotaBeli',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/NotaBeliModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});*/
</script>
@endsection
