<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPembeli = $MySQLi->real_escape_string($_POST["ID"]);
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

<form class="form-horizontal" id="FormDetailPembeli" method="POST" action="EditCustomer" enctype="multipart/form-data">
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
                               <input type="hidden" name="IDUser" value="<?php echo $DataPembeli[0]['IDUser']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataPembeli[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Customer Name</label>
                          <div class="col-md-5">
                               <input type="text" name="Nama" class="form-control" value="<?php echo $DataPembeli[0]['Nama']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                               <textarea  name="Alamat" rows="3" cols="60"><?php echo $DataPembeli[0]['Alamat']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">City</label>
                          <div class="col-md-5">
                               <input type="text" name="Kota" class="form-control" value="<?php echo $DataPembeli[0]['Kota']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Phone</label>
                          <div class="col-md-5">
                               <input type="text" name="Telepon" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo $DataPembeli[0]['Telepon']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Password</label>
                          <div class="col-md-6">
                               <input type="password" required name="Password" class="form-control" value=""  style="background:white; color:black;"/>
                          </div>
                    </div>
                     <div class="form-group">
                            <label class="col-md-4 control-label">Empoyee Photo</label>
                            <div class="col-md-5">
                                   <input type="file" class="fileinput" id="FotoPembeli" name="FotoPembeli"/>
                            </div>
                     </div>
                 <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataPembeli[0]['Status'] == 1) {
                                          echo '<option selected value="1">Active</option>';
                                          echo '<option value="0">Inactive</option>';
                                   } else {
                                          echo '<option value="1">Active</option>';
                                          echo '<option selected value="0">Inactive</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditPembeli" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
