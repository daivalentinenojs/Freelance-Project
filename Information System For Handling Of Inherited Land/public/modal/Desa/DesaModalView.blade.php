<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDDesa = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataDesa = "SELECT Desa.ID AS 'ID', Desa.Nama AS 'DesaName', Desa.IsActive AS 'Status' FROM Desa
                            WHERE Desa.ID = '$IDDesa'";
       $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDataDesa);
       $DataDesa = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
       	$DataDesa[] = $Hasil;
       }
       if ($DataDesa[0]['Status'] == 1) {
              $Status = "Aktif";
       } else {
              $Status = "Tidak Aktif";
       }
}
?>

<form class="form-horizontal" id="FormDetailDesa" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDDesa" value="<?php echo $DataDesa[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataDesa[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Desa</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataDesa[0]['DesaName']; ?>" readonly style="background:white; color:black;"/>
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
