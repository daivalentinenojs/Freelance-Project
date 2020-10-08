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

		$QueryGetKodeDi301 = "SELECT COUNT(BerkasPermohonan.KodeDi301) AS 'KodeDi301'
							FROM BerkasPermohonan
							WHERE BerkasPermohonan.KodeDi301 != ''";
		$HasilQueryGetDataKodeDi301 = mysqli_query($MySQLi, $QueryGetKodeDi301);
		$DataKodeDi301 = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKodeDi301)) {
			$DataKodeDi301[] = $Hasil;
		}

		$RunningNumber =  $DataKodeDi301[0]['KodeDi301'] + 1;
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
		$KodeDi301 = $SRunningNumber.'/'.date("Y");
	}
	mysqli_close($MySQLi);
}

if (!empty($KodeDi301)) {
	echo '<input type="text" name="KodeDi301" value="'.$KodeDi301.'" class="form-control" id="KodeDi301" >';
?>
<?php } ?>
