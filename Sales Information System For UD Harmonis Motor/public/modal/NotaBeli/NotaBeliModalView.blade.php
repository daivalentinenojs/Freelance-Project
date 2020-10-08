<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $NoNotaBeli = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataNotaBeli = "SELECT NotaBelis.TanggalBuat AS TanggalBuat, 
                                  NotaBelis.NoNotaBeli AS NoNotaBeli, 
                                  NotaBelis.JatuhTempo AS JatuhTempo,
                                  NotaBelis.Total AS Total, 
                                  NotaBelis.StatusBeli AS StatusBeli, 
                                  NotaBelis.StatusTerdaftar AS StatusTerdaftar, 
                                  Karyawans.Nama AS NamaKaryawan, 
                                  Pemasoks.NamaRekening AS NamaPemasok
                                FROM Karyawans 
                                  INNER JOIN NotaBelis ON Karyawans.IDKaryawan = NotaBelis.KaryawanID 
                                  INNER JOIN Pemasoks ON NotaBelis.PemasokID = Pemasoks.IDPemasok
                                WHERE NotaBelis.NoNotaBeli = '$NoNotaBeli'";
       $HasilQueryGetDataNotaBeli = mysqli_query($MySQLi, $QueryGetDataNotaBeli);
       $DataNotaBeli = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaBeli)) {
        $DataNotaBeli[] = $Hasil;
       }

       if ($DataNotaBeli[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }

       if ($DataNotaBeli[0]['StatusBeli'] == "Pesan") {
              $StatusBeli = "Pesan";
       } else if ($DataNotaBeli[0]['StatusBeli'] == "Dikirim"){
              $StatusBeli = "Dikirim";
       } else {
              $StatusBeli = "Lunas";
       }

       $QueryGetDataDetailNotaBeli = "SELECT Barangs.Nama AS Nama,
                                          BarangCatatNotaBelis.BarangID AS BarangID,
                                          BarangCatatNotaBelis.Kuantiti AS Kuantiti, 
                                          BarangCatatNotaBelis.HargaBeli AS HargaBeli,
                                          BarangCatatNotaBelis.SubTotal AS SubTotal
                                      FROM BarangCatatNotaBelis INNER JOIN Barangs 
                                          ON BarangCatatNotaBelis.BarangID = Barangs.IDBarang
                                      WHERE BarangCatatNotaBelis.NotaBeliNo = '$NoNotaBeli'";
       $HasilQueryGetDataDetailNotaBeli = mysqli_query($MySQLi, $QueryGetDataDetailNotaBeli);
       $DataDetailNotaBeli = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailNotaBeli)) {
         $DataDetailNotaBeli[] = $Hasil;
       }

       $QueryGetDataBaris= "SELECT COUNT(BarangCatatNotaBelis.BarangID) AS Baris 
                            FROM BarangCatatNotaBelis
                            WHERE BarangCatatNotaBelis.NotaBeliNo = '$NoNotaBeli'";
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

<form class="form-horizontal" id="FormDetailNotaBeli" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Nota Beli:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataNotaBeli[0]['NoNotaBeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal Buat:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataNotaBeli[0]['TanggalBuat']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Jatuh Tempo:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataNotaBeli[0]['JatuhTempo']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Total Akhir (Rp):</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo formatMoney($DataNotaBeli[0]['Total']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Pemasok:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataNotaBeli[0]['NamaPemasok']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Karyawan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataNotaBeli[0]['NamaKaryawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Beli:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusBeli; ?>" readonly style="background:white; color:black;"/>
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
                       <th style="text-align:center" width="10%">Kode Barang</th>
                       <th style="text-align:center" width="10%">Nama Barang</th>
                       <th style="text-align:center" width="10%">Kuantiti</th>
                       <th style="text-align:center" width="10%">Harga Beli (Rp)</th>
                       <th style="text-align:center" width="10%">Sub Total (Rp)</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<td>".$DataDetailNotaBeli[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailNotaBeli[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailNotaBeli[$i]['Kuantiti']."</td>";
                        echo "<td>".formatMoney($DataDetailNotaBeli[$i]['HargaBeli'])."</td>";
                        echo "<td>".formatMoney($DataDetailNotaBeli[$i]['SubTotal'])."</td></tr>";
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
    window.open("CetakNotaBeli/<?php echo $DataNotaBeli[0]['NoNotaBeli']?>","_blank");
  }
</script>
