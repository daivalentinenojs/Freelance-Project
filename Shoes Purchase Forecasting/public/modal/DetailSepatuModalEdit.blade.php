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

       $QueryGetDataTipe = "SELECT tp.ID as 'ID', tp.Nama as 'Tipe', ms.Nama as 'Merek' From Tipe tp, mereksepatu ms
       Where tp.MerekSepatuID = ms.ID and tp.isDelete = 1";
       $HasilQueryGetDataTipe = mysqli_query($MySQLi, $QueryGetDataTipe);
       $DataTipe = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataTipe)) {
        $DataTipe[] = $Hasil;
       }

       $QueryGetDataWarna = "SELECT Warna.ID as 'ID', Warna.Nama as 'Warna' From Warna Where Warna.isDelete = 1";
       $HasilQueryGetDataWarna = mysqli_query($MySQLi, $QueryGetDataWarna);
       $DataWarna = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataWarna)) {
        $DataWarna[] = $Hasil;
       }

       $QueryGetDataUkuran = "SELECT SizeOrBox.ID as 'ID', SizeOrBox.Nama as 'SizeOrBox' From SizeOrBox Where SizeOrBox.isDelete = 1";
       $HasilQueryGetDataUkuran = mysqli_query($MySQLi, $QueryGetDataUkuran);
       $DataUkuran = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUkuran)) {
        $DataUkuran[] = $Hasil;
       }
}
?>

<form class="form-horizontal" id="FormTambahDetailSepatu" method="POST" action="UbahDataDetailSepatu">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/perusahaan.png"-->
                 </div>

                 <input type="hidden" name="IDDetailSepatu" value="<?php echo $DataDetailSepatu[0]['Nomor']; ?>">
                 <div class="form-group">
                      <label class="col-md-3 control-label">Tipe</label>
                      <div class="col-md-7">
                             <select class="form-control select" name="TipeSepatu">
                               <?php
                                 for($i=0; $i<count($DataTipe); $i++){
                                   if($DataTipe[$i]['Tipe'] == $DataDetailSepatu[0]['Tipe'])
                                      echo "<option selected value='".$DataTipe[$i]['ID']."'>".$DataTipe[$i]['Merek'].' '.$DataTipe[$i]['Tipe']."</option>";
                                   else
                                     echo "<option value='".$DataTipe[$i]['ID']."'>".$DataTipe[$i]['Merek'].' '.$DataTipe[$i]['Tipe']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Warna</label>
                      <div class="col-md-7">
                             <select class="form-control select" name="WarnaSepatu">
                               <?php
                                 for($i=0; $i<count($DataWarna); $i++){
                                   if($DataWarna[$i]['Warna'] == $DataDetailSepatu[0]['Warna'])
                                      echo "<option selected value='".$DataWarna[$i]['ID']."'>".$DataWarna[$i]['Warna']."</option>";
                                   else
                                     echo "<option value='".$DataWarna[$i]['ID']."'>".$DataWarna[$i]['Warna']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Jenis Ukuran</label>
                      <div class="col-md-7">
                             <select class="form-control select" name="JenisUkuran">
                               <?php
                                 for($i=0; $i<count($DataUkuran); $i++){
                                   if($DataUkuran[$i]['SizeOrBox'] == $DataDetailSepatu[0]['JenisUkuran'])
                                      echo "<option selected value='".$DataUkuran[$i]['ID']."'>".$DataUkuran[$i]['SizeOrBox']."</option>";
                                   else
                                     echo "<option value='".$DataUkuran[$i]['ID']."'>".$DataUkuran[$i]['SizeOrBox']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <!--div class="form-group">
                       <label class="col-md-3 control-label">Harga Beli Terakhir</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Nama Sepatu" name="HargaBeliSepatu" value="<!?php echo $DataDetailSepatu[0]['HargaBeli']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div-->

                 <div class="form-group">
                       <label class="col-md-3 control-label">Harga Jual</label>
                       <div class="col-md-7">
                            <input type="hidden" name="HargaJualSepatu" id='hargajual1' value="">
                            <input type="text" onkeyup='KomaJual(this)' class="form-control" Required placeholder="Harga Jual" name="" id="HasilJual1" value="<?php echo formatMoney($DataDetailSepatu[0]['HargaJual']); ?>" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Keterangan</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" Required placeholder="Keterangan" name="KeteranganSepatu" value="<?php echo $DataDetailSepatu[0]['Keterangan']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Status</label>
                      <div class="col-md-7">
                             <select class="form-control select" name="isDelete">
                                    <?php
                                    if($DataDetailSepatu[0]['isDelete'] == 1) {
                                           echo "<option selected value='1'>Aktif</option>";
                                           echo "<option value='0'>Tidak Aktif</option>";
                                    } else {
                                           echo "<option value='1'>Aktif</option>";
                                           echo "<option selected value='0'>Tidak Aktif</option>";
                                    }
                                    ?>
                             </select>
                      </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnEditDetailSepatu" value="Ubah" class="btn btn-warning">
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

<script type="text/javascript">
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      alert("Harus input angka!");
      return false;
  }
  return true;
}

function KomaJual(param){
  var sum = param.value;
  var id = param.id;
  var nomor = id.split('HasilJual');

  if(sum!= 0){
    sums = parseFloat(sum.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#HasilJual'+nomor[1]).val(sums);
    $('#hargajual'+nomor[1]).val(sums.replace(/,/g, ""));
    //alert($('#harga'+nomor[1]).val());
  }
}
</script>
