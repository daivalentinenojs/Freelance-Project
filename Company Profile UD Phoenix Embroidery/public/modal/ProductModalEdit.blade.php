<?php
if(isset($_POST["ID"])) {
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDProduct = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataProduct = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName',
                            Product.NamaIndonesia AS 'NamaIndonesia', Product.DeskripsiIndonesia AS 'DeskripsiIndonesia',
                            Product.ProductFormat AS 'ProductFormat', Product.Description AS 'Description', Product.Urutan AS 'Urutan'
				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID
                            WHERE ProductXCategory.IDProductXCategory = '$IDProduct'";
       $HasilQueryGetDataProduct = mysqli_query($MySQLi, $QueryGetDataProduct);
       $DataProduct = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataProduct)) {
       	$DataProduct[] = $Hasil;
       }

       if ($DataProduct[0]['Status'] == 1)
              $Status = "Active";
       else
              $Status = "Inactive";
}
?>

<form class="form-horizontal" id="FormDetailProduct" method="POST" action="EditProduct" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group" style="text-align:center">
                          <?php
                          if ($DataProduct[0]['ProductFormat'] == 0) {
                                echo '<img width="150px" height="160px" src="foto/product/'.$DataProduct[0]['IDProduct'].'.jpg"><br><br>';
                         } else {
                                echo '<video  width="320" height="240" src="foto/product/'.$DataProduct[0]['IDProduct'].'.mp4" controls autoplay></video>';
                         }
                          ?>
                    </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDProduct" class="form-control" value="<?php echo $DataProduct[0]['IDProduct']; ?>" readonly style="background:white; color:black;"/>
                            <input type="text" name="IDProductXCategory" class="form-control" value="<?php echo $DataProduct[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Product Name (English)</label>
                       <div class="col-md-5">
                            <input type="text" name="ProductName" class="form-control" value="<?php echo $DataProduct[0]['ProductName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Product Name (Indonesian)</label>
                       <div class="col-md-5">
                            <input type="text" name="NamaIndonesia" class="form-control" value="<?php echo $DataProduct[0]['NamaIndonesia']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Sequence</label>
                       <div class="col-md-5">
                            <input type="text" name="Urutan" class="form-control" value="<?php echo $DataProduct[0]['Urutan']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Product Category</label>
                       <div class="col-md-7">
                              <label class="check"><input type="checkbox" id="CheckBoxCategory" value="1" name="CheckBoxCategory[]" /> Fashion</label><br>
                              <label class="check"><input type="checkbox" id="CheckBoxCategory" value="2"  name="CheckBoxCategory[]" /> Home Decoration</label><br>
                              <label class="check"><input type="checkbox" id="CheckBoxCategory" value="3"  name="CheckBoxCategory[]" /> 3D Embroidery</label><br>
                              <label class="check"><input type="checkbox" id="CheckBoxCategory" value="4"  name="CheckBoxCategory[]" /> Souvenir</label>
                       </div>
                </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description (English)</label>
                     <div class="col-md-6">
                            <textarea name="Description" rows="8" cols="60"><?php echo $DataProduct[0]['Description']; ?></textarea>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description (Indonesian)</label>
                     <div class="col-md-6">
                            <textarea name="DeskripsiIndonesia" rows="8" cols="60"><?php echo $DataProduct[0]['DeskripsiIndonesia']; ?></textarea>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Product Format</label>
                     <div class="col-md-3">
                     <select class="form-control select" data-live-search="true" name="ProductFormat">
                            <option value="0">Foto</option>
                            <option value="1">Video</option>
                     </select>
                     </div>
                 </div>
              <div class="form-group">
                     <label class="col-md-5 control-label">Foto / Video</label>
                     <div class="col-md-5">
                            <input type="file" class="fileinput" required id="FotoProduct" name="FotoProduct"/><br>
                     </div>
              </div>
              <div class="form-group">
                    <label class="col-md-5 control-label">Status</label>
                    <div class="col-md-4">
                         <select class="form-control select" data-live-search="true" name="StatusProduct">
                                <?php
                                if($DataProduct[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditProduct" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
