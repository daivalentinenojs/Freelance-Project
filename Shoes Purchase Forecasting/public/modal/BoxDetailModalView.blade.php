<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDDetail = $MySQLi->real_escape_string($_POST["ID"]);
       $QueryGetDataDetail= "SELECT DISTINCT ms.Nama as 'Merek', sob.Nama as 'Boxsize', ds.ID as 'Nomor', t.Nama as 'Tipe', w.Nama as 'Warna'
       FROM detailsepatu ds, sizeorbox sob, tipe t, mereksepatu ms, detailsepatucatatdetailsepatu dsc, warna w
       WHERE ds.SizeorBoxID = sob.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID and ds.WarnaID = w.ID  and ds.ID = dsc.BoxID and dsc.BoxID = '$IDDetail'";
       $HasilQueryGetDataDetail = mysqli_query($MySQLi, $QueryGetDataDetail);
       $DataDetail = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetail)) {
         $DataDetail[] = $Hasil;
       }

       $QueryGetDataSizeSepatu= "SELECT sob.Nama as 'Ukuran', dsc.Jumlah as 'Jumlah'
       From detailsepatu ds, detailsepatucatatdetailsepatu dsc, sizeorbox sob
       WHERE dsc.SizeID = ds.ID and ds.SizeorBoxID = sob.ID and dsc.BoxID ='$IDDetail'";
       $HasilQueryGetDataSizeSepatu = mysqli_query($MySQLi, $QueryGetDataSizeSepatu);
       $DataSizeSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSizeSepatu)) {
         $DataSizeSepatu[] = $Hasil;
       }

       $QueryGetDatabaris= "SELECT count(dsc.BoxID) as 'sum' FROM detailsepatucatatdetailsepatu dsc Where dsc.BoxID ='$IDDetail'";
       $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
       $Databaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
         $Databaris[] = $Hasil;
       }

}
?>

<form class="form-horizontal" id="FormDetailSizeSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>

                 <div class="form-group">
                   <table class="table table-bordered">
                   <thead ><tr>
                      <th style="text-align:center" width="5%">Nomor</th>
                       <th style="text-align:center" width="10%">Ukuran Sepatu</th>
                       <th style="text-align:center" width="10%">Jumlah</th>
                   </tr></thead>

                    <?php
                    //print_r($Databaris);
                      for($i = 0; $i < $Databaris[0]['sum']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center'><td>".$j."</td>";
                        echo "<td>".$DataSizeSepatu[$i]['Ukuran']."</td>";
                        echo "<td>".$DataSizeSepatu[$i]['Jumlah']."</td></tr>";
                      }

                     ?>
                 </div>


                 <div class="form-group">
                       <label class="col-md-3 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Sepatu</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['Merek'].' '.$DataDetail[0]['Tipe'].' '.$DataDetail[0]['Warna']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Ukuran Box</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['Boxsize'] ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <!--div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $isDelete; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div-->
             </div>
        </div>
</div>
</form>
