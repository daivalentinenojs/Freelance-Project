<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDDetail = $MySQLi->real_escape_string($_POST["ID"]);
       $QueryGetDataDetail= "SELECT k.ID as 'Nomor', concat(m.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBox', k.Tanggal as 'TanggalBuka', k.Kuantiti as 'JumlahBuka', k.ID as 'View', ds.Stok as 'StokSaatIni'
     	FROM konversi k, detailsepatu ds, tipe t, mereksepatu m, warna w, sizeorbox sob
     	WHERE k.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = m.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID and k.ID = '$IDDetail'";
       $HasilQueryGetDataDetail = mysqli_query($MySQLi, $QueryGetDataDetail);
       $DataDetail = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetail)) {
         $DataDetail[] = $Hasil;
       }

       $QueryGetDataSizeSepatu= "SELECT sob.Nama as 'Ukuran', ds.Stok as 'Stok'
       FROM detailsepatu ds, detailsepatucatatdetailsepatu dscds, sizeorbox sob
       WHERE ds.ID = dscds.SizeID and ds.SizeorBoxID = sob.ID and dscds.BoxID  ='$IDDetail'";
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
                       <label class="col-md-3 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Box</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['NamaBox']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal Buka</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['TanggalBuka'] ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Jumlah Buka</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['JumlahBuka'] ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Stok Saat Ini</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetail[0]['StokSaatIni'] ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                   <table class="table table-bordered">
                   <thead ><tr>
                      <th style="text-align:center" width="5%">Nomor</th>
                       <th style="text-align:center" width="10%">Ukuran Sepatu</th>
                       <th style="text-align:center" width="10%">Stok Saat Ini</th>
                   </tr></thead>

                    <?php
                    //print_r($Databaris);
                      for($i = 0; $i < $Databaris[0]['sum']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center'><td>".$j."</td>";
                        echo "<td>".$DataSizeSepatu[$i]['Ukuran']."</td>";
                        echo "<td>".$DataSizeSepatu[$i]['Stok']."</td></tr>";
                      }

                     ?>
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
