@extends('Master')
@section('Judul','Slider')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
         <div class="panel-heading">
            <h3 class="panel-title">Slider Information Page</h3>
         </div>

         <!-- Awal Informasi Pra Estimasi -->
         <div class="panel-body">
             <p>In this page, you may add and change your slider information.</p><br>
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
                     <h3 class="panel-title">Slider Information Table</h3>
                 </div>
                 <div class="panel-body">
                     <table class="table" id="DataTableSlider">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">ID</th>
                                 <th style="text-align:center;">Slider Name</th>
                                 <th style="text-align:center;">View</th>
                                 <th style="text-align:center;">Change</th>
                             </tr>
                         </thead>
                         <tfoot>
                            <tr>
                               <th style="text-align:center;">ID</th>
                               <th style="text-align:center;">Slider Name</th>
                               <th style="text-align:center;">View</th>
                               <th style="text-align:center;">Change</th>
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
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-6">
                     <div class="form-group">
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>You can get detail slider information by pressing this button.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>You can change detail slider information by pressing this button.</b>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <b>1. In one page only show 10 items from your data slider.</b>
                     </div>
                     <div class="form-group">
                           <b>2. If you want to know further about data slider, you may choose the page on your table.</b>
                     </div>
                     <div class="form-group">
                           <b>3. You can search your detail slider information from [Search] column.</b>
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
<!-- Modal View Slider -->
<div class="modal fade" id="myModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Slider Detail Information</h4>
           </div>
           <div class="modal-body-view">

           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           </div>
       </div>
   </div>
</div>

<!-- Modal Edit Slider -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Change Slider Information</h4>
           </div>
           <div class="modal-body-edit">
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
$(document).ready(function() {
   var dataTable = $('#DataTableSlider').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/SliderIndex.php",
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
               return '<div style="text-align:center"><a href="#" class="ViewDataSlider" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":3,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataSlider" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','.ViewDataSlider',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');

       $.post('modal/SliderModalView.blade.php',
           { ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataSlider',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');

       $.post('modal/SliderModalEdit.blade.php',
           { ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
