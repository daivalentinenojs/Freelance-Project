<?php
if(isset($_POST["ID"]))
{
       require '../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDDetailSepatu = $MySQLi->real_escape_string($_POST["ID"]);;
       $QueryGetDataDetailSepatu= "SELECT ds.ID AS 'Nomor', t.Nama AS 'Tipe', m.Nama AS 'Merek', ds.Stok AS 'Stok', ds.HargaBeliTerakhir AS 'HargaBeli', ds.HargaJual AS 'HargaJual',
     	w.Nama AS 'Warna', ds.isDelete AS 'isDelete', ds.Keterangan AS 'Keterangan',sob.Nama AS 'JenisUkuran', ds.ID AS 'View', ds.ID AS 'Edit'
     	FROM DetailSepatu ds,  Mereksepatu m, Warna w, Tipe t, SizeOrBox sob Where t.ID = ds.TipeID and t.MereksepatuID = m.ID  and w.ID = ds.WarnaID and ds.SizeOrBoxID = sob.ID and ds.ID = '$IDDetailSepatu'";
       $HasilQueryGetDataDetailSepatu = mysqli_query($MySQLi, $QueryGetDataDetailSepatu);
       $DataDetailSepatu = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDetailSepatu)) {
       	$DataDetailSepatu[] = $Hasil;
       }

       if($DataDetailSepatu[0]['isDelete'] == 1)
              $isDelete = "Aktif";
       else if($DataDetailSepatu[0]['isDelete'] == 0)
              $isDelete = "Tidak Aktif";
}
?>

<form class="form-horizontal" id="FormDetailSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/perusahaan.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">ID</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetailSepatu[0]['Nomor']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Tipe</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetailSepatu[0]['Merek'].' '.$DataDetailSepatu[0]['Tipe']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Warna</label>
                      <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetailSepatu[0]['Warna']; ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Jenis Ukuran</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetailSepatu[0]['JenisUkuran']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Harga Beli Terakhir</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo 'Rp '.formatMoney($DataDetailSepatu[0]['HargaBeli']); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Harga_Jual</label>
                      <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo 'Rp '.formatMoney($DataDetailSepatu[0]['HargaJual']); ?>" readonly style="background:white; color:black;"/>
                      </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Stok</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataDetailSepatu[0]['Stok']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Keterangan</label>
                       <div class="col-md-6">
                            <input type="textarea" class="form-control" value="<?php echo $DataDetailSepatu[0]['Keterangan']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $isDelete; ?>" readonly style="background:white; color:black;"/>
                      </div>
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
