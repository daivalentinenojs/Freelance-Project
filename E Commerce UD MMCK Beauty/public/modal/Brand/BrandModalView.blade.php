<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDBrand = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataBrand = "SELECT Merk.ID AS 'ID', Merk.Nama AS 'BrandName', Merk.Keterangan AS 'Description', Merk.IsActive AS 'Status' FROM Merk
                            WHERE Merk.ID = '$IDBrand'";
       $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
       $DataBrand = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
       	$DataBrand[] = $Hasil;
       }
       if ($DataBrand[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailBrand" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDBrand" value="<?php echo $DataBrand[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataBrand[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Brand Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataBrand[0]['BrandName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataBrand[0]['Description']; ?>
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
