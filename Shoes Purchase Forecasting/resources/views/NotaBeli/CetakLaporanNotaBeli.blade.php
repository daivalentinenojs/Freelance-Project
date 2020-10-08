<?php


?>
<h1>Laporan Pesan Pembelian Periode :</h1>

<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                     <th style="text-align:center; border-style: solid;">Baris</th>
                      <th style="text-align:center; border-style: solid;">Nomor Nota</th>
                      <th style="text-align:center; border-style: solid;">Tanggal Beli</th>
                      <th style="text-align:center; border-style: solid;">Nama Sepatu</th>
                      <th style="text-align:center; border-style: solid;">Supplier</th>
                       <th style="text-align:center; border-style: solid;">Karyawan</th>
                       <th style="text-align:center; border-style: solid;">Jumlah</th>
                       <th style="text-align:center; border-style: solid;">Harga Beli</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $BarisLaporan[0]['Baris']; $i++){
                        $j = $i+1;
                        $TanggalBeli = $DataDetailSepatu[$i]['TanggalBeli'];
                        $TanggalBeliBaru = date("d-m-Y", strtotime($TanggalBeli));
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$j."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['NomorNota']."</td>";
                        echo "<td style='border-style: solid;'>".$TanggalBeliBaru."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['NamaBarang']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Supplier']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Karyawan']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Jumlah']."</td>";
                        echo "<td style='border-style: solid;'> Rp ".formatMoney($DataDetailSepatu[$i]['HargaBeli'])."</td></tr>";
                      }
                      echo "<tr style='text-align:center;'><td colspan='7' style='border-style: solid;'>"."Total Harga"."</td>";
                      echo "<td style='border-style: solid;'> Rp ".formatMoney($Total[0]['Total'])."</td></tr>";
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
