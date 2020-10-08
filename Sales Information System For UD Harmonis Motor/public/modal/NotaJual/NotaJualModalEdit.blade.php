<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $NoNotaJual = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataNotaJual = "SELECT NotaJuals.NoNotaJual AS NoNotaJual, 
                                  NotaJuals.StatusJual AS StatusJual,
                                  NotaJuals.Total AS TotalAkhir,
                                  NotaJuals.StatusTerdaftar AS StatusTerdaftar
                                FROM NotaJuals  
                                WHERE NotaJuals.NoNotaJual = '$NoNotaJual'";
       $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
       $DataNotaJual = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
        $DataNotaJual[] = $Hasil;
       }

       if ($DataNotaJual[0]['StatusJual'] == "Belum Lunas") {
              $StatusJual = "Belum Lunas";
       } else if($DataNotaJual[0]['StatusJual'] == "Sudah Lunas"){
              $StatusJual = "Sudah Lunas";
       } else {
              $StatusJual = "Lewat Jatuh Tempo";
       }

       if ($DataNotaJual[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }
}
function formatMoney($number, $fractional = false){
    if($fractional){
      $number= sprintf('%.2f', $number);
    }
    while(true){
      $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
      if ($replaced != $number){
        $number = $replaced;
      }
      else{
        break;
      }
    }
    return $number;
  }
?>

<script>
$('#UbahNotaJual').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Nota Jual ?",
    function() {
      $("#FormUbahNotaJual").submit();
      alertify.success('Data Nota Jual Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Nota Jual Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahNotaJual" method="POST" action="UbahDataNotaJual" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Nota Jual:</label>
                       <div class="col-md-2">
                            <input type="hidden" name="NoNotaJual" value="<?php echo $DataNotaJual[0]['NoNotaJual']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['NoNotaJual']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Total Tagihan (Rp):</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo formatMoney($DataNotaJual[0]['TotalAkhir']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Jual:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusJual">
                                   <?php
                                   if($DataNotaJual[0]['StatusJual'] == "Belum Lunas") {
                                          echo '<option selected value="Belum Lunas">Belum Lunas</option>';
                                          echo '<option value="Sudah Lunas">Sudah Lunas</option>';
                                          echo '<option value="Lewat Jatuh Tempo">Lewat Jatuh Tempo</option>';
                                   } else if($DataNotaJual[0]['StatusJual'] == "Sudah Lunas"){
                                          echo '<option value="Belum Lunas">Belum Lunas</option>';
                                          echo '<option selected value="Sudah Lunas">Sudah Lunas</option>';
                                          echo '<option value="Lewat Jatuh Tempo">Lewat Jatuh Tempo</option>';
                                   } else {
                                          echo '<option value="Belum Lunas">Belum Lunas</option>';
                                          echo '<option value="Sudah Lunas">Sudah Lunas</option>';
                                          echo '<option selected value="Lewat Jatuh Tempo">Lewat Jatuh Tempo</option>';
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
                                   if($DataNotaJual[0]['StatusTerdaftar'] == 1) {
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
                      <input type="button" id="UbahNotaJual" name="BtnEditNotaJual" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
