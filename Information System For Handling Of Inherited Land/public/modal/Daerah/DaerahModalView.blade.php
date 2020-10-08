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
       if ($DataDaerah[0]['Status'] == 1) {
              $Status = "Aktif";
       } else {
              $Status = "Tidak Aktif";
       }
}
?>

<form class="form-horizontal" id="FormDetailDaerah" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDDaerah" value="<?php echo $DataDaerah[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataDaerah[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Daerah</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataDaerah[0]['DaerahName']; ?>" readonly style="background:white; color:black;"/>
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
