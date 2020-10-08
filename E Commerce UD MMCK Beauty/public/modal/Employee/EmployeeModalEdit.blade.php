<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.ID AS View, Karyawan.ID AS Edit, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat, Karyawan.Kota AS Kota,
                            Karyawan.Telepon AS Telepon, Karyawan.Handphone AS Handphone, Karyawan.IDUser AS IDUser,
                            Karyawan.IDJabatan AS IDJabatan, users.email AS 'Email', Jabatan.Nama AS 'NamaJabatan', Karyawan.IsActive AS 'Status'
                            FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Jabatan ON Jabatan.ID = Karyawan.IDJabatan
                            WHERE Karyawan.ID = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
       	$DataKaryawan[] = $Hasil;
       }
       if ($DataKaryawan[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }

       $QueryGetDataRole = "SELECT Jabatan.ID AS 'ID', Jabatan.Nama AS 'RoleName', Jabatan.Keterangan AS 'Description', Jabatan.IsActive AS 'Status' FROM Jabatan WHERE Jabatan.IsActive = '1'";
       $HasilQueryGetDataRole = mysqli_query($MySQLi, $QueryGetDataRole);
       $DataRole = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataRole)) {
           $DataRole[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailKaryawan" method="POST" action="EditEmployee" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <!-- <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/karyawan/<?php echo $DataKaryawan[0]['ID'] ?>.jpg">
                    </div><br> -->
                    <div class="form-group">
                          <label class="col-md-4 control-label">ID</label>
                          <div class="col-md-3">
                               <input type="hidden" name="IDKaryawan" value="<?php echo $DataKaryawan[0]['ID']; ?>">
                               <input type="hidden" name="IDUser" value="<?php echo $DataKaryawan[0]['IDUser']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataKaryawan[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Employee Name</label>
                          <div class="col-md-5">
                               <input type="text" name="Nama" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                               <textarea  name="Alamat" rows="3" cols="60"><?php echo $DataKaryawan[0]['Alamat']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">City</label>
                          <div class="col-md-5">
                               <input type="text" name="Kota" class="form-control" value="<?php echo $DataKaryawan[0]['Kota']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Phone</label>
                          <div class="col-md-5">
                               <input type="text" name="Telepon" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo $DataKaryawan[0]['Telepon']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Password</label>
                          <div class="col-md-6">
                               <input type="password" required name="Password" class="form-control" value=""  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-4 control-label">Role</label>
                            <div class="col-md-4">
                                   <select name="IDJabatan" required class="form-control select" data-live-search="true">
                                   <?php foreach ($DataRole as $Role): ?>
                                          <?php if ($Role['ID'] == $DataKaryawan[0]['IDJabatan']) {
                                                 echo '<option value="'.$Role['ID'].'" selected>'.$Role['RoleName'].'</option>';
                                          } else {
                                                 echo '<option value="'.$Role['ID'].'">'.$Role['RoleName'].'</option>';
                                          }?>
                                   <?php endforeach; ?>
                                   </select>
                            </div>
                     </div>
                     <div class="form-group">
                            <label class="col-md-4 control-label">Empoyee Photo</label>
                            <div class="col-md-5">
                                   <input type="file" class="fileinput" id="FotoKaryawan" name="FotoKaryawan"/>
                            </div>
                     </div>
                 <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataKaryawan[0]['Status'] == 1) {
                                          echo '<option selected value="1">Active</option>';
                                          echo '<option value="0">Inactive</option>';
                                   } else {
                                          echo '<option value="1">Active</option>';
                                          echo '<option selected value="0">Inactive</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditKaryawan" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
