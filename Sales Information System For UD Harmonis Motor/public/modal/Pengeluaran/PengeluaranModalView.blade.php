<?php
if(isset($_POST["ID"]))
{
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPengeluaran = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataPengeluaran = "SELECT Pengeluarans.IDPengeluaran AS IDPengeluaran, 
                                    Pengeluarans.Tanggal AS Tanggal, 
                                    Pengeluarans.Nama AS Nama, 
                                    Pengeluarans.Nominal AS Nominal, 
                                    Pengeluarans.Keterangan AS Keterangan,
                                    Pengeluarans.StatusTerdaftar AS StatusTerdaftar, 
                                    Karyawans.Nama AS NamaKaryawan,
                                    Pengeluarans.IDPengeluaran AS Detail, 
                                    Pengeluarans.IDPengeluaran AS Ubah
                                  FROM Pengeluarans INNER JOIN Karyawans ON 
                                    Pengeluarans.KaryawanID = Karyawans.IDKaryawan
                                  WHERE Pengeluarans.IDPengeluaran = '$IDPengeluaran'";
       $HasilQueryGetDataPengeluaran = mysqli_query($MySQLi, $QueryGetDataPengeluaran);
       $DataPengeluaran = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPengeluaran)) {
       	$DataPengeluaran[] = $Hasil;
       }

       if ($DataPengeluaran[0]['StatusTerdaftar'] == 1) {
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

</script>

<form class="form-horizontal" id="FormDetailPengeluaran" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Pengeluaran:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataPengeluaran[0]['IDPengeluaran']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPengeluaran[0]['Tanggal']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama:</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataPengeluaran[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nominal (Rp):</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo formatMoney($DataPengeluaran[0]['Nominal']); ?>" readonly style="text-align:right; background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Keterangan:</label>
                       <div class="col-md-4">
                            <textarea class="form-control" value="" readonly style="background:white; color:black;"><?php echo $DataPengeluaran[0]['Keterangan']; ?></textarea>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Status Terdaftar:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $StatusTerdaftar; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama Karyawan:</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataPengeluaran[0]['NamaKaryawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
             </div>
        </div>
</div>
</form>
