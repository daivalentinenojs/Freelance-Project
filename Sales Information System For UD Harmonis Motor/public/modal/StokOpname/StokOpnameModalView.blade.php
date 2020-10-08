<?php
if(isset($_POST["ID"])) 
{
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $NoNotaStokOpname = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataStokOpname = "SELECT StokOpnames.NoNotaStokOpname AS NoNotaStokOpname, 
                                    StokOpnames.Tanggal AS Tanggal, 
                                    Karyawans.Nama AS Nama, 
                                    StokOpnames.StatusTerdaftar AS StatusTerdaftar
                                  FROM StokOpnames INNER JOIN Karyawans 
                                    ON StokOpnames.KaryawanID = Karyawans.IDKaryawan
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

       $QueryGetDataDetailStokOpname = "SELECT BarangCatatStokOpnames.BarangID AS BarangID, 
                                          BarangCatatStokOpnames.JumlahSelisih AS JumlahSelisih, 
                                          BarangCatatStokOpnames.Alasan AS Alasan,
                                          Barangs.Nama AS Nama,
                                          Barangs.Stok AS StokDB
                                        FROM BarangCatatStokOpnames INNER JOIN Barangs 
                                          ON BarangCatatStokOpnames.BarangID = Barangs.IDBarang
                                        WHERE BarangCatatStokOpnames.NotaStokOpnameNo = '$NoNotaStokOpname'";
       $HasilQueryGetDataDetailStokOpname = mysqli_query($MySQLi, $QueryGetDataDetailStokOpname);
       $DataDetailStokOpname = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailStokOpname)) {
         $DataDetailStokOpname[] = $Hasil;
       }

       $QueryGetDataBaris= "SELECT COUNT(BarangCatatStokOpnames.BarangID) AS Baris 
                            FROM BarangCatatStokOpnames
                            WHERE BarangCatatStokOpnames.NotaStokOpnameNo = '$NoNotaStokOpname'";
       $HasilQueryGetDataBaris = mysqli_query($MySQLi, $QueryGetDataBaris);
       $DataBaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBaris)) {
         $DataBaris[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormDetailStokOpname" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">No Nota Stok Opname:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataStokOpname[0]['NoNotaStokOpname']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataStokOpname[0]['Tanggal']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Karyawan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataStokOpname[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
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
                       <th style="text-align:center" width="10%">Stok Database</th>
                       <th style="text-align:center" width="10%">Jumlah Selisih (+/-)</th>
                       <th style="text-align:center" width="10%">Alasan</th>
                   </tr></thead>
                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<td>".$DataDetailStokOpname[$i]['BarangID']."</td>";
                        echo "<td>".$DataDetailStokOpname[$i]['Nama']."</td>";
                        echo "<td>".$DataDetailStokOpname[$i]['StokDB']."</td>";
                        echo "<td>".$DataDetailStokOpname[$i]['JumlahSelisih']."</td>";
                        echo "<td>".$DataDetailStokOpname[$i]['Alasan']."</td></tr>";
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
    window.open("CetakStokOpname/<?php echo $DataStokOpname[0]['NoNotaStokOpname']?>","_blank");
  }
</script>