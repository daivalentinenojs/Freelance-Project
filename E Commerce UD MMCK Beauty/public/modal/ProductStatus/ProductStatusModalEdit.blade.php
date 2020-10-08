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
}
?>

<form class="form-horizontal" id="FormDetailProductStatus" method="POST" action="EditProductStatus" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDProductStatus" class="form-control" value="<?php echo $DataProductStatus[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ProductStatus Name</label>
                       <div class="col-md-5">
                            <input type="text" readonly name="NamaProductStatus" readonly class="form-control" value="<?php echo $DataProductStatus[0]['ProductStatusName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataProductStatus[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditProductStatus" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
