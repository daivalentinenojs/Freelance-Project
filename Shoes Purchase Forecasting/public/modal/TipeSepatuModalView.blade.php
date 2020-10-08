<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDTipeSepatu = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataTipeSepatu= "SELECT t.ID AS 'Nomor', ms.Nama AS 'Merek', t.Nama AS 'Tipe', t.isDelete AS 'isDelete',
     	 t.ID AS 'View', t.ID AS 'Edit' FROM Tipe t, MerekSepatu ms Where t.MerekSepatuID = ms.ID and t.ID = '$IDTipeSepatu'";
       $HasilQueryGetDataTipeSepatu = mysqli_query($MySQLi, $QueryGetDataTipeSepatu);
       $DataTipeSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataTipeSepatu)) {
       	$DataTipeSepatu[] = $Hasil;
       }

       if($DataTipeSepatu[0]['isDelete'] == 1)
          $isDelete = "Aktif";
       else
          $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormDetailTipeSepatu" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataTipeSepatu[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Merek</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataTipeSepatu[0]['Merek']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tipe Sepatu</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataTipeSepatu[0]['Tipe']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $isDelete; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
             </div>
        </div>
</div>
</form>
