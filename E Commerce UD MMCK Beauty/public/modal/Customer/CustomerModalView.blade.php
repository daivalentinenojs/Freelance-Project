<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPembeli = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataPembeli = "SELECT Pembeli.ID AS ID, Pembeli.ID AS View, Pembeli.ID AS Edit, Pembeli.Nama AS Nama, Pembeli.Alamat AS Alamat, Pembeli.Kota AS Kota,
                            Pembeli.Telepon AS Telepon, Pembeli.Handphone AS Handphone, Pembeli.IDUser AS IDUser,
                            users.email AS 'Email', Pembeli.IsActive AS 'Status'
                            FROM Pembeli INNER JOIN users ON users.id = Pembeli.IDUser
                            WHERE Pembeli.ID = '$IDPembeli'";
       $HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
       $DataPembeli = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
       	$DataPembeli[] = $Hasil;
       }
       if ($DataPembeli[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailPembeli" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <!-- <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/Pembeli/<?php echo $DataPembeli[0]['ID'] ?>.jpg">
                    </div><br> -->
                 <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDPembeli" value="<?php echo $DataPembeli[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Customer Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Address</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataPembeli[0]['Alamat']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">City</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Kota']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Phone</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <!-- <div class="form-group">
                       <label class="col-md-4 control-label">Handphone</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Handphone']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div> -->
                 <div class="form-group">
                       <label class="col-md-4 control-label">Email</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Status</label>
                     <div class="col-md-4">
                          <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                     </div>
               </div>
             </div>
        </div>
</div>
</form>
