<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSepatu = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataSepatu= "SELECT Mereksepatu.ID AS 'Nomor', Mereksepatu.Nama AS 'Sepatu', Mereksepatu.idDelete AS 'idDelete',
       Mereksepatu.ID AS 'View', Mereksepatu.ID AS 'Edit' FROM Mereksepatu WHERE Mereksepatu.ID = '$IDSepatu'";
       $HasilQueryGetDataSepatu = mysqli_query($MySQLi, $QueryGetDataSepatu);
       $DataSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSepatu)) {
       	$DataSepatu[] = $Hasil;
       }

       if($DataSepatu[0]['idDelete'] == 1)
          $idDelete = "Aktif";
       else
          $idDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormDetailSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataSepatu[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Sepatu</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataSepatu[0]['Sepatu']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $idDelete; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
             </div>
        </div>
</div>
</form>
