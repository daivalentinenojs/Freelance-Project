<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPemohon = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataPemohon = "SELECT Pemohon.ID AS ID, Pemohon.NIK AS NIK, Pemohon.Nama AS Nama, Pemohon.Alamat AS Alamat,
                                Pemohon.Telepon AS Telepon, Pemohon.IDUser AS IDUser, Pemohon.Pekerjaan AS Pekerjaan, Pemohon.Umur AS Umur,
                                users.email AS 'Email', Pemohon.IsActive AS Status, users.name AS Username
                                FROM Pemohon INNER JOIN users ON users.id = Pemohon.IDUser WHERE Pemohon.ID = '$IDPemohon'";
       $HasilQueryGetDataPemohon = mysqli_query($MySQLi, $QueryGetDataPemohon);
       $DataPemohon = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemohon)) {
       	$DataPemohon[] = $Hasil;
       }
       if ($DataPemohon[0]['Status'] == 1) {
              $Status = "Aktif";
       } else {
              $Status = "Tidak Aktif";
       }
}
?>

<form class="form-horizontal" id="FormDetailPemohon" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDPemohon" value="<?php echo $DataPemohon[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Pengguna</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['Username']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Email</label>
                       <div class="col-md-5">
                            <input type="email" class="form-control" value="<?php echo $DataPemohon[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Kata Sandi</label>
                       <div class="col-md-3">
                            <input type="password" class="form-control" value="<?php echo $DataPemohon[0]['Password']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <br><br>
                 <div class="form-group">
                       <label class="col-md-5 control-label">NIK</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['NIK']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Alamat</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['Alamat']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Telepon</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Pekerjaan</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['Pekerjaan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Umur</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPemohon[0]['Umur']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Status</label>
                     <div class="col-md-3">
                          <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                     </div>
               </div>
             </div>
        </div>
</div>
</form>
