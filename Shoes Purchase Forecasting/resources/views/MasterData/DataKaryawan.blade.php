<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Karyawan')

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
         <h3 class="panel-title">Data Karyawan</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Karyawan berisi semua data karyawan yang bekerja pada PT Inti Sejati Surabaya. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data karyawan dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>
          <div class="col-md-2 pull-right">
             <button id="CreateDataKaryawan" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Karyawan</button>
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
                  <h3 class="panel-title">Tabel Informasi Karyawan</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTableKaryawan">
                      <thead>
                          <tr>
                            <th style="text-align:center;">ID</th>
                            <th style="text-align:center;">Nama</th>
                            <th style="text-align:center;">Email</th>
                            <th style="text-align:center;">Jabatan</th>
                            <th style="text-align:center;">Alamat</th>
                            <th style="text-align:center;">Telepon</th>
                            <th style="text-align:center;">Mulai Kerja</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Detail</th>
                            <th style="text-align:center;">Ubah</th>
                        </tr>
                    </thead>
                    <tfoot>
                       <tr>
                         <th style="text-align:center;">ID</th>
                         <th style="text-align:center;">Nama</th>
                         <th style="text-align:center;">Email</th>
                         <th style="text-align:center;">Jabatan</th>
                         <th style="text-align:center;">Alamat</th>
                         <th style="text-align:center;">Telepon</th>
                         <th style="text-align:center;">Mulai Kerja</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail data karyawan.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>Untuk mengubah data karyawan.</b>
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
               <h4 class="modal-title" id="myModalLabel">Detail Karyawan</h4>
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
   var dataTable = $('#DataTableKaryawan').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/KaryawanIndex.php",
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
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataKaryawan" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":9,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataKaryawan" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataKaryawan',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/KaryawanModalCreate.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.ViewDataKaryawan',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/KaryawanModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataKaryawan',function(e){
       e.preventDefault();
       $("#myModal").modal('show');
       $.post('modal/KaryawanModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body").html(html);
           }
       );
   });
});
</script>
@endsection
