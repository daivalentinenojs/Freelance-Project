<h1 style="text-align:center">Nota Beli UD Harmonis Motor</h1>
<table>
  <tr>
    <td>Nomor Nota Beli:</td>
    <td><?php echo $DataNotaB[0]['NoNotaBeli']; ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Tanggal Buat:</td>
    <td><?php echo $DataNotaB[0]['TanggalBuat']; ?></td>
  <tr>
    <td>Total Akhir (Rp):</td>
    <td><?php echo formatMoney($DataNotaB[0]['Total']); ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Jatuh Tempo:</td>
    <td><?php echo $DataNotaB[0]['JatuhTempo']; ?></td>
  </tr>
  <tr>
    <td>Nama Pemasok:</td>
    <td><?php echo $DataNotaB[0]['NamaPemasok']; ?></td>
  </tr>
  <tr>
    <td>Nama Karyawan:</td>
    <td><?php echo $DataNotaB[0]['NamaKaryawan']; ?></td>
  </tr>
  <tr>
    <td>Status Beli:</td>
    <td><?php echo $DataNotaB[0]['StatusBeli']; ?></td>
  </tr>
</table>
<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                       <th style="text-align:center; border-style: solid;" width="3%">Kode Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Nama Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Kuantiti</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Harga Beli (Rp)</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Sub Total (Rp)</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$DataDetailNotaBeli[$i]['BarangID']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailNotaBeli[$i]['Nama']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailNotaBeli[$i]['Kuantiti']."</td>";
                        echo "<td style='border-style: solid;'>".formatMoney($DataDetailNotaBeli[$i]['HargaBeli'])."</td>";
                        echo "<td style='border-style: solid;'>".formatMoney($DataDetailNotaBeli[$i]['SubTotal'])."</td></tr>";
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