<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Penjualan')

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
         <h3 class="panel-title">Data Penjualan</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Penjualan berisi semua data Penjualan yang terjual oleh PT Violatama Inti Sejati Surabaya. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data penjualan dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>
          <div class="col-md-2 pull-right">
             <button id="CreateDataPenjualan" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Penjualan</button>
          <br><br></div>

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
                  <h3 class="panel-title">Tabel Informasi Penjualan</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTablePenjualan">
                      <thead>
                          <tr>
                              <th style="text-align:center;">Nomor</th>
                              <th style="text-align:center;">Nama Toko Pemesan</th>
                              <th style="text-align:center;">Nama Sepatu</th>
                              <th style="text-align:center;">Ukuran Box</th>
                              <th style="text-align:center;">Warna</th>
                              <th style="text-align:center;">Jumlah</th>
                              <th style="text-align:center;">Tanggal Pesan</th>
                              <th style="text-align:center;">Dibuat Oleh</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">Status Daftar</th>
                              <th style="text-align:center;">Detail</th>
                              <th style="text-align:center;">Ubah</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                           <th style="text-align:center;">Nomor</th>
                           <th style="text-align:center;">Nama Toko Pemesan</th>
                           <th style="text-align:center;">Nama Sepatu</th>
                           <th style="text-align:center;">Ukuran Box</th>
                           <th style="text-align:center;">Warna</th>
                           <th style="text-align:center;">Jumlah</th>
                           <th style="text-align:center;">Tanggal Pesan</th>
                           <th style="text-align:center;">Dibuat Oleh</th>
                           <th style="text-align:center;">Status</th>
                           <th style="text-align:center;">Status Daftar</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail data pesanan.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>Untuk mengubah data pesanan.</b>
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
               <h4 class="modal-title" id="myModalLabel">Detail Penjualan</h4>
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
   var dataTable = $('#DataTablePenjualan').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/PenjualanIndex.php",
         type: "get",
      },
      "columns":[
         {"data":0},
         {"data":1},
         {"data":2},
         {"data":3},
         {"data":4},
         {"data":5},
         {"data":6},
         {"data":7},
         {"data":8},
         {"data":9},
         {"data":10,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataPenjualan" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":11,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataPenjualan" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataPenjualan',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/PenjualanModalCreate.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.ViewDataPenjualan',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/PenjualanModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataPenjualan',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/PenjualanModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});
</script>
@endsection
