<h1 style="text-align:center">Stok Opname UD Harmonis Motor</h1>
<table>
  <tr>
    <td>Nomor Nota Stok Opname:</td>
    <td><?php echo $DataStokO[0]['NoNotaStokOpname']; ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Tanggal:</td>
    <td><?php echo $DataStokO[0]['Tanggal']; ?></td>
  </tr>  
  <tr>
    <td>Nama Karyawan:</td>
    <td><?php echo $DataStokO[0]['Nama']; ?></td>
  </tr>
</table>
<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                       <th style="text-align:center; border-style: solid;" width="3%">Kode Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Nama Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Stok Database</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Jumlah Selisih</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Alasan</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$DataDetailStokOpname[$i]['BarangID']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailStokOpname[$i]['Nama']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailStokOpname[$i]['StokDB']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailStokOpname[$i]['JumlahSelisih']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailStokOpname[$i]['Alasan']."</td></tr>";
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