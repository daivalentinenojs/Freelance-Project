<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSocialMedia = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataSocialMedia = "SELECT SosialMedia.ID AS 'ID', SosialMedia.Nama AS 'SocialMediaName', SosialMedia.Keterangan AS 'Description',  SosialMedia.Link AS 'Link', SosialMedia.IsActive AS 'Status' FROM SosialMedia
                            WHERE SosialMedia.ID = '$IDSocialMedia'";
       $HasilQueryGetDataSocialMedia = mysqli_query($MySQLi, $QueryGetDataSocialMedia);
       $DataSocialMedia = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSocialMedia)) {
       	$DataSocialMedia[] = $Hasil;
       }
       if ($DataSocialMedia[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailSocialMedia" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDSocialMedia" value="<?php echo $DataSocialMedia[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataSocialMedia[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Social Media Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataSocialMedia[0]['SocialMediaName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataSocialMedia[0]['Description']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Link</label>
                     <div class="col-md-6">
                            <p readonly name="Link" rows="8" cols="60">
                                   <?php echo $DataSocialMedia[0]['Link']; ?>
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
