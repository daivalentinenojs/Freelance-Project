@extends('Master')
@section('Judul','Product')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
         <div class="panel-heading">
            <h3 class="panel-title">Product Information Page</h3>
         </div>

         <!-- Awal Informasi Pra Estimasi -->
         <div class="panel-body">
             <p>In this page, you may add and change your product information.</p><br>
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
                   <button id="CreateDataProduct" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i> Add Product</button>
                </div>
             </div>


             <!-- Awal Isi Konten -->
             <!-- START DEFAULT DATATABLE -->
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <h3 class="panel-title">Product Information Table</h3>
                 </div>
                 <div class="panel-body">
                     <table class="table" id="DataTableProduct">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">ID</th>
                                 <th style="text-align:center;">Product Name</th>
                                 <th style="text-align:center;">Product Category</th>
                                 <th style="text-align:center;">Status</th>
                                 <th style="text-align:center;">View</th>
                                 <th style="text-align:center;">Change</th>
                             </tr>
                         </thead>
                         <tfoot>
                            <tr>
                               <th style="text-align:center;">ID</th>
                               <th style="text-align:center;">Product Name</th>
                               <th style="text-align:center;">Product Category</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>You can get detail product information by pressing this button.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>You can change detail product information by pressing this button.</b>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <b>1. In one page only show 10 items from your data product.</b>
                     </div>
                     <div class="form-group">
                           <b>2. If you want to know further about data product, you may choose the page on your table.</b>
                     </div>
                     <div class="form-group">
                           <b>3. You can search your detail product information from [Search] column.</b>
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
<!-- Modal Create Produk -->
<div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Add Product</h4>
           </div>
           <div class="modal-body">
             <form class="form-horizontal" id="FormTambahProduct" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             <div class="modal-body">
                    <div class="panel-body">
                          <div class="col-md-12">
                              <div class="form-group">
                                    <label class="col-md-4 control-label">Product Name (English)</label>
                                    <div class="col-md-6">
                                         <input type="text" name="ProductName" required class="form-control" value="" placeholder="Insert Product Name" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label">Product Name (Indonesian)</label>
                                    <div class="col-md-6">
                                         <input type="text" name="NamaIndonesia" required class="form-control" value="" placeholder="Insert Product Name" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Product Category</label>
                                 <div class="col-md-8">
                                     <label class="check"><input type="checkbox" id="CheckBoxCategory" value="1" name="CheckBoxCategory[]" /> Fashion</label><br>
                                     <label class="check"><input type="checkbox" id="CheckBoxCategory" value="2"  name="CheckBoxCategory[]" /> Home Decoration</label><br>
                                     <label class="check"><input type="checkbox" id="CheckBoxCategory" value="3"  name="CheckBoxCategory[]" /> 3D Embroidery</label><br>
                                     <label class="check"><input type="checkbox" id="CheckBoxCategory" value="4"  name="CheckBoxCategory[]" /> Souvenir</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label">Sequence</label>
                                    <div class="col-md-6">
                                         <input type="text" name="Urutan" required class="form-control" value="" placeholder="Insert Product Name" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-4 control-label">Description (English)</label>
                                   <div class="col-md-6">
                                         <textarea name="Description" rows="8" cols="60"></textarea>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-4 control-label">Description (Indonesian)</label>
                                   <div class="col-md-6">
                                         <textarea name="DeskripsiIndonesia" rows="8" cols="60"></textarea>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-4 control-label">Product Format</label>
                                   <div class="col-md-3">
                                         <select class="form-control select" data-live-search="true" name="ProductFormat" id="ProductFormat">
                                                <option value="0">Foto</option>
                                                <option value="1">Video</option>
                                         </select>
                                   </div>
                              </div>
                              <div class="form-group" name="DivFotoVideo">
                                   <label class="col-md-4 control-label">Foto / Video</label>
                                   <div class="col-md-5">
                                         <input type="file" class="fileinput" required id="FotoProduct" name="FotoProduct"/>
                                         <br>
                                   </div>
                              </div>
                              <div class="form-group" style="text-align:center;">
                                     <input type="submit" name="BtnCreateProduct" value="Add Product" class="btn btn-success">
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

<!-- Modal View Produk -->
<div class="modal fade" id="myModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Product Detail Information</h4>
           </div>
           <div class="modal-body-view">

           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           </div>
       </div>
   </div>
</div>

<!-- Modal Edit Produk -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
               <h4 class="modal-title" id="myModalLabel">Change Product Information</h4>
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
   var dataTable = $('#DataTableProduct').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "ajax/ProductIndex.php",
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
         {"data":3,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":4,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataProduct" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":5,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataProduct" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataProduct',function(e){
       e.preventDefault();

       $("#myModalCreate").modal('show');
   });
});

$(function(){
   $(document).on('click','.ViewDataProduct',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');

       $.post('modal/ProductModalView.blade.php',
           { ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataProduct',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');

       $.post('modal/ProductModalEdit.blade.php',
           { ID:$(this).attr('data-id')},
           function(html){
               $(".modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
