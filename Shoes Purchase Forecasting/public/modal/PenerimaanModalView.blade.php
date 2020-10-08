<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDNota = $MySQLi->real_escape_string($_POST["ID"]);
       $QueryGetDataPesanPembelian= "SELECT DISTINCT p.Nomor as 'Nomor', p.Tanggal as 'TanggalTerima', s.Nama as 'Supplier', u.Nama as 'Karyawan', p.Total as 'Total', pp.Status as 'Status'
       FROM penerimaan p, detailsepatucatatpenerimaan dscp, supplier s, user u, pesanpembelian pp
       WHERE p.Nomor = dscp.PenerimaanID and pp.SupplierID = s.ID and p.UserID = u.IDUser and p.NomorPesanPembelian = pp.Nomor and p.Nomor = '$IDNota'";
       $HasilQueryGetDataPesanPembelian = mysqli_query($MySQLi, $QueryGetDataPesanPembelian);
       $DataPesanPembelian = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPesanPembelian)) {
         $DataPesanPembelian[] = $Hasil;
       }

       $QueryGetDataDetailSepatu= "SELECT t.Nama as 'Tipe', ms.Nama as 'Merek', sob.Nama as 'Ukuran', w.Nama as 'Warna', dscp.Jumlah as 'Jumlah', dscp.Harga as 'Harga'
       FROM detailsepatu ds, detailsepatucatatpenerimaan dscp, tipe t, warna w, sizeorbox sob, mereksepatu ms
       WHERE ms.ID = t.MerekSepatuID and ds.TipeID = t.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID and dscp.DetailSepatuID = ds.ID and dscp.PenerimaanID = '$IDNota'";
       $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
       $DataDetailSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
         $DataDetailSepatu[] = $Hasil;
       }

       $QueryGetDatabaris= "SELECT COUNT(dspp.PenerimaanID) as baris FROM detailsepatucatatpenerimaan dspp WHERE dspp.PenerimaanID = '$IDNota'";
       $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
       $Databaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
         $Databaris[] = $Hasil;
       }

       if($DataPesanPembelian[0]['Status'] == 0)
          $Status = "Belum Datang";
       else
          $Status = "Sudah Datang";

      $tanggalTerima = $DataPesanPembelian[0]['TanggalTerima'];
      $tanggalTerimaBaru = date("d-m-Y", strtotime($tanggalTerima));

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
                            <input type="text" class="form-control" value="<?php echo $DataPesanPembelian[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal Terima</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $tanggalTerimaBaru; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Supplier</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPesanPembelian[0]['Supplier']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Karyawan</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPesanPembelian[0]['Karyawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Total Harga</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo "Rp ".formatMoney($DataPesanPembelian[0]['Total']); ?>" readonly style="background:white; color:black;"/>
                       </div>
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
                 <div class="form-group" style="text-align:center;">
                        <button type="button" id="buttonPrint" onclick="printData();" class="btn btn-info">Print</button>
                 </div>
                 <!--button type="button" id="buttonPrint" onclick="printData();" class="btn btn-info">Print</button-->
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
    window.open("CetakNotaTerima/<?php echo $DataPesanPembelian[0]['Nomor']?>","_blank");
  }
</script>
