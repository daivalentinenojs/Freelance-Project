<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPemohon = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataPemohon = "SELECT Pemohon.ID AS ID, Pemohon.NIK AS NIK, Pemohon.Nama AS Nama, Pemohon.Alamat AS Alamat,
                                Pemohon.Telepon AS Telepon, Pemohon.IDUser AS IDUser, Pemohon.Pekerjaan AS Pekerjaan, Pemohon.Umur AS Umur,
                                users.email AS 'Email', Pemohon.IsActive AS Status, users.name AS Username
                                FROM Pemohon INNER JOIN users ON users.id = Pemohon.IDUser WHERE Pemohon.ID = '$IDPemohon'";
       $HasilQueryGetDataPemohon = mysqli_query($MySQLi, $QueryGetDataPemohon);
       $DataPemohon = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemohon)) {
       	$DataPemohon[] = $Hasil;
       }
       if ($DataPemohon[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }

       $QueryGetDataDaerah = "SELECT Daerah.ID AS 'ID', Daerah.ID AS 'View', Daerah.ID AS 'Edit', Daerah.Nama AS 'NamaDaerah', Daerah.IsActive AS 'Status' FROM Daerah WHERE Daerah.IsActive = '1'";
       $HasilQueryGetDataDaerah = mysqli_query($MySQLi, $QueryGetDataDaerah);
       $DataDaerah = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDaerah)) {
           $DataDaerah[] = $Hasil;
       }

       $QueryGetDataDesa = "SELECT Desa.ID AS 'ID', Desa.ID AS 'View', Desa.ID AS 'Edit', Desa.Nama AS 'NamaDesa', Desa.IsActive AS 'Status' FROM Desa";
       $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDataDesa);
       $DataDesa = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
       $DataDesa[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailPemohon" method="POST" action="EditPemohon" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <!-- <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/Pemohon/<?php echo $DataPemohon[0]['ID'] ?>.jpg">
                    </div><br> -->
                    <div class="form-group">
                          <label class="col-md-5 control-label">ID</label>
                          <div class="col-md-3">
                               <input type="hidden" name="IDPemohon" value="<?php echo $DataPemohon[0]['ID']; ?>">
                               <input type="hidden" name="IDUser" value="<?php echo $DataPemohon[0]['IDUser']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataPemohon[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Nama Pengguna</label>
                          <div class="col-md-3">
                               <input type="text" name="Username" class="form-control" value="<?php echo $DataPemohon[0]['Username']; ?>" readonly style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Email</label>
                          <div class="col-md-5">
                               <input type="email" name="Email" class="form-control" value="<?php echo $DataPemohon[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Kata Sandi</label>
                          <div class="col-md-3">
                               <input type="password" name="Password" class="form-control" value="<?php echo $DataPemohon[0]['Password']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Nama</label>
                          <div class="col-md-4">
                               <input type="text" name="Nama" class="form-control" value="<?php echo $DataPemohon[0]['Nama']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Alamat</label>
                          <div class="col-md-5">
                               <input type="text" name="Alamat" class="form-control" value="<?php echo $DataPemohon[0]['Alamat']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Telepon</label>
                          <div class="col-md-4">
                               <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $DataPemohon[0]['Telepon']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Pekerjaan</label>
                          <div class="col-md-5">
                               <input type="text" name="Pekerjaan" class="form-control" value="<?php echo $DataPemohon[0]['Pekerjaan']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Umur</label>
                          <div class="col-md-4">
                               <input type="text" name="Umur" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $DataPemohon[0]['Umur']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Desa</label>
                          <div class="col-md-4">
                               <select name="IDDesa" required class="form-control select" data-live-search="true">
                               <?php
                                  foreach ($DataDesa as $Desa) {
                                      $IDDesa = $Desa['ID'];
                                      $NamaDesa = $Desa['NamaDesa'];
                                      echo '<option value="'.$IDDesa.'">'.$NamaDesa.'</option>';
                                  }
                                ?>
                               </select>
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataPemohon[0]['Status'] == 1) {
                                          echo '<option selected value="1">Aktif</option>';
                                          echo '<option value="0">Tidak Aktif</option>';
                                   } else {
                                          echo '<option value="1">Aktif</option>';
                                          echo '<option selected value="0">Tidak Aktif</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group">
                        <label class="col-md-5 control-label">Foto Pemohon</label>
                        <div class="col-md-5">
                               <input type="file" class="fileinput" id="FotoPemohon" name="FotoPemohon"/>
                        </div>
                 </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditPemohon" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
