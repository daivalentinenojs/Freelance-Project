<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataKaryawan= "SELECT u.IDUser AS 'Nomor', u.Nama AS 'Nama', u.Email AS 'Email', j.Nama AS 'Jabatan', u.Alamat AS 'Alamat',
     	 u.Telepon AS 'Telepon', u.isDelete AS 'isDelete', u.IDUser AS 'View', u.IDUser AS 'Edit', u.Password AS 'Password',
       u.TanggalMulaiKerja AS 'TanggalMulaiKerja' FROM User u, Jabatan j WHERE j.ID = u.JabatanID and u.IDUser = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
       	$DataKaryawan[] = $Hasil;
       }
       if($DataKaryawan[0]['isDelete'] == 1)
              $isDelete = "Aktif";
       else
              $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormDetailKaryawan" method="POST">
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
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-7">
                            <input type="email" class="form-control" value="<?php echo $DataKaryawan[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Jabatan</label>
                      <div class="col-md-7">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Jabatan']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Alamat</label>
                      <div class="col-md-7">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Alamat']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Nomor Telepon</label>
                      <div class="col-md-7">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['Telepon']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Tanggal Mulai Kerja</label>
                      <div class="col-md-7">
                            <input type="text" class="form-control" value="<?php echo $DataKaryawan[0]['TanggalMulaiKerja']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $isDelete; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>
             </div>
        </div>
</div>
</form>
