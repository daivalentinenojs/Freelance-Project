<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDRole = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataRole = "SELECT Jabatan.ID AS 'ID', Jabatan.Nama AS 'RoleName', Jabatan.Keterangan AS 'Description', Jabatan.IsActive AS 'Status' FROM Jabatan
                            WHERE Jabatan.ID = '$IDRole'";
       $HasilQueryGetDataRole = mysqli_query($MySQLi, $QueryGetDataRole);
       $DataRole = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataRole)) {
       	$DataRole[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailRole" method="POST" action="EditRole" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDRole" class="form-control" value="<?php echo $DataRole[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Role Name</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaRole" readonly class="form-control" value="<?php echo $DataRole[0]['RoleName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Description</label>
                     <div class="col-md-6">
                            <textarea name="Deskripsi" rows="8" cols="60"><?php echo $DataRole[0]['Description'];?></textarea>
                     </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataRole[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditRole" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
