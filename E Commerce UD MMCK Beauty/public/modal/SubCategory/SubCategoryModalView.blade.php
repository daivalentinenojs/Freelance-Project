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
}
?>

<form class="form-horizontal" id="FormDetailSubKategori" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDSubKategori" value="<?php echo $DataSubKategori[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataSubKategori[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Sub Category Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataSubKategori[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataSubKategori[0]['Keterangan']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Category Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataSubKategori[0]['NamaKategori']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Status</label>
                     <div class="col-md-4">
                          <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                     </div>
               </div>
             </div>
        </div>
</div>
</form>
