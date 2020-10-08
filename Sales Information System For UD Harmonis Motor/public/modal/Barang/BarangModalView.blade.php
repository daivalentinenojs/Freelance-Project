<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDBarang = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataBarang = "SELECT Barangs.IDBarang AS IDBarang, 
                                Barangs.Nama AS Nama, 
                                Barangs.Tahun AS Tahun,
                                Barangs.Stok AS Stok, 
                                Barangs.HPP AS HPP, 
                                Barangs.HargaJual AS HargaJual, 
                                Barangs.StatusTerdaftar AS StatusTerdaftar,
                                Kategoris.Nama AS Merk
                              FROM Barangs 
                                INNER JOIN Kategoris ON Barangs.KategoriID = Kategoris.IDKategori
                              WHERE Barangs.IDBarang = '$IDBarang'";
       $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
       $DataBarang = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
       	$DataBarang[] = $Hasil;
       }
       if ($DataBarang[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Tersedia";
       } else {
              $StatusTerdaftar = "Kosong";
       }

       $IDKaryawan = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataKaryawan = "SELECT Karyawans.IDKaryawan AS IDKaryawan, 
                                Karyawans.Nama AS Nama
                                FROM Karyawans
                                WHERE Karyawans.IDKaryawan = '$IDKaryawan'";
       $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
       $DataKaryawan = array();

       while($Hasil2 = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
        $DataKaryawan[] = $Hasil2;
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

<form class="form-horizontal" id="FormDetailBarang" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                          <img width="120px" height="160px" src="foto/barang/<?php echo $DataBarang[0]['IDBarang'];?>.jpg">
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Barang:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['IDBarang']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tahun:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Tahun']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Stok:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Stok']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                <!--  <?php //var_dump($DataKaryawan); die(); ?>
                 <?php //if($DataKaryawan[0]['Nama'] == 'tjandra') :?>
                 <div class="form-group">
                       <label class="col-md-5 control-label">HPP:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php //echo formatMoney($DataBarang[0]['HPP']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <?php //endif; ?> -->
                 <div class="form-group">
                       <label class="col-md-5 control-label">Harga Jual (Rp):</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo formatMoney($DataBarang[0]['HargaJual']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Merk:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Merk']; ?>" readonly style="background:white; color:black;"/>
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
