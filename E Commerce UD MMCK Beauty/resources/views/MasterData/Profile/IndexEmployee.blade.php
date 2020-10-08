@extends('Master')
@section('Judul','Profile | Employee')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
      <!-- Awal Informasi Pra Estimasi -->
         @foreach ($errors->all() as $error)
         <p class="alert alert-danger">{{ $error }}</p>
         @endforeach
         @if (session('status'))
             <div class="alert alert-success">
                 {{ session('status') }}
             </div>
         @endif
        <form class="form-horizontal" id="FormTambahKaryawan" name="FormTambahKaryawan" method="POST" enctype="multipart/form-data">
           <input type="hidden" name="_token" value="{!! csrf_token() !!}">
           <div class="modal-body">
                  <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:center">
                                          <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/Karyawan/<?php echo $DataEmployee[0]['ID'] ?>.jpg">
                            </div><br>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Employee Name</label>
                                  <div class="col-md-3">
                                       <input type="hidden" name="IDUser" value="{{$DataEmployee[0]['IDUser']}}">
                                       <input type="hidden" name="IDKaryawan" value="{{$DataEmployee[0]['ID']}}">
                                       <input type="text" name="Nama" required class="form-control" value="{{$DataEmployee[0]['Nama']}}" placeholder="Employee Name" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                               <label class="col-md-5 control-label">Address</label>
                               <div class="col-md-4">
                                     <textarea required style="border-radius:8px; text-align:justify; padding:10px;" placeholder="Insert Your Address" name="Alamat" rows="2" cols="110">{{$DataEmployee[0]['Alamat']}}</textarea>
                               </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">City</label>
                                  <div class="col-md-2">
                                       <input type="text" name="Kota" required class="form-control" value="{{$DataEmployee[0]['Kota']}}" placeholder="City" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Phone</label>
                                  <div class="col-md-3">
                                       <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" required class="form-control" value="{{$DataEmployee[0]['Telepon']}}" placeholder="Phone" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Handphone</label>
                                  <div class="col-md-4">
                                       <input type="text" name="Handphone" onkeypress="return isNumberKey(event)" required class="form-control" value="{{$DataEmployee[0]['Handphone']}}" placeholder="Handphone" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Email</label>
                                  <div class="col-md-4">
                                       <input type="email" name="Email" required class="form-control" value="{{$DataEmployee[0]['Email']}}" placeholder="Email" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Password</label>
                                  <div class="col-md-3">
                                       <input type="password" name="Password" required class="form-control" value="" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-md-5 control-label">Employee Photo</label>
                                 <div class="col-md-2">
                                       <input type="file" class="fileinput" id="FotoKaryawan" name="FotoKaryawan"/>
                                 </div>
                            </div>
                            <div class="form-group" style="text-align:center;">
                                   <input type="submit" id="BtnEditKaryawan" name="BtnEditKaryawan" value="Change" class="btn btn-warning">
                            </div>
                        </div>
                   </div>
             </div>
           </form>
</div>
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
