@extends('Master')
@section('Judul','Employee')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
         <div class="panel-heading">
            <h3 class="panel-title">Employee Information Page</h3>
         </div>

         <!-- Awal Informasi Pra Estimasi -->
         <div class="panel-body">
             <p>In this page, you may add and change your employee information.</p><br>
             @foreach ($errors->all() as $error)
              <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
              @if (session('status'))
                   <div class="alert alert-success">
                       {{ session('status') }}
                   </div>
              @endif
             <div class="panel-body col-md-12">
                <div class="form-group">
                   <button id="CreateDataEmployee" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i> Add Employee</button>
                </div>
             </div>


             <!-- Awal Isi Konten -->
             <!-- START DEFAULT DATATABLE -->
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <h3 class="panel-title">Employee Information Table</h3>
                 </div>
                 <div class="panel-body">
                     <table class="table" id="DataTableEmployee">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">ID</th>
                                 <th style="text-align:center;">NIP</th>
                                 <th style="text-align:center;">Name</th>
                                 <th style="text-align:center;">Email</th>
                                 <th style="text-align:center;">Status</th>
                                 <th style="text-align:center;">View</th>
                                 <th style="text-align:center;">Change</th>
                             </tr>
                         </thead>
                         <tfoot>
                            <tr>
                               <th style="text-align:center;">ID</th>
                               <th style="text-align:center;">NIP</th>
                               <th style="text-align:center;">Name</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>You can get detail employee information by pressing this button.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>You can change detail employee information by pressing this button.</b>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <b>1. In one page only show 10 items from your data employee.</b>
                     </div>
                     <div class="form-group">
                           <b>2. If you want to know further about data employee, you may choose the page on your table.</b>
                     </div>
                     <div class="form-group">
                           <b>3. You can search your detail employee information from [Search] column.</b>
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
<!-- Modal Create Employee -->
<div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
           </div>
           <div class="modal-body">
             <form class="form-horizontal" id="FormTambahEmployee" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             <div class="modal-body">
                    <div class="panel-body">
                          <div class="col-md-12">
                             <div class="form-group">
                                   <label class="col-md-4 control-label">NIP</label>
                                   <div class="col-md-3">
                                        <input type="text" name="NIP" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Insert NIP" style="background:white; color:black;"/>
                                   </div>
                             </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label">Employee Name</label>
                                    <div class="col-md-6">
                                         <input type="text" name="UserName" required class="form-control" value="" placeholder="Insert Employee Name" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-4 control-label">Email</label>
                                   <div class="col-md-4">
                                         <input type="text" name="Email" class="form-control" required value="" placeholder="Insert Email" style="background:white; color:black;"/>
                                   </div>
                                   <div class="col-md-4">
                                             <select class="form-control select" data-live-search="true" name="Domain">
                                                    <option value="@gmail.com">@gmail.com</option>
                                                    <option value="@yahoo.com">@yahoo.com</option>
                                             </select>
                                      </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label">Password</label>
                                    <div class="col-md-4">
                                         <input type="password" name="Password" required class="form-control" value="" placeholder="Insert Password" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-4 control-label">Foto</label>
                                   <div class="col-md-5">
                                         <input type="file" class="fileinput" required id="FotoUser" name="FotoUser"/><br>
                                   </div>
                              </div>
                              <div class="form-group" style="text-align:center;">
                                     <input type="submit" name="BtnCreateEmployee" value="Add Employee" class="btn btn-success">
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

<!-- Modal View Employee -->
<div class="modal fade" id="myModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Employee Detail Information</h4>
           </div>
           <div class="modal-body-view">

           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           </div>
       </div>
   </div>
</div>

<!-- Modal Edit Employee -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Change Employee Information</h4>
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
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$(document).ready(function() {
   var dataTable = $('#DataTableEmployee').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/EmployeeIndex.php",
         type: "get",
      },
      "columns":[
         {"data":0,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":1},
         {"data":2},
         {"data":3},
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":5,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataEmployee" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":6,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataEmployee" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataEmployee',function(e){
       e.preventDefault();

       $("#myModalCreate").modal('show');
   });
});

$(function(){
   $(document).on('click','.ViewDataEmployee',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');

       $.post('modal/EmployeeModalView.blade.php',
           { ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataEmployee',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');

       $.post('modal/EmployeeModalEdit.blade.php',
           { ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
