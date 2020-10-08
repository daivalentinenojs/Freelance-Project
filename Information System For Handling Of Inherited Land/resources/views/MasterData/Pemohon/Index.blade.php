@extends('Master')

@section('Judul','Master Data | Informasi Pemohon')

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
         <h3 class="panel-title">Informasi Pemohon</h3>
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
          <p>Halaman ini merupakan halaman informasi master data 'Pemohon'. Halaman informasi master data 'Pemohon' digunakan untuk mencari, menambah, dan mengubah informasi 'Pemohon' yang terdaftar.</p><br>
          <div class="panel-body col-md-12">
             <div class="form-group">
                <button id="CreateDataPemohon" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Data Pemohon</button>
             </div>
          </div>

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Tabel Informasi Master Data Pemohon</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTablePemohon">
                      <thead>
                          <tr>
                              <th style="text-align:center;">ID</th>
                              <th style="text-align:center;">NIK</th>
                              <th style="text-align:center;">Nama</th>
                              <th style="text-align:center;">Alamat</th>
                              <th style="text-align:center;">Telepon</th>
                              <th style="text-align:center;">Pekerjaan</th>
                              <th style="text-align:center;">Umur</th>
                              <th style="text-align:center;">Desa</th>
                              <th style="text-align:center;">Email</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">Detail</th>
                              <th style="text-align:center;">Ubah</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                           <th style="text-align:center;">ID</th>
                           <th style="text-align:center;">NIK</th>
                           <th style="text-align:center;">Nama</th>
                           <th style="text-align:center;">Alamat</th>
                           <th style="text-align:center;">Telepon</th>
                           <th style="text-align:center;">Pekerjaan</th>
                           <th style="text-align:center;">Umur</th>
                           <th style="text-align:center;">Desa</th>
                           <th style="text-align:center;">Email</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengetahui informasi detail dari master data 'Pemohon'.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengubah informasi detail dari master data 'Pemohon'.</b>
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
                           <b>3. Fitur [Search] terletak di kanan atas dari tabel untuk mencari informasi master data 'Pemohon' dengan cepat.</b>
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
               <h4 class="modal-title" id="myModalLabel">Tambah Pemohon</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahPemohon" name="FormTambahPemohon" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                             <div class="form-group">
                                   <label class="col-md-5 control-label">Nama Pengguna</label>
                                   <div class="col-md-4">
                                        <input type="text" name="Username" required class="form-control" value="" placeholder="Nama Pengguna" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <div class="form-group">
                                   <label class="col-md-5 control-label">Email</label>
                                   <div class="col-md-5">
                                        <input type="email" name="Email" required class="form-control" value="" placeholder="Email" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <div class="form-group">
                                   <label class="col-md-5 control-label">Kata Sandi</label>
                                   <div class="col-md-4">
                                        <input type="password" name="Password" required class="form-control" value="" placeholder="Kata Sandi" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <br><br>
                             <div class="form-group">
                                   <label class="col-md-5 control-label">NIK</label>
                                   <div class="col-md-4">
                                        <input type="text" name="NIK" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="NIK Pemohon" style="background:white; color:black;"/>
                                   </div>
                             </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Nama Pemohon</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Nama" required class="form-control" value="" placeholder="Nama Pemohon" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Telepon</label>
                                     <div class="col-md-4">
                                          <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Telepon" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Alamat</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Alamat" required class="form-control" value="" placeholder="Alamat" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Pekerjaan</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Pekerjaan" required class="form-control" value="" placeholder="Pekerjaan" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Umur</label>
                                     <div class="col-md-4">
                                          <input type="text" name="Umur" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Umur" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Desa</label>
                                     <div class="col-md-4">
                                          <select name="IDDesa" required class="form-control select" data-live-search="true"/>
                                             @foreach ($DataDesa as $Desa) {
                                                   <option value="{{$Desa['ID']}}">{{$Desa['NamaDesa']}}</option>
                                             @endforeach
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                    <label class="col-md-5 control-label">Foto Pemohon</label>
                                    <div class="col-md-5">
                                          <input type="file" required id="FotoPemohon" name="FotoPemohon"/>
                                    </div>
                               </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="submit" id="BtnCreatePemohon" name="BtnCreatePemohon" value="Tambah" class="btn btn-success">
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
               <h4 class="modal-title" id="myModalLabel">Detail Pemohon</h4>
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
               <h4 class="modal-title" id="myModalLabel">Ubah Pemohon</h4>
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
   var dataTable = $('#DataTablePemohon').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxPemohon",
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
               return '<div style="text-align:left">'+data+'</div>';
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
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:left">'+data+'</div>';
            }
         },
         {"data":9,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":10,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataPemohon" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":11,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataPemohon" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataPemohon',function(e){
       e.preventDefault();
       $("#myModalCreate").modal('show');
   });
});

$(function(){
   $(document).on('click','.ViewDataPemohon',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Pemohon/PemohonModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataPemohon',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Pemohon/PemohonModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
