<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDProductStatus = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataProductStatus = "SELECT StatusBarang.ID AS 'ID', StatusBarang.Nama AS 'ProductStatusName', StatusBarang.IsActive AS 'Status' From StatusBarang
                            WHERE StatusBarang.ID = '$IDProductStatus'";
       $HasilQueryGetDataProductStatus = mysqli_query($MySQLi, $QueryGetDataProductStatus);
       $DataProductStatus = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataProductStatus)) {
       	$DataProductStatus[] = $Hasil;
       }
       if ($DataProductStatus[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailProductStatus" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDProductStatus" value="<?php echo $DataProductStatus[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataProductStatus[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Product Status Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataProductStatus[0]['ProductStatusName']; ?>" readonly style="background:white; color:black;"/>
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
