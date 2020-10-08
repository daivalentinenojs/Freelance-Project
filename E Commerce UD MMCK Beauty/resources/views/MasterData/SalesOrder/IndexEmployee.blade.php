@extends('Master')
@section('Judul','Transaction | SalesOrder')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
    <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Sales Order Information</h3>
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
          <p>This page is a Sales Order information page. The Sales Order Information page is used to <strong> find</strong>, <strong> add</strong>, and <strong> change</strong> SalesOrder data listed in <strong> {{$Content[0]['Nama']}}</strong>.</p><br>

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Sales Order Information Table</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTableNotaJual">
                      <thead>
                          <tr>
                             <th style="text-align:center;">Nomor</th>
                              <th style="text-align:center;">Date</th>
                              <th style="text-align:center;">Recipient Name</th>
                              <th style="text-align:center;">Recipient Address</th>
                              <!-- <th style="text-align:center;">Recipient Handphone</th> -->
                              <th style="text-align:center;">City</th>
                              <th style="text-align:center;">Province</th>
                              <th style="text-align:center;">Grand Total</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">Action</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                            <th style="text-align:center;">Nomor</th>
                            <th style="text-align:center;">Date</th>
                            <th style="text-align:center;">Recipient Name</th>
                            <th style="text-align:center;">Recipient Address</th>
                            <!-- <th style="text-align:center;">Recipient Handphone</th> -->
                            <th style="text-align:center;">City</th>
                            <th style="text-align:center;">Province</th>
                            <th style="text-align:center;">Grand Total</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Action</th>
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
         <h3 class="panel-title">Help and Hint</h3>
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-4">
                     <div class="form-group">
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>To find the detail of Sales Order data.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>To change the detail of Sales Order data.</b>
                     </div>
                  </div>

                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Every list only shows 10 items in 1 page.</b>
                     </div>
                     <div class="form-group">
                           <b>2. If you want to know the next page, you may click next button which is located on the bottom right of your table.</b>
                     </div>
                     <div class="form-group">
                           <b>3. [Search] Feature on the top right of your table used for looking Sales Order data fastly.</b>
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
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Sales Order Confirmation</h4>
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
   var dataTable = $('#DataTableNotaJual').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxTransactionEmployee",
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
               return '<div style="text-align:left">'+data+'</div>';
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
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":6,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         // {"data":7,
         //    "render" : function ( data, type, full, meta ) {
         //       return '<div style="text-align:center">'+data+'</div>';
         //    }
         // },
         {"data":7,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataNotaJual" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','.EditDataNotaJual',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/SalesOrder/SalesOrderModalEditEmployee.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
