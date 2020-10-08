<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDDaerah = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataDaerah = "SELECT Daerah.ID AS 'ID', Daerah.Nama AS 'DaerahName', Daerah.IsActive AS 'Status' FROM Daerah
                            WHERE Daerah.ID = '$IDDaerah'";
       $HasilQueryGetDataDaerah = mysqli_query($MySQLi, $QueryGetDataDaerah);
       $DataDaerah = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDaerah)) {
       	$DataDaerah[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailDaerah" method="POST" action="EditDaerah" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDDaerah" class="form-control" value="<?php echo $DataDaerah[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Daerah</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaDaerah" class="form-control" value="<?php echo $DataDaerah[0]['DaerahName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataDaerah[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditDaerah" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
