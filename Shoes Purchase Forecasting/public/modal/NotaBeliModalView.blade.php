<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDNota = $MySQLi->real_escape_string($_POST["ID"]);
       $QueryGetDataPesanPembelian= "SELECT pp.Nomor AS 'Nomor', pp.Tanggal AS 'Tanggal', s.Nama AS 'Supplier', u.Nama AS 'Karyawan',
     	pp.Total as 'Total', pp.Status as 'Status', pp.Nomor as 'View', pp.Nomor as 'Edit' FROM PesanPembelian pp, Supplier s, User u
     	Where pp.SupplierID = s.id and pp.UserID = u.IDUser and pp.Nomor = '$IDNota'";
       $HasilQueryGetDataPesanPembelian = mysqli_query($MySQLi, $QueryGetDataPesanPembelian);
       $DataPesanPembelian = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPesanPembelian)) {
         $DataPesanPembelian[] = $Hasil;
       }

       $QueryGetDataDetailSepatu= "SELECT ds.ID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', w.Nama as 'Warna', sob.Nama as 'Ukuran', dspp.Jumlah as 'Jumlah', dspp.harga as 'Harga'
       FROM detailsepatucatatpesanpembelian dspp, detailsepatu ds, mereksepatu ms, tipe t, warna w, sizeorbox sob, pesanpembelian pp
       WHERE dspp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and ds.WarnaID = w.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and pp.Nomor = dspp.PembelianID and dspp.PembelianID  = '$IDNota'";
       $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
       $DataDetailSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
         $DataDetailSepatu[] = $Hasil;
       }

       $QueryGetDatabaris= "SELECT COUNT(dspp.PembelianID) as baris FROM detailsepatucatatpesanpembelian dspp WHERE dspp.PembelianID = '$IDNota'";
       $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
       $Databaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
         $Databaris[] = $Hasil;
       }

       if($DataPesanPembelian[0]['Status'] == 0)
          $Status = "Belum Datang";
       else
          $Status = "Sudah Datang";

      $TanggalBeli = $DataPesanPembelian[0]['Tanggal'];
      $TanggalBeliBaru = date("d-m-Y", strtotime($TanggalBeli));
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
                       <label class="col-md-3 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataPesanPembelian[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $TanggalBeliBaru; ?>" readonly style="background:white; color:black;"/>
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
                       <label class="col-md-3 control-label">Total</label>
                       <div class="col-md-6">
                             <input type="text" class="form-control" value="<?php echo "Rp ".formatMoney($DataPesanPembelian[0]['Total']); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $Status; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>

                 <div class="form-group">
                   <table class="table table-bordered">
                   <thead ><tr>
                      <!--th style="text-align:center" width="5%">Nomor</th-->
                      <th style="text-align:center" width="5%">Kode Barang</th>
                       <th style="text-align:center" width="10%">Nama Sepatu</th>
                       <th style="text-align:center" width="10%">Jumlah</th>
                       <th style="text-align:center" width="10%">Harga</th>
                   </tr></thead>

                    <?php
                    //print_r($Databaris);
                      for($i = 0; $i < $Databaris[0]['baris']; $i++){
                        $j = $i+1;
                        //echo "<tr style='text-align:center'><td>".$j."</td>";
                        echo "<td>".$DataDetailSepatu[$i]['ID']."</td>";
                        echo "<td>".$DataDetailSepatu[$i]['Merek']." ".$DataDetailSepatu[$i]['Tipe']." ".$DataDetailSepatu[$i]['Warna']." ".$DataDetailSepatu[$i]['Ukuran']."</td>";
                        echo "<td>".$DataDetailSepatu[$i]['Jumlah']."</td>";
                        echo "<td> Rp ".formatMoney($DataDetailSepatu[$i]['Harga'])."</td></tr>";
                      }

                     ?>
                 </div>

                 <div class="form-group" style="text-align:center;">
                        <button type="button" id="buttonPrint" onclick="printData();" class="btn btn-info">Print</button>
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
     window.open("CetakNotaBeli/<?php echo $DataPesanPembelian[0]['Nomor']?>","_blank");
   }
 </script>
