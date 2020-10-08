<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKepalaDesa = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataKepalaDesa = "SELECT KepalaDesa.ID AS ID, KepalaDesa.ID AS View, KepalaDesa.ID AS Edit, KepalaDesa.Nama AS Nama, KepalaDesa.IDUser AS IDUser,
                                KepalaDesa.IDDesa AS IDDesa, Desa.Nama AS NamaDesa, users.name AS 'Username',
                                users.email AS 'Email', KepalaDesa.IsActive AS 'Status'
                                FROM KepalaDesa INNER JOIN users ON users.id = KepalaDesa.IDUser INNER JOIN Desa ON Desa.ID = KepalaDesa.IDDesa WHERE KepalaDesa.ID = '$IDKepalaDesa'";
       $HasilQueryGetDataKepalaDesa = mysqli_query($MySQLi, $QueryGetDataKepalaDesa);
       $DataKepalaDesa = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKepalaDesa)) {
       	$DataKepalaDesa[] = $Hasil;
       }
       if ($DataKepalaDesa[0]['Status'] == 1) {
              $Status = "Aktif";
       } else {
              $Status = "Tidak Aktif";
       }
}
?>

<form class="form-horizontal" id="FormDetailKepalaDesa" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDKepalaDesa" value="<?php echo $DataKepalaDesa[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataKepalaDesa[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Pengguna</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataKepalaDesa[0]['Username']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Email</label>
                       <div class="col-md-5">
                            <input type="email" class="form-control" value="<?php echo $DataKepalaDesa[0]['Email']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Kata Sandi</label>
                       <div class="col-md-3">
                            <input type="password" class="form-control" value="<?php echo $DataKepalaDesa[0]['Password']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <br><br>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKepalaDesa[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Desa</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKepalaDesa[0]['NamaDesa']; ?>" readonly style="background:white; color:black;"/>
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
