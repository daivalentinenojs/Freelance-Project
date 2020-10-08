<?php
  require '../../connection/Init.php';
  $MySQLi = mysqli_connect($domain, $username, $password, $database);

  $QueryGetSepatu = "SELECT MerekSepatu.ID as 'ID', MerekSepatu.Nama as 'Merek' From Mereksepatu where MerekSepatu.idDelete = 1";
  $HasilQueryGetDataSepatu = mysqli_query($MySQLi, $QueryGetSepatu);
  $DataSepatu = array();
  while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSepatu)) {
   $DataSepatu[] = $Hasil;
  }
?>

<form class="form-horizontal" id="FormTambahTipeSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>

                 <div class="form-group">
                       <input type="hidden" name="IDDetailSepatu" value="<?php echo $DataSepatu[0]['ID']; ?>">
                       <label class="col-md-3 control-label">Merek Sepatu</label>
                       <div class="col-md-5">
                         <select class="form-control select" name="MerekSepatu">
                           <?php
                             for($i=0; $i<count($DataSepatu); $i++){
                               echo "<option value='".$DataSepatu[$i]['ID']."'>".$DataSepatu[$i]['Merek']."</option>";
                             }
                           ?>
                         </select>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tipe Sepatu</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Tipe Sepatu" name="NamaTipeSepatu" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateTipeSepatu" value="Tambah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
