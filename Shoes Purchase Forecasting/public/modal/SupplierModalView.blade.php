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

<form class="form-horizontal" id="FormDetailSupplier" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataSupplier[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Supplier</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataSupplier[0]['Nama']; ?>"  readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Alamat</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataSupplier[0]['Alamat']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataSupplier[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
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
