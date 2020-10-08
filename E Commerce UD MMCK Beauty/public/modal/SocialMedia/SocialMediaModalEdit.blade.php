<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSocialMedia = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataSocialMedia = "SELECT SosialMedia.ID AS 'ID', SosialMedia.Nama AS 'SocialMediaName', SosialMedia.Keterangan AS 'Description', SosialMedia.Link AS 'Link', SosialMedia.IsActive AS 'Status' FROM SosialMedia
                            WHERE SosialMedia.ID = '$IDSocialMedia'";
       $HasilQueryGetDataSocialMedia = mysqli_query($MySQLi, $QueryGetDataSocialMedia);
       $DataSocialMedia = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSocialMedia)) {
       	$DataSocialMedia[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailSocialMedia" method="POST" action="EditSocialMedia" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" name="IDSosialMedia" class="form-control" value="<?php echo $DataSocialMedia[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Social Media Name</label>
                       <div class="col-md-5">
                            <input type="text" readonly name="NamaSosialMedia" class="form-control" value="<?php echo $DataSocialMedia[0]['SocialMediaName']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Description</label>
                     <div class="col-md-6">
                            <textarea name="Deskripsi" rows="3" cols="60"><?php echo $DataSocialMedia[0]['Description'];?></textarea>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Link</label>
                     <div class="col-md-6">
                            <textarea name="Link" rows="2" cols="60"><?php echo $DataSocialMedia[0]['Link'];?></textarea>
                     </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-4 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataSocialMedia[0]['Status'] == 1) {
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
                     <input type="submit" name="BtnEditSocialMedia" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
