<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataKaryawan= "SELECT u.IDUser AS 'Nomor', u.Nama AS 'Nama', u.Email AS 'Email', j.Nama AS 'Jabatan', u.Alamat AS 'Alamat',
     	 u.Telepon AS 'Telepon', u.isDelete AS 'isDelete', u.IDUser AS 'View', u.IDUser AS 'Edit', u.Password AS 'Password',
       u.TanggalMulaiKerja AS 'TanggalMulaiKerja' FROM User u, Jabatan j WHERE j.ID = u.JabatanID and u.IDUser = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
       	$DataKaryawan[] = $Hasil;
       }
       if($DataKaryawan[0]['isDelete'] == 1)
              $isDelete = "Aktif";
       else
              $isDelete = "Tidak Aktif";

      $Email = explode('@', $DataKaryawan[0]['Email']);

      $QueryGetDataJabatan = "SELECT Jabatan.ID as 'ID', Jabatan.Nama as 'Jabatan' From Jabatan Where Jabatan.isDelete = 1";
      $HasilQueryGetDataJabatan = mysqli_query($MySQLi, $QueryGetDataJabatan);
      $DataJabatan = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataJabatan)) {
        $DataJabatan[] = $Hasil;
      }
}
?>

<form class="form-horizontal" id="FormTambahKaryawan" method="POST" action="UbahDataKaryawan">
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
                            <input type="hidden" name="IDKaryawan" value="<?php echo $DataKaryawan[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Nama Karyawan" name="NamaKaryawan" value="<?php echo $DataKaryawan[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $Email[0]; ?>" placeholder="Email" name="EmailKaryawan" style="background:white; color:black;"/>
                      </div>
                      <div class="col-md-3">
                             <select class="form-control select" data-live-search="true" name="DomainKaryawan">
                                    <?php
                                    if($Email[1]=="gmail.com") {
                                          echo "<option selected value='@gmail.com'>@gmail.com</option>";
                                          echo "<option value='@yahoo.com'>@yahoo.com</option>";
                                    } else {
                                           echo "<option value='@gmail.com'>@gmail.com</option>";
                                           echo "<option selected value='@yahoo.com'>@yahoo.com</option>";
                                    }
                                    ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Kata Sandi</label>
                       <div class="col-md-5">
                            <input type="password" class="form-control" placeholder="Kata Sandi" name="PasswordKaryawan" value="<?php echo $DataKaryawan[0]['Password']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Jabatan</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="JabatanKaryawan">
                               <?php
                                 for($i=0; $i<count($DataJabatan); $i++){
                                   if($DataJabatan[$i]['Jabatan'] == $DataKaryawan[0]['Jabatan'])
                                      echo "<option selected value='".$DataJabatan[$i]['ID']."'>".$DataJabatan[$i]['Jabatan']."</option>";
                                   else
                                     echo "<option value='".$DataJabatan[$i]['ID']."'>".$DataJabatan[$i]['Jabatan']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Alamat</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Alamat " name="AlamatKaryawan" value="<?php echo $DataKaryawan[0]['Alamat']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="TeleponKaryawan" value="<?php echo $DataKaryawan[0]['Telepon']; ?>" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal Mulai Kerja</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Tanggal Mulai Kerja" name="TanggalKerjaKaryawan" value="<?php echo $DataKaryawan[0]['TanggalMulaiKerja']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteKaryawan">
                                    <?php
                                    if($DataKaryawan[0]['isDelete'] == 1) {
                                           echo "<option selected value='1'>Aktif</option>";
                                           echo "<option value='0'>Tidak Aktif</option>";
                                    } else {
                                           echo "<option value='1'>Aktif</option>";
                                           echo "<option selected value='0'>Tidak Aktif</option>";
                                    }
                                    ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnEditKaryawan" value="Ubah" class="btn btn-warning">
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
