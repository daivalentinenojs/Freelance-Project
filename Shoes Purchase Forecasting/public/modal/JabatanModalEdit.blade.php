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

<form class="form-horizontal" id="FormTambahJabatan" method="POST" action="UbahDataJabatan">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Jabatan</label>
                       <div class="col-md-7">
                            <input type="hidden" name="IDJabatan" value="<?php echo $DataJabatan[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Jabatan" name="NamaJabatan" value="<?php echo $DataJabatan[0]['Jabatan']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteJabatan">
                                    <?php
                                    if($DataJabatan[0]['isDelete'] == 1) {
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
                        <input type="submit" name="BtnEditJabatan" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
