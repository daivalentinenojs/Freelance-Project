<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSubKategori = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataSubKategori = "SELECT SubKategori.ID AS ID, SubKategori.ID AS View, SubKategori.ID AS Edit, SubKategori.Nama AS Nama, SubKategori.Keterangan AS Keterangan,
                            SubKategori.IDKategori AS IDKategori, Kategori.Nama AS 'NamaKategori', SubKategori.IsActive AS 'Status'
                            FROM SubKategori INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori
                            WHERE SubKategori.ID = '$IDSubKategori'";
       $HasilQueryGetDataSubKategori = mysqli_query($MySQLi, $QueryGetDataSubKategori);
       $DataSubKategori = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSubKategori)) {
       	$DataSubKategori[] = $Hasil;
       }
       if ($DataSubKategori[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }

       $QueryGetDataCategory = "SELECT Kategori.ID AS 'ID', Kategori.Nama AS 'CategoryName', Kategori.Keterangan AS 'Description', Kategori.IsActive AS 'Status' FROM Kategori WHERE Kategori.IsActive = '1'";
       $HasilQueryGetDataCategory = mysqli_query($MySQLi, $QueryGetDataCategory);
       $DataCategory = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataCategory)) {
           $DataCategory[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailSubKategori" method="POST" action="EditSubCategory" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group">
                          <label class="col-md-4 control-label">ID</label>
                          <div class="col-md-3">
                               <input type="hidden" name="IDSubKategori" value="<?php echo $DataSubKategori[0]['ID']; ?>">
                               <input type="hidden" name="IDUser" value="<?php echo $DataSubKategori[0]['IDUser']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataSubKategori[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Sub Category Name</label>
                          <div class="col-md-5">
                               <input type="text" name="Nama" class="form-control" value="<?php echo $DataSubKategori[0]['Nama']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Description</label>
                        <div class="col-md-6">
                               <textarea  name="Keterangan" rows="3" cols="60"><?php echo $DataSubKategori[0]['Keterangan']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-4 control-label">Category</label>
                            <div class="col-md-4">
                                   <select name="IDKategori" required class="form-control select" data-live-search="true">
                                   <?php foreach ($DataCategory as $Category): ?>
                                          <?php if ($Category['ID'] == $DataSubKategori[0]['IDKategori']) {
                                                 echo '<option value="'.$Category['ID'].'" selected>'.$Category['CategoryName'].'</option>';
                                          } else {
                                                 echo '<option value="'.$Category['ID'].'">'.$Category['CategoryName'].'</option>';
                                          }?>
                                   <?php endforeach; ?>
                                   </select>
                            </div>
                     </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataSubKategori[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditSubKategori" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
