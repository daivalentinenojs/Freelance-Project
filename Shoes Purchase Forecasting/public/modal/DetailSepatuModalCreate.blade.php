<?php
  require '../../connection/Init.php';
  $MySQLi = mysqli_connect($domain, $username, $password, $database);

  $QueryGetSepatu = "SELECT MerekSepatu.ID as 'ID', MerekSepatu.Nama as 'NamaSepatu' From Mereksepatu where MerekSepatu.idDelete = 1";
  $HasilQueryGetDataSepatu = mysqli_query($MySQLi, $QueryGetSepatu);
  $DataSepatu = array();
  while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSepatu)) {
   $DataSepatu[] = $Hasil;
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

  $QueryGetDataUkuran = "SELECT sob.ID as 'ID', sob.Nama as 'Sizesepatu' From SizeOrBox sob Where sob.isDelete = 1";
  $HasilQueryGetDataUkuran = mysqli_query($MySQLi, $QueryGetDataUkuran);
  $DataUkuran = array();
  while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataUkuran)) {
   $DataUkuran[] = $Hasil;
  }


?>
<form class="form-horizontal" id="FormTambahSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/perusahaan.png"-->
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Tipe</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="TipeSepatu">
                               <?php
                                 for($i=0; $i<count($DataTipe); $i++){
                                   echo "<option value='".$DataTipe[$i]['ID']."'>".$DataTipe[$i]['Merek'].' '.$DataTipe[$i]['Tipe']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Warna</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="WarnaSepatu">
                               <?php
                                 for($i=0; $i<count($DataWarna); $i++){
                                   echo "<option value='".$DataWarna[$i]['ID']."'>".$DataWarna[$i]['Warna']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <div class="form-group">
                      <label class="col-md-3 control-label">Jenis Ukuran</label>
                      <div class="col-md-5">
                             <select class="form-control select" name="JenisUkuran">
                               <?php
                                 for($i=0; $i<count($DataUkuran); $i++){
                                   echo "<option value='".$DataUkuran[$i]['ID']."'>".$DataUkuran[$i]['Sizesepatu']."</option>";
                                 }
                               ?>
                             </select>
                      </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Stok</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" Required placeholder="Stok" name="StokSepatu" value="" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Harga Beli</label>
                       <div class="col-md-7">
                            <input type="hidden" name="HargaBeliSepatu" id='harga1' value="">
                            <input type="text" onkeyup='KomaBeli(this)' class="form-control" Required placeholder="Harga Beli" name="" id="Hasil1" value="" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Harga Jual</label>
                       <div class="col-md-7">
                            <input type="hidden" name="HargaJualSepatu" id='hargajual1' value="">
                            <input type="text" onkeyup='KomaJual(this)' class="form-control" Required placeholder="Harga Jual" name="" id="HasilJual1" value="" style="background:white; color:black;" onkeypress="return isNumber(event)"/>
                       </div>
                 </div>

                 <div class="form-group">
                       <label class="col-md-3 control-label">Keterangan</label>
                       <div class="col-md-7">
                            <input type="textarea" class="form-control" Required placeholder="Keterangan Sepatu" name="KeteranganSepatu" value="" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateSepatu" value="Tambah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
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

function KomaBeli(param){
  var sum = param.value;
  var id = param.id;
  var nomor = id.split('Hasil');

  if(sum!= 0){
    sums = parseFloat(sum.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#Hasil'+nomor[1]).val(sums);
    $('#harga'+nomor[1]).val(sums.replace(/,/g, ""));
    //alert($('#harga'+nomor[1]).val());
  }
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
