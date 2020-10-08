<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDBarang = $MySQLi->real_escape_string($_POST["ID"]);

       $QueryGetDataBarang = "SELECT Barangs.IDBarang AS IDBarang, Barangs.Nama AS Nama, 
                                Barangs.Tahun AS Tahun, 
                                Barangs.HargaJual AS HargaJual, 
                                Kategoris.Nama AS Merk,
                                Barangs.StatusTerdaftar AS StatusTerdaftar 
                              FROM Barangs 
                                INNER JOIN Kategoris ON Barangs.KategoriID = Kategoris.IDKategori
                              WHERE Barangs.IDBarang = '$IDBarang'";
       $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
       $DataBarang = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
        $DataBarang[] = $Hasil;
       }

      $QueryGetDataKategori = "SELECT Kategoris.Nama AS Nama, Kategoris.IDKategori AS ID 
                               FROM Kategoris";
      $HasilQueryGetDataKategori = mysqli_query($MySQLi, $QueryGetDataKategori);
      $DataKategori = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKategori)) {
        $DataKategori[] = $Hasil;
      }
}
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
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

// function convertToRupiah(objek) {
//    a = objek.value;
//    b = a.replace(/[^\d]/g,"");
//    c = "";
//    panjang = b.length;
//    j = 0;
//    for (i = panjang; i > 0; i--) {
//      j = j + 1;
//      if (((j % 3) == 1) && (j != 1)) {
//        c = b.substr(i-1,1) + "." + c;
//      } else {
//        c = b.substr(i-1,1) + c;
//      }
//    }
//    objek.value = c;
// }

// function convertToAngka(rupiah)
// { 
//   var rupiah = $('#HargaBeli').val();
//   var rupiah = $('#HargaJual').val();
//   return parseInt(rupiah.replace(/,/g, ""));
// }

$('#UbahBarang').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Barang ?",
    function() {
      $("#FormUbahBarang").submit();
      alertify.success('Data Barang Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Barang Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahBarang" method="POST" action="UbahDataBarang" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                      <input type="hidden" name="IDBarang" value="<?php echo $DataBarang[0]['IDBarang']; ?>">
                      <img width="120px" height="160px" src="foto/barang/<?php echo $DataBarang[0]['IDBarang'];?>.jpg">
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Barang:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['IDBarang']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama:</label>
                       <div class="col-md-3">
                            <input type="text" name="Nama" class="form-control" value="<?php echo $DataBarang[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tahun:</label>
                       <div class="col-md-2">
                            <input type="number" name="Tahun" onkeypress = "return isNumberKey(event)" class="form-control" value="<?php echo $DataBarang[0]['Tahun']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Harga Jual (Rp):</label>
                       <div class="col-md-3">
                            <!-- <input type="hidden" id='HargaJual' value="" name="HargaJual"> -->
                            <input type="text" name="HargaJual" style="text-align:right" onkeypress = "return isNumberKey(event)" class="form-control" value="<?php echo $DataBarang[0]['HargaJual']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Merk:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="KategoriID">
                                   <?php
                                   for ($i=0; $i < count($DataKategori) ; $i++) { 
                                        if($DataBarang[0]['Merk'] == $DataKategori[$i]['Nama']) {
                                          echo '<option selected value="'. $DataKategori[$i]['ID'].'">'.$DataKategori[$i]['Nama'].'</option>';
                                        } else {
                                          echo '<option value="'. $DataKategori[$i]['ID'].'">'.$DataKategori[$i]['Nama'].'</option>';
                                        }
                                   }                                   
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataBarang[0]['StatusTerdaftar'] == 1) {
                                          echo '<option selected value="1">Tersedia</option>';
                                          echo '<option value="0">Kosong</option>';
                                   } else {
                                          echo '<option value="1">Tersedia</option>';
                                          echo '<option selected value="0">Kosong</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-5 control-label">Foto:</label>
                     <div class="col-md-5">
                           <input type="file" class="fileinput" id="FotoBarang" name="FotoBarang"/>
                     </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahBarang" name="BtnEditBarang" value="Ubah" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>
