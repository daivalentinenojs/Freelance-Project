<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $NoNotaJual = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataNotaJual = "SELECT NotaJuals.NoNotaJual AS NoNotaJual, 
                                  NotaJuals.TanggalBuat AS TanggalBuat, 
                                  NotaJuals.TanggalBayar AS TanggalBayar, 
                                  NotaJuals.Total AS TotalAkhir, 
                                  NotaJuals.StatusJual AS StatusJual, 
                                  NotaJuals.StatusTerdaftar AS StatusTerdaftar, 
                                  Karyawans.Nama AS NamaKaryawan, 
                                  Pembelis.Nama AS NamaPembeli, 
                                  Pembelis.Kota AS Kota, 
                                  Pembelis.Bank AS Bank,
                                  Pembelis.StatusLangganan AS StatusLangganan
                                FROM Karyawans 
                                  INNER JOIN NotaJuals ON Karyawans.IDKaryawan = NotaJuals.KaryawanID 
                                  INNER JOIN Pembelis ON NotaJuals.PembeliID = Pembelis.IDPembeli
                                WHERE NotaJuals.NoNotaJual = '$NoNotaJual'";
       $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
       $DataNotaJual = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
        $DataNotaJual[] = $Hasil;
       }

       if ($DataNotaJual[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }

       if ($DataNotaJual[0]['StatusJual'] == "Belum Lunas") {
              $StatusJual = "Belum Lunas";
       } else if($DataNotaJual[0]['StatusJual'] == "Sudah Lunas") {
              $StatusJual = "Sudah Lunas";
       } else {
              $StatusJual = "Lewat Jatuh Tempo";
       }

       if ($DataNotaJual[0]['StatusLangganan'] == 1) {
              $StatusLangganan = "Langganan";
       } else {
              $StatusLangganan = "Tidak Langganan";
       }

       $QueryGetDataDetailNotaJual = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatNotaJuals.BarangID AS BarangID,
                                          BarangCatatNotaJuals.Kuantiti AS Kuantiti, 
                                          BarangCatatNotaJuals.HargaJual AS HargaJual,
                                          BarangCatatNotaJuals.SubTotal AS SubTotal
                                      FROM BarangCatatNotaJuals INNER JOIN Barangs 
                                          ON BarangCatatNotaJuals.BarangID = Barangs.IDBarang
                                      WHERE BarangCatatNotaJuals.NotaJualNo = '$NoNotaJual'";
       $HasilQueryGetDataDetailNotaJual = mysqli_query($MySQLi, $QueryGetDataDetailNotaJual);
       $DataDetailNotaJual = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailNotaJual)) {
         $DataDetailNotaJual[] = $Hasil;
       }

       $QueryGetDataBaris= "SELECT COUNT(BarangCatatNotaJuals.BarangID) AS Baris
                            FROM BarangCatatNotaJuals 
                            WHERE BarangCatatNotaJuals.NotaJualNo = '$NoNotaJual'";
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

<form class="form-horizontal" id="FormDetailNotaJual" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Nota Jual:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['NoNotaJual']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal Buat:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['TanggalBuat']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal Bayar:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['TanggalBayar']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Total Akhir (Rp):</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo formatMoney($DataNotaJual[0]['TotalAkhir']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Pembeli:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['NamaPembeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Kota:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['Kota']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Bank:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['Bank']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Langganan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusLangganan; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Karyawan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataNotaJual[0]['NamaKaryawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Jual:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $StatusJual; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Terdaftar:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusTerdaftar; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                

                 <div class="form-group">
                   <table class="table table-bordered" style="text-align:center">
                   <thead ><tr>
                       <th style="text-align:center" width="10%">Kode Barang</th>
                       <th style="text-align:center" width="10%">Nama Barang</th>
                       <th style="text-align:center" width="10%">Kuantiti</th>
                       <th style="text-align:center" width="10%">Harga Jual (Rp)</th>
                       <th style="text-align:center" width="10%">Sub Total (Rp)</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<td>".$DataDetailNotaJual[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailNotaJual[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailNotaJual[$i]['Kuantiti']."</td>";
                        echo "<td>".formatMoney($DataDetailNotaJual[$i]['HargaJual'])."</td>";
                        echo "<td>".formatMoney($DataDetailNotaJual[$i]['SubTotal'])."</td></tr>";
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
    window.open("CetakNotaJual/<?php echo $DataNotaJual[0]['NoNotaJual']?>","_blank");
  }
</script>
