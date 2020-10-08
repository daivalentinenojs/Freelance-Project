<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if (!empty($IDFP)) {
		// $QueryGetDesa = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', Pemohon.IDDesa AS 'IDDesa'
		// 					FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
		// 					WHERE FormulirPermohonan.ID = '$IDFP'";
		// $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDesa);
		// $DataDesa = array();
		// while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
		// 	$DataDesa[] = $Hasil;
		// }
		//
		// $IDDesa = $DataDesa[0]['IDDesa'];

		$QueryGetKodeDi306 = "SELECT COUNT(BerkasPermohonan.KodeDi306) AS 'KodeDi306'
							FROM BerkasPermohonan
							WHERE BerkasPermohonan.KodeDi306 != ''";
		$HasilQueryGetDataKodeDi306 = mysqli_query($MySQLi, $QueryGetKodeDi306);
		$DataKodeDi306 = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKodeDi306)) {
			$DataKodeDi306[] = $Hasil;
		}

		$RunningNumber =  $DataKodeDi306[0]['KodeDi306'] + 1;
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
		$KodeDi306 = $SRunningNumber.'/'.date("Y");
	}
	mysqli_close($MySQLi);
}

if (!empty($KodeDi306)) {
	echo '<input type="text" name="KodeDi306" value="'.$KodeDi306.'" class="form-control" id="KodeDi306" >';
?>
<?php } ?>
