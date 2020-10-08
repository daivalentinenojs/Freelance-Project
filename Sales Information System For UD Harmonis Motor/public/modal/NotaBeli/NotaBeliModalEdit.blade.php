<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $NoNotaBeli = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataNotaBeli = "SELECT NotaBelis.NoNotaBeli AS NoNotaBeli, 
                                  NotaBelis.StatusBeli AS StatusBeli,
                                  NotaBelis.Total AS TotalAkhir,
                                  NotaBelis.StatusTerdaftar AS StatusTerdaftar
                                FROM NotaBelis  
                                WHERE NotaBelis.NoNotaBeli = '$NoNotaBeli'";
       $HasilQueryGetDataNotaBeli = mysqli_query($MySQLi, $QueryGetDataNotaBeli);
       $DataNotaBeli = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaBeli)) {
        $DataNotaBeli[] = $Hasil;
       }

       if ($DataNotaBeli[0]['StatusBeli'] == "Pesan") {
              $StatusBeli = "Pesan";
       } else if ($DataNotaBeli[0]['StatusBeli'] == "Dikirim"){
              $StatusBeli = "Dikirim";
       } else {
              $StatusBeli = "Lunas";
       }

       if ($DataNotaBeli[0]['StatusTerdaftar'] == 1) {
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
$('#UbahNotaBeli').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Nota Beli ?",
    function() {
      $("#FormUbahNotaBeli").submit();
      alertify.success('Data Nota Beli Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Nota Beli Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahNotaBeli" method="POST" action="UbahDataNotaBeli" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Nota Beli:</label>
                       <div class="col-md-2">
                            <input type="hidden" name="NoNotaBeli" value="<?php echo $DataNotaBeli[0]['NoNotaBeli']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataNotaBeli[0]['NoNotaBeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Total Tagihan (Rp):</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo formatMoney($DataNotaBeli[0]['TotalAkhir']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Beli:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusBeli">
                                   <?php
                                   if($DataNotaBeli[0]['StatusBeli'] == "Pesan") {
                                          echo '<option selected value="Pesan">Pesan</option>';
                                          echo '<option value="Dikirim">Dikirim</option>';
                                          echo '<option value="Lunas">Lunas</option>';
                                   } else if($DataNotaBeli[0]['StatusBeli'] == "Dikirim"){
                                          echo '<option value="Pesan">Pesan</option>';
                                          echo '<option selected value="Dikirim">Dikirim</option>';
                                          echo '<option value="Lunas">Lunas</option>';
                                   } else{
                                          echo '<option value="Pesan">Pesan</option>';
                                          echo '<option value="Dikirim">Dikirim</option>';
                                          echo '<option selected value="Lunas">Lunas</option>';
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
                                   if($DataNotaBeli[0]['StatusTerdaftar'] == 1) {
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
                      <input type="button" id="UbahNotaBeli" name="BtnEditNotaBeli" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
