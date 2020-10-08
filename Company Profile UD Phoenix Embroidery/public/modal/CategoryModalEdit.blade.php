<?php
if(isset($_POST["ID"])) {
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDCategory = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataCategory = "SELECT Category.ID AS 'ID', Category.ID AS 'View',
                            Category.ID AS 'Edit', Category.Name AS 'Name', Category.Description
                            AS 'Description', Category.NamaIndonesia AS 'NamaIndonesia', Category.DeskripsiIndonesia AS 'DeskripsiIndonesia' FROM Category
                            WHERE Category.ID = '$IDCategory'";
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
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDCategory" class="form-control" value="<?php echo $DataCategory[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Category Name (Indonesian)</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaIndonesia" class="form-control" value="<?php echo $DataCategory[0]['NamaIndonesia']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description (English)</label>
                     <div class="col-md-6">
                            <textarea name="Description" rows="5" cols="40"><?php echo $DataCategory[0]['Description']; ?></textarea>
                     </div>
              </div>
              <div class="form-group">
                  <label class="col-md-5 control-label">Description (Indonesian)</label>
                  <div class="col-md-6">
                         <textarea name="DeskripsiIndonesia" rows="8" cols="40"><?php echo $DataCategory[0]['DeskripsiIndonesia']; ?></textarea>
                  </div>
           </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditCategory" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
