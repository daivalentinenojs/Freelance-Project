<h1 style="text-align:center">Retur Jual UD Harmonis Motor</h1>
<table>
  <tr>
    <td>Nomor Retur Jual:</td>
    <td><?php echo $DataReturJ[0]['IDReturJual']; ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Tanggal Buat:</td>
    <td><?php echo $DataReturJ[0]['Tanggal']; ?></td>
  </tr>
  <tr>
    <td>Nama Karyawan:</td>
    <td><?php echo $DataReturJ[0]['NamaKaryawan']; ?></td>
  </tr>
</table>
<?php echo "<br>"; ?>
<div class="form-group">
                   <table class="table table-bordered" style="border-style: solid;">
                   <thead ><tr>
                       <th style="text-align:center; border-style: solid;" width="3%">Kode Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Barang Asal</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Kuantiti</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Kode Barang</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Barang Ganti</th>
                       <th style="text-align:center; border-style: solid;" width="3%">Kuantiti</th>
                   </tr></thead>

                    <?php
                      for($i = 0; $i < $DataBaris[0]['Baris']; $i++){
                        $j = $i+1;
                        echo "<tr style='text-align:center;'><td style='border-style: solid;'>".$DataDetailReturJual[$i]['BarangID']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailReturJual[$i]['Nama']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailReturJual[$i]['KuantitiBarangAsal']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailReturJual[$i]['BarangID']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailReturJual[$i]['Nama']."</td>";
                        echo "<td style='border-style: solid;'>".$DataDetailReturJual[$i]['KuantitiBarangGanti']."</td></tr>";
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