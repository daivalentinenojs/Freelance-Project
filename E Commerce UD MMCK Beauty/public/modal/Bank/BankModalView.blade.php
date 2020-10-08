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
       if ($DataBank[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailBank" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDBank" value="<?php echo $DataBank[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataBank[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank Name</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataBank[0]['BankName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Account Owner Name</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataBank[0]['NamaPemilikRekening']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Account Number</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataBank[0]['NomorRekening']; ?>" readonly style="background:white; color:black;"/>
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
