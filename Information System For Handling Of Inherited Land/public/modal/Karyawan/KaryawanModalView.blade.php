<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
                                Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, Karyawan.IsActive AS Status, Karyawan.Jabatan AS Jabatan,
                                Karyawan.IDDaerah AS IDDaerah, users.email AS Email, Daerah.Nama AS NamaDaerah, users.name AS Username, users.email AS Email, users.password AS Password
                                FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah WHERE Karyawan.ID = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
       	$DataKaryawan[] = $Hasil;
       }
       if ($DataKaryawan[0]['Status'] == 1) {
              $Status = "Aktif";
       } else {
              $Status = "Tidak Aktif";
       }

       if ($DataKaryawan[0]["Jabatan"] == 1) {
         $Jabatan = 'Penerima Setoran PNBP';
       } elseif ($DataKaryawan[0]["Jabatan"] == 2) {
         $Jabatan = 'Kepala Sub Bagian TU';
       } elseif ($DataKaryawan[0]["Jabatan"] == 3) {
         $Jabatan = 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah';
       } elseif ($DataKaryawan[0]["Jabatan"] == 4) {
         $Jabatan = 'Kepala Seksi Pengukuran dan Pemetaan';
       } elseif ($DataKaryawan[0]["Jabatan"] == 5) {
         $Jabatan = 'Petugas Pengumpul Data Yuridis';
       } elseif ($DataKaryawan[0]["Jabatan"] == 6) {
         $Jabatan = 'Kepala Seksi Hub Hukum Pertanahan';
       }
}
?>

<form class="form-horizontal" id="FormDetailKaryawan" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDKaryawan" value="<?php echo $DataKaryawan[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Pengguna</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Username']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Email</label>
                       <div class="col-md-5">
                            <input type="email" class="form-control" value="<?php echo $DataKaryawan[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Kata Sandi</label>
                       <div class="col-md-3">
                            <input type="password" class="form-control" value="<?php echo $DataKaryawan[0]['Password']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <br><br>
                 <div class="form-group">
                       <label class="col-md-5 control-label">NIK</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['NIK']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Alamat</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Alamat']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Telepon</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Jabatan</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" value="<?php echo $Jabatan; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Daerah</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['NamaDaerah']; ?>" readonly style="background:white; color:black;"/>
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
