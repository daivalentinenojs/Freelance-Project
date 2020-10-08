<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Laporan Keuangan')

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
         <h3 class="panel-title">Informasi Laporan Keuangan</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

         <!-- Awal Informasi Pra Estimasi -->
         <div class="panel-body">
             <p>Halaman ini adalah halaman informasi laporan keuangan. Halaman Informasi Laporan Keuangan digunakan untuk <strong>mencari</strong> data laporan keuangan yang terdaftar pada UD Harmonis Motor</strong>.</p><br>
             @foreach ($errors->all() as $error)
             <p class="alert alert-danger">{{ $error }}</p>
             @endforeach
             @if (session('status'))
                 <div class="alert alert-success">
                     {{ session('status') }}
                 </div>
             @endif
             <form role="form" class="form-horizontal">
                 <div class="form-group">
                      <div class="col-md-12">
                        <label class="col-md-5 control-label" style="margin-top:3px;">Periode:</label>
                          <div class="col-md-2">
                            <select class="form-control select" data-live-search="true" name="Periode" id="Periode">
                               <option value="Januari">Januari 2017</option>
                               <option value="Februari">Februari 2017</option>
                               <option value="Maret">Maret 2017</option>
                               <option value="April">April 2017</option>
                               <option value="Mei">Mei 2017</option>
                               <option value="Juni">Juni 2017</option>
                               <option value="Juli">Juli 2017</option>
                               <option value="Agustus">Agustus 2017</option>
                               <option value="September">September 2017</option>
                               <option value="Oktober">Oktober 2017</option>
                               <option value="November">November 2017</option>
                               <option value="Desember">Desember 2017</option>
                            </select>
                          </div>
                      </div>
                 </div>
                 <div class="form-group">
                      <div class="col-md-12">
                         <label class="col-md-5 control-label" style="margin-top:3px;">Tanggal Cetak:</label>
                         <div class="col-md-1">
                                 <div class="input-group">
                                     <input type="date" name="TanggalCetak" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                         </div>
                      </div>
                 </div>
                 <div class="form-group">
                  <div class="col-md-5">
                  </div>
                    <div class="col-md-4">
                      <button type="button" id="CetakLaporanKeuangan" onclick="printData()" class="btn btn-info" name="CetakLaporanKeuangan">Cetak</button>
                  </div>
               </div>
             </form>
             <br />
             <br />
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
             <!-- <div class="panel panel-default">
                 <div class="panel-heading">
                     <h3 class="panel-title">Tabel Informasi Laporan Keuangan</h3>
                 </div>
                 <div class="panel-body">
                     <table class="table" id="DataTableLaporanKeuangan">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">Keterangan</th>
                                 <th style="text-align:center;">Nominal (Rp)</th>
                             </tr>
                         </thead>
                         <tfoot>
                            <tr>
                                 <th style="text-align:center;">Keterangan</th>
                                 <th style="text-align:center;">Nominal (Rp)</th>
                            </tr>
                         </tfoot>
                     </table>
                 </div>
             </div> -->
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
                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Bila Anda ingin melihat laporan keuangan dalam bentuk PDF, silahkan klik tombol Cetak.</b>
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
<!-- <div class="modal fade" id="myModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Detail Laporan Keuangan</h4>
           </div>
           <div class="modal-body-view" id="modal-body-view">
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
           </div>
       </div>
   </div>
</div> -->
<!-- Akhir MyModel-->

<!-- Akhir Informasi Dashboard -->
<script type="text/javascript">
// $(document).ready(function() {
//    var dataTable = $('#DataTableLaporanKeuangan').DataTable( {
//       "processing": true,
//       "serverSide": true,
//       "bDestroy": true,
//       "scrollX": true,
//       "ajax":{
//          url : "ajax/LaporanKeuanganIndex.php",
//          type: "get",
//       },
//       "columns":[
//          {"data":0,
//             "render" : function ( data, type, full, meta ) {
//                return '<div style="text-align:center">'+data+'</div>';
//             }
//          },
//          {"data":1,
//             "render" : function ( data, type, full, meta ) {
//                return '<div style="text-align:center">'+data+'</div>';
//             }
//          },
//          {"data":2,
//             "render" : function ( data, type, full, meta ) {
//                return '<div style="text-align:center"><a href="#" class="ViewDataLaporanKeuangan" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
//             }
//          }
//          ],
//       "order":[[0, 'asc']]
//    });
// });

// $(function(){
//    $(document).on('click','.ViewDataLaporanKeuangan',function(e){
//        e.preventDefault();
//        $("#myModal").modal('show');
//        $.post('modal/LaporanKeuangan/LaporanKeuanganModalView.blade.php',
//            {ID:$(this).attr('data-id')},
//            function(html){
//                $(".modal-body").html(html);
//            }
//        );
//    });
// });

// $(function(){
//    $(document).on('click','#CetakLaporanKeuangan',function(e){
//        e.preventDefault();
//        $("#myModal").modal('show');
//        $.post('views/LaporanKeuangan/CetakLaporanKeuangan.blade.php',
//            {ID:$(this).attr('data-id')},
//            function(html){
//                $(".modal-body").html(html);
//            }
//        );
//    });
// });

function printData()
  {
    window.open("CetakLaporanKeuangan?periode="+$("#Periode").val()+"&tanggalCetak="+$("#TanggalCetak").val(),"_blank");
  }
</script>
@endsection
