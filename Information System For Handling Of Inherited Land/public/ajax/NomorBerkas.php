<?php
require '../../connection/Init.php';
$MySQLi = mysqli_connect($domain, $username, $password, $database);

$QueryGetNomor = "SELECT COUNT(BerkasPermohonan.Nomor) AS 'Nomor'
					FROM BerkasPermohonan";
$HasilQueryGetDataNomor = mysqli_query($MySQLi, $QueryGetNomor);
$DataNomor = array();
while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNomor)) {
	$DataNomor[] = $Hasil;
}

$RunningNumber =  $DataNomor[0]['Nomor'] + 1;
$SRunningNumber = '';
if ($RunningNumber < 10) {
	$SRunningNumber = '0000'.$RunningNumber;
} else if ($RunningNumber < 100) {
	$SRunningNumber = '000'.$RunningNumber;
} else if ($RunningNumber < 1000) {
	$SRunningNumber = '00'.$RunningNumber;
} else if ($RunningNumber < 10000) {
	$SRunningNumber = '0'.$RunningNumber;
}
$Nomor = $SRunningNumber.'/'.date("Y");

mysqli_close($MySQLi);

if (!empty($Nomor)) {
	echo '<input type="text" name="NomorWarkah" value="'.$Nomor.'"  style="color:black; background-color:white;" readonly class="form-control" required id="NomorWarkah" onkeypress="return isNumberKey(event)" >';

?>
<?php } ?>
