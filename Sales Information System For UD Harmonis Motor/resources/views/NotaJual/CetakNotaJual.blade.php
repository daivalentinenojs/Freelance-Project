<h1 style="text-align:center">Nota Jual UD Harmonis Motor</h1>
<table>
  <tr>
    <td>Nomor Nota Jual:</td>
    <td><?php echo $DataNotaJ[0]['NoNotaJual']; ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Tanggal Buat:</td>
    <td><?php echo $DataNotaJ[0]['TanggalBuat']; ?></td>
  <tr>
    <td>Total Akhir (Rp):</td>
    <td><?php echo formatMoney($DataNotaJ[0]['TotalAkhir']); ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Jatuh Tempo:</td>
    <td><?php echo $DataNotaJ[0]['TanggalBayar']; ?></td>
  </tr>
  <tr>
    <td>Nama Pembeli:</td>
    <td><?php echo $DataNotaJ[0]['NamaPembeli']; ?></td>
  </tr>
  <tr>
    <td>Kota:</td>
    <td><?php echo $DataNotaJ[0]['Kota']; ?></td>
  </tr>
  <tr>
    <td>Bank:</td>
    <td><?php echo $DataNotaJ[0]['Bank']; ?></td>
  </tr>
  <tr>
    <td>Bank:</td>
    <td><?php echo $DataNotaJ[0]['NamaKaryawan']; ?></td>
  </tr>
  <tr>
    <td>Status Jual:</td>
    <td><?php echo $DataNotaJ[0]['StatusJual']; ?></td>
  </tr>
</table>
<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                       <th style="text-align:center; border-style: solid;" width="3%">Kode Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Nama Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Kuantiti</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Harga Jual (Rp)</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Sub Total (Rp)</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$DataDetailNotaJual[$i]['BarangID']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailNotaJual[$i]['Nama']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailNotaJual[$i]['Kuantiti']."</td>";
                        echo "<td style='border-style: solid;'>".formatMoney($DataDetailNotaJual[$i]['HargaJual'])."</td>";
                        echo "<td style='border-style: solid;'>".formatMoney($DataDetailNotaJual[$i]['SubTotal'])."</td></tr>";
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