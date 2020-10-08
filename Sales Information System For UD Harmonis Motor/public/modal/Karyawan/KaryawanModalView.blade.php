<?php
if(isset($_POST["ID"]))
{
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataKaryawan = "SELECT Karyawans.IDKaryawan AS IDKaryawan, 
                                Karyawans.Nama AS Nama,
                                Karyawans.Alamat AS Alamat,
                                Karyawans.Email AS Email,
                                Karyawans.NoTelepon AS NoTelepon,
                                Karyawans.StatusTerdaftar AS StatusTerdaftar
                                FROM Karyawans
                                WHERE Karyawans.IDKaryawan = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
       	$DataKaryawan[] = $Hasil;
       }
       if ($DataKaryawan[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }
}
?>

<form class="form-horizontal" id="FormDetailKaryawan" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <img width="120px" height="160px" src="foto/karyawan/<?php echo $DataKaryawan[0]['IDKaryawan'];?>.jpg">
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Karyawan:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['IDKaryawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Alamat:</label>
                       <div class="col-md-4">
                            <textarea class="form-control" value="" readonly style="background:white; color:black;"><?php echo $DataKaryawan[0]['Alamat']; ?></textarea>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Email:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Telepon:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['NoTelepon']; ?>" readonly style="background:white; color:black;"/>
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
