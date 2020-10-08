<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDCategory = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataCategory = "SELECT Kategori.ID AS 'ID', Kategori.Nama AS 'CategoryName', Kategori.Keterangan AS 'Description', Kategori.IsActive AS 'Status' FROM Kategori
                            WHERE Kategori.ID = '$IDCategory'";
       $HasilQueryGetDataCategory = mysqli_query($MySQLi, $QueryGetDataCategory);
       $DataCategory = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataCategory)) {
       	$DataCategory[] = $Hasil;
       }
       if ($DataCategory[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailCategory" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDCategory" value="<?php echo $DataCategory[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataCategory[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Category Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataCategory[0]['CategoryName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataCategory[0]['Description']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
             </div>
        </div>
</div>
</form>
