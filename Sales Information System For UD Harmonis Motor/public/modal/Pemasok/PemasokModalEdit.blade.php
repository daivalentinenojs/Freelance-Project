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
       } else {
              $StatusBeli = "Lunas";
       } 
}
?>
<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$('#UbahPemasok').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Pemasok ?",
    function() {
      $("#FormUbahPemasok").submit();
      alertify.success('Data Pemasok Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Pemasok Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahPemasok" method="POST" action="UbahDataPemasok" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                    <input type="hidden" name="IDPemasok" value="<?php echo $DataPemasok[0]['IDPemasok']; ?>">
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
                            <input type="text" name="NoRekening" onkeypress = "return isNumberKey(event)" class="form-control" value="<?php echo $DataPemasok[0]['NoRekening']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Rekening:</label>
                       <div class="col-md-4">
                            <input type="text" name="NamaRekening" class="form-control" value="<?php echo $DataPemasok[0]['NamaRekening']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank:</label>
                       <div class="col-md-2">
                            <input type="text" name="Bank" class="form-control" value="<?php echo $DataPemasok[0]['Bank']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Alamat:</label>
                       <div class="col-md-4">
                            <textarea name="Alamat" class="form-control" value="" style="background:white; color:black;"><?php echo $DataPemasok[0]['Alamat']; ?></textarea>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Telepon:</label>
                       <div class="col-md-4">
                            <input type="text" name="NoTelepon" onkeypress = "return isNumberKey(event)" class="form-control" value="<?php echo $DataPemasok[0]['NoTelepon']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Beli:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusBeli">
                                   <?php
                                   if($DataPemasok[0]['StatusBeli'] == 1) {
                                          echo '<option selected value="0">Hutang</option>';
                                          echo '<option value="1">Lunas</option>';
                                   } else {
                                          echo '<option value="0">Hutang</option>';
                                          echo '<option selected value="1">Lunas</option>';
                                   } 
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataPemasok[0]['StatusTerdaftar'] == 1) {
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
                           <input type="file" class="fileinput" id="FotoPemasok" name="FotoPemasok"/>
                     </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahPemasok" name="BtnEditPemasok" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>