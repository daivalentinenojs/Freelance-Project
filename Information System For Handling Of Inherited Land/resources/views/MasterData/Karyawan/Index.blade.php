@extends('Master')

@section('Judul','Master Data | Informasi Karyawan')

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
         <h3 class="panel-title">Informasi Karyawan</h3>
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
          <p>Halaman ini merupakan halaman informasi master data 'Karyawan'. Halaman informasi master data 'Karyawan' digunakan untuk mencari, menambah, dan mengubah informasi 'Karyawan' yang terdaftar.</p><br>
          <div class="panel-body col-md-12">
             <div class="form-group">
                <button id="CreateDataKaryawan" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Data Karyawan</button>
             </div>
          </div>

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Tabel Informasi Master Data Karyawan</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTableKaryawan">
                      <thead>
                          <tr>
                              <th style="text-align:center;">ID</th>
                              <th style="text-align:center;">NIK</th>
                              <th style="text-align:center;">Nama</th>
                              <th style="text-align:center;">Alamat</th>
                              <th style="text-align:center;">Telepon</th>
                              <th style="text-align:center;">Email</th>
                              <th style="text-align:center;">Jabatan</th>
                              <th style="text-align:center;">Nama Daerah</th>
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
                           <th style="text-align:center;">Email</th>
                           <th style="text-align:center;">Jabatan</th>
                           <th style="text-align:center;">Nama Daerah</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengetahui informasi detail dari master data 'Karyawan'.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>digunakan untuk mengubah informasi detail dari master data 'Karyawan'.</b>
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
                           <b>3. Fitur [Search] terletak di kanan atas dari tabel untuk mencari informasi master data 'Karyawan' dengan cepat.</b>
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
               <h4 class="modal-title" id="myModalLabel">Tambah Karyawan</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahKaryawan" name="FormTambahKaryawan" method="POST" enctype="multipart/form-data">
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
                                        <input type="text" name="NIK" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="NIK Karyawan" style="background:white; color:black;"/>
                                   </div>
                             </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Nama Karyawan</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Nama" required class="form-control" value="" placeholder="Nama Karyawan" style="background:white; color:black;"/>
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
                                     <label class="col-md-5 control-label">Jabatan</label>
                                     <div class="col-md-7">
                                          <select name="Jabatan" required class="form-control select" data-live-search="true"/>
                                                 <option value="1">Penerima Setoran PNBP</option>
                                                 <option value="2">Kepala Sub Bagian TU</option>
                                                 <option value="3">Kepala Seksi Hak Tanah dan Pendaftaran Tanah</option>
                                                 <option value="4">Kepala Seksi Pengukuran dan Pemetaan</option>
                                                 <option value="5">Petugas Pengumpul Data Yuridis</option>
                                                 <option value="6">Kepala Seksi Hub Hukum Pertanahan</option>
                                                 <option value="7">Sekretaris Bukan Anggota</option>
                                                 <option value="8">Anggota</option>
                                                 <option value="9">Ketua</option>
                                                 <option value="10">Koordinator</option>
                                                 <option value="11">Kepala Seksi Infrastruktur Pertanahan</option>
                                                 <option value="12">Kepala Sub Bagian Seksi Peralihan Hak</option>
                                                 <option value="13">Staff Hubungan Hukum Pertanahan</option>
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-5 control-label">Daerah</label>
                                     <div class="col-md-4">
                                          <select name="IDDaerah" required class="form-control select" data-live-search="true"/>
                                             @foreach ($DataDaerah as $Daerah)
                                                   <option value="{{$Daerah['ID']}}">{{$Daerah['NamaDaerah']}}</option>
                                             @endforeach
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                    <label class="col-md-5 control-label">Foto Karyawan</label>
                                    <div class="col-md-5">
                                          <input type="file" required id="FotoKaryawan" name="FotoKaryawan"/>
                                    </div>
                               </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="submit" id="BtnCreateKaryawan" name="BtnCreateKaryawan" value="Tambah" class="btn btn-success">
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
               <h4 class="modal-title" id="myModalLabel">Detail Karyawan</h4>
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
               <h4 class="modal-title" id="myModalLabel">Ubah Karyawan</h4>
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
   var dataTable = $('#DataTableKaryawan').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxKaryawan",
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
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":9,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataKaryawan" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":10,
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
       $("#myModalCreate").modal('show');
   });
});

$(function(){
   $(document).on('click','.ViewDataKaryawan',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Karyawan/KaryawanModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataKaryawan',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Karyawan/KaryawanModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
