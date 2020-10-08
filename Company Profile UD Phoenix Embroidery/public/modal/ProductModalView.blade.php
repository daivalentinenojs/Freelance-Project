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

<form class="form-horizontal" id="FormDetailProduct" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataProduct[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Product Name (English)</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataProduct[0]['ProductName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Product Name (Indonesian)</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataProduct[0]['NamaIndonesia']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Sequence</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataProduct[0]['Urutan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description (English)</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataProduct[0]['Description']; ?>
                            </p>
                     </div>
              </div>
              <div class="form-group">
                  <label class="col-md-5 control-label">Description (Indonesian)</label>
                  <div class="col-md-6">
                         <p readonly name="Description" rows="8" cols="60">
                                <?php echo $DataProduct[0]['DeskripsiIndonesia']; ?>
                         </p>
                  </div>
           </div>
              <div class="form-group">
                     <label class="col-md-5 control-label">Product Category</label>
                     <div class="col-md-7">
                            <?php
                                   for ($i=0; $i < count($DataProduct); $i++) {
                                          echo '<label class="check"><input type="checkbox" checked id="CheckBoxCategory" readonly disabled value="1" name="CheckBoxCategory[]" /> '.$DataProduct[$i]['CategoryName'].'</label><br>';
                                   }
                            ?>
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
