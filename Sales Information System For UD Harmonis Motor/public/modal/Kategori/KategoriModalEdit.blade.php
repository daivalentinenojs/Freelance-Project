<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDKategori = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataKategori = "SELECT Kategoris.IDKategori AS IDKategori, 
                                  Kategoris.Nama AS NamaKategori, 
                                  Kategoris.StatusTerdaftar AS StatusTerdaftar
                                FROM Kategoris  
                                WHERE Kategoris.IDKategori = '$IDKategori'";
       $HasilQueryGetDataKategori = mysqli_query($MySQLi, $QueryGetDataKategori);
       $DataKategori = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKategori)) {
        $DataKategori[] = $Hasil;
       }
       if ($DataKategori[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Tersedia";
       } else {
              $StatusTerdaftar = "Kosong";
       }
}
?>
<script>
$('#UbahKategori').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Kategori ?",
    function() {
      $("#FormUbahKategori").submit();
      alertify.success('Data Kategori Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Kategori Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahKategori" method="POST" action="UbahDataKategori" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Kategori:</label>
                       <div class="col-md-2">
                       <input type="hidden" name="IDKategori" value="<?php echo $DataKategori[0]['IDKategori']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataKategori[0]['IDKategori']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Kategori:</label>
                       <div class="col-md-4">
                            <input type="text" name="NamaKategori" class="form-control" value="<?php echo $DataKategori[0]['NamaKategori']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataKategori[0]['StatusTerdaftar'] == 1) {
                                          echo '<option selected value="1">Tersedia</option>';
                                          echo '<option value="0">Kosong</option>';
                                   } else {
                                          echo '<option value="1">Tersedia</option>';
                                          echo '<option selected value="0">Kosong</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahKategori" name="BtnEditKategori" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
