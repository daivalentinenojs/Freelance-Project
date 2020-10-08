<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if (!empty($IDFP)) {
		$QueryGetNomorSuratTugasUkur = "SELECT COUNT(GambarUkur.Nomor) AS 'NomorSuratTugasUkur'
							FROM GambarUkur";
		$HasilQueryGetDataNomorSuratTugasUkur = mysqli_query($MySQLi, $QueryGetNomorSuratTugasUkur);
		$DataNomorSuratTugasUkur = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNomorSuratTugasUkur)) {
			$DataNomorSuratTugasUkur[] = $Hasil;
		}

		$RunningNumber =  $DataNomorSuratTugasUkur[0]['NomorSuratTugasUkur'] + 1;
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
		$NomorSuratTugasUkur = $SRunningNumber.'/'.date("Y");
	}
	mysqli_close($MySQLi);
}

if (!empty($NomorSuratTugasUkur)) {
	echo '<input type="text" readonly style="background:white; color:black;" name="NomorSuratTugasUkur" value="'.$NomorSuratTugasUkur.'" class="form-control" required id="NomorSuratTugasUkur" onkeypress="return isNumberKey(event)">';
?>
<?php } ?>
