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

<form class="form-horizontal" id="FormDetailKategori" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Kategori:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataKategori[0]['IDKategori']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Kategori:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataKategori[0]['NamaKategori']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Terdaftar:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusTerdaftar; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
             </div>
        </div>
</div>
</form>
