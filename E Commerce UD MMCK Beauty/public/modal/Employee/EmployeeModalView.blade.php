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
}
?>

<form class="form-horizontal" id="FormDetailKaryawan" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Employee Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Address</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataKaryawan[0]['Alamat']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">City</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Kota']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Phone</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <!-- <div class="form-group">
                       <label class="col-md-4 control-label">Handphone</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Handphone']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div> -->
                 <div class="form-group">
                       <label class="col-md-4 control-label">Email</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Role</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['NamaJabatan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Status</label>
                     <div class="col-md-4">
                          <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                     </div>
               </div>
             </div>
        </div>
</div>
</form>
