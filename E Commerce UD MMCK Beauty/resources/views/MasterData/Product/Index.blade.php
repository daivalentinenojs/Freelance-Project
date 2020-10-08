@extends('Master')
@section('Judul','Master Data | Product')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
    <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Product Information</h3>
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
          <p>This page is a Product information page. The Product Information page is used to <strong> find</strong>, <strong> add</strong>, and <strong> change</strong> Product data listed in <strong> {{$Content[0]['Nama']}}</strong>.</p><br>
          <div class="panel-body col-md-12">
             <div class="form-group">
                <button id="CreateDataBarang" class="btn btn-success pull-right" data-toggle><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Product Data</button>
             </div>
          </div>

          <!-- Awal Isi Konten -->
          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Product Information Table</h3>
              </div>
              <div class="panel-body">
                  <table class="table" id="DataTableBarang">
                      <thead>
                          <tr>
                              <th style="text-align:center;">ID</th>
                              <th style="text-align:center;">Name</th>
                              <th style="text-align:center;">Description</th>
                              <th style="text-align:center;">Stock</th>
                              <th style="text-align:center;">Weight</th>
                              <th style="text-align:center;">Purchasing Price</th>
                              <th style="text-align:center;">Selling Price</th>
                              <th style="text-align:center;">Promo Selling Price</th>
                              <th style="text-align:center;">Sub Category</th>
                              <th style="text-align:center;">Brand</th>
                              <th style="text-align:center;">Product Status</th>
                              <th style="text-align:center;">Promo</th>
                              <th style="text-align:center;">Status</th>
                              <th style="text-align:center;">View</th>
                              <th style="text-align:center;">Change</th>
                          </tr>
                      </thead>
                      <tfoot>
                         <tr>
                            <th style="text-align:center;">ID</th>
                            <th style="text-align:center;">Name</th>
                            <th style="text-align:center;">Description</th>
                            <th style="text-align:center;">Stock</th>
                            <th style="text-align:center;">Weight</th>
                            <th style="text-align:center;">Purchasing Price</th>
                            <th style="text-align:center;">Selling Price</th>
                            <th style="text-align:center;">Promo Selling Price</th>
                            <th style="text-align:center;">Sub Category</th>
                            <th style="text-align:center;">Brand</th>
                            <th style="text-align:center;">Product Status</th>
                            <th style="text-align:center;">Promo</th>
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
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>To find the detail of Product data.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>To change the detail of Product data.</b>
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
                           <b>3. [Search] Feature on the top right of your table used for looking Product data fastly.</b>
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
               <h4 class="modal-title" id="myModalLabel">Product Detail</h4>
           </div>
           <div class="modal-body">
           <form class="form-horizontal" id="FormTambahBarang" name="FormTambahBarang" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Product Name</label>
                                     <div class="col-md-5">
                                          <input type="text" name="Nama" required class="form-control" value="" placeholder="Product Name" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                  <label class="col-md-4 control-label">Description</label>
                                  <div class="col-md-6">
                                        <textarea required style="border-radius:8px; text-align:justify; padding:10px;" placeholder="Insert Product Description" name="Keterangan" rows="2" cols="110"></textarea>
                                  </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Stock</label>
                                     <div class="col-md-4">
                                          <input type="number" name="Stok" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Stock" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Weight (gram)</label>
                                     <div class="col-md-5">
                                          <input type="number" name="Berat" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Weight (gram)" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Purchasing Price</label>
                                     <div class="col-md-5">
                                          <input type="number" name="HargaBeli" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Purchasing Price" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Selling Price</label>
                                     <div class="col-md-5">
                                          <input type="number" name="HargaJual" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Selling Price" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Promo Selling Price</label>
                                     <div class="col-md-5">
                                          <input type="number" name="HargaJualPromo" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Promo Selling Price" style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Sub Category</label>
                                     <div class="col-md-4">
                                          <select name="IDSubKategori" required class="form-control select" data-live-search="true"/>
                                             @foreach ($DataSubCategory as $SubCategory)
                                                   <option value="{{$SubCategory['ID']}}">{{$SubCategory['Nama']}}</option>
                                             @endforeach
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Brand</label>
                                     <div class="col-md-4">
                                          <select name="IDMerk" required class="form-control select" data-live-search="true"/>
                                             @foreach ($DataBrand as $Brand)
                                                   <option value="{{$Brand['ID']}}">{{$Brand['BrandName']}}</option>
                                             @endforeach
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Product Status</label>
                                     <div class="col-md-4">
                                          <select name="IDStatusBarang" required class="form-control select" data-live-search="true"/>
                                             @foreach ($DataProductStatus as $ProductStatus)
                                                   <option value="{{$ProductStatus['ID']}}">{{$ProductStatus['ProductStatusName']}}</option>
                                             @endforeach
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                     <label class="col-md-4 control-label">Promo</label>
                                     <div class="col-md-4">
                                          <select name="IsPromo" required class="form-control select" data-live-search="true"/>
                                                   <option value="0">UnDiscount</option>
                                                   <option value="1">Discount</option>
                                          </select>
                                     </div>
                               </div>
                               <div class="form-group">
                                    <label class="col-md-4 control-label">Product Photo</label>
                                    <div class="col-md-5">
                                          <input type="file" required class="fileinput" id="FotoBarang" name="FotoBarang"/>
                                    </div>
                               </div>
                               <div class="form-group" style="text-align:center;">
                                      <input type="submit" id="BtnCreateBarang" name="BtnCreateBarang" value="Add" class="btn btn-success">
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
               <h4 class="modal-title" id="myModalLabel">Detail Product</h4>
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
               <h4 class="modal-title" id="myModalLabel">Change Product</h4>
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
   var dataTable = $('#DataTableBarang').DataTable( {
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "scrollX": true,
      "ajax":{
         url : "AjaxProduct",
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
         {"data":6,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
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
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":10,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":11,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":12,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center">'+data+'</div>';
            }
         },
         {"data":13,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="ViewDataBarang" data-id="'+data+'"><i class="fa fa-eye"></i></a></div>';
            }
         },
         {"data":14,
            "render" : function ( data, type, full, meta ) {
               return '<div style="text-align:center"><a href="#" class="EditDataBarang" data-id="'+data+'"><i class="fa fa-pencil"></i></a></div>';
            }
         }
         ],
      "order":[[0, 'asc']]
   });
});

$(function(){
   $(document).on('click','#CreateDataBarang',function(e){
       e.preventDefault();
       $("#myModalCreate").modal('show');

   });
});

$(function(){
   $(document).on('click','.ViewDataBarang',function(e){
       e.preventDefault();
       $("#myModalView").modal('show');
       $.post('modal/Product/ProductModalView.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-view").html(html);
           }
       );
   });
});

$(function(){
   $(document).on('click','.EditDataBarang',function(e){
       e.preventDefault();
       $("#myModalEdit").modal('show');
       $.post('modal/Product/ProductModalEdit.blade.php',
           {ID:$(this).attr('data-id')},
           function(html){
               $("#modal-body-edit").html(html);
           }
       );
   });
});
</script>
@endsection
