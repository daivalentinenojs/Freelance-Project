<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDReturJual = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataReturJual = "SELECT ReturJuals.IDReturJual AS IDReturJual,
                                  ReturJuals.Tanggal AS Tanggal,
                                  Karyawans.Nama AS NamaKaryawan, 
                                  ReturJuals.StatusTerdaftar AS StatusTerdaftar
                                 FROM ReturJuals 
                                  INNER JOIN Karyawans ON ReturJuals.KaryawanID = Karyawans.IDKaryawan
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

       $QueryGetDataDetailReturJual = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatReturJuals.BarangID AS BarangID,
                                          BarangCatatReturJuals.KuantitiBarangAsal AS KuantitiBarangAsal, 
                                          BarangCatatReturJuals.KuantitiBarangGanti AS KuantitiBarangGanti
                                       FROM ReturJuals INNER JOIN BarangCatatReturJuals 
                                          ON ReturJuals.IDReturJual = BarangCatatReturJuals.ReturJualID
                                          INNER JOIN Barangs ON BarangCatatReturJuals.BarangID = Barangs.IDBarang
                                       WHERE BarangCatatReturJuals.ReturJualID = '$IDReturJual'";
       $HasilQueryGetDataDetailReturJual = mysqli_query($MySQLi, $QueryGetDataDetailReturJual);
       $DataDetailReturJual = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailReturJual)) {
         $DataDetailReturJual[] = $Hasil;
       }

       $QueryGetDataBaris= "SELECT COUNT(BarangCatatReturJuals.BarangID) AS Baris 
                            FROM BarangCatatReturJuals
                            WHERE BarangCatatReturJuals.ReturJualID = '$IDReturJual'";
       $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
       $DataBaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
         $DataBaris[] = $Hasil;
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

<form class="form-horizontal" id="FormDetailReturJual" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Retur Jual:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataReturJual[0]['IDReturJual']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataReturJual[0]['Tanggal']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Karyawan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataReturJual[0]['NamaKaryawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Terdaftar:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusTerdaftar; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group" style="text-align:center">
                   <table class="table table-bordered">
                   <thead ><tr>
                       <th style="text-align:center" width="5%">Kode Barang</th>
                       <th style="text-align:center" width="10%">Barang Asal</th>
                       <th style="text-align:center" width="5%">Kuantiti</th>
                       <th style="text-align:center" width="5%">Kode Barang</th>
                       <th style="text-align:center" width="10%">Barang Ganti</th>
                       <th style="text-align:center" width="5%">Kuantiti</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<td>".$DataDetailReturJual[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailReturJual[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailReturJual[$i]['KuantitiBarangAsal']."</td>";
                        echo "<td>".$DataDetailReturJual[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailReturJual[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailReturJual[$i]['KuantitiBarangGanti']."</td></tr>";
                      }
                     ?>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <button type="button" id="buttonPrint" onclick="printData();" class="btn btn-info">Cetak</button>
                 </div>
             </div>
        </div>
</div>
</form>

<script>
function printData()
  {
    window.open("CetakReturJual/<?php echo $DataReturJual[0]['IDReturJual']?>","_blank");
  }
</script>