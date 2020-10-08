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
}
?>

<form class="form-horizontal" id="FormDetailDesa" method="POST" action="EditDesa" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDDesa" class="form-control" value="<?php echo $DataDesa[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Desa</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaDesa" class="form-control" value="<?php echo $DataDesa[0]['DesaName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataDesa[0]['Status'] == 1) {
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
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditDesa" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
