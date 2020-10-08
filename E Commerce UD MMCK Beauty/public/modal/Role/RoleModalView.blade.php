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
       if ($DataRole[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailRole" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDRole" value="<?php echo $DataRole[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataRole[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Role Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataRole[0]['RoleName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataRole[0]['Description']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Status</label>
                     <div class="col-md-4">
                          <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                     </div>
               </div>
             </div>
        </div>
</div>
</form>
