<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDWarna = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataWarna= "SELECT Warna.ID AS 'Nomor', Warna.Nama AS 'Warna', Warna.isDelete AS 'isDelete',
       Warna.ID AS 'View', Warna.ID AS 'Edit' FROM Warna WHERE Warna.ID = '$IDWarna'";
       $HasilQueryGetDataWarna = mysqli_query($MySQLi, $QueryGetDataWarna);
       $DataWarna = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataWarna)) {
       	$DataWarna[] = $Hasil;
       }

       if($DataWarna[0]['isDelete'] == 1)
          $isDelete = "Aktif";
       else
          $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormTambahWarna" method="POST" action="UbahDataWarna">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Warna</label>
                       <div class="col-md-7">
                            <input type="hidden" name="IDWarna" value="<?php echo $DataWarna[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Warna" name="NamaWarna" value="<?php echo $DataWarna[0]['Warna']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteWarna">
                                    <?php
                                    if($DataWarna[0]['isDelete'] == 1) {
                                           echo "<option selected value='1'>Aktif</option>";
                                           echo "<option value='0'>Tidak Aktif</option>";
                                    } else {
                                           echo "<option value='1'>Aktif</option>";
                                           echo "<option selected value='0'>Tidak Aktif</option>";
                                    }
                                    ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnEditWarna" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
