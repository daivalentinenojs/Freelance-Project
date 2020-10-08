<?php
if($DataPesanan[0]['Status'] == 0)
   $Status = "Belum Dikirm";
else
   $Status = "Sudah Dikirm";

$TanggalPesan = $DataPesanan[0]['Tanggal'];
$TanggalPesanBaru = date("d-m-Y", strtotime($TanggalPesan));
?>
<h1>Nota Pesan PT "X"</h1>
<table>
  <tr>
    <td>Nomor Nota</td>
    <td><?php echo $DataPesanan[0]['Nomor']; ?></td>
  </tr>
  <tr>
    <td>Tanggal Pesan</td>
    <td><?php echo $TanggalPesanBaru; ?></td>
  </tr>
  <tr>
    <td>Pelanggan</td>
    <td><?php echo $DataPesanan[0]['Pelanggan']; ?></td>
  </tr>
  <tr>
    <td>Karyawan</td>
    <td><?php echo $DataPesanan[0]['Karyawan']; ?></td>
  </tr>
  <tr>
    <td>Status Barang</td>
    <td><?php echo $Status; ?></td>
  </tr>
</table>
<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                      <th style="text-align:center; border-style: solid;" width="5%">Nomor</th>
                       <th style="text-align:center; border-style: solid;" width="10%">Nama Sepatu</th>
                       <th style="text-align:center; border-style: solid;" width="10%">Jumlah</th>
                       <th style="text-align:center; border-style: solid;" width="10%">Harga</th>
                   </tr></thead>

                    <?php
                    //print_r($Databaris);
                      for($i = 0; $i < $Databaris[0]['baris']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$j."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Merek']." ".$DataDetailSepatu[$i]['Tipe']." ".$DataDetailSepatu[$i]['Warna']." ".$DataDetailSepatu[$i]['Ukuran']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Jumlah']."</td>";
                        echo "<td style='border-style: solid;'> Rp ".formatMoney($DataDetailSepatu[$i]['Harga'])."</td></tr>";
                      }
                      echo "<tr style='text-align:center;'><td colspan='3' style='border-style: solid;'>"."Total Harga"."</td>";
                      echo "<td style='border-style: solid;'> Rp ".formatMoney($DataPesanan[0]['Total'])."</td></tr>";
                     ?>
                 </div>


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
    window.print();
</script>
