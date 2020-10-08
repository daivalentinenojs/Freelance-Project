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

<form class="form-horizontal" id="FormDetailCustomer" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataCustomer[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Pemilik</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataCustomer[0]['Nama']; ?>"  readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Toko</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control"  value="<?php echo $DataCustomer[0]['NamaToko']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Alamat</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataCustomer[0]['Alamat']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Telepon</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataCustomer[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
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
