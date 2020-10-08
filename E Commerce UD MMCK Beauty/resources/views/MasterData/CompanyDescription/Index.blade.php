@extends('Master')
@section('Judul','Master Data | Company Information')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
   @foreach ($errors->all() as $error)
   <p class="alert alert-danger">{{ $error }}</p>
   @endforeach
   @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
   @endif
       <div class="panel panel-success" id="grid_block_5">
         <div class="panel-heading">
            <h3 class="panel-title">Master Company Information</h3>
         </div>

         <!-- Awal Informasi Pra Estimasi -->
         <div class="panel-body">
             <p>In this page, you may add and change your company information.</p><br>
              <form class="form-horizontal" id="FormEditDataCompany" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="modal-body">
                     <div class="panel-body">
                           <div class="col-md-12">
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Name</label>
                                      <div class="col-md-4">
                                          <input type="text" name="Nama" required class="form-control" value="{{$Content[0]['Nama']}}" placeholder="Insert Company Title" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Description</label>
                                    <div class="col-md-6">
                                          <textarea required style="border-radius:8px; text-align:justify; padding:10px;" placeholder="Insert Company Information" name="Deskripsi" rows="8" cols="90">{{$Content[0]['Keterangan']}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Address</label>
                                      <div class="col-md-5">
                                          <input type="text" name="Alamat" required class="form-control" value="{{$Content[0]['Alamat']}}" placeholder="Insert Company Address" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">City</label>
                                      <div class="col-md-2">
                                          <input type="text" name="Kota" required class="form-control" value="{{$Content[0]['Kota']}}" placeholder="Insert Company City" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Country</label>
                                      <div class="col-md-3">
                                          <input type="text" name="Negara" required class="form-control" value="{{$Content[0]['Negara']}}" placeholder="Insert Company Country" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Phone</label>
                                      <div class="col-md-2">
                                          <input type="text" name="Telepon" onkeypress = "return isNumberKey(event)" required class="form-control" value="{{$Content[0]['Telepon']}}" placeholder="Insert Company Phone" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Handphone</label>
                                      <div class="col-md-3">
                                          <input type="text" name="Handphone" onkeypress = "return isNumberKey(event)" required class="form-control" value="{{$Content[0]['Handphone']}}" placeholder="Insert Company Handphone" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Email</label>
                                      <div class="col-md-5">
                                          <input type="email" name="Email" required class="form-control" value="{{$Content[0]['Email']}}" placeholder="Insert Company Email" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                      <label class="col-md-4 control-label">Stock Limit</label>
                                      <div class="col-md-2">
                                          <input type="number" name="BatasStock" onkeypress = "return isNumberKey(event)" required class="form-control" value="{{$Content[0]['BatasStock']}}" placeholder="Insert Company Stock Limit" style="background:white; color:black;"/>
                                      </div>
                                </div>
                                <div class="form-group">
                                     <label class="col-md-4 control-label">Company Logo</label>
                                     <div class="col-md-5">
                                           <input type="file" class="fileinput" id="FotoLogo" name="FotoLogo"/>
                                     </div>
                                </div>
                                <div class="panel-body col-md-12">
                                   <div class="form-group" style="margin:auto; text-align:center;">
                                      <button id="EditDataCompany" class="btn btn-warning" data-toggle><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;Change Company Information</button>
                                   </div>
                                </div>
                          </div>
                      </div>
                </div>
              </form>
         </div>
      </div>
</div>

<!-- Awal Group Box Help and Hint-->
<div class="col-md-12 scCol" style="background:white;"><br>
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
                  <div class="col-md-6">
                     <div class="form-group">
                           <b>Help</b>
                     </div>
                     <div class="form-group">
                           <b>1. In this page, you may add and change your company information.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help and Hint -->
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
</script>
@endsection
