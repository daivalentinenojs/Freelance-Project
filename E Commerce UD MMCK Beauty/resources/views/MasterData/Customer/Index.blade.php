@extends('Master')
@section('Judul','Master Data | Customer')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
    <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Customer Information</h3>
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
          <p>This page is a Customer information page. The Customer Information page is used to <strong> find</strong>, <strong> add</strong>, and <strong> change</strong> Customer data listed in <strong> {{$Content[0]['Nama']}}</strong>.</p><br>
          <div class="panel-body col-md-12">
             <div class="form-group">
                <button id="CreateDataPembeli" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Customer Data</button>
             </div>
          </div>

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Customer Information Table</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTablePembeli">
                      <thead>
                          <tr>
                              <th style="text-align:center;">ID</th>
                              <th style="text-align:center;">Name</th>
                              <th style="text-align:center;">Address</th>
                              <th style="text-align:center;">City</th>
                              <th style="text-align:center;">Phone</th>
                              <!-- <th style="text-align:center;">Handphone</th> -->
                              <th style="text-align:center;">Email</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">View</th>
                              <th style="text-align:center;">Change</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                            <th style="text-align:center;">ID</th>
                            <th style="text-align:center;">Name</th>
                            <th style="text-align:center;">Address</th>
                            <th style="text-align:center;">City</th>
                            <th style="text-align:center;">Phone</th>
                            <!-- <th style="text-align:center;">Handphone</th> -->
                            <th style="text-align:center;">Email</th>
                            <th style="text-align:center;">Status</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>To find the detail of Customer data.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>To change the detail of Customer data.</b>
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
                           <b>3. [Search] Feature on the top right of your table used for looking Customer data fastly.</b>
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
               <h4 class="modal-title" id="myModalLabel">Customer Detail</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahPembeli" name="FormTambahPembeli" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Customer Name</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Nama" required class="form-control" value="" placeholder="Customer Name" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                  <label class="col-md-4 control-label">Address</label>
                                  <div class="col-md-6">
                                        <textarea required style="border-radius:8px; text-align:justify; padding:10px;" placeholder="Insert Your Address" name="Alamat" rows="2" cols="110"></textarea>
                                  </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">City</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Kota" required class="form-control" value="" placeholder="City" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Phone</label>
                                     <div class="col-md-4">
                                          <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Phone" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <!-- <div class="form-group">
                                     <label class="col-md-4 control-label">Handphone</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Handphone" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Handphone" style="background:white; color:black;"/>
                                     </div>
                               </div> -->
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Email</label>
                                     <div class="col-md-6">
                                          <input type="email" name="Email" required class="form-control" value="" placeholder="Email" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Password</label>
                                     <div class="col-md-4">
                                          <input type="password" name="Password" required class="form-control" value="" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                    <label class="col-md-4 control-label">Customer Photo</label>
                                    <div class="col-md-5">
                                          <input type="file" class="fileinput" id="FotoPembeli" name="FotoPembeli"/>
                                    </div>
                               </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="submit" id="BtnCreatePembeli" name="BtnCreatePembeli" value="Add" class="btn btn-success">
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
               <h4 class="modal-title" id="myModalLabel">Detail Customer</h4>
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
               <h4 class="modal-title" id="myModalLabel">Change Customer</h4>
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
   var dataTable = $('#DataTablePembeli').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxCustomer",
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
         // {"data":6,
         //    "render" : function ( data, type, full, meta ) {
         //       return '<div style="text-align:center">'+data+'</div>';
         //    }
         // },
         {"data":6,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":7,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataPembeli" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":8,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataPembeli" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataPembeli',function(e){
       e.preventDefault();
       $("#myModalCreate").modal('show');

   });
});

$(function(){
   $(document).on('click','.ViewDataPembeli',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Customer/CustomerModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataPembeli',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Customer/CustomerModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
