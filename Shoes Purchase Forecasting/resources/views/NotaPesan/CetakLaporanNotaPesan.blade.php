<?php


?>
<h1>Laporan Pemesanan Periode :</h1>

<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                     <th style="text-align:center; border-style: solid;">Baris</th>
                      <th style="text-align:center; border-style: solid;">Nomor Nota</th>
                      <th style="text-align:center; border-style: solid;">Tanggal Pesan</th>
                      <th style="text-align:center; border-style: solid;">Nama Sepatu</th>
                      <th style="text-align:center; border-style: solid;">Nama Toko Pemesan</th>
                       <th style="text-align:center; border-style: solid;">Karyawan</th>
                       <th style="text-align:center; border-style: solid;">Jumlah</th>

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
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['NamaToko']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Karyawan']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailSepatu[$i]['Jumlah']."</td></tr>";
                      }
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
