<?php
  require '../../connection/Init.php';
  $MySQLi = mysqli_connect($domain, $username, $password, $database);

  $QueryGetDataJabatan = "SELECT Jabatan.ID as 'ID', Jabatan.Nama as 'Jabatan' From Jabatan Where Jabatan.isDelete = 1";
  $HasilQueryGetDataJabatan = mysqli_query($MySQLi, $QueryGetDataJabatan);
  $DataJabatan = array();
  while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataJabatan)) {
   $DataJabatan[] = $Hasil;
  }


?>

<form class="form-horizontal" id="FormTambahKaryawan" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nama Karyawan" name="NamaKaryawan" value="" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-4">
                            <input type="text" class="form-control" value="" placeholder="Email" name="EmailKaryawan" style="background:white; color:black;"/>
                      </div>
                      <div class="col-md-3">
                             <select class="form-control select" data-live-search="true" name="DomainKaryawan">
                                    <option value="@gmail.com">@gmail.com</option>
                                    <option value="@yahoo.com">@yahoo.com</option>
                             </select>
                      </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Kata Sandi</label>
                       <div class="col-md-5">
                            <input type="password" class="form-control" placeholder="Kata Sandi" name="PasswordKaryawan" value="" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Jabatan</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="JabatanKaryawan">
                               <?php
                                 for($i=0; $i<count($DataJabatan); $i++){
                                   echo "<option value='".$DataJabatan[$i]['ID']."'>".$DataJabatan[$i]['Jabatan']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Alamat</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Alamat" name="AlamatKaryawan" value="" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="TeleponKaryawan" value="" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal Mulai Kerja</label>
                       <div class="col-md-7">
                            <input type="date" class="form-control" placeholder="Tanggal Mulai Kerja" name="TanggalKerjaKaryawan" value="" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateKaryawan" value="Tambah" class="btn btn-success">
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
