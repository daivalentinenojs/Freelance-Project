<?php
if(isset($_POST["ID"])) {
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDUser = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataUser = "SELECT User.ID AS 'ID', User.Name AS 'Name', User.Email AS 'Email', User.NIP AS 'NIP',
	User.IsActive AS 'Status', User.ID AS 'View', User.ID AS 'Change' FROM User
                            WHERE User.ID = '$IDUser'";
       $HasilQueryGetDataUser = mysqli_query($MySQLi, $QueryGetDataUser);
       $DataUser = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUser)) {
       	$DataUser[] = $Hasil;
       }

       if ($DataUser[0]['Status'] == 1)
              $Status = "Active";
       else
              $Status = "Inactive";
}
?>

<form class="form-horizontal" id="FormDetailUser" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group" style="text-align:center">
                          <img width="125px" height="160px" style="border:3px solid grey; border-radius:5px;" src="foto/User/<?php echo $DataUser[0]['ID'];?>.jpg"><br><br>
                    </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataUser[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">NIP</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataUser[0]['NIP']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataUser[0]['Name']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Email</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataUser[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $Status; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
             </div>
        </div>
</div>
</form>
