<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSupplier = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataSupplier= "SELECT Supplier.ID AS 'Nomor', Supplier.Nama AS 'Nama',  Supplier.Alamat AS 'Alamat', Supplier.Telepon AS 'Telepon',
     	 Supplier.isDelete AS 'isDelete', Supplier.ID AS 'View', Supplier.ID AS 'Edit' FROM Supplier WHERE Supplier.ID = '$IDSupplier'";
       $HasilQueryGetDataSupplier = mysqli_query($MySQLi, $QueryGetDataSupplier);
       $DataSupplier = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSupplier)) {
       	$DataSupplier[] = $Hasil;
       }

       if($DataSupplier[0]['isDelete'] == 1)
          $isDelete = "Aktif";
       else
          $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormTambahSupplier" method="POST" action="UbahDataSupplier">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Pemilik</label>
                       <div class="col-md-7">
                            <input type="hidden" name="IDSupplier" value="<?php echo $DataSupplier[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Nama Supplier" name="NamaSupplier" value="<?php echo $DataSupplier[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Alamat</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Alamat" name="AlamatSupplier" value=" <?php echo $DataSupplier[0]['Alamat']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="TeleponSupplier" value="<?php echo $DataSupplier[0]['Telepon']; ?>" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteSupplier">
                                    <?php
                                    if($DataSupplier[0]['isDelete'] == 1) {
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
                        <input type="submit" name="BtnEditSupplier" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
<script type="text/javascript">
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      alert("Harus input angka!");
      return false;
  }
  return true;
}
</script>
