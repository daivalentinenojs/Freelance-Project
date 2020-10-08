<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDSizeSepatu = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataSizeSepatu= "SELECT  mcb.ID as 'Nomor', ss.Nama as 'Ukuran_Sepatu', bd.Boxsize as 'Boxsize', bd.Jumlah as 'Jumlah', ms.Nama as 'Merek', mcb.isDelete as 'isDelete'
       FROM boxdetail bd, merekcatatboxdetail mcb, mereksepatu ms , sizesepatu ss Where bd.ID = mcb.BoxDetailID and
       ms.ID = mcb.MerekSepatuID and bd.SizeID = ss.ID and mcb.ID = '$IDSizeSepatu'";
       $HasilQueryGetDataSizeSepatu = mysqli_query($MySQLi, $QueryGetDataSizeSepatu);
       $DataSizeSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSizeSepatu)) {
         $DataSizeSepatu[] = $Hasil;
       }

       if($DataSizeSepatu[0]['Boxsize'] == 'Kecil')
          $UkuranBox = "Kecil";
       else if ($DataSizeSepatu[0]['Boxsize'] == 'Sedang')
          $UkuranBox = "Sedang";
       else if ($DataSizeSepatu[0]['Boxsize'] == 'Besar')
          $UkuranBox = "Besar";
}
?>

<form class="form-horizontal" id="FormTambahSizeSepatu" method="POST" action="UbahDataBoxDetail">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Merek Sepatu</label>
                       <div class="col-md-6">
                         <input type="hidden" name="IDMerekCatatBox" value="<?php echo $DataSizeSepatu[0]['Nomor']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataSizeSepatu[0]['Merek']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Ukuran Box</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $UkuranBox ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="isDelete">
                                    <?php
                                    if($DataSizeSepatu[0]['isDelete'] == 1) {
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
                        <input type="submit" name="BtnEditSizeSepatu" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
