<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDReturBeli = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataReturBeli = "SELECT ReturBelis.IDReturBeli AS IDReturBeli, 
                                  ReturBelis.StatusTerdaftar AS StatusTerdaftar
                                FROM ReturBelis  
                                WHERE ReturBelis.IDReturBeli = '$IDReturBeli'";
       $HasilQueryGetDataReturBeli = mysqli_query($MySQLi, $QueryGetDataReturBeli);
       $DataReturBeli = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataReturBeli)) {
        $DataReturBeli[] = $Hasil;
       }

       if ($DataReturBeli[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }
}
?>

<script>
$('#UbahReturBeli').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Retur Beli ?",
    function() {
      $("#FormUbahReturBeli").submit();
      alertify.success('Data Retur Beli Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Retur Beli Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahReturBeli" method="POST" action="UbahDataReturBeli" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Retur Beli:</label>
                       <div class="col-md-2">
                       <input type="hidden" name="IDReturBeli" value="<?php echo $DataReturBeli[0]['IDReturBeli']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataReturBeli[0]['IDReturBeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataReturBeli[0]['StatusTerdaftar'] == 1) {
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
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahReturBeli" name="BtnEditNotaJual" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
