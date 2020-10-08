@extends('Master')
@section('Judul','Register Customer | MMC Shop')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="signup-form"><!--sign up form-->
   <form class="form-horizontal" id="FormTambahPembeli" name="FormTambahPembeli" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}">
      <div class="modal-body">
             <div class="panel-body">
                   <div class="col-md-2">
                   </div>
                   <div class="col-md-8">
                       <div class="form-group" style="text-align:center;">
                          <h2><b>New User Sign Up !</b></h2>
                       </div>
                       <div class="form-group">
                             <label class="col-md-5 control-label">Name</label>
                             <div class="col-md-5">
                                  <input type="text" name="Nama" required class="form-control" value="" placeholder="Customer Name" style="background:white; color:black;"/>
                             </div>
                       </div>
                       <div class="form-group">
                          <label class="col-md-5 control-label">Address</label>
                          <div class="col-md-6">
                                <textarea required style="border-radius:8px; text-align:justify; padding:10px; background:white;" placeholder="Insert Your Address" name="Alamat" rows="2" cols="80"></textarea>
                          </div>
                       </div>
                       <div class="form-group">
                             <label class="col-md-5 control-label">City</label>
                             <div class="col-md-3">
                                  <input type="text" name="Kota" required class="form-control" value="" placeholder="City" style="background:white; color:black;"/>
                             </div>
                       </div>
                       <div class="form-group">
                             <label class="col-md-5 control-label">Phone</label>
                             <div class="col-md-3">
                                  <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Phone" style="background:white; color:black;"/>
                             </div>
                       </div>
                       <!-- <div class="form-group">
                             <label class="col-md-5 control-label">Handphone</label>
                             <div class="col-md-3">
                                  <input type="text" name="Handphone" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Handphone" style="background:white; color:black;"/>
                             </div>
                       </div> -->
                       <div class="form-group">
                             <label class="col-md-5 control-label">Email</label>
                             <div class="col-md-5">
                                  <input type="email" name="Email" required class="form-control" value="" placeholder="Email" style="background:white; color:black;"/>
                             </div>
                       </div>
                       <div class="form-group">
                             <label class="col-md-5 control-label">Password</label>
                             <div class="col-md-3">
                                  <input type="password" name="Password" required class="form-control" value="" style="background:white; color:black;"/>
                             </div>
                       </div>
                       <div class="form-group">
                            <label class="col-md-5 control-label">Customer Photo</label>
                            <div class="col-md-5">
                                  <input type="file" id="FotoPembeli" name="FotoPembeli" style="background:white;"/>
                            </div>
                       </div>
                       <div class="form-group" style="text-align:center;">
                           <div class="col-md-4">
                           </div>
                           <div class="col-md-4">
                              <input type="submit" id="BtnCreatePembeli" name="BtnCreatePembeli" value="Sign Up" class="btn btn-success">
                           </div>
                       </div>
                   </div>
              </div>
        </div>
      </form>
</div><!--/sign up form-->
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
