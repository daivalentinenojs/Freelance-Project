<?php
if(isset($_POST["ID"]))
{
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDPengeluaran = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataPengeluaran = "SELECT Pengeluarans.IDPengeluaran AS IDPengeluaran, 
                                    Pengeluarans.Tanggal AS Tanggal, 
                                    Pengeluarans.Nama AS Nama, 
                                    Pengeluarans.Nominal AS Nominal, 
                                    Pengeluarans.Keterangan AS Keterangan,
                                    Pengeluarans.StatusTerdaftar AS StatusTerdaftar, 
                                    Karyawans.Nama AS NamaKaryawan,
                                    Pengeluarans.IDPengeluaran AS Detail, 
                                    Pengeluarans.IDPengeluaran AS Ubah
                                   FROM Pengeluarans INNER JOIN Karyawans ON 
                                    Pengeluarans.KaryawanID = Karyawans.IDKaryawan
                                   WHERE Pengeluarans.IDPengeluaran = '$IDPengeluaran'";
       $HasilQueryGetDataPengeluaran = mysqli_query($MySQLi, $QueryGetDataPengeluaran);
       $DataPengeluaran = array();

       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPengeluaran)) {
        $DataPengeluaran[] = $Hasil;
       }

       if ($DataPengeluaran[0]['StatusTerdaftar'] == 1) {
              $StatusTerdaftar = "Aktif";
       } else {
              $StatusTerdaftar = "Tidak Aktif";
       }

      $QueryGetDataKaryawan = "SELECT Karyawans.Nama AS Nama, Karyawans.IDKaryawan AS ID 
                               FROM Karyawans";
      $HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
      $DataKaryawan = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
        $DataKaryawan[] = $Hasil;
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

function convertToRupiah(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}

function convertToAngka(rupiah)
{ 
  var rupiah;
  return parseInt(rupiah.replace(/,/g, ""));
}

$('#UbahPengeluaran').click(function () {
    alertify.confirm("Apakah Anda Yakin Ingin Mengubah Data Pengeluaran ?",
    function() {
      $("#FormUbahPengeluaran").submit();
      alertify.success('Data Pengeluaran Anda telah disimpan');
    }, 
    function(){
      alertify.error('Proses Menyimpan Data Pengeluaran Anda dibatalkan');
    });
});
</script>

<form class="form-horizontal" id="FormUbahPengeluaran" method="POST" action="UbahDataPengeluaran">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                    <input type="hidden" name="IDPengeluaran" value="<?php echo $DataPengeluaran[0]['IDPengeluaran']; ?>">
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">ID Pengeluaran:</label>
                       <div class="col-md-2">
                            <input type="text" class="form-control" value="<?php echo $DataPengeluaran[0]['IDPengeluaran']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Tanggal:</label>
                       <div class="col-md-4">
                            <input type="date" name="Tanggal" class="form-control" value="<?php echo $DataPengeluaran[0]['Tanggal']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nama:</label>
                       <div class="col-md-4">
                            <input type="text" name="Nama" class="form-control" value="<?php echo $DataPengeluaran[0]['Nama']; ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Nominal (Rp):</label>
                       <div class="col-md-4">
                            <!-- <input type="hidden" id='Nominal' onkeyup="convertToAngka(this)" value="" name="Nominal"> -->
                            <input type="text" name="Nominal" class="form-control" style="text-align:right" onkeypress = "return isNumberKey(event)" value="<?php echo formatMoney($DataPengeluaran[0]['Nominal']); ?>" style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-5 control-label">Keterangan:</label>
                       <div class="col-md-4">
                            <textarea name="Keterangan" class="form-control" value="" style="background:white; color:black;"><?php echo $DataPengeluaran[0]['Keterangan']; ?></textarea>
                       </div>
                 </div>
                 <div class="form-group">
                      <label class="col-md-5 control-label">Status Terdaftar:</label>
                      <div class="col-md-3">
                            <select class="form-control select" data-live-search="true" name="StatusTerdaftar">
                                   <?php
                                   if($DataPengeluaran[0]['StatusTerdaftar'] == 1) {
                                          echo '<option selected value="1">Aktif</option>';
                                          echo '<option value="0">Tidak Aktif</option>';
                                   } else {
                                          echo '<option value="1">Aktif</option>';
                                          echo '<option selected value="0">Tidak Aktif</option>';
                                   }
                                   ?>
                            </select>
                      </div>
                 </div>
                 <div class="form-group" style="text-align:center;">
                      <input type="button" id="UbahPengeluaran" name="BtnEditPengeluaran" value="Ubah" onclick="convertToAngka(nominal)" class="btn btn-warning">
                 </div>
             </div>
        </div>
</div>
</form>