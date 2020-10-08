<?php
if(isset($_POST["ID"]))
{
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPemasok = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataPemasok = "SELECT Pemasoks.IDPemasok AS IDPemasok, 
                                Pemasoks.NoRekening AS NoRekening,
                                Pemasoks.NamaRekening AS NamaRekening, 
                                Pemasoks.Bank AS Bank, 
                                Pemasoks.Alamat AS Alamat, 
                                Pemasoks.NoTelepon AS NoTelepon, 
                                Pemasoks.StatusBeli AS StatusBeli, 
                                Pemasoks.StatusTerdaftar AS StatusTerdaftar
                               FROM Pemasoks
                               WHERE Pemasoks.IDPemasok = '$IDPemasok'";
       $HasilQueryGetDataPemasok = mysqli_query($MySQLi, $QueryGetDataPemasok);
       $DataPemasok = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemasok)) {
       	$DataPemasok[] = $Hasil;
       }

       if ($DataPemasok[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }

       if ($DataPemasok[0]["StatusBeli"] == 0) {
              $StatusBeli = "Hutang";
       } else{
              $StatusBeli = "Lunas";
       }
}
?>

<form class="form-horizontal" id="FormDetailPemasok" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                          <img width="120px" height="160px" src="foto/pemasok/<?php echo $DataPemasok[0]['IDPemasok'];?>.jpg">
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Pemasok:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataPemasok[0]['IDPemasok']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Rekening:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemasok[0]['NoRekening']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Rekening:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemasok[0]['NamaRekening']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataPemasok[0]['Bank']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Alamat:</label>
                       <div class="col-md-4">
                            <textarea class="form-control" value="" readonly style="background:white; color:black;"><?php echo $DataPemasok[0]['Alamat']; ?></textarea>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Telepon:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemasok[0]['NoTelepon']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Beli:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusBeli; ?>" readonly style="background:white; color:black;"/>
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
