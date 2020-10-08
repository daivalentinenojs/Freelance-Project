<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $NoNotaStokOpname = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataStokOpname = "SELECT StokOpnames.NoNotaStokOpname AS NoNotaStokOpname, 
                                  StokOpnames.StatusTerdaftar AS StatusTerdaftar
                                  FROM StokOpnames  
                                  WHERE StokOpnames.NoNotaStokOpname = '$NoNotaStokOpname'";
       $HasilQueryGetDataStokOpname = mysqli_query($MySQLi, $QueryGetDataStokOpname);
       $DataStokOpname = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataStokOpname)) {
        $DataStokOpname[] = $Hasil;
       }

       if ($DataStokOpname[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }
}
?>

<script>
$('#UbahStokOpname').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Stok Opname ?",
    function() {
      $("#FormUbahStokOpname").submit();
      alertify.success('Data Stok Opname Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Stok Opname Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahStokOpname" method="POST" action="UbahDataStokOpname" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Nota Stok Opname:</label>
                       <div class="col-md-2">
                            <input type="hidden" name="NoNotaStokOpname" value="<?php echo $DataStokOpname[0]['NoNotaStokOpname']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataStokOpname[0]['NoNotaStokOpname']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataStokOpname[0]['StatusTerdaftar'] == 1) {
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
                      <input type="button" id="UbahStokOpname" name="BtnEditStokOpname" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
