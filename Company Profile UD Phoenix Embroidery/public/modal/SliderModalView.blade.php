<?php
if(isset($_POST["ID"])) {
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSlider = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataSlider = "SELECT Slider.ID AS 'ID', Slider.ID AS 'View', Slider.ID AS 'Edit', Slider.Nama AS 'Name' FROM Slider
                            WHERE Slider.ID = '$IDSlider'";
       $HasilQueryGetDataSlider = mysqli_query($MySQLi, $QueryGetDataSlider);
       $DataSlider = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSlider)) {
       	$DataSlider[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailSlider" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group" style="text-align:center">
                          <img width="150px" height="160px" src="foto/slider/<?php echo $DataSlider[0]['ID'];?>.jpg"><br><br>
                    </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataSlider[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Slider Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataSlider[0]['Name']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>                 
             </div>
        </div>
</div>
</form>
