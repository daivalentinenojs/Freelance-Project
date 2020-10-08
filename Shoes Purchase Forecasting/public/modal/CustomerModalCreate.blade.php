<form class="form-horizontal" id="FormTambahCustomer" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Pemilik</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nama Pemilik" name="NamaPemilik" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Toko</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nama Toko" name="NamaToko" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Alamat</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Alamat" name="AlamatCustomer" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-7">
                             <input type="text" class="form-control" placeholder="Nomor Telepon" name="TeleponCustomer" value="" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                        </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateCustomer" value="Tambah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
<script type="text/javascript">
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      alert("Harus input angka!");
      return false;
  }
  return true;
}
</script>
