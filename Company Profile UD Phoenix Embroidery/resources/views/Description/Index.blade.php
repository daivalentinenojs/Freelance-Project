@extends('Master')
@section('Judul','Company Description')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
         <div class="panel-heading">
            <h3 class="panel-title">Company Description Page</h3>
         </div>

         <!-- Awal Informasi Pra Estimasi -->
         <div class="panel-body">
             <p>In this page, you may change your company description.</p><br>
             @foreach ($errors->all() as $error)
             <p class="alert alert-danger">{{ $error }}</p>
             @endforeach
             @if (session('status'))
                 <div class="alert alert-success">
                     {{ session('status') }}
                 </div>
             @endif

             <!-- Awal Isi Konten -->
             <form class="form-horizontal" id="FormCompanyDescription" method="POST" enctype="multipart/form-data">
             <div class="modal-body">
                    <div class="panel-body">
                          <div class="col-md-12">
                             <div class="form-group">
                                   <label class="col-md-5 control-label">Company Name</label>
                                   <div class="col-md-3">
                                        <input type="text" name="CompanyName" required class="form-control" value="<?php echo $Content[0]['CompanyName']; ?>" placeholder="Insert Company Name" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <div class="form-group">
                                   <label class="col-md-5 control-label">Address</label>
                                   <div class="col-md-4">
                                        <input type="text" name="Address" required class="form-control" value="<?php echo $Content[0]['Address']; ?>" placeholder="Insert Company Address" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <div class="form-group">
                                   <label class="col-md-5 control-label">City</label>
                                   <div class="col-md-2">
                                        <input type="text" name="City" required class="form-control" value="<?php echo $Content[0]['City']; ?>" placeholder="Insert Company City" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <div class="form-group">
                                   <label class="col-md-5 control-label">Phone</label>
                                   <div class="col-md-2">
                                        <input type="text" name="Phone" onkeypress="return isNumberKey(event)" required class="form-control" value="<?php echo $Content[0]['Phone']; ?>" placeholder="Insert Phone Number" style="background:white; color:black;"/>
                                   </div>
                             </div>
                             <?php $Email = explode('@', $Content[0]['Email']);?>
                             <div class="form-group">
                                  <label class="col-md-5 control-label">Email</label>
                                  <div class="col-md-3">
                                        <input type="text" name="Email" class="form-control" required value="<?php echo $Email[0]; ?>" placeholder="Insert Email" style="background:white; color:black;"/>
                                  </div>
                                  <div class="col-md-2">
                                       <select class="form-control select" data-live-search="true" name="Domain">
                                              <?php
                                              if($Email[1] == "gmail.com") {
                                                    echo '<option selected value="@gmail.com">@gmail.com</option>';
                                                    echo '<option value="@yahoo.com">@yahoo.com</option>';
                                              } else {
                                                     echo '<option value="@gmail.com">@gmail.com</option>';
                                                     echo '<option selected value="@yahoo.com">@yahoo.com</option>';
                                              }
                                              ?>
                                       </select>
                                 </div>
                             </div>
                             <div class="form-group">
                                        <label class="col-md-5 control-label">Company Logo</label>
                                        <div class="col-md-5">
                                              <input type="file" class="fileinput" id="FotoLogo" name="FotoLogo"/>
                                        </div>
                                      </div>
                             <div class="form-group">
                                        <label class="col-md-5 control-label">Map Location</label>
                                        <div class="col-md-5">
                                              <input type="file" class="fileinput" id="FotoPeta" name="FotoPeta"/>
                                        </div>
                                      </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Company Description (English)</label><br><br>
                                    <input type="hidden" name="IDDescription" value="<?php echo  $Content[0]['ID'];?>">
                                    <textarea name="CompanyDescription" rows="5" cols="35"><?php echo $Content[0]['Content']; ?></textarea>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Company Description (Indonesian)</label><br><br>
                                    <textarea name="CompanyDescriptionIndonesia" rows="5" cols="35"><?php echo $Content[0]['ContentIndonesia']; ?></textarea>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Social Networking Description (English)</label><br><br>
                                    <textarea name="HomeDescription" rows="1" cols="35"><?php echo $Content[0]['Home']; ?></textarea>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Social Networking Description (Indonesian)</label><br><br>
                                    <textarea name="HomeDescriptionIndonesia" rows="1" cols="35"><?php echo $Content[0]['HomeIndonesia']; ?></textarea>
                              </div>
                              <div class="form-group" style="text-align:center;">
                                     <input type="submit" name="BtnEditDescription" value="Change" class="btn btn-warning">
                              </div>
                          </div>
                     </div>
             </div>
             </form>
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
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>You can change your company description by pressing change button.</b>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <b>1. In this page you may change your company description.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help dan Hint -->
@endsection

@section('Script')
<script type="text/javascript">
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 43 || charCode == 44)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}
</script>
@endsection
