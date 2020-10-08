<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDReturJual = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataReturJual = "SELECT ReturJuals.IDReturJual AS IDReturJual, 
                                  ReturJuals.StatusTerdaftar AS StatusTerdaftar
                                FROM ReturJuals  
                                WHERE ReturJuals.IDReturJual = '$IDReturJual'";
       $HasilQueryGetDataReturJual = mysqli_query($MySQLi, $QueryGetDataReturJual);
       $DataReturJual = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataReturJual)) {
        $DataReturJual[] = $Hasil;
       }

       if ($DataReturJual[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }
}
?>

<script>
$('#UbahReturJual').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Retur Jual ?",
    function() {
      $("#FormUbahReturJual").submit();
      alertify.success('Data Retur Jual Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Retur Jual Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahReturJual" method="POST" action="UbahDataReturJual" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Retur Jual:</label>
                       <div class="col-md-2">
                            <input type="hidden" name="IDReturJual" value="<?php echo $DataReturJual[0]['IDReturJual']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataReturJual[0]['IDReturJual']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataReturJual[0]['StatusTerdaftar'] == 1) {
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
                      <input type="button" id="UbahReturJual" name="BtnEditReturJual" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
