<h1>Laporan Keuangan Periode :</h1>


<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                      <th style="text-align:center; border-style: solid;">Nomor</th>
                      <th style="text-align:center; border-style: solid;">Total Pengeluaran (Rp)</th>
                      <th style="text-align:center; border-style: solid;">Total Pendapatan (Rp)</th>
                      <th style="text-align:center; border-style: solid;">Laba / Rugi (Rp)</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $BarisLaporan[0]['Baris']; $i++){
                        $j = $i+1;
                        // $TanggalBeli = $DataDetailSepatu[$i]['TanggalBeli'];
                        // $TanggalBeliBaru = date("d-m-Y", strtotime($TanggalBeli));
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$j."</td>";
                        echo "<td style='border-style: solid;'>".$Pengeluaran[$i]['Pengeluaran']."</td>";
                        echo "<td style='border-style: solid;'>".$NotaJual[$i]['Total']."</td>";
                        echo "<td style='border-style: solid;'>".$LabaRugi."</td>";
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
