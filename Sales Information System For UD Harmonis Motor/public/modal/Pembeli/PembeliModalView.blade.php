<?php
if(isset($_POST["ID"]))
{
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPembeli = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataPembeli = "SELECT Pembelis.IDPembeli AS IDPembeli, 
                               Pembelis.Nama AS Nama, 
                               Pembelis.NoTelepon AS NoTelepon, 
                               Pembelis.Kota AS Kota, 
                               Pembelis.Bank AS Bank, 
                               Pembelis.StatusLangganan AS StatusLangganan, 
                               Pembelis.StatusJual AS StatusJual,
                               Pembelis.StatusTerdaftar AS StatusTerdaftar
                               FROM Pembelis
                               WHERE Pembelis.IDPembeli = '$IDPembeli'";
       $HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
       $DataPembeli = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
       	$DataPembeli[] = $Hasil;
       }

       if ($DataPembeli[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }

       if ($DataPembeli[0]["StatusJual"] == 0) {
              $StatusJual = "Hutang";
       } else {
              $StatusJual = "Lunas";
       }  

       if ($DataPembeli[0]["StatusLangganan"] == 0) {
              $StatusLangganan = "Tidak Langganan";
       } else if ($DataPembeli[0]["StatusLangganan"] == 1) {
              $StatusLangganan = "Langganan";
       }
}
?>

<form class="form-horizontal" id="FormDetailPembeli" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                          <img width="120px" height="160px" src="foto/pembeli/<?php echo $DataPembeli[0]['IDPembeli'];?>.jpg">
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Pembeli:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['IDPembeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Telepon:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['NoTelepon']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Kota:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Kota']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPembeli[0]['Bank']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Langganan:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $StatusLangganan; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Jual:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusJual; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Terdaftar:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusTerdaftar; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
             </div>
        </div>
</div>
</form>
