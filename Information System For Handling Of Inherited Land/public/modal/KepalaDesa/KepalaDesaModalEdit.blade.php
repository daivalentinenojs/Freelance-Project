<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKepalaDesa = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataKepalaDesa = "SELECT KepalaDesa.ID AS ID, KepalaDesa.ID AS View, KepalaDesa.ID AS Edit, KepalaDesa.Nama AS Nama, KepalaDesa.IDUser AS IDUser,
                                KepalaDesa.IDDesa AS IDDesa, Desa.Nama AS NamaDesa, users.name AS 'Username',
                                users.email AS 'Email', KepalaDesa.IsActive AS 'Status'
                                FROM KepalaDesa INNER JOIN users ON users.id = KepalaDesa.IDUser INNER JOIN Desa ON Desa.ID = KepalaDesa.IDDesa WHERE KepalaDesa.ID = '$IDKepalaDesa'";
       $HasilQueryGetDataKepalaDesa = mysqli_query($MySQLi, $QueryGetDataKepalaDesa);
       $DataKepalaDesa = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKepalaDesa)) {
       	$DataKepalaDesa[] = $Hasil;
       }
       if ($DataKepalaDesa[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }

       $QueryGetDataDesa = "SELECT Desa.ID AS 'ID', Desa.ID AS 'View', Desa.ID AS 'Edit', Desa.Nama AS 'NamaDesa', Desa.IsActive AS 'Status' FROM Desa WHERE Desa.IsActive = '1'";
       $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDataDesa);
       $DataDesa = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
           $DataDesa[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailKepalaDesa" method="POST" action="EditKepalaDesa" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <!-- <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/KepalaDesa/<?php echo $DataKepalaDesa[0]['ID'] ?>.jpg">
                    </div><br> -->
                    <div class="form-group">
                          <label class="col-md-5 control-label">ID</label>
                          <div class="col-md-3">
                               <input type="hidden" name="IDKepalaDesa" value="<?php echo $DataKepalaDesa[0]['ID']; ?>">
                               <input type="hidden" name="IDUser" value="<?php echo $DataKepalaDesa[0]['IDUser']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataKepalaDesa[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Nama Pengguna</label>
                          <div class="col-md-3">
                               <input type="text" name="Username" class="form-control" value="<?php echo $DataKepalaDesa[0]['Username']; ?>" readonly style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Email</label>
                          <div class="col-md-5">
                               <input type="email" name="Email" class="form-control" value="<?php echo $DataKepalaDesa[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Kata Sandi</label>
                          <div class="col-md-3">
                               <input type="password" name="Password" class="form-control" value="<?php echo $DataKepalaDesa[0]['Password']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Nama</label>
                          <div class="col-md-4">
                               <input type="text" name="Nama" class="form-control" value="<?php echo $DataKepalaDesa[0]['Nama']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-5 control-label">Desa</label>
                            <div class="col-md-4">
                                   <select name="IDDesa" required class="form-control select" data-live-search="true">
                                   <?php foreach ($DataDesa as $Desa): ?>
                                          <?php if ($Desa['ID'] == $DataKepalaDesa[0]['IDDesa']) {
                                                 echo '<option value="'.$Desa['ID'].'" selected>'.$Desa['NamaDesa'].'</option>';
                                          } else {
                                                 echo '<option value="'.$Desa['ID'].'">'.$Desa['NamaDesa'].'</option>';
                                          }?>
                                   <?php endforeach; ?>
                                   </select>
                            </div>
                     </div>
                    <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataKepalaDesa[0]['Status'] == 1) {
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
                        <label class="col-md-5 control-label">Foto Kepala Desa</label>
                        <div class="col-md-5">
                               <input type="file" class="fileinput" id="FotoKepalaDesa" name="FotoKepalaDesa"/>
                        </div>
                 </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditKepalaDesa" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
