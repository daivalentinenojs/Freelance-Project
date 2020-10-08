<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSizeSepatu = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataSizeSepatu= "SELECT SizeOrBox.ID AS 'Nomor', SizeOrBox.Nama AS 'Ukuran_Sepatu', SizeOrBox.isDelete AS 'isDelete',
       SizeOrBox.ID AS 'View', SizeOrBox.ID AS 'Edit' FROM SizeOrBox WHERE SizeOrBox.ID = '$IDSizeSepatu'";
       $HasilQueryGetDataSizeSepatu = mysqli_query($MySQLi, $QueryGetDataSizeSepatu);
       $DataSizeSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSizeSepatu)) {
       	$DataSizeSepatu[] = $Hasil;
       }

       if($DataSizeSepatu[0]['isDelete'] == 1)
          $isDelete = "Aktif";
       else
          $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormTambahSizeSepatu" method="POST" action="UbahDataSizeSepatu">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Ukuran Sepatu</label>
                       <div class="col-md-7">
                            <input type="hidden" name="IDSizeSepatu" value="<?php echo $DataSizeSepatu[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Ukuran Sepatu" name="NamaSizeSepatu" value="<?php echo $DataSizeSepatu[0]['Ukuran_Sepatu']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteSizeSepatu">
                                    <?php
                                    if($DataSizeSepatu[0]['isDelete'] == 1) {
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
                        <input type="submit" name="BtnEditSizeSepatu" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
