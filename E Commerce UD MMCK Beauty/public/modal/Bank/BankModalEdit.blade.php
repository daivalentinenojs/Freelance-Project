<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDBank = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataBank = "SELECT Bank.ID AS 'ID', Bank.Nama AS 'BankName', Bank.NamaPemilikRekening AS 'NamaPemilikRekening', Bank.NomorRekening AS 'NomorRekening', Bank.IsActive AS 'Status' FROM Bank
                            WHERE Bank.ID = '$IDBank'";
       $HasilQueryGetDataBank = mysqli_query($MySQLi, $QueryGetDataBank);
       $DataBank = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBank)) {
       	$DataBank[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailBank" method="POST" action="EditBank" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDBank" class="form-control" value="<?php echo $DataBank[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank Name</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaBank" readonly class="form-control" value="<?php echo $DataBank[0]['BankName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Account Owner Name</label>
                       <div class="col-md-6">
                            <input type="text" name="NamaPemilikRekening" class="form-control" value="<?php echo $DataBank[0]['NamaPemilikRekening']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Account Number</label>
                       <div class="col-md-5">
                            <input type="text" name="NomorRekening" onkeypress = "return isNumberKey(event)" class="form-control" value="<?php echo $DataBank[0]['NomorRekening']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataBank[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditBank" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
