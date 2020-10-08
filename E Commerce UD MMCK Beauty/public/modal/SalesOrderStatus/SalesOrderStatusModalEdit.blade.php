<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSalesOrderStatus = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataSalesOrderStatus = "SELECT StatusNotaJual.ID AS 'ID', StatusNotaJual.Nama AS 'SalesOrderStatusName', StatusNotaJual.IsActive AS 'Status' From StatusNotaJual
                            WHERE StatusNotaJual.ID = '$IDSalesOrderStatus'";
       $HasilQueryGetDataSalesOrderStatus = mysqli_query($MySQLi, $QueryGetDataSalesOrderStatus);
       $DataSalesOrderStatus = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSalesOrderStatus)) {
       	$DataSalesOrderStatus[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailSalesOrderStatus" method="POST" action="EditSalesOrderStatus" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDSalesOrderStatus" class="form-control" value="<?php echo $DataSalesOrderStatus[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Sales Order Status Name</label>
                       <div class="col-md-6">
                            <input type="text" readonly name="NamaSalesOrderStatus" readonly class="form-control" value="<?php echo $DataSalesOrderStatus[0]['SalesOrderStatusName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataSalesOrderStatus[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditSalesOrderStatus" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
