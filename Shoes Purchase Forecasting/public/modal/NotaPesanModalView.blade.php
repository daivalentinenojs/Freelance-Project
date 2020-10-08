<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDNota = $MySQLi->real_escape_string($_POST["ID"]);
       $QueryGetDataPesanan= "SELECT p.Nomor AS 'Nomor', p.Tanggal AS 'Tanggal', c.NamaToko AS 'Pelanggan', u.Nama AS 'Karyawan',
     	p.Total as 'Total', p.Status as 'Status', p.Nomor as 'View' FROM Pemesanan p, Customer c, User u
     	Where p.CustomerID = c.id and p.UserID = u.IDUser and p.Nomor = '$IDNota'";
       $HasilQueryGetDataPesanan = mysqli_query($MySQLi, $QueryGetDataPesanan);
       $DataPesanan = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPesanan)) {
         $DataPesanan[] = $Hasil;
       }

       $QueryGetDataDetailSepatu= "SELECT dspp.PemesananID as 'ID', ms.Nama as 'Merek', t.Nama as 'Tipe', w.Nama as 'Warna', sob.Nama as 'Ukuran', dspp.Jumlah as 'Jumlah', ds.HargaJual as 'Harga'
       FROM detailsepatucatatpemesanan dspp, detailsepatu ds, mereksepatu ms, tipe t, warna w, sizeorbox sob, pemesanan pp
       WHERE dspp.DetailSepatuID = ds.ID and ds.TipeID = t.ID and ds.WarnaID = w.ID and t.MerekSepatuID = ms.ID and ds.SizeorBoxID = sob.ID and pp.Nomor = dspp.PemesananID and dspp.PemesananID  = '$IDNota'";
       $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
       $DataDetailSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
         $DataDetailSepatu[] = $Hasil;
       }

       $QueryGetDatabaris= "SELECT COUNT(dspp.PemesananID) as baris FROM detailsepatucatatpemesanan dspp WHERE dspp.PemesananID = '$IDNota'";
       $HasilQueryGetDatabaris = mysqli_query($MySQLi, $QueryGetDatabaris);
       $Databaris = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDatabaris)) {
         $Databaris[] = $Hasil;
       }

       if($DataPesanan[0]['Status'] == 0)
          $Status = "Belum Dikirim";
       else
          $Status = "Sudah Dikirim";

      $TanggalPesan = $DataPesanan[0]['Tanggal'];
      $TanggalPesanBaru = date("d-m-Y", strtotime($TanggalPesan));

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
                   <table class="table table-bordered">
                   <thead ><tr>
                      <!--th style="text-align:center" width="5%">Nomor</th-->
                      <th style="text-align:center" width="5%">Kode Barang</th>
                       <th style="text-align:center" width="10%">Nama Sepatu</th>
                       <th style="text-align:center" width="10%">Jumlah</th>
                       <th style="text-align:center" width="10%">Harga Jual</th>
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

                 <div class="form-group">
                       <label class="col-md-3 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataPesanan[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tanggal</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $TanggalPesanBaru; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Pelanggan</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPesanan[0]['Pelanggan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Karyawan</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataPesanan[0]['Karyawan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Total</label>
                       <div class="col-md-6">
                             <input type="text" class="form-control" value="<?php echo "Rp ".formatMoney($DataPesanan[0]['Total']); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $Status; ?>" readonly style="background:white; color:black;"/>
                      </div>
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
     window.open("CetakNotaPesan/<?php echo $DataPesanan[0]['Nomor']?>","_blank");
   }
 </script>
