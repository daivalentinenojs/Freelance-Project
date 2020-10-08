<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDCustomer = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataCustomer= "SELECT Customer.ID AS 'Nomor', Customer.NamaPemilik AS 'Nama', Customer.NamaToko AS 'NamaToko', Customer.Alamat
     	 AS 'Alamat', Customer.Telepon AS 'Telepon', Customer.isDelete AS 'isDelete'
       FROM Customer WHERE Customer.ID = '$IDCustomer'";
       $HasilQueryGetDataCustomer = mysqli_query($MySQLi, $QueryGetDataCustomer);
       $DataCustomer = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataCustomer)) {
       	$DataCustomer[] = $Hasil;
       }

       if($DataCustomer[0]['isDelete'] == 1)
          $isDelete = "Aktif";
       else
          $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormTambahCustomer" method="POST" action="UbahDataCustomer">
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
                            <input type="hidden" name="IDCustomer" value="<?php echo $DataCustomer[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Nama Pemilik" name="NamaPemilik" value="<?php echo $DataCustomer[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Toko</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nama Toko" name="NamaToko" value="<?php echo $DataCustomer[0]['NamaToko']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Alamat</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Alamat" name="AlamatCustomer" value=" <?php echo $DataCustomer[0]['Alamat']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="TeleponCustomer" value="<?php echo $DataCustomer[0]['Telepon']; ?>" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteCustomer">
                                    <?php
                                    if($DataCustomer[0]['isDelete'] == 1) {
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
                        <input type="submit" name="BtnEditCustomer" value="Ubah" class="btn btn-warning">
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
