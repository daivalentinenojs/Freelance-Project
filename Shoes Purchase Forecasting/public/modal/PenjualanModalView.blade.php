<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDNota = $MySQLi->real_escape_string($_POST["ID"]);
       $QueryGetDataPenjualan= "SELECT DISTINCT pj.Nomor as 'Nomor', pm.Tanggal as 'TanggalPesan', pj.Tanggal as 'TanggalKirim', c.NamaToko 'NamaToko', u.Nama as 'Karyawan', pm.Status as 'Status', pj.Total as 'Total'
       FROM pemesanan pm, penjualan pj, detailsepatucatatpenjualan dscpj, customer c, user u
       where pj.NomorPemesanan = pm.Nomor and pj.Nomor = dscpj.PenjualanID and pj.UserID = u.IDUser and pm.CustomerID = c.ID and pj.Nomor = '$IDNota'";
       $HasilQueryGetDataPenjualan = mysqli_query($MySQLi, $QueryGetDataPenjualan);
       $DataPenjualan = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPenjualan)) {
         $DataPenjualan[] = $Hasil;
       }

       $QueryGetDataDetailSepatu= "SELECT t.Nama as 'Tipe', ms.Nama as 'Merek', sob.Nama as 'Ukuran', w.Nama as 'Warna', dscp.Jumlah as 'Jumlah', dscp.Harga as 'Harga'
       FROM detailsepatu ds, detailsepatucatatpenjualan dscp, tipe t, warna w, sizeorbox sob, mereksepatu ms
       WHERE ms.ID = t.MerekSepatuID and ds.TipeID = t.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID and dscp.DetailSepatuID = ds.ID and dscp.PenjualanID = '$IDNota'";
       $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
       $DataDetailSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
         $DataDetailSepatu[] = $Hasil;
       }

       $QueryGetDatabaris= "SELECT COUNT(dspp.PenjualanID) as baris FROM detailsepatucatatpenjualan dspp WHERE dspp.PenjualanID = '$IDNota'";
       $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
       $Databaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
         $Databaris[] = $Hasil;
       }

       if($DataPenjualan[0]['Status'] == 0)
          $Status = "Belum Dikirim";
       else
          $Status = "Sudah Dikirm";

      $tanggalPesan = $DataPenjualan[0]['TanggalPesan'];
      $tanggalPesanBaru = date("d-m-Y", strtotime($tanggalPesan));
      $tanggalKirim = $DataPenjualan[0]['TanggalKirim'];
      $tanggalKirimBaru = date("d-m-Y", strtotime($tanggalKirim));
}
?>

<form class="form-horizontal" id="FormDetailSizeSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nomor Nota</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataPenjualan[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal Pesan</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $tanggalPesanBaru; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal Kirim</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $tanggalKirimBaru; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Nama Toko</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPenjualan[0]['NamaToko']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Karyawan</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPenjualan[0]['Karyawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Status</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $Status ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Total Belanja</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo "Rp ".formatMoney($DataPenjualan[0]['Total']); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group" style="text-align:center;">
                        <button type="button" id="buttonPrint" onclick="printData();" class="btn btn-info">Print</button>
                 </div>
                 <!--div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<!?php echo $Status; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div-->

                 <div class="form-group">
                   <table class="table table-bordered">
                   <thead ><tr>
                      <th style="text-align:center" width="5%">Nomor</th>
                       <th style="text-align:center" width="10%">Nama Sepatu</th>
                       <th style="text-align:center" width="10%">Jumlah</th>
                       <th style="text-align:center" width="10%">Harga</th>
                   </tr></thead>

                    <?php
                    //print_r($Databaris);
                      for($i = 0; $i < $Databaris[0]['baris']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center'><td>".$j."</td>";
                        echo "<td>".$DataDetailSepatu[$i]['Merek']." ".$DataDetailSepatu[$i]['Tipe']." ".$DataDetailSepatu[$i]['Warna']." ".$DataDetailSepatu[$i]['Ukuran']."</td>";
                        echo "<td>".$DataDetailSepatu[$i]['Jumlah']."</td>";
                        echo "<td> Rp ".formatMoney($DataDetailSepatu[$i]['Harga'])."</td></tr>";
                      }

                     ?>
                 </div>
             </div>
        </div>
</div>
</form>
<?php
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
   function printData()
   {
     window.open("CetakNotaJual/<?php echo $DataPenjualan[0]['Nomor']?>","_blank");
   }
 </script>
