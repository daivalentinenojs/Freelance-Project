<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSlider = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataSlider = "SELECT Slider.ID AS 'ID', Slider.Nama AS 'SliderName', Slider.Judul AS 'Title', Slider.Keterangan AS 'Description', Slider.IsActive AS 'Status' FROM Slider
                            WHERE Slider.ID = '$IDSlider'";
       $HasilQueryGetDataSlider = mysqli_query($MySQLi, $QueryGetDataSlider);
       $DataSlider = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSlider)) {
       	$DataSlider[] = $Hasil;
       }
       if ($DataSlider[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }
}
?>

<form class="form-horizontal" id="FormDetailSlider" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                     <img width="180px" height="160px" style="border-radius:20px; border: 2px solid black;" src="foto/slider/<?php echo $DataSlider[0]['ID'] ?>.jpg">
                 </div><br>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDSlider" value="<?php echo $DataSlider[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataSlider[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Slider Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataSlider[0]['SliderName']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Slider Title</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataSlider[0]['Title']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataSlider[0]['Description']; ?>
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
