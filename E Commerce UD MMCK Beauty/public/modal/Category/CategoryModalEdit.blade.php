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
}
?>

<form class="form-horizontal" id="FormDetailCategory" method="POST" action="EditCategory" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDKategori" class="form-control" value="<?php echo $DataCategory[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Category Name</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaKategori" class="form-control" value="<?php echo $DataCategory[0]['CategoryName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Description</label>
                     <div class="col-md-6">
                            <textarea name="Deskripsi" rows="8" cols="60"><?php echo $DataCategory[0]['Description'];?></textarea>
                     </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataCategory[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditCategory" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
