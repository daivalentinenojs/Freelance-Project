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
                                Karyawans.Password AS Password, 
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
<script>
$('#UbahKaryawan').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Karyawan ?",
    function() {
      $("#FormUbahKaryawan").submit();
      alertify.success('Data Karyawan Anda telah diubah');
    },
    function(){
      alertify.error('Proses Mengubah Data Karyawan Anda dibatalkan');
    });  
});
</script>

<form class="form-horizontal" id="FormUbahKaryawan" method="POST" action="UbahDataKaryawan" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <input type="hidden" name="IDKaryawan" value="<?php echo $DataKaryawan[0]['IDKaryawan']; ?>">
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
                            <input type="text" name="Nama" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Alamat:</label>
                       <div class="col-md-4">
                            <textarea type="text" name="Alamat" class="form-control" value="" style="background:white; color:black;"><?php echo $DataKaryawan[0]['Alamat']; ?></textarea>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Email:</label>
                       <div class="col-md-4">
                            <input type="text" name="Email" class="form-control" value="<?php echo $DataKaryawan[0]['Email']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Telepon:</label>
                       <div class="col-md-4">
                            <input type="number" name="NoTelepon" class="form-control" value="<?php echo $DataKaryawan[0]['NoTelepon']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Password:</label>
                       <div class="col-md-3">
                            <input type="password" id="Password" name="Password" class="form-control" value="<?php echo $DataKaryawan[0]['Password']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <!-- <div class="form-group">
                       <label class="col-md-5 control-label">Ulangi Password:</label>
                       <div class="col-md-3">
                            <input type="password" id="UlangiPassword" name="UlangiPassword" class="form-control" value="<?php echo $DataKaryawan[0]['Password']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div> -->
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataKaryawan[0]['StatusTerdaftar'] == 1) {
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
                     <label class="col-md-5 control-label">Foto:</label>
                     <div class="col-md-5">
                           <input type="file" class="fileinput" id="FotoKaryawan" name="FotoKaryawan"/>
                     </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahKaryawan" name="BtnEditKaryawan" value="Ubah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
