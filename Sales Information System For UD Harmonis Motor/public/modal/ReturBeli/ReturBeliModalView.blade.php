<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDReturBeli = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataReturBeli = "SELECT ReturBelis.IDReturBeli AS IDReturBeli,
                                  ReturBelis.Tanggal AS Tanggal, 
                                  Karyawans.Nama AS NamaKaryawan, 
                                  ReturBelis.StatusTerdaftar AS StatusTerdaftar
                                 FROM ReturBelis 
                                  INNER JOIN Karyawans ON ReturBelis.KaryawanID = Karyawans.IDKaryawan
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

       $QueryGetDataDetailReturBeli = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatReturBelis.BarangID AS BarangID,
                                          BarangCatatReturBelis.KuantitiBarangAsal AS KuantitiBarangAsal, 
                                          BarangCatatReturBelis.KuantitiBarangGanti AS KuantitiBarangGanti
                                       FROM ReturBelis INNER JOIN BarangCatatReturBelis 
                                          ON ReturBelis.IDReturBeli = BarangCatatReturBelis.ReturBeliID
                                          INNER JOIN Barangs ON BarangCatatReturBelis.BarangID = Barangs.IDBarang
                                       WHERE BarangCatatReturBelis.ReturBeliID = '$IDReturBeli'";
       $HasilQueryGetDataDetailReturBeli = mysqli_query($MySQLi, $QueryGetDataDetailReturBeli);
       $DataDetailReturBeli = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailReturBeli)) {
         $DataDetailReturBeli[] = $Hasil;
       }

       $QueryGetDataBaris= "SELECT COUNT(BarangCatatReturBelis.BarangID) AS Baris 
                            FROM BarangCatatReturBelis
                            WHERE BarangCatatReturBelis.ReturBeliID = '$IDReturBeli'";
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

<form class="form-horizontal" id="FormDetailReturBeli" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Retur Beli:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataReturBeli[0]['IDReturBeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataReturBeli[0]['Tanggal']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Karyawan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataReturBeli[0]['NamaKaryawan']; ?>" readonly style="background:white; color:black;"/>
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
                        echo "<td>".$DataDetailReturBeli[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailReturBeli[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailReturBeli[$i]['KuantitiBarangAsal']."</td>";
                        echo "<td>".$DataDetailReturBeli[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailReturBeli[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailReturBeli[$i]['KuantitiBarangGanti']."</td></tr>";
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
    window.open("CetakReturBeli/<?php echo $DataReturBeli[0]['IDReturBeli']?>","_blank");
  }
</script>
