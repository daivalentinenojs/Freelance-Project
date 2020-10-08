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
       } else if ($DataPembeli[0]["StatusJual"] == 1) {
              $StatusJual = "Lunas";
       } 

       if ($DataPembeli[0]["StatusLangganan"] == 0) {
              $StatusLangganan = "Langganan";
       } else if ($DataPembeli[0]["StatusLangganan"] == 1) {
              $StatusLangganan = "Tidak Langganan";
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

$('#UbahPembeli').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Pembeli ?",
    function() {
      $("#FormUbahPembeli").submit();
      alertify.success('Data Pembeli Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Pembeli Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahPembeli" method="POST" action="UbahDataPembeli" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
   <div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                  <input type="hidden" name="IDPembeli" value="<?php echo $DataPembeli[0]['IDPembeli']; ?>">
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
                            <input type="text" name="Nama" class="form-control" value="<?php echo $DataPembeli[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Telepon:</label>
                       <div class="col-md-4">
                            <input type="text" name="NoTelepon" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $DataPembeli[0]['NoTelepon']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Kota:</label>
                       <div class="col-md-4">
                            <input type="text" name="Kota" class="form-control" value="<?php echo $DataPembeli[0]['Kota']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank:</label>
                       <div class="col-md-4">
                            <input type="text" name="Bank" class="form-control" value="<?php echo $DataPembeli[0]['Bank']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Langganan:</label>
                      <div class="col-md-4">
                            <select class="form-control select" data-live-search="true" name="StatusLangganan">
                                   <?php
                                   if($DataBarang[0]['StatusLangganan'] == 1) {
                                          echo '<option selected value="1">Langganan</option>';
                                          echo '<option value="0">Tidak Langganan</option>';
                                   } else {
                                          echo '<option value="1">Langganan</option>';
                                          echo '<option selected value="0">Tidak Langganan</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Jual:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusJual">
                                   <?php
                                   if($DataPembeli[0]['StatusJual'] == 1) {
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
                                   if($DataPembeli[0]['StatusTerdaftar'] == 1) {
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
                           <input type="file" class="fileinput" id="FotoPembeli" name="FotoPembeli"/>
                     </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahPembeli" name="BtnEditPembeli" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
    </div>
</form>