<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDJabatan = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataJabatan= "SELECT Jabatan.ID AS 'Nomor', Jabatan.Nama AS 'Jabatan', Jabatan.isDelete AS 'isDelete',
       Jabatan.ID AS 'View', Jabatan.ID AS 'Edit' FROM Jabatan WHERE Jabatan.ID = '$IDJabatan'";
       $HasilQueryGetDataJabatan = mysqli_query($MySQLi, $QueryGetDataJabatan);
       $DataJabatan = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataJabatan)) {
       	$DataJabatan[] = $Hasil;
       }

       if($DataJabatan[0]['isDelete'] == 1)
          $isDelete = "Aktif";
       else
          $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormDetailJabatan" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataJabatan[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Jabatan</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataJabatan[0]['Jabatan']; ?>" readonly style="background:white; color:black;"/>
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
