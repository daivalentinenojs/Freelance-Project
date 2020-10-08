<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDTipeSepatu = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataTipeSepatu= "SELECT t.ID AS 'Nomor', ms.Nama AS 'Merek', t.Nama AS 'Tipe', t.isDelete AS 'isDelete',
     	 t.ID AS 'View', t.ID AS 'Edit' FROM Tipe t, MerekSepatu ms Where t.MerekSepatuID = ms.ID and t.ID = '$IDTipeSepatu'";
       $HasilQueryGetDataTipeSepatu = mysqli_query($MySQLi, $QueryGetDataTipeSepatu);
       $DataTipeSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataTipeSepatu)) {
       	$DataTipeSepatu[] = $Hasil;
       }

       $QueryGetSepatu = "SELECT MerekSepatu.ID as 'ID', MerekSepatu.Nama as 'Merek' From Mereksepatu where MerekSepatu.idDelete = 1";
       $HasilQueryGetDataSepatu = mysqli_query($MySQLi, $QueryGetSepatu);
       $DataSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSepatu)) {
        $DataSepatu[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormTambahTipeSepatu" method="POST" action="UbahDataTipeSepatu">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Merek Sepatu</label>
                       <div class="col-md-7">
                            <input type="hidden" name="IDDetailSepatu" value="<?php echo $DataTipeSepatu[0]['Nomor']; ?>">
                            <select class="form-control select" name="MerekSepatu">
                              <?php
                                for($i=0; $i<count($DataSepatu); $i++){
                                  if($DataSepatu[$i]['Merek'] == $DataTipeSepatu[0]['Merek'])
                                     echo "<option selected value='".$DataSepatu[$i]['ID']."'>".$DataSepatu[$i]['Merek']."</option>";
                                  else
                                    echo "<option value='".$DataSepatu[$i]['ID']."'>".$DataSepatu[$i]['Merek']."</option>";
                                 }
                              ?>
                            </select>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tipe Sepatu</label>
                       <div class="col-md-7">
                            <input type="hidden" name="IDTipeSepatu" value="<?php echo $DataTipeSepatu[0]['Nomor']; ?>">
                            <input type="text" class="form-control" placeholder="Tipe Sepatu" name="NamaTipeSepatu" value="<?php echo $DataTipeSepatu[0]['Tipe']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDeleteTipeSepatu">
                                    <?php
                                    if($DataTipeSepatu[0]['isDelete'] == 1) {
                                           echo "<option selected value='1'>Aktif</option>";
                                           echo "<option value='0'>Tidak Aktif</option>";
                                    } else {
                                           echo "<option value='1'>Aktif</option>";
                                           echo "<option selected value='0'>Tidak Aktif</option>";
                                    }
                                    ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnEditTipeSepatu" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
