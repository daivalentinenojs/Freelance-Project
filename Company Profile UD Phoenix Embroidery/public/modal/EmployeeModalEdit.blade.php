<?php
if(isset($_POST["ID"])) {
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDUser = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataUser = "SELECT User.ID AS 'ID', User.Name AS 'Name', User.Email AS 'Email', User.NIP AS 'NIP', User.Password AS 'Password',
	User.IsActive AS 'Status', User.ID AS 'View', User.ID AS 'Change' FROM User
                            WHERE User.ID = '$IDUser'";
       $HasilQueryGetDataUser = mysqli_query($MySQLi, $QueryGetDataUser);
       $DataUser = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUser)) {
       	$DataUser[] = $Hasil;
       }
       $Email = explode('@', $DataUser[0]['Email']);
       if ($DataUser[0]['Status'] == 1)
              $Status = "Active";
       else
              $Status = "Inactive";
}
?>

<form class="form-horizontal" id="FormDetailUser" method="POST" action="EditEmployee" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group" style="text-align:center">
                          <img width="125px" height="160px" style="border:3px solid grey; border-radius:5px;" src="foto/User/<?php echo $DataUser[0]['ID'];?>.jpg"><br><br>
                    </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-2">
                              <input type="hidden" name="IDUser" value="<?php echo $DataUser[0]['ID']; ?>">
                            <input type="text" class="form-control" readonly value="<?php echo $DataUser[0]['ID']; ?>"  style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">NIP</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" name="NIP" readonly placeholder="Insert NIP" value="<?php echo $DataUser[0]['NIP']; ?>"  style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Employee Name</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" name="UserName" placeholder="Insert Name" value="<?php echo $DataUser[0]['Name']; ?>"  style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                   <label class="col-md-4 control-label">Email</label>
                   <div class="col-md-4">
                         <input type="text" name="Email" class="form-control" required value="<?php echo $Email[0]; ?>" placeholder="Insert Email" style="background:white; color:black;"/>
                   </div>
                   <div class="col-md-4">
                             <select class="form-control select" data-live-search="true" name="Domain">
                                    <?php
                                    if($Email[1] == "gmail.com") {
                                          echo '<option selected value="@gmail.com">@gmail.com</option>';
                                          echo '<option value="@yahoo.com">@yahoo.com</option>';
                                    } else {
                                           echo '<option value="@gmail.com">@gmail.com</option>';
                                           echo '<option selected value="@yahoo.com">@yahoo.com</option>';
                                    }
                                    ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Password</label>
                       <div class="col-md-6">
                            <input type="password" class="form-control" name="Password" value="<?php echo $DataUser[0]['Password']; ?>"  style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataUser[0]['Status'] == 1) {
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
                 <div class="form-group">
                   <label class="col-md-4 control-label">Foto</label>
                   <div class="col-md-5">
                         <input type="file" class="fileinput" id="FotoUser" name="FotoUser"/><br>
                   </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                       <input type="submit" name="BtnEditEmployee" value="Change" class="btn btn-warning">
                </div>
             </div>
        </div>
</div>
</form>
