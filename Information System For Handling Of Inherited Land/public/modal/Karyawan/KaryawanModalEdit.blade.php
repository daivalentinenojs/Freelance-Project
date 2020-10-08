<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
                                Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, Karyawan.IsActive AS Status, Karyawan.IDUser AS IDUser, Karyawan.Jabatan AS Jabatan,
                                Karyawan.IDDaerah AS IDDaerah, users.email AS 'Email', Daerah.Nama AS 'NamaDaerah', users.name AS 'Username', users.email AS 'Email', users.password AS 'Password'
                                FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah WHERE Karyawan.ID = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
       	$DataKaryawan[] = $Hasil;
       }
       if ($DataKaryawan[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }

       $QueryGetDataDaerah = "SELECT Daerah.ID AS 'ID', Daerah.ID AS 'View', Daerah.ID AS 'Edit', Daerah.Nama AS 'NamaDaerah', Daerah.IsActive AS 'Status' FROM Daerah WHERE Daerah.IsActive = '1'";
       $HasilQueryGetDataDaerah = mysqli_query($MySQLi, $QueryGetDataDaerah);
       $DataDaerah = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDaerah)) {
           $DataDaerah[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailKaryawan" method="POST" action="EditKaryawan" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <!-- <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/karyawan/<?php echo $DataKaryawan[0]['ID'] ?>.jpg">
                    </div><br> -->
                    <div class="form-group">
                          <label class="col-md-5 control-label">ID</label>
                          <div class="col-md-3">
                               <input type="hidden" name="IDKaryawan" value="<?php echo $DataKaryawan[0]['ID']; ?>">
                               <input type="hidden" name="IDUser" value="<?php echo $DataKaryawan[0]['IDUser']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataKaryawan[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Nama Pengguna</label>
                          <div class="col-md-3">
                               <input type="text" name="Username" class="form-control" value="<?php echo $DataKaryawan[0]['Username']; ?>" readonly style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Email</label>
                          <div class="col-md-5">
                               <input type="email" name="Email" class="form-control" value="<?php echo $DataKaryawan[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Kata Sandi</label>
                          <div class="col-md-3">
                               <input type="password" name="Password" class="form-control" value="<?php echo $DataKaryawan[0]['Password']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Nama</label>
                          <div class="col-md-4">
                               <input type="text" name="Nama" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Alamat</label>
                          <div class="col-md-5">
                               <input type="text" name="Alamat" class="form-control" value="<?php echo $DataKaryawan[0]['Alamat']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-5 control-label">Telepon</label>
                          <div class="col-md-4">
                               <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $DataKaryawan[0]['Telepon']; ?>" style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                            <label class="col-md-5 control-label">Jabatan</label>
                            <div class="col-md-7">
                                 <select name="Jabatan" required class="form-control select" data-live-search="true">
                                          <option value="1" <?php if ($DataKaryawan[0]['Jabatan'] == 1) { echo "selected"; } ?> >Penerima Setoran PNBP</option>
                                          <option value="2" <?php if ($DataKaryawan[0]['Jabatan'] == 2) { echo "selected"; } ?> >Kepala Sub Bagian TU</option>
                                          <option value="3" <?php if ($DataKaryawan[0]['Jabatan'] == 3) { echo "selected"; } ?> >Kepala Seksi Hak Tanah dan Pendaftaran Tanah</option>
                                          <option value="4" <?php if ($DataKaryawan[0]['Jabatan'] == 4) { echo "selected"; } ?> >Kepala Seksi Pengukuran dan Pemetaan</option>
                                          <option value="5" <?php if ($DataKaryawan[0]['Jabatan'] == 5) { echo "selected"; } ?> >Petugas Pengumpul Data Yuridis</option>
                                          <option value="6" <?php if ($DataKaryawan[0]['Jabatan'] == 6) { echo "selected"; } ?> >Kepala Seksi Hub Hukum Pertanahan</option>
                                          <option value="7" <?php if ($DataKaryawan[0]['Jabatan'] == 7) { echo "selected"; } ?> >Sekretaris Bukan Anggota</option>
                                          <option value="8" <?php if ($DataKaryawan[0]['Jabatan'] == 8) { echo "selected"; } ?> >Anggota</option>
                                          <option value="9" <?php if ($DataKaryawan[0]['Jabatan'] == 9) { echo "selected"; } ?> >Ketua</option>
                                          <option value="10" <?php if ($DataKaryawan[0]['Jabatan'] == 10) { echo "selected"; } ?> >Koordinator</option>
                                          <option value="11" <?php if ($DataKaryawan[0]['Jabatan'] == 11) { echo "selected"; } ?> >Kepala Seksi Infrastruktur Pertanahan</option>
                                          <option value="12" <?php if ($DataKaryawan[0]['Jabatan'] == 12) { echo "selected"; } ?> >Kepala Sub Bagian Seksi Peralihan Hak</option>
                                          <option value="13" <?php if ($DataKaryawan[0]['Jabatan'] == 13) { echo "selected"; } ?> >Staff Hubungan Hukum Pertanahan</option>
                                 </select>
                            </div>
                     </div>
                    <div class="form-group">
                            <label class="col-md-5 control-label">Daerah</label>
                            <div class="col-md-4">
                                   <select name="IDDaerah" required class="form-control select" data-live-search="true">
                                   <?php foreach ($DataDaerah as $Daerah): ?>
                                          <?php if ($Daerah['ID'] == $DataKaryawan[0]['IDDaerah']) {
                                                 echo '<option value="'.$Daerah['ID'].'" selected>'.$Daerah['NamaDaerah'].'</option>';
                                          } else {
                                                 echo '<option value="'.$Daerah['ID'].'">'.$Daerah['NamaDaerah'].'</option>';
                                          }?>
                                   <?php endforeach; ?>
                                   </select>
                            </div>
                     </div>
                    <div class="form-group">
                      <label class="col-md-5 control-label">Status</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="Status">
                                   <?php
                                   if($DataKaryawan[0]['Status'] == 1) {
                                          echo '<option selected value="1">Aktif</option>';
                                          echo '<option value="0">Tidak Aktif</option>';
                                   } else {
                                          echo '<option value="1">Aktif</option>';
                                          echo '<option selected value="0">Tidak Aktif</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group">
                        <label class="col-md-5 control-label">Foto Karyawan</label>
                        <div class="col-md-5">
                               <input type="file" class="fileinput" id="FotoKaryawan" name="FotoKaryawan"/>
                        </div>
                 </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditKaryawan" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
